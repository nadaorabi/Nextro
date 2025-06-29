<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|integer|min:1|unique:rooms,room_number',
            'capacity' => 'nullable|integer|min:1',
            'location' => 'nullable|string|max:255',
        ], [
            'room_number.required' => 'رقم القاعة مطلوب.',
            'room_number.integer' => 'رقم القاعة يجب أن يكون رقمًا صحيحًا.',
            'room_number.unique' => 'رقم القاعة مستخدم من قبل.',
            'room_number.min' => 'رقم القاعة يجب أن يكون أكبر من الصفر.',
        ]);
        Room::create($request->only('room_number', 'capacity', 'location'));
        return redirect()->back()->with('success', 'تمت إضافة القاعة بنجاح!');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->back()->with('success', 'تم حذف القاعة بنجاح!');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_number' => 'required|integer|min:1|unique:rooms,room_number,' . $room->id,
            'capacity' => 'nullable|integer|min:1',
            'location' => 'nullable|string|max:255',
        ], [
            'room_number.required' => 'رقم القاعة مطلوب.',
            'room_number.integer' => 'رقم القاعة يجب أن يكون رقمًا صحيحًا.',
            'room_number.unique' => 'رقم القاعة مستخدم من قبل.',
            'room_number.min' => 'رقم القاعة يجب أن يكون أكبر من الصفر.',
        ]);
        $room->update($request->only('room_number', 'capacity', 'location'));
        return redirect()->route('admin.facilities.rooms.index')->with('success', 'تم تحديث بيانات القاعة بنجاح!');
    }
} 