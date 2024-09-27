<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Payment;
use App\Models\Activity;
use Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['payments'] = Payment::latest()->get();
        return view('payments.index', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['payment'] = Payment::findOrFail($id);
        return view('payments.show', $data);
    }

    public function receipt($id)
    {
        $data['payment'] = Payment::findOrFail($id);
        return view('payments.receipt', $data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $del = $payment->delete();
        if ($del) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'deleted a payment';
            Activity::create($audit);
            return back()->with('success', 'Payment deleted');
        } else {
            return back()->with('alert', 'Unable to delete payment');
        }
    }

    public function paymentMethods()
    {
        $data['methods'] = PaymentMethod::all();
        return view('payments.methods', $data);
    }

    public function activatePM($id)
    {
        $method = PaymentMethod::findOrFail($id);
        $method->status = 1;
        $sav = $method->save();
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'activated '.$method->name.' payment method';
            Activity::create($audit);
            return back()->with('success', 'Payment method activated');
        } else {
            return back()->with('alert', 'Unable to activate payment method');
        }
    }

    public function deactivatePM($id)
    {
        $method = PaymentMethod::findOrFail($id);
        $method->status = 0;
        $sav = $method->save();
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'deactivated '.$method->name.' payment method';
            Activity::create($audit);
            return back()->with('success', 'Payment method deactivated');
        } else {
            return back()->with('alert', 'Unable to deactivate payment method');
        }
    }
}
