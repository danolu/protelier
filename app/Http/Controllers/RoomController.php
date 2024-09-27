<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Activity;
use App\Models\Guest;
use Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['rooms'] = Room::all();
        return view('rooms.index', $data);
    }

    public function available()
    {
        $data['rooms'] = Room::where('status', 1)->get();
        return view('rooms.available', $data);
    }

    public function activate($id)
    {
        $room = Room::findOrFail($id);
        $room->status = 1;
        $sav = $room->save();
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'activated room '.$room->number;
            Activity::create($audit);
            return back()->with('success', 'room activated');
        } else {
            return back()->with('alert', 'Unable to activate room');
        }
    }

    public function deactivate($id)
    {
        $room = Room::findOrFail($id);
        $room->status = 0;
        $sav = $room->save();
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'deactivated room '.$room->number;
            Activity::create($audit);
            return back()->with('success', 'room deactivated');
        } else {
            return back()->with('alert', 'Unable to deactivate room');
        }
    }

    public function book($id)
    {
        $data['room'] = Room::findOrFail($id);
        $data['guests'] = Guest::all();
        return view('rooms.book', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|numeric|unique:rooms',
            'room_type_id' => 'required|numeric'
        ]);
        $sav = Room::create($request->all());
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'created room '.$request->number;
            Activity::create($audit);
            return back()->with('success', 'Room created!');
        } else {
            return back()->with('alert', 'Error creating room');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['room'] = Room::findOrFail($id);
        return view('rooms.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'room_type_id' => 'required|numeric'
        ]);
        $room = Room::findOrFail($id);
        $sav = $room->update($request->all());
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'updated room '.$request->number;
            Activity::create($audit);
            return back()->with('success', 'Room updated!');
        } else {
            return back()->with('alert', 'Error updating room');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $number = $room->number;
        $del = $room->delete();
        if ($del) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'deleted room '.$number;
            Activity::create($audit);
            return back()->with('success', 'Room deleted!');
        } else {
            return back()->with('alert', 'Error deleting room');
        }
    }
}
