@extends('layouts.simple.master')
@section('title', 'Employee')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Employees</li>
<li class="breadcrumb-item active">Employee</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header b-l-primary d-flex justify-content-between">
               <h5>Profile Information</h5>
               <a class="btn btn-primary" href="{{route('employees.edit', $employee->id)}}">Edit Employee</a>
            </div>
			<div class="card-body">
				<h6>Name:</h6><p>{{$employee->first_name.' '.$employee->last_name}}</p>
				<h6>Email:</h6><p>{{$employee->email}}</p>
				<h6>Phone Number:</h6><p>{{$employee->phone}}</p>
				<h6>Address:</h6><p>{{$employee->address}}</p>
				<h6>Designation:</h6><p>{{$employee->designation}}</p>
				<h6>Salary:</h6><p>N{{number_format($employee->salary)}}</p>
				<h6>Bank Name:</h6><p>{{$employee->bank_name}}</p>
				<h6>Bank Account Number:</h6><p>{{$employee->bank_account_number}}</p>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
@endsection