<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Activity;
use Hash;
use Spatie;
use DB;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::where('id', '>', 1)->get();
        $data['employees'] = Employee::where('user_id', null)->get();
        return view('users.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['employees'] = Employee::where('user_id', null)->get();
        return view('users.create', $data);
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
            'username' => 'required|string|unique:users|max:255',
            'email' => 'email|required|unique:users',
            'password' => 'required|string|min:6',
            'employee_id' => 'required|numeric',
        ]);
        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->employee_id = $request->employee_id;
        $user->password = Hash::make($request->password);
        $user->assignRole($request->role);
        $employee = Employee::findOrFail($request->employee_id);
        $employee->user_id = $user->id;
        
        $sav = $employee->save() && $user->save();
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'created new user @'.$user->username;
            Activity::create($audit);
            return back()->with('success', 'User created');
        } else {
            return back()->with('alert', 'Error creating user');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        return view('users.edit', $data);
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
            'email' => 'required|email',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->syncRoles([$request->role]);
        $sav = $user->save();
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'updated @'.$user->username;
            Activity::create($audit);
            return back()->with('success', 'User updated');
        } else {
            return back()->with('alert', 'Error updating user');
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
        $del = User::findOrFail($id)->delete();  
        if ($del) {
            return redirect()->route('users.index')->with('success', 'User deleted');
        } else {
            return back()->with('alert', 'error deleting user');
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|string|min:6',
        ]);
        if (! Hash::check($request->old_password, $request->user()->password)) {
        return back()->withErrors(['old_password' => ['The provided password does not match our records.']]);
        }
        $user = $request->user();
        $user->password = Hash::make($request->password);
        $sav = $user->save();
        if ($sav) {
            $audit['user_id'] = $user->id;
            $audit['activity'] = 'changed password';
            Activity::create($audit);
            return back()->with('success', 'Password Changed.');
        } else {
            return back()->with('alert', 'Error changing password');
        }
    }   

    public function logoutOtherDevices()
    {
    Auth::guard('user')->logoutOtherDevices($password);  
    return back()->with('success', 'Successfully logged out of other devices'); 
    }
}
