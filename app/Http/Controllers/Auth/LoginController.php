<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Activity;
use Carbon\Carbon;
use Mail;
use App\Mail\SendMail;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. 
    |
    */
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    } 
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {  
        $request->validate([
            'username' => 'required|string|max:20',
            'password' => 'required'
        ]);
        $hotel = Hotel::firstOrFail();
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password, 'status' => 1], true)) {
            $ip_address = $request->ip();
            $user = Auth::user();
            if($ip_address!=$user->ip_address && $user->username != 1) {
                $audit['user_id'] = $user->id;
                $audit['activity'] = 'logged in from another IP address';
                Activity::create($audit);
            } else if ($ip_address!=$user->ip_address && $user->role == 1) {
                $data['subject'] = 'Suspicious Login Attempt';
                $data['content'] = 'Hello administrator,<br>Your '.$hotel->name.' Management System account was just accessed from an unknown IP address: '.$ip_address.'.<br>If this was you, ignore this message, otherwise, kindly reset your password and log out of other devices.';
                Mail::to($user->email)->send(new SendMail($data));
                $audit['user_id'] = $user->id;
                $audit['activity'] = 'logged in from another IP address';
                Activity::create($audit);
            } else {
                $audit['user_id'] = $user->id;
                $audit['activity'] = 'logged in';
                Activity::create($audit);
            }
            $user->last_login = Carbon::now();
            $user->ip_address = $ip_address;
            $user->save();
            $audit['user_id'] = $user->id;
            $audit['activity'] = 'logged in';
            Activity::create($audit);
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } elseif (Auth::attempt([$fieldType => $request->username, 'password' => $request->password, 'status' => 0], true)) {
            return back()->with('alert', 'Your account has been deactivated. Contact administrator for more details.')->withInput($request->only('email'));
        } else {
            return back()->with('alert', 'Oops! You have entered invalid credentials')->withInput($request->only('email'));
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|string|min:8',
        ]);
        if (! Hash::check($request->old_password, $request->user()->password)) {
        return back()->withErrors(['old_password' => ['The provided password does not match our records.']]);
        }
        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();
        $audit['user_id'] = $user->id;
        $audit['activity']='changed password';
        Activity::create($audit);
        return back()->with('success', 'Password Changed.');
    } 

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}