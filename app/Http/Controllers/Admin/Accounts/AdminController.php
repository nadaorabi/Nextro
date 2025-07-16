<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'admin');

        $totalAdmins = User::where('role', 'admin')->count();
        $activeAdmins = User::where('role', 'admin')->where('is_active', '1')->count();
        $pendingAdmins = User::where('role', 'admin')->where('is_active', '2')->count();
        $blockedAdmins = User::where('role', 'admin')->where('is_active', '0')->count();

        $adminsThisMonth = User::where('role', 'admin')
            ->whereMonth('created_at', now()->month)
            ->count();

        $admins = $query->latest()->paginate(10)->appends($request->all());

        return view('admin.accounts.admin.index', compact(
            'admins',
            'totalAdmins',
            'activeAdmins',
            'pendingAdmins',
            'blockedAdmins',
            'adminsThisMonth'
        ));
    }

    public function create()
    {
        return view('admin.accounts.admin.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'         => 'required|string|max:150',
                'email'        => 'required|email|unique:users,email|max:150',
                'mobile'       => 'required|string|unique:users,mobile|max:15',
                'address'      => 'nullable|string|max:500',
                'notes'        => 'nullable|string|max:1000',
                'is_active'    => 'required|boolean',
            ]);

            $year = now()->format('Y');
            do {
                $randomDigits = rand(1000, 9999);
                $loginId = $year . $randomDigits;
            } while (User::where('login_id', $loginId)->exists());

            $plainPassword = Str::random(8);

            $user = new User();

            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->mobile = $validated['mobile'];
            $user->address = $validated['address'] ?? null;
            $user->notes = $validated['notes'] ?? null;
            $user->is_active = $validated['is_active'];
            $user->role = 'admin';
            $user->login_id = $loginId;
            $user->user_name = $loginId; // استخدام login_id كـ user_name
            $user->plain_password = $plainPassword;
            $user->password = Hash::make($plainPassword);

            $user->save();

            return redirect()->route('admin.accounts.admins.list')->with('success', 'Admin created successfully with password: ' . $plainPassword);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create admin: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return view('admin.accounts.admin.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return view('admin.accounts.admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        try {
            $admin = User::where('role', 'admin')->findOrFail($id);
            
            $validated = $request->validate([
                'name'         => 'required|string|max:150',
                'email'        => 'required|email|max:150|unique:users,email,' . $id,
                'mobile'       => 'required|string|max:15|unique:users,mobile,' . $id,
                'address'      => 'nullable|string|max:500',
                'notes'        => 'nullable|string|max:1000',
                'is_active'    => 'required|boolean',
            ]);

            $admin->update($validated);
            
            return redirect()->back()->with('success', 'Admin updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update admin: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $admin = User::where('role', 'admin')->findOrFail($id);
            
            // Prevent deletion of the current logged-in admin
            if ($admin->id === auth()->id()) {
                return redirect()->back()->with('error', 'You cannot delete your own account');
            }
            
            $admin->delete();
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Admin deleted successfully'
                ]);
            }
            
            return redirect()->back()->with('success', 'Admin deleted successfully');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete admin. Please try again.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to delete admin: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        try {
            $admin = User::where('role', 'admin')->findOrFail($id);
            
            // Prevent status change of the current logged-in admin
            if ($admin->id === auth()->id()) {
                return redirect()->back()->with('error', 'You cannot change your own account status');
            }
            
            $admin->is_active = $admin->is_active ? 0 : 1;
            $admin->save();
            
            $status = $admin->is_active ? 'activated' : 'deactivated';
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Admin ' . $status . ' successfully',
                    'new_status' => $admin->is_active
                ]);
            }
            
            return redirect()->back()->with('success', 'Admin ' . $status . ' successfully');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to change admin status. Please try again.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to change admin status: ' . $e->getMessage());
        }
    }

    public function resetPassword($id)
    {
        try {
            $admin = User::where('role', 'admin')->findOrFail($id);
            
            $plainPassword = Str::random(8);
            $admin->plain_password = $plainPassword;
            $admin->password = Hash::make($plainPassword);
            $admin->save();
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Password reset successfully. New password: ' . $plainPassword,
                    'new_password' => $plainPassword
                ]);
            }
            
            return redirect()->back()->with('success', 'Password reset successfully. New password: ' . $plainPassword);
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to reset password. Please try again.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to reset password: ' . $e->getMessage());
        }
    }

    public function printCredentials($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return view('admin.accounts.admin.print-credentials', compact('admin'));
    }
}