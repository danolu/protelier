<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Models\Activity;
use App\Models\Payment;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index() {

        $data['total_guests'] = Guest::count();
        $data['total_rooms'] = Room::count();
        $data['pending_checkin'] = Booking::where('status', 1)->count();
        $data['checkins_today'] = Booking::where([['status', '=', '2'], ['checked_in', '>=', Carbon::today()],])->count();
        $data['checkouts_today'] = Booking::where([['status', '=', '3'], ['checked_out', '>=', Carbon::today()],])->count();
        $data['cancellations_today'] = Booking::where([['status', '=', '0'], ['cancellation_date', '>=', Carbon::today()],])->count();
        $data['bookings_today'] = $today = Booking::where('created_at', '>=', Carbon::today())->count();
        $data['bookings_yesterday'] = $yesterday = Booking::where([['created_at', '>=', Carbon::yesterday()], ['created_at', '<', Carbon::today()],])->count();
        $data['bookings_this_week'] = $this_week = Booking::where('created_at', '>=', Carbon::today()->startOfWeek())->count();
        $data['bookings_last_week'] = $last_week = Booking::whereBetween('created_at', [Carbon::today()->subWeek()->startOfWeek(), Carbon::today()->subWeek()->endOfWeek()])->count();
        $data['bookings_this_month'] = $this_month = Booking::where('created_at', '>=', Carbon::today()->startOfMonth())->count();
        $data['bookings_last_month'] = $last_month = Booking::whereMonth('created_at', Carbon::today()->subMonth()->format('m'))->count();         
        $data['unavailable_rooms'] = Room::where('status', 0)->count();
        $data['available_rooms'] = Room::where('status', 1)->count();
        $data['booked_rooms'] = Room::where('status', 2)->count();                
        $data['occupied_rooms'] = Room::where('status', 3)->count();
        $data['sales_today'] = $sales_today = Booking::where('created_at', '>=', Carbon::today())->sum('payable');
        $data['sales_yesterday'] = $sales_yesterday = Booking::where([['created_at', '>=', Carbon::yesterday()], ['created_at', '<', Carbon::today()],])->sum('payable');
        $data['sales_this_week'] = $sales_this_week = Booking::where('created_at', '>=', Carbon::today()->startOfWeek())->sum('payable');
        $data['sales_last_week'] = $sales_last_week = Booking::whereBetween('created_at', [Carbon::today()->subWeek()->startOfWeek(), Carbon::today()->subWeek()->endOfWeek()])->sum('payable');
        $data['sales_this_month'] = $sales_this_month = Booking::where('created_at', '>=', Carbon::today()->startOfMonth())->sum('payable');
        $data['sales_last_month'] = $sales_last_month = Booking::whereMonth('created_at', Carbon::today()->subMonth()->format('m'))->sum('payable');  
        $data['sales_this_year'] = Booking::where('created_at', '>=', Carbon::today()->startOfYear())->sum('payable');
        $data['activities'] = Activity::latest()->limit(5)->get();
        $data['bookings'] = Booking::latest()->limit(5)->get();
        return view('dashboard', $data);
    }
    public function activity() {
        $data['activities'] = Activity::all();
        return view('activity', $data);
    }

    public function stats() {
        return view('statistics');
    }
}
