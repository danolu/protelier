<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Activity;
use Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['employees'] = Employee::where('id', '>', 1)->get();
        return view('employees.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
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
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'phone' => 'nullable|string|max:18',
            'email' => 'email|nullable',
            'address' => 'nullable|string',
            'designation' => 'string|nullable',
            'salary' => 'numeric|nullable|min:0',
            'bank_name' => 'string|nullable',
            'bank_account_number' => 'numeric|nullable|min:0',
        ]);
        $sav = Employee::create($request->all());
        if ($sav) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'created employee: '.$request->first_name.' '.$request->last_name;
            Activity::create($audit);
            return redirect()->route('employees.index')->with('success', 'Employee created');
        } else {
            return back()->with('alert', 'error creating employee');
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
        $data['employee'] = Employee::findOrFail($id);
        return view('employees.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['employee'] = Employee::findOrFail($id);
        return view('employees.edit', $data);
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
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'phone' => 'nullable|string|max:18',
            'email' => 'email|nullable',
            'address' => 'nullable|string',
            'designation' => 'string|nullable',
            'salary' => 'numeric|nullable|min:0',
            'bank_name' => 'string|nullable',
            'bank_account_number' => 'numeric|nullable',
        ]);
        $employee = Employee::findOrFail($id);
        $upd = $employee->update($request->all());
        if ($upd) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'updated employee: '.$request->first_name.' '.$request->last_name;
            Activity::create($audit);
            return back()->with('success', 'Employee updated');
        } else {
            return back()->with('alert', 'error updating employee');
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
        $employee = Employee::findOrFail($id);
        $del = $employee->delete();
        $em = $employee;
        if ($del) {
            $audit['user_id'] = Auth::id();
            $audit['activity'] = 'deleted employee: '.$em->first_name.' '.$em->last_name;
            Activity::create($audit);
             return redirect()->route('employees.index')->with('success', 'Employee deleted');
        } else {
             return back()->with('alert', 'Unable to delete employee');
        }
    }

    public function payroll()
    {
        $data['employees'] = Employee::where('id', '>', 1)->get();
        return view('payroll', $data);
    }
}
