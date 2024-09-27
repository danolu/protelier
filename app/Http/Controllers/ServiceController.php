<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Payment;
use App\Models\Activity;
use Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['services'] = Service::all();
        return view('services', $data); 
    }

    public function book(Request $request)
    {
        $request->validate([
            'customer' => 'required|string',
            'service' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'customer' => 'required|string',
            'method' => 'required|string',
            'discount' => 'nullable|numeric',
        ]);
        $payment = new Payment;
        if ($request->discount) {
            $discount = $request->discount;
        } else {
            $discount = 0;
        }
        $payment->amount = ($request->price * $request->quantity) - $discount;
        $payment->quantity = $request->quantity;
        $payment->unit_price = $request->price;
        $payment->customer = $request->customer;
        $payment->discount = $discount;
        $payment->method = $request->method;
        $payment->description = $request->service;
        $sav = $payment->save();
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'booked '.$request->service.' for '.$payment->amount;
            Activity::create($audit);
            $data['payment'] = $payment;
            return view('payments.show', $data); 
        } else {
            return back()->with('alert', 'Error booking service');
        }
            
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
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);
        $sav = Service::create($request->all());
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'created '.$request->name.' service';
            Activity::create($audit);
            return back()->with('success', 'Service created!');
        } else {
            return back()->with('alert', 'Error creating service');
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
        //
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
            'price' => 'required|numeric|min:0',
            'status' => 'required|numeric',
        ]);
        $service = Service::findOrFail($id);
        $upd = $service->update($request->all());
        if ($upd) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'updated '.$request->name.' service';
            Activity::create($audit);
            return back()->with('Success', 'Service updated');
        } else {
            return back()->with('alert', 'Unable to update service');
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
        $service = Service::findOrFail($id);
        $name = $service->name;
        $del = $service->delete();
        if ($del) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'deleted '.$name.' service';
            Activity::create($audit);
            return back()->with('success', 'Service deleted!');
        } else {
            return back()->with('alert', 'Error deleting service');
        }
    }
}
