@extends('layouts.simple.master')
@section('title', 'Create Booking')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.flexdatalist.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Book Room</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Rooms</li>
<li class="breadcrumb-item active">Book</li>
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
					<form class="theme-form" action="{{route('book.room')}}" method="POST">
						@csrf
						<section>
							@php $today = date('Y-m-d') @endphp
							<div class="mb-3 row">
								<label class="col-sm-3 col-form-label text-right">Check In</label>
								<div class="input-group date col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control datetimepicker-input digits" min="{{ $today }}" type="date" id="checkin" value="{{ old('checkin') }}" name="checkin" required="">
								</div>
							</div>

							@php 
			                  $nextday = date('Y-m-d', strtotime($today))." +1 day";
			                  $nextday = date('Y-m-d', strtotime($nextday));
			                @endphp
							<div class="mb-3 row">
								<label class="col-sm-3 col-form-label text-right">Check Out</label>
								<div class="input-group date col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control datetimepicker-input digits" type="date" min="{{ $nextday }}" id="checkout" name="checkout" value="{{ old('checkout') }}" required="">
								</div>
							</div>

							<div class="mb-3 row duration" style="display: none;">
								<label class="col-sm-3 col-form-label text-right">Duration</label>
								<div class="input-group col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control" type="number" id="duration" name="duration" readonly value="{{ old('duration') }}">
									<div class="input-group-append">
					                    <span class="input-group-text">Nights</span>
					                </div>
								</div>
							</div>

							<div class="mb-3 row">
								<label class="col-sm-3 col-form-label text-right">Room</label>
								<div class="col-xl-5 col-sm-7 col-lg-8 input-group">
									<input class="form-control" type="number" value="{{$room->number}}" name="room_number" readonly required>
								</div>
							</div>

							<div class="mb-3 row">
				                <label class="col-sm-3 col-form-label text-right">Adults</label>
				                <div class="col-xl-5 col-sm-7 col-lg-8 input-group">
				                  <input class="touchspin" type="number" min="1" max="{{$room->room_type->adult_capacity}}" name="adults" id="adults" required value="{{ old('adults', 1) }}">
				                </div>
				            </div>

				            <div class="mb-3 row">
				                <label class="col-sm-3 col-form-label text-right">Children</label>
				                <div class="col-xl-5 col-sm-7 col-lg-8 input-group">
				                  <input class="touchspin" type="number" min="0" max="{{$room->room_type->children_capacity}}" id="children" name="children" required value="{{ old('children', 0) }}">
				                </div>
				            </div>
						</section>

						<section id="payment_info" style="display:none;">
				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-right">Cost </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                  <div class="input-group-prepend">
				                    <span class="input-group-text">N</span>
				                  </div>
				                  <input type="number" class="form-control" id="cost" name="cost" value="{{$room->room_type->rate}}" readonly>
				                </div>
				              </div>
				            </div>

				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-right">Caution Fee (Refundable) </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                  <div class="input-group-prepend">
				                    <span class="input-group-text">N</span>
				                  </div>
				                  <input type="number" class="form-control" name="caution" id="caution" value="{{$room->room_type->caution}}" readonly>
				                </div>
				              </div>
				            </div>

				            <div class="media row">
								<label class="col-form-label col-md-3 text-right">Caution Paid?</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<div class="media-body icon-state">
										<label class="switch">
										<input value="1" name="caution_status" type="checkbox" {{ (old('caution_status') == '1' ) ? 'checked' : '' }}><span class="switch-state"></span>
										</label>
									</div>
								</div>
							</div>

				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-right">Discount </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                  <div class="input-group-prepend">
				                    <span class="input-group-text">N</span>
				                  </div>
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
				              <label class="col-form-label col-md-3 text-right">Extra Charge </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                  <div class="input-group-prepend">
				                    <span class="input-group-text">N</span>
				                  </div>
				                  <input type="number" class="form-control" name="extra_charge" id="extra_charge" value="{{ old('extra_charge') }}" min="0">
				                </div>
				              </div>
				            </div>

				            <div class="mb-3 row">
				              <label class="col-sm-3 col-form-label text-right">Payment Status </sup></label>
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
				              <label class="col-form-label col-md-3 text-right">Deposit </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                  <div class="input-group-prepend">
				                    <span class="input-group-text">N</span>
				                  </div>
				                  <input type="number" class="form-control" name="deposit" id="deposit" value="{{ old('deposit') }}">
				                </div>
				                @error('deposit')
				                  <div class="error-message text-danger pl-1 mt-1">
				                    <small>{{ $message }}</small>
				                  </div>
				                @enderror
				              </div>
				            </div>

				            <div class="mb-3 row" id="payment-method" style="display: none;">
				              <label class="col-sm-3 col-form-label text-right">Payment Method</sup></label>
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
							<div class="mb-3 row">
								<div class="col-sm-3 col-form-label text-right">
									<h6>Guest: </sup></sup></h6>
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
	                           <div class="mb-3 row">
	                              <label class="col-sm-3 col-form-label text-right">Salutation*</label>
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
	                           <div class="mb-3 row">
	                              <label class="col-sm-3 col-form-label text-right">First name*</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="text" name="first_name">
	                              </div>
	                              @error('first_name')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 row">
	                              <label class="col-sm-3 col-form-label text-right">Last name*</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="text" name="last_name">
	                              </div>
	                              @error('last_name')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 row">
	                              <label class="col-sm-3 col-form-label text-right">Email</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="email" name="email">
	                              </div>
	                              @error('email')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 row">
	                              <label class="col-sm-3 col-form-label text-right">Phone*</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="tel" name="phone">
	                              </div>
	                               @error('phone')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 row">
	                              <label class="col-sm-3 col-form-label text-right">Address</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="text" name="address">
	                              </div>
	                               @error('address')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 row">
	                              <label class="col-sm-3 col-form-label text-right">NIN / Passport Number</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="number" name="nin">
	                              </div>
	                              	@error('nin')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 row">
	                              <label class="col-sm-3 col-form-label text-right">Emergency Contact</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="tel" name="emergency_contact">
	                              </div>
	                              	@error('emergency_contact')
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small>{{ $message }}</small>
				                      </div>
				                    @enderror
	                           </div>
	                           <div class="mb-3 row">
	                              <label class="col-sm-3 col-form-label text-right">Guest Note/Preference</label>
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
								<div class="mb-3 row">
				                    <label class="col-sm-3 col-form-label text-right">Guest: </sup></label>
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
				            <div class="mb-3 row">
				              <label class="col-sm-3 col-form-label text-right" for="note">Purpose:</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <input class="form-control" type="text" name="purpose" id="purpose">{{ old('purpose') }}
				              </div>
				            </div>
				            <div class="mb-3 row">
				              <label class="col-sm-3 col-form-label text-right" for="note">Car Number:</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <input class="form-control" type="text" name="car_number" id="car_number">{{ old('car_number') }}
				              </div>
				            </div>
				            <div class="mb-3 row">
				              <label class="col-sm-3 col-form-label text-right" for="note">Booking Note</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <textarea class="form-control" rows="3" name="note" id="note">{{ old('note') }}</textarea>
				              </div>
				            </div>
				            <hr>

					        <div class="mb-3 row mt-2">
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
		let rate = $('#cost').val();
	$('#checkin').change(function() {
		$('#checkout').val("")
		$('#duration').val("")
		$('.duration').hide('600')
		$('#payment_info').hide('600')
        startdate = new Date($(this).val());
        startdate.setDate(startdate.getDate() + 1);
        var mindate = startdate.toISOString().substr(0,10);
        $('#checkout').attr('min', mindate);
      });

	$('#checkout').change(function() {
        startdate = new Date($('#checkin').val());
        checkout = new Date($(this).val());
        diff = new Date(checkout - startdate);
        days  = diff/1000/60/60/24;
        if (days > 0) {
          $('#duration').val(days);
        }
        $('.duration').show('600')
        $('#cost').val(days * rate)
        $('#payment_info').show('600')
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