@extends('layouts.simple.master')
@section('title', 'Create Booking')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.flexdatalist.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>New Booking</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Bookings</li>
<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h5>Create Booking</h5>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<form class="theme-form" action="{{route('bookings.store')}}" method="POST">
						@csrf
						<section>
							@php $today = date('Y-m-d') @endphp
							<div class="mb-3 g-3 row">
								<label class="col-sm-3 col-form-label text-end">Check In</label>
								<div class="date col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control datetimepicker-input digits" min="{{ $today }}" type="date" id="checkin" value="{{ old('checkin') }}" name="checkin" required="">
								</div>
							</div>

							@php 
			                  $nextday = date('Y-m-d', strtotime($today))." +1 day";
			                  $nextday = date('Y-m-d', strtotime($nextday));
			                @endphp
							<div class="mb-3 g-3 row">
								<label class="col-sm-3 col-form-label text-end">Check Out</label>
								<div class="date col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control datetimepicker-input digits" type="date" min="{{ $nextday }}" id="checkout" name="checkout" value="{{ old('checkout') }}" required="">
								</div>
							</div>

							<div class="mb-3 g-3 row duration" style="display: none;">
								<label class="col-sm-3 col-form-label text-end">Duration</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<div class="input-group">
										<input class="form-control" type="number" id="duration" name="duration" readonly value="{{ old('duration') }}">
					                    <span class="input-group-text">Nights</span>
									</div>
								</div>
							</div>

		                    <div class="mb-3 g-3 row">
								<label class="col-sm-3 col-form-label text-end">Room Type</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<select class="form-control digits" id="roomtype_id" required="">
									<option hidden selected disabled>Select room type</option>
									@foreach ($roomtypes as $roomtype)
										<option value="{{$roomtype->id}}">{{ $roomtype->name }}</option>
									@endforeach	
									</select>
								</div>
							</div>
							
							<div class="mb-3 g-3 row" id="check_availability" style="display: none;">
								<label class="col-sm-3 col-form-label text-end"></label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<div class="input-group">
										<button class="btn btn-outline-primary" id="btn-check" type="button" data-container="body" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="You haven't picked dates.">Check Availability</button>
									</div>
								</div>
							</div>

							<div class="mb-3 g-3 row" id="rooms" style="display: none;">
								<label class="col-sm-3 col-form-label text-end">Available Rooms</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<select class="available_rooms col-12" id="available_rooms" multiple="multiple">
									</select>
								</div>
							</div>

							<div class="mb-3 g-3 row" id="confirm_rooms" style="display: none;">
								<label class="col-sm-3 col-form-label text-end"></label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<button class="btn btn-outline-primary" id="btn-confirm" type="button" data-container="body" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Rooms haven't been chosen">Confirm Room(s)</button>
								</div>
							</div>

							<div class="mb-3 g-3 row" id="confirmed_rooms" style="display: none;">
								<label class="col-sm-3 col-form-label text-end">Room(s)</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control confirmed_rooms" type="text" name='room_numbers' required readonly><button class="btn btn-xs btn-info" id="reset_rooms">edit</button>
								</div>
							</div>

							<div class="mb-3 g-3 row" id="number_of_rooms" style="display: none;">
								<label class="col-sm-3 col-form-label text-end">Number of Rooms</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control" id="no_of_rooms" readonly type="number" name="no_of_rooms">
								</div>
							</div>

							<div class="mb-3 g-3 row adults" style="display: none;">
				                <label class="col-sm-3 col-form-label text-end">Adults</label>
				                <div class="col-xl-5 col-sm-7 col-lg-8">
				                  <input class="touchspin" type="number" min="1" name="adults" id="adults" required="" value="{{ old('adults', 1) }}">
				                </div>
				            </div>

				            <div class="mb-3 g-3 row children" style="display: none;">
				                <label class="col-sm-3 col-form-label text-end">Children</label>
				                <div class="col-xl-5 col-sm-7 col-lg-8">
				                  <input class="touchspin" type="number" min="0" id="children" name="children" required="" value="{{ old('children', 0) }}">
				                </div>
				            </div>
						</section>

						<section id="payment_info" style="display: none;">
				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-end">Cost </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                    <span class="input-group-text">N</span>
				                 	<input type="number" class="form-control" name="cost" id="cost" value="{{ old('cost') }}" readonly>
				                </div>
				              </div>
				            </div>

				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-end">Caution Fee (Refundable) </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                    <span class="input-group-text">N</span>
				                  	<input type="number" class="form-control" name="caution" id="caution" value="{{ old('caution') }}" readonly>
				                </div>
				              </div>
				            </div>

				            <div class="media row">
								<label class="col-form-label col-md-3 text-end">Caution Paid?</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<div class="media-body icon-state">
										<label class="switch">
										<input value="1" name="caution_status" type="checkbox" {{ (old('caution_status') == '1' ) ? 'checked' : '' }}><span class="switch-state"></span>
										</label>
									</div>
								</div>
							</div>

				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-end">Discount </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                    <span class="input-group-text">N</span>
				                  	<input type="number" class="form-control" name="discount" id="discount" value="{{ old('discount') }}" min="0" >
				                </div>
				                @error('discount')
				                  <div class="error-message text-danger pl-1 mt-1">
				                    <small>{{ $message }}</small>
				                  </div>
				                @enderror
				              </div>
				            </div>

				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-end">Extra Charge </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                    <span class="input-group-text">N</span>
				                  	<input type="number" class="form-control" name="extra_charge" id="extra_charge" value="{{ old('extra_charge') }}" min="0">
				                </div>
				              </div>
				            </div>

				            <div class="mb-3 g-3 row">
				              <label class="col-sm-3 col-form-label text-end">Payment Status* </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <select class="form-control" id="payment_status" name="payment_status" required="">
				                  <option disabled hidden @if (old('payment_status') == '') selected @endif>Select Payment Status</option>
				                  <option value="1" @if (old('payment_status') == '1') selected @endif >Full Payment</option>
				                  <option value="2" @if (old('payment_status') == '2') selected @endif >Deposit</option>
				                  <option value="0" @if (old('payment_status') == '0') selected @endif >Credit</option>
				                </select>
				                @error('payment_status')
				                  <div class="error-message text-danger pl-1 mt-1">
				                    <small>{{ $message }}</small>
				                  </div>
				                @enderror
				              </div>
				            </div>

				            <div class="row mb-4 deposit" style="display: none;">
				              <label class="col-form-label col-md-3 text-end">Deposit</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                    <span class="input-group-text">N</span>
				                  	<input type="number" class="form-control" name="deposit" id="deposit" value="{{ old('deposit') }}">
				                </div>
				                @error('deposit')
				                  <div class="error-message text-danger pl-1 mt-1">
				                    <small>{{ $message }}</small>
				                  </div>
				                @enderror
				              </div>
				            </div>

				            <div class="mb-3 g-3 row" id="payment-method" style="display: none;">
				              <label class="col-sm-3 col-form-label text-end">Payment Method</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <select class="form-control" id="payment_method" name="payment_method" required>
				                  <option disabled hidden selected>Select Payment Method</option>
				                  @foreach($paymentmethods as $pm)
				                  <option value="{{$pm->name}}" @if (old('paymentmethods') == '{{$pm->name}}') selected @endif >{{$pm->name}}</option>
				                  @endforeach
				                </select>
				                @error('payment_method')
				                  <div class="error-message text-danger pl-1 mt-1">
				                    <small>{{ $message }}</small>
				                  </div>
				                @enderror
				              </div>
				            </div>
				        </section>  

						<section id="guest-info" style="display: none;">
							<div class="mb-3 g-3 row">
								<div class="col-sm-3 col-form-label text-end">
									<h6>Guest </sup></sup></h6>
								</div>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<div class="mb-3 m-t-5 m-checkbox-inline mb-0 custom-radio-ml">
										<div class="radio radio-secondary">
											<input id="new" value="new" type="radio" name="guesttype" {{ (old('guesttype') == 'new' ) ? 'checked' : '' }}>
											<label class="mb-0" for="new">New</label>
										</div>
										<div class="radio radio-secondary">
											<input id="returning" value="returning" type="radio" name="guesttype" {{ (old('guesttype') == 'returning' ) ? 'checked' : '' }}>
											<label class="mb-0" for="returning">Returning</label>
										</div>
									</div>
								</div>
							</div>
							<div id="new_guest" style="display: none;">
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Salutation*</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<select class="form-control" name="salutation">
		                              <option hidden selected disabled>Select Salutation</option>
		                              <option value="Mr">Mr</option>
		                              <option value="Mrs">Mrs</option>
		                              <option value="Miss">Miss</option>
		                              <option value="Dr">Dr</option>
		                              <option value="Engr.">Engr.</option>
		                              <option value="Barr.">Barr.</option>
	                           	  </select>
	                              </div>
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">First name*</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="text" name="first_name">
	                              </div>
	                              @error('first_name')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Last name*</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="text" name="last_name">
	                              </div>
	                              @error('last_name')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Email</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="email" name="email">
	                              </div>
	                              @error('email')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Phone*</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="tel" name="phone">
	                              </div>
	                               @error('phone')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Address</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="text" name="address">
	                              </div>
	                               @error('address')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">NIN / Passport Number</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="number" name="nin">
	                              </div>
	                              	@error('nin')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Emergency Contact</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="tel" name="emergency_contact">
	                              </div>
	                              	@error('emergency_contact')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Guest Note/Preference</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<textarea class="form-control" name="guest_note"></textarea>
	                              </div>
	                                @error('note')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
							</div>

							<div id="returning_guest" style="display: none;">
								<div class="mb-3 g-3 row">
				                    <label class="col-sm-3 col-form-label text-end">Guest </sup></label>
				                    <div class="col-xl-5 col-sm-7 col-lg-8">
				                    	<input type="text" placeholder="Search Guest Name" class="form-control flexdatalist" data-min-length='1' list='guests' name="guest">
					                    <datalist id="guests">
					                      @foreach ($guests as $guest)
					                        <option value="{{ $guest->id }}" @if(old('guest') == $guest->id) selected @endif> {{$guest->first_name.' '.$guest->last_name}}</option>
					                      @endforeach
					                    </datalist>
					                    <input type="hidden" name="guest_id" id="guest_id">
					                    <div class="guest_info" style="display: none;">
					                  		<p class="mt-2">Email :<span id="g-email"></span></p>
					                  		<p class="mt-2">Phone :<span id="g-phone"></span></p>
					                  		<p class="mt-2">Address :<span id="g-address"></span></p>
					                  		<p class="mt-2">Note :<span id="g-note"></span></p>
					                  	</div>
				                    </div>
			                  	</div>
							</div>
						</section>

						<section id="book" style="display: none;">
				            <div class="mb-3 g-3 row">
				              <label class="col-sm-3 col-form-label text-end" for="note">Purpose</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <input class="form-control" type="text" name="purpose" id="purpose">{{ old('purpose') }}
				              </div>
				            </div>
				            <div class="mb-3 g-3 row">
				              <label class="col-sm-3 col-form-label text-end" for="note">Car Number</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <input class="form-control" type="text" name="car_number" id="car_number">{{ old('car_number') }}
				              </div>
				            </div>
				            <div class="mb-3 g-3 row">
				              <label class="col-sm-3 col-form-label text-end" for="note">Booking Note</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <textarea class="form-control" rows="3" name="note" id="note">{{ old('note') }}</textarea>
				              </div>
				            </div>
				            <hr>

					        <div class="mb-3 g-3 row mt-2">
					            <div class="col-md-12">
					              <button type="submit" class="btn btn-block btn-outline-primary px-5">CREATE BOOKING</button>
					            </div>
					        </div>
					    </section>
				    </form>
				</div>
			</div>
		</div>
	</div>
</div>

  <div class="modal fade" id="no_rooms" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-secondary font-weight-medium" id="exampleModalLabel">No room found</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h6 class="font-weight-medium">No rooms matching queries were found. Change room type or dates and try again.</h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script src="{{asset('assets/js/touchspin/vendors.min.js')}}"></script>
<script src="{{asset('assets/js/touchspin/touchspin.js')}}"></script>
<script src="{{asset('assets/js/touchspin/input-groups.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.flexdatalist.min.js') }}"></script>
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script>
	//Date Validation
	$(function () {
	$('#checkin').change(function() {
		$('#checkout').val("")
		$('#duration').val("")
		$('.duration').hide('600')
		$('#check_availability').hide('600')
		$('#rooms').hide('600')
	    $('#confirm_rooms').hide('600')
	    $('.confirmed_rooms').val("")
	    $('#confirmed_rooms').hide('600')
	    $('#no_of_rooms').val("")
	    $('#number_of_rooms').hide('600')
	    $('#payment_info').hide('600')
	    $('.adults').hide('600')
        $('.children').hide('600')
        startdate = new Date($(this).val());
        startdate.setDate(startdate.getDate() + 1);
        var mindate = startdate.toISOString().substr(0,10);
        $('#checkout').attr('min', mindate);
        $('#btn-check').tooltip('enable')
      });
	$('#checkout').change(function() {
		$('#rooms').hide('600')
	    $('#confirm_rooms').hide('600')
	    $('.confirmed_rooms').val("")
	    $('#confirmed_rooms').hide('600')
	    $('#no_of_rooms').val("")
	    $('#number_of_rooms').hide('600')
	    $('#payment_info').hide('600')
	    $('.adults').hide('600')
        $('.children').hide('600')
        startdate = new Date($('#checkin').val());
        checkout = new Date($(this).val());
        diff = new Date(checkout - startdate);
        days  = diff/1000/60/60/24;
        if (days > 0) {
          $('#duration').val(days);
        }
        $('.duration').show('600')
        if ($('#roomtype_id').val()) {
           $('#check_availability').show('600')	
        }
        $('#btn-check').tooltip('disable')
      });
	$('#roomtype_id').change(function() {
		$('#rooms').hide('600')
	    $('#confirm_rooms').hide('600')
	    $('.confirmed_rooms').val("")
	    $('#confirmed_rooms').hide('600')
	    $('#no_of_rooms').val("")
	    $('#number_of_rooms').hide('600')
	    $('#payment_info').hide('600')
	    $('.adults').hide('600')
        $('.children').hide('600')
	    if ($('#checkin').val() && $('#checkout').val()) {
	       $('#check_availability').show('600')
	    }
      });


	$(".available_rooms").select2({
        placeholder: "Select Rooms"
    });

    $('form').on('click', '#btn-check', function() {
    	$('#available_rooms').empty()
    	$('#rooms').hide('600')
        $('#confirm_rooms').hide('600')
      let checkin = $('#checkin').val();
      let checkout = $('#checkout').val();
      let roomtype_id = $('#roomtype_id').val();
      if (checkin && checkout && roomtype_id) {
        let url = '{{ route('getavailablerooms', [":checkin", ":checkout", ":roomtype_id"]) }}'
        url = url.replace(':checkin', checkin)
        url = url.replace(':checkout', checkout)
        url = url.replace(':roomtype_id', roomtype_id)
        $.ajax({
          type:'GET',
          url: url,
          success:function(data){
          	if (data) {
          		rooms = data.rooms
                let html = "";
                $.each(rooms, function(i, v) {
                  html += `
                  <option value="${v.number}">${v.number}</option> 
                  `;
                });
                $('#available_rooms').append(html);
                $('#rooms').show('400')
                $('#check_availability').hide('600')
                $('#confirm_rooms').show('400')
          	} else {
                $('#available_rooms').append(html);
                $('#rooms').hide('600');
                $('#no_rooms').modal('show')
          	}
          },
          error:function(e) {
            console.log(e)
          }
        });
        $('#btn-confirm').tooltip('disable')
      } else {
        $('#btn-check').tooltip('enable')
      }
    });


    $('form').on('click', '#reset_rooms', function() {
    	$('#rooms').show('600')
        $('#confirm_rooms').show('600')
        $('#check_availability').hide('600')
        $('#number_of_rooms').hide('600')
        $('#payment_info').hide('600')
        $('#confirmed_rooms').hide('600')
        $('.adults').hide('600')
        $('.children').hide('600')
    });

    $('form').on('click', '#btn-confirm', function() {
      let duration = $('#duration').val();
      if (duration) {
      	let rooms = $('#available_rooms').val();
        let roomtype_id = $("#roomtype_id").val();
        let no_of_rooms = rooms.length;
        if (roomtype_id && no_of_rooms) {
         let url = '{{ route('gettotalcost', [":roomtype_id", ":no_of_rooms", ":duration"]) }}'
         url = url.replace(':roomtype_id', roomtype_id)
         url = url.replace(':no_of_rooms', no_of_rooms)
         url = url.replace(':duration', duration)
          $.ajax({
            type:'GET',
            url: url,
            success:function(data){
            	console.log(data)
              $('#cost').val(data.cost);
              $('#caution').val(data.caution);
              $('#discount').attr('max', data.cost);
              $('#adults').attr('max', data.adults);
              $('#children').attr('max', data.children);
              $('#deposit').attr('max', data.cost - 1);
            },
            error:function(e) {
            console.log(e)
          	}
          });
          $('#no_of_rooms').val(no_of_rooms)
          $('#confirm_rooms').hide('600')
          $('#number_of_rooms').show('600')
          $('#payment_info').show('600')
          $('.confirmed_rooms').val(rooms)
          $('#confirmed_rooms').show('600')
          $('#rooms').hide('600')
          $('.adults').show('600')
          $('.children').show('600')
        } else {
        	$('#btn-confirm').tooltip('enable')
      	   } 
      }  
    });

    $('#adults').change(function() {
    	if ($(this).val()>$(this).attr('max')) {
    		alert('Adult capacity for selected room(s) exceeded')
    		$(this).val($(this).attr('max'))
    	}
      });

    $('#children').change(function() {
    	if ($(this).val()>$(this).attr('max')) {
    		alert('Children capacity for selected room(s) exceeded')
    		$(this).val($(this).attr('max'))
    	}
      });

    $('#payment_status').change(function() {
        if ($(this).val() == 1) {
          $('.deposit').hide('600')
          $('#payment-method').show('600')
          $('#payment-method').prop('required', true)
        } else if ($(this).val() == 2) {
          $('.deposit').show('600')	
          $('#payment-method').show('600')
          $('#payment-method').prop('required', true)
        } else if ($(this).val() == 0) {
        	$('#payment-method').prop('required', false)
        	$('#payment-method').hide('600')
        	$('.deposit').hide('600')
        	$('#guest-info').show('600')
        }
      });

    $('#payment_method').change(function() {
          $('#guest-info').show('600')
      });


	$('input[type=radio][name=guesttype]').change(function() {
	    if (this.value == 'returning') {
	      $('#new_guest').hide('600');
	      $('#returning_guest').show('400');
	    } else {
	      $('#returning_guest').hide('600');
	      $('#new_guest').show('400');
	      $('#book').show('600')
	    }
	  });

	$('.flexdatalist').flexdatalist({
	    minLength: 1,
	    noResultsText: 'No Guest found for "{keyword}"'
	  });

  	$('input.flexdatalist').on('select:flexdatalist', function(event, set, options) {
      let guestid = set.value;
      let url = '{{ route('getguestdata', ":guestid") }}'
      url = url.replace(':guestid', guestid)

      $.ajax({
        type:'GET',
        url: url,
        success:function(data){
	    	if (data.email) {
	    		$('#g-email').text(data.email)		
	    	} else {
	    		$('#g-email').text('Guest email not in records')
	    	}
	    	if (data.phone) {
	    		$('#g-phone').text(data.phone)		
	    	} else {
	    		$('#g-phone').text('Guest phone number not in records')
	    	}
	    	if (data.note) {
	    		$('#g-note').text(data.note)		
	    	} else {
	    		$('#g-note').text('No available note for guest')
	    	}
	    	if (data.address) {
	    		$('#g-address').text(data.address)		
	    	} else {
	    		$('#g-address').text('Guest address not in records')
	    	}
          $('#guest_id').val(data.guest_id)
        },
        error:function(e) {
          console.log(e)
        }
      });
      $('.guest_info').show('500');
      $('#book').show('600')
    });

    })  // end of document ready function 
</script>
@endsection