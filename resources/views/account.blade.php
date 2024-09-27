@extends('layouts.simple.master')
@section('title', 'Account')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Account</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header b-l-primary">
					<h5>Profile Information</h5>
				</div>
				<div class="card-body">
					@if($user->id!=1)
					<h6>Name</h6>
					<p>{{$user->employee->first_name.' '.$user->employee->last_name}}</p>
					<h6>Email</h6>
					<p>{{$user->email}}</p>
					<h6>Phone Number</h6>
					<p>{{$user->employee->phone}}</p>
					@endif
					<h6>Username</h6>
					<p>{{$user->username}}</p>
					<h6>Role</h6>
					<p>{{$user->getRoleNames()->implode('')}}</p>
				</div>
			</div>
		</div>
		
		<div class="col-sm-12">
			<div class="card card-absolute">
				<div class="card-header bg-primary">
					<h5 class="text-white">Change Password</h5>
				</div>
				
				<form class="form theme-form" action="{{route('password.change')}}" method="POST">
	              @csrf
				  <div class="card-body">
	              <div class="card-body">
	                <div class="row">
	                  <div class="col">
	                    <div class="mb-3 row">
	                      <label class="col-sm-3 col-form-label">Old Password</label>
	                      <div class="col-sm-9">
	                        <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="Enter current password">
	                        @error('old_password')
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
	                      </div>
	                    </div>
	                    <div class="mb-3 row">
	                      <label class="col-sm-3 col-form-label">New Password</label>
	                      <div class="col-sm-9">
	                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" maxlength="14" placeholder="Enter a new password">
	                        @error('password')
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
	                      </div>
	                    </div>
	                    <div class="mb-3 row">
	                      <label class="col-sm-3 col-form-label">Re-enter new password</label>
	                      <div class="col-sm-9">
	                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password">
	                      </div>
	                    </div>
	                  </div>
	                
						<div class="col-sm-9 offset-sm-3">
							<button class="btn btn-outline-primary" type="submit">Change Password</button>
						</div>
					</div>
	              </div>
				</div>
	            </form>
				
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
@endsection

