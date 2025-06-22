<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordIsChanged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Check if user is authenticated, is a teacher, and has not changed their password yet.
        // This assumes your User model has a 'role' attribute or a similar way to identify teachers.
        if ($user && $user->role === 'teacher' && is_null($user->password_changed_at)) {
            
            // Allow access to the password change form and the logout route to prevent a redirect loop.
            if (! $request->routeIs('teacher.password.change') && ! $request->routeIs('admin.logout')) {
                return redirect()->route('teacher.password.change')
                                 ->with('status', 'Please update your password to continue.');
            }
        }

        return $next($request);
    }
}
