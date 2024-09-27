<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Booking;
use App\Models\RoomType;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Guest;
use App\Models\Room;
use App\Models\Activity;
use Spatie;
use Hash;
use Auth;
use Carbon\Carbon;
use Str;
use Mail;
use App\Mail\CheckoutMail;
use App\Mail\CheckinMail;
use App\Mail\BookingMail;
use App\Mail\CancellationMail;
use PDF;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['bookings'] = Booking::latest()->get();
        return view('bookings.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['guests'] = Guest::all();
        return view('bookings.create', $data);
    }

    public function getGuestData($id)
    {
        $guest = Guest::findOrFail($id);
        return response()->json([
                    'guest_id'=> $guest->id,
                    'email'=> $guest->email,
                    'phone'=> $guest->phone,
                    'address'=> $guest->address,
                    'note' => $guest->note,
                    'loyalty_points' => $guest->loyalty_points,
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hotel = Hotel::first();
        if ($request->guesttype == 'new') {
                $request->validate([
                'salutation' => 'nullable|string|max:191',
                'first_name' => 'required|string|max:191',
                'last_name' => 'required|string|max:191',
                'email' => 'email|nullable',
                'phone' => 'required|string|max:18',
                'address' => 'string|nullable',
                'nin' => 'string|nullable',
                'emergency_contact' => 'string|nullable',
                'guest_note' => 'string|nullable'
            ]);

            $guest = new Guest;
            $guest->salutation = $request->salutation;
            $guest->first_name = $request->first_name;
            $guest->last_name = $request->last_name;
            $guest->email = $request->email;
            $guest->phone = $request->phone;
            $guest->address = $request->address;
            $guest->nin = $request->nin;
            $guest->loyalty_points = $request->cost * ($hotel->loyalty_fraction/100);
            $guest->emergency_contact = $request->emergency_contact;
            $guest->note = $request->guest_note;
            $guest->save();
            $guest_id = $guest->id;
        } else if ($request->guesttype == 'returning') {
            $guest_id = $request->guest_id;
            $guest = Guest::where('id', $guest_id)->first();
            if ($request->payment_method == 'loyalty') {
                $guest->loyalty_points -= $request->cost;
                $guest->redeemed_points += $request->cost;
            }
            $guest->loyalty_points += $request->cost * ($hotel->loyalty_fraction /100);
            $guest->save();
        }

        $request->validate([
            'checkin' => 'date|required',
            'checkout' => 'date|required',
            'room_numbers' => 'required|string',
            'adults' => 'required|numeric|min:0',
            'children' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'purpose' => 'string|nullable',
            'duration' => 'numeric|required',
            'extra_charge' => 'numeric|nullable',
            'caution_status' => 'numeric|nullable',
            'car_number' => 'string|nullable',
            'cost' => 'required|numeric',
            'deposit' => 'nullable|numeric|lt:cost',
            'discount' => 'numeric|nullable|lte:cost',
            'caution' => 'required|numeric',
        ]);

        $booking = new Booking;
        $booking->booking_id = 'B-'.date('ymdHis');
        $booking->checkin = $request->checkin;
        $booking->checkout = $request->checkout;
        $booking->adults = $request->adults;
        $booking->children = $request->children;
        $booking->purpose = $request->purpose;
        $booking->guest_id = $guest_id;
        $booking->charge = $request->cost;

        if ($request->discount) {
            $booking->discount = $request->discount; 
            $booking->payable = $request->cost - $request->discount;  
        } else {
            $booking->payable = $request->cost;
            $booking->discount = 0;
        }

        if ($request->extra_charge) {
            $booking->payable += $request->extra_charge;
            $booking->extra_charge = $request->extra_charge;
        } else {
            $booking->extra_charge = 0;
        }

        if ($request->payment_status==0) {
            $booking->outstanding = $booking->payable;
            $booking->payment_status = 0;
        } else if ($request->payment_status==1) { 
            $booking->outstanding = 0;
            $booking->payment_status = 1;
        } else if ($request->payment_status==2) {
            if ($request->deposit) {
                $booking->deposit = $request->deposit;
                $booking->outstanding = $booking->payable - $request->deposit;
                $booking->payment_status = 2;
            } else {
                $booking->deposit = 0;
                $booking->payment_status = 0;
                $booking->outstanding = $booking->payable;
            }
        }

        $booking->payment_method = $request->payment_method;
        $booking->caution = $request->caution;
        if ($request->caution_status) {
            $booking->caution_status = $request->caution_status;
        } else {
            $booking->caution_status = 0;
        }
        $booking->note = $request->note;
        $booking->car_number = $request->car_number;

        $sav = $booking->save();
        $rooms = explode(",", $request->room_numbers);
        foreach ($rooms as &$room) {
            $room = Room::where('number', $room)->first()->id;
        }
        unset($room);
        $booking->rooms()->attach($rooms);
        foreach ($rooms as $room) {
            $roo = Room::findOrFail($room);
            $roo->status = 2;
            $roo->save();
        }
        $data['booking'] = $booking;
        if ($sav) {
            if ($booking->payment_status==1 && $booking->guest->email) {
                $data['booking'] = $booking;
                $pdf = PDF::loadView('bookings.receipt', $data)->setOptions(['defaultFont' => 'sans-serif']);
                Mail::send('email.booking', $data, function ($message) use ($data, $pdf) {
                    $message->to($data['booking']->guest->email, $data['booking']->guest->email)
                        ->from('info@vactionhaus.com')
                        ->subject('Vacation Haus - Booking Confirmation')
                        ->attachData($pdf->output(), "receipt.pdf");
                });
            }
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'created booking '.$booking->booking_id;
            Activity::create($audit);
            return redirect()->route('bookings.show', $booking->id)->with('success', 'Booking created.');
        } else {
            return back()->with('alert', 'Error creating booking');
        }
    }

    public function bookRoom(Request $request)
    {
        if ($request->guesttype == 'new') {
                $request->validate([
                'salutation' => 'nullable|string|max:191',
                'first_name' => 'required|string|max:191',
                'last_name' => 'required|string|max:191',
                'email' => 'email|nullable',
                'phone' => 'required|string|max:18',
                'address' => 'string|nullable',
                'nin' => 'string|nullable',
                'emergency_contact' => 'string|nullable',
                'guest_note' => 'string|nullable'
            ]);

            $guest = new Guest;
            $guest->salutation = $request->salutation;
            $guest->first_name = $request->first_name;
            $guest->last_name = $request->last_name;
            $guest->email = $request->email;
            $guest->phone = $request->phone;
            $guest->address = $request->address;
            $guest->nin = $request->nin;
            $guest->loyalty_points = $request->cost * ($hotel->loyalty_fraction /100);
            $guest->emergency_contact = $request->emergency_contact;
            $guest->note = $request->guest_note;
            $guest->save();
            $guest_id = $guest->id;
        } else if ($request->guesttype == 'returning') {
            $guest_id = $request->guest_id;
            $guest = Guest::where('id', $guest_id);
            if ($request->payment_method == 'loyalty') {
                $guest->loyalty_points -= $request->cost;
                $guest->redeemed_points += $request->cost;
            }
            $guest->loyalty_points += $request->cost * ($hotel->loyalty_fraction /100);
        }

        $request->validate([
            'checkin' => 'date|required',
            'checkout' => 'date|required',
            'room_number' => 'required|string',
            'adults' => 'required|numeric|min:0',
            'children' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'purpose' => 'string|nullable',
            'duration' => 'numeric|required',
            'extra_charge' => 'numeric|nullable',
            'caution_status' => 'numeric|nullable',
            'car_number' => 'string|nullable',
            'cost' => 'required|numeric',
            'deposit' => 'nullable|numeric|lt:cost',
            'discount' => 'numeric|nullable|lte:cost',
            'caution' => 'required|numeric',
        ]);

        $booking = new Booking;
        $booking->booking_id = 'B-'.date('ymdHis');
        $booking->checkin = $request->checkin;
        $booking->checkout = $request->checkout;
        $booking->adults = $request->adults;
        $booking->children = $request->children;
        $booking->purpose = $request->purpose;
        $booking->guest_id = $guest_id;
        $booking->charge = $request->cost;

        if ($request->discount) {
            $booking->discount = $request->discount; 
            $booking->payable = $request->cost - $request->discount;  
        } else {
            $booking->payable = $request->cost;
            $booking->discount = 0;
        }

        if ($request->extra_charge) {
            $booking->payable += $request->extra_charge;
            $booking->extra_charge = $request->extra_charge;
        } else {
            $booking->extra_charge = 0;
        }

        if ($request->payment_status==0) {
            $booking->outstanding = $booking->payable;
            $booking->payment_status = 0;
        } else if ($request->payment_status==1) { 
            $booking->outstanding = 0;
            $booking->payment_status = 1;
        } else if ($request->payment_status==2) {
            if ($request->deposit) {
                $booking->deposit = $request->deposit;
                $booking->outstanding = $booking->payable - $request->deposit;
                $booking->payment_status = 2;
            } else {
                $booking->deposit = 0;
                $booking->payment_status = 0;
                $booking->outstanding = $booking->payable;
            }
        }

        $booking->payment_method = $request->payment_method;
        $booking->caution = $request->caution;
        if ($request->caution_status) {
            $booking->caution_status = $request->caution_status;
        } else {
            $booking->caution_status = 0;
        }
        $booking->note = $request->note;
        $booking->car_number = $request->car_number;

        $sav = $booking->save();
        $room = Room::where('number', $request->room_number)->first()->id;
        $booking->rooms()->attach($room);
        $room = Room::findOrFail($room);
        $room->status = 2;
        $room->save();
        if ($sav) {
            if ($booking->payment_status==1 && $booking->guest->email) {
                $data['booking'] = $booking;
                $pdf = PDF::loadView('bookings.receipt', $data)->setOptions(['defaultFont' => 'sans-serif']);
                Mail::send('email.booking', $data, function ($message) use ($data, $pdf) {
                    $message->to($data['booking']->guest->email, $data['booking']->guest->email)
                        ->from('info@vacationhaus.com')
                        ->subject('Vacation Haus - Booking Confirmation')
                        ->attachData($pdf->output(), "receipt.pdf");
                });
            }
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'created booking '.$booking->booking_id;
            Activity::create($audit);
            return redirect()->route('bookings.show', $booking->id)->with('success', 'Booking created.');
        } else {
            return back()->with('alert', 'Error creating booking');
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
        $data['booking'] = Booking::findOrFail($id);
        return view('bookings.show', $data);
    }

    public function details($id)
    {
        $data['booking'] = Booking::findOrFail($id);
        return view('bookings.details', $data);
    }

    public function receipt($id)
    {
        $data['booking'] = Booking::findOrFail($id);
        return view('bookings.receipt', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['booking'] = Booking::findOrFail($id);
        return view('bookings.edit', $data);
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
            'checkin' => 'date|required',
            'checkout' => 'date|required',
            'room_numbers' => 'required|string',
            'adults' => 'required|numeric|min:0',
            'children' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'purpose' => 'string|nullable',
            'duration' => 'numeric|required',
            'extra_charge' => 'numeric|nullable',
            'caution_status' => 'numeric|nullable',
            'car_number' => 'string|nullable',
            'cost' => 'required|numeric',
            'deposit' => 'nullable|numeric|lt:cost',
            'discount' => 'numeric|nullable|lte:cost',
            'caution' => 'required|numeric',
        ]);
        $booking = Booking::findOrFail($id);
        $booking->checkin = $request->checkin;
        $booking->checkout = $request->checkout;
        $booking->adults = $request->adults;
        $booking->children = $request->children;
        $booking->purpose = $request->purpose;
        $booking->charge = $request->cost;

        if ($request->discount) {
            $booking->discount = $request->discount; 
            $booking->payable = $request->cost - $request->discount;  
        } else {
            $booking->payable = $request->cost;
            $booking->discount = 0;
        }

        if ($request->extra_charge) {
            $booking->payable += $request->extra_charge;
            $booking->extra_charge = $request->extra_charge;
        } else {
            $booking->extra_charge = 0;
        }

        if ($request->payment_status==0) {
            $booking->outstanding = $booking->payable;
            $booking->payment_status = 0;
        } else if ($request->payment_status==1) { 
            $booking->outstanding = 0;
            $booking->payment_status = 1;
        } else if ($request->payment_status==2) {
            $booking->deposit = $request->deposit;
            $booking->outstanding = $booking->payable - $request->deposit;
            $booking->payment_status = 2;
        }

        $booking->payment_method = $request->payment_method;
        $booking->caution = $request->caution;
        if ($request->caution_status) {
            $booking->caution_status = $request->caution_status;
        } else {
            $booking->caution_status = 0;
        }
        $booking->note = $request->note;
        $booking->car_number = $request->car_number;

        $sav = $booking->save();
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'updated booking '.$booking->booking_id;
            Activity::create($audit);
            return redirect()->route('bookings.show', $booking->id)->with('success', 'Booking updated.');
        } else {
            return back()->with('alert', 'Error updating booking');
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
        $booking = Booking::findOrFail($id);
        $del = $booking->delete();
        if ($del) {
            return redirect()->route('bookings.index')->with('success', 'booking deleted');
         } else {
            return back()->with('alert', 'unable to delete booking');
         }
    }

    public function getAvailableRooms($checkin, $checkout, $roomtype_id)
    {
        $rooms = Room::where('room_type_id', $roomtype_id)->whereDoesntHave('bookings', function (Builder $query) use ($checkin, $checkout) {
                    $query->whereIn('bookings.status', [1, 2])
                          ->whereBetween('checkin', [$checkin, $checkout])
                          ->orWhereBetween('checkout', [$checkin, $checkout]);
                    })->get();
        return response()->json(array('rooms' => $rooms));
    }

    public function getTotalCost($roomtype_id, $no_of_rooms, $duration)
    {
        $roomtype = RoomType::findOrFail($roomtype_id);
        $daily_cost = (int) $roomtype->rate * (int) $no_of_rooms;
        $cost = $daily_cost * (int)$duration;
        $caution = $roomtype->caution * (int) $no_of_rooms;
        $adults = (int) $roomtype->adult_capacity * (int) $no_of_rooms;
        $children = (int) $roomtype->children_capacity * (int) $no_of_rooms;
        return response()->json(['cost' => $cost, 'caution' => $caution, 'adults' => $adults, 'children' => $children]);
    }


    public function checkin($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->checked_in = Carbon::now();
        $booking->status = 2;
        $guest = Guest::findOrFail($booking->guest->id);
        $guest->status = 2;
        $guest->save();
        foreach ($booking->rooms as $room) {
            $room = Room::findOrFail($room->id);
            $room->status = 3;
            $room->save();
        }
        $sav = $booking->save();
        if ($sav) {
            if ($booking->guest->email) {
                $data['booking'] = $booking;
                Mail::to($booking->guest->email)->send(new CheckinMail($data));
            }
            return back()->with('success', 'Checked In');
        } else {
            return back()->with('alert', 'Checkin failed');
        }
    }

    public function checkout(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->checked_out = Carbon::now();

        if ($request->property_damage_cost) {
            $booking->property_damage_cost = $request->property_damage_cost;
        }
        $booking->note = $request->note;
        $booking->status = 3;
        $booking->payment_status = 1;
        $guest = Guest::findOrFail($booking->guest->id);
        $guest->status = 1;
        $guest->save();
        $sav = $booking->save();

        foreach ($booking->rooms as $room) {
            $room = Room::findOrFail($room->id);
            $room->status = 1;
            $room->save();
        }
        if ($sav) {
            if ($booking->guest->email) {
                $data['booking'] = $booking;
                Mail::to($booking->guest->email)->send(new CheckoutMail($data));
            }
            return redirect()->route('bookings.show', $id)->with('success', 'Checkout Successful!');    
        } else {
            return back()->with('alert', 'Checkout failed');
        }
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->cancellation_date = Carbon::now();
        $booking->status = 0;
        $booking->payment_status = 3;
        $guest = Guest::findOrFail($booking->guest->id);
        $guest->status = 1;
        $guest->save();
        $sav = $booking->save();
        foreach ($booking->rooms as $room) {
            $room = Room::findOrFail($room->id);
            $room->status = 1;
            $room->save();
        }
        if ($sav) {
            if ($booking->guest->email) {
                $data['booking'] = $booking;
                Mail::to($booking->guest->email)->send(new CancellationMail($data));
            }
            return back()->with('success', 'Booking cancelled');
        } else {
            return back()->with('alert', 'Unable to cancel booking');
        }
    }

}
