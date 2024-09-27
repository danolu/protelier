<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use Auth;
use App\Models\Activity;

class SettingController extends Controller
{
    public function index() {
        return view('settings');
    }

    public function account() {
        return view('account');
    }

    public function updateBank(Request $request) {
        $request->validate([
            'bank_name' => 'nullable|string',
            'account_name' => 'nullable|string',
            'account_number' => 'nullable|numeric',
        ]);
        $hotel = Hotel::firstOrFail();
        $sav = $hotel->update($request->all());
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'updated hotel bank details';
            Activity::create($audit);
            return back()->with('success', 'Bank Details Updated');
         } else {
            return back()->with('alert', 'Error updating bank details');
         }     
    }

    public function updateHotel(Request $request) {
        $request->validate([
            'name' => 'nullable|string',
            'tagline' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|numeric',
            'alt_phone' => 'nullable|numeric',
            'email' => 'nullable|email',
            'alt_email' => 'nullable|email',
            'website' => 'nullable|string',
        ]);
        $hotel = Hotel::firstOrFail();
        $sav = $hotel->update($request->all());
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'updated hotel details';
            Activity::create($audit);
            return back()->with('success', 'Hotel Info Updated');
         } else {
            return back()->with('alert', 'Error updating hotel info');
         }
    }

    public function updateTerms(Request $request) {
        $request->validate([
            'terms' => 'nullable|string',
        ]);
        $hotel = Hotel::firstOrFail();
        $sav = $hotel->update($request->all());
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'updated hotel terms';
            Activity::create($audit);
            return back()->with('success', 'Hotel Terms Updated');
         } else {
            return back()->with('alert', 'Error updating hotel terms');
         }
    }

    public function updateLoyalty(Request $request) {
        $request->validate([
            'loyalty_fraction' => 'numeric',
        ]);
        $hotel = Hotel::firstOrFail();
        $sav = $hotel->update($request->all());
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'updated loyalty percentage';
            Activity::create($audit);
            return back()->with('success', 'Loyalty percentage updated');
         } else {
            return back()->with('alert', 'Loyalty percentage updated');
         }
    }
}
