<?php

namespace App\Http\Controllers;
use App\Models\RoomType;
use App\Models\Activity;
use Illuminate\Http\Request;
use Auth;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roomtypes'] = RoomType::all();
        return view('roomtypes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roomtypes.create');
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
            'name' => 'required|string',
            'rate' => 'required|numeric|min:0',
            'caution' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'bed_type' => 'nullable|string',
            'number_of_beds' => 'nullable|numeric|min:0',
            'adult_capacity' => 'required|numeric|min:0',
            'children_capacity' => 'required|numeric|min:0',
            'images' => 'nullable|string',
            'facilities' => 'nullable|string'
        ]);
        $sav = RoomType::create($request->all());
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'created '.$request->name.' room type';
            Activity::create($audit);
            return back()->with('success', 'Room type created!');
        } else {
            return back()->with('alert', 'Error creating room type');
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
        $data['roomtype'] = RoomType::findOrFail($id);
        return view('roomtypes.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['roomtype'] = RoomType::findOrFail($id);
        return view('roomtypes.edit', $data);
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
            'name' => 'required|string',
            'rate' => 'required|numeric|min:0',
            'caution' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'bed_type' => 'nullable|string',
            'number_of_beds' => 'nullable|numeric|min:0',
            'adult_capacity' => 'required|numeric|min:0',
            'children_capacity' => 'required|numeric|min:0',
            'images' => 'nullable|string',
            'facilities' => 'nullable|string'
        ]);

        $room_type = RoomType::findOrFail($id);
        $sav = $room_type->update($request->all());
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'updated '.$request->name.' room type';
            Activity::create($audit);
            return back()->with('success', 'Room Type updated!');
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
        $roomtype = RoomType::findOrFail($id);
        $name = $roomtype->name;
        $del = $roomtype->delete();
        if ($del) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'deleted '.$name.' room type';
            Activity::create($audit);
            return back()->with('success', 'Room Type deleted!');
        } else {
            return back()->with('alert', 'Error deleting room type');
        }
    }
}
