<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Activity;
use Auth;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['guests'] = Guest::all();
        return view('guests.index', $data);
    }

    public function loyalty()
    {
        $data['guests'] = Guest::all();
        return view('loyalty', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'salutation' => 'nullable|string|max:191',
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'email|nullable',
            'phone' => 'required|string|max:18',
            'address' => 'string|nullable',
            'emergency_contact' => 'string|nullable',
            'note' => 'string|nullable'
        ]);
        $sav = Guest::create($request->all());
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'created guest: '.$request->first_name.' '.$request->last_name;
            Activity::create($audit);
            return back()->with('success', 'Guest created');
        } else {
            return back()->with('alert', 'Error creating guest');
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
        $data['guest'] = Guest::findOrFail($id);
        return view('guests.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['guest'] = Guest::findOrFail($id);
        return view('guests.edit', $data);
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
            'salutation' => 'nullable|string|max:191',
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'email|nullable',
            'phone' => 'required|string|max:18',
            'address' => 'string|nullable',
            'emergency_contact' => 'string|nullable',
            'note' => 'string|nullable'
        ]);
        $guest = Guest::findOrFail($id);
        $upd = $guest->update($request->all());
        if ($upd) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'updated guest: '.$guest->first_name.' '.$guest->last_name;
            Activity::create($audit);
            return back()->with('success', 'Guest updated successfully');
        } else {
            return back()->with('alert', 'error updating guest');
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
        $guest = Guest::findOrFail($id);
        $name = $guest->first_name.' '.$guest->last_name; 
        $del = $guest->delete();
        if ($del) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'deleted guest: '.$name;
            Activity::create($audit);
             return back()->with('success', 'Guest deleted successfully');
        } else {
             return back()->with('alert', 'Unable to delete Guest');
        }
    }
}
