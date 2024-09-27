@extends('layouts.simple.master')
@section('title', 'Guest')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Guest</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="job-search">
					<div class="card-body pb-0">
						<div class="media">
							<div class="media-body">
								<h4 class="f-w-600"> Guest Details
								</h4>
							</div>
						</div>
						<div class="job-description">
							<h6 class="mb-0">{{$guest->salutation.' '.$guest->first_name.' '.$guest->last_name}} </h6>
							<form class="form theme-form" action="{{route('guests.update', $guest->id)}}" method="POST">
								@csrf
								@method('patch')
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Salutation:</label>
											<select class="form-control" name="salutation">
				                              <option hidden disabled value="">Select Salutation</option>
				                              <option @if ($guest->salutation=='Mr') selected @endif value="Mr">Mr</option>
				                              <option @if ($guest->salutation=='Mrs') selected @endif value="Mrs">Mrs</option>
				                              <option @if ($guest->salutation=='Miss') selected @endif value="Miss">Miss</option>
				                              <option @if ($guest->salutation=='Dr') selected @endif value="Dr">Dr</option>
				                              <option @if ($guest->salutation=='Engr.') selected @endif value="Engr.">Engr.</option>
				                              <option @if ($guest->salutation=='Barr.') selected @endif value="Barr.">Barr.</option>
			                           	  </select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>First Name*:<span class="font-danger">*</span></label>
											<input class="form-control" name="first_name" value="{{$guest->first_name}}" type="text" required="">
										</div>
									</div>
								</div>
      							<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Last Name:<span class="font-danger">*</span></label>
											<input class="form-control" name="last_name" value="{{$guest->last_name}}" type="text" required="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Email:</label>
											<input class="form-control" name="email" value="{{$guest->email}}" type="email">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Phone:</label>
											<input class="form-control" name="phone" value="{{$guest->phone}}" type="tel">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Address:</label>
											<input class="form-control" name="address" value="{{$guest->address}}" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>NIN/Passport Number:</label>
											<input class="form-control" name="nin" value="{{$guest->nin}}" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Outstanding:</label>
											<input class="form-control" name="outstanding" value="{{$guest->outstanding}}" type="number">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Note:</label>
											<textarea class="form-control" name="note" type="text">{{$guest->note}}</textarea>
										</div>
									</div>
								</div>
								<div>
									<button class="btn btn-outline-primary" type="submit">Update</button>
								</div>
							</form>
						</div>
					</div>		
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
@endsection