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
            'room_number.required' => 'Room number is required.',
            'room_number.integer' => 'Room number must be an integer.',
            'room_number.unique' => 'Room number is already in use.',
            'room_number.min' => 'Room number must be greater than zero.',
        ]);
        Room::create($request->only('room_number', 'capacity', 'location'));
        return redirect()->back()->with('success', 'Room added successfully!');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->back()->with('success', 'Room deleted successfully!');
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
            'room_number.required' => 'Room number is required.',
            'room_number.integer' => 'Room number must be an integer.',
            'room_number.unique' => 'Room number is already in use.',
            'room_number.min' => 'Room number must be greater than zero.',
        ]);
        $room->update($request->only('room_number', 'capacity', 'location'));
        return redirect()->route('admin.facilities.rooms.index')->with('success', 'Room data updated successfully!');
    }
} 