@extends('layouts.simple.master')
@section('title', 'Edit Booking')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>New Booking</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Bookings</li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h5>Edit Booking {{$booking->booking_id}}</h5>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<form class="theme-form" action="{{route('bookings.update', $booking->id)}}" method="POST">
						@csrf
						@method('patch')
						<section>
							<div class="mb-3 row">
								<label class="col-sm-3 col-form-label text-right">Check In</label>
								<div class="input-group date col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control datetimepicker-input digits" type="date" id="checkin" value="{{ date('Y-m-d', strtotime($booking->checkin)) }}" name="checkin" required="" readonly>
								</div>
							</div>

							@php 
			                  $nextday = date('Y-m-d', strtotime($booking->checkin))." +1 day";
			                  $nextday = date('Y-m-d', strtotime($nextday));
			                @endphp
							<div class="mb-3 row">
								<label class="col-sm-3 col-form-label text-right">Check Out</label>
								<div class="input-group date col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control datetimepicker-input digits" type="date" min="{{ $nextday }}" id="checkout" name="checkout" value="{{ date('Y-m-d', strtotime($booking->checkout)) }}" readonly required="">
								</div>
							</div>

							<div class="mb-3 row duration">
								<label class="col-sm-3 col-form-label text-right">Duration</label>
								<div class="input-group col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control" type="number" id="duration" name="duration" readonly value="{{(strtotime($booking->checkout) - strtotime($booking->checkin))/60/60/24}}">
									<div class="input-group-append">
					                    <span class="input-group-text">Nights</span>
					                </div>
								</div>
							</div>

		                    <div class="mb-3 row">
								<label class="col-sm-3 col-form-label text-right">Room Type</label>
								<div class="col-xl-5 col-sm-7 col-lg-8 input-group">
									<select class="form-control digits" id="roomtype_id" required disabled>
									@foreach ($roomtypes as $roomtype)
										<option @if($booking->rooms[0]->room_type->id == $roomtype->id) selected @endif value="{{$roomtype->id}}">{{ $roomtype->name }}</option>
									@endforeach	
									</select>
								</div>
							</div>
							
							<div class="mb-3 row" id="check_availability" style="display: none;">
								<label class="col-sm-3 col-form-label text-right"></label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<button class="btn btn-outline-primary btn-check" type="button" data-bs-toggle="tooltip" title="You haven't picked dates ">Check Availability</button>
								</div>
							</div>
							<div class="mb-3 row" id="rooms" style="display: none;">
								<label class="col-sm-3 col-form-label text-right">Available Rooms</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<select class="available_rooms col-12" id="available_rooms" multiple="multiple">
									</select>
								</div>
							</div>

							<div class="mb-3 row" id="confirm_rooms" style="display: none;">
								<label class="col-sm-3 col-form-label text-right"></label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<button class="btn btn-outline-primary btn-confirm" type="button" data-bs-toggle="tooltip" title="Rooms haven't been chosen">Confirm Room(s)</button>
								</div>
							</div>

							<div class="mb-3 row" id="confirmed_rooms">
								<label class="col-sm-3 col-form-label text-right">Room(s)</label>
								<div class="col-xl-5 col-sm-7 col-lg-8 input-group">
									<input class="form-control confirmed_rooms" type="text" name="room_numbers" value="@foreach ($booking->rooms as $i => $room) {{$booking->rooms[$i]->number}} @endforeach" readonly><!-- <button class="btn btn-xs btn-info" id="reset_rooms">edit</button> -->
								</div>
							</div>

							<div class="mb-3 row" id="number_of_rooms">
								<label class="col-sm-3 col-form-label text-right">Number of Rooms</label>
								<div class="col-xl-5 col-sm-7 col-lg-8 input-group">
									<input class="form-control" id="no_of_rooms" value="{{$booking->rooms->count()}}" readonly type="number" name="no_of_rooms">
								</div>
							</div>

							<div class="mb-3 row adults">
				                <label class="col-sm-3 col-form-label text-right">Adults</label>
				                <div class="col-xl-5 col-sm-7 col-lg-8 input-group">
				                  <input class="touchspin" type="number" min="1" name="adults" max="{{$booking->rooms[0]->room_type->adult_capacity * $booking->rooms->count()}}" id="adults" required="" value="{{ $booking->adults }}">
				                </div>
				            </div>

				            <div class="mb-3 row children">
				                <label class="col-sm-3 col-form-label text-right">Children</label>
				                <div class="col-xl-5 col-sm-7 col-lg-8 input-group">
				                  <input class="touchspin" type="number" min="0" max="{{$booking->rooms[0]->room_type->children_capacity * $booking->rooms->count()}}" id="children" name="children" required="" value="{{ $booking->children }}">
				                </div>
				            </div>
						</section>

						<section id="payment_info">
				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-right">Cost: </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                  <div class="input-group-prepend">
				                    <span class="input-group-text">N</span>
				                  </div>
				                  <input type="number" class="form-control" name="cost" id="cost" value="{{ $booking->charge }}" readonly>
				                </div>
				              </div>
				            </div>

				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-right">Caution Fee (Refundable): </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                  <div class="input-group-prepend">
				                    <span class="input-group-text">N</span>
				                  </div>
				                  <input type="number" class="form-control" name="caution" id="caution" value="{{ $booking->caution }}" readonly>
				                </div>
				              </div>
				            </div>

				            <div class="media row">
								<label class="col-form-label col-md-3 text-right">Caution Paid?:</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<div class="media-body icon-state">
										<label class="switch">
										<input value="1" name="caution_status" type="checkbox" {{ ($booking->caution_status == '1' ) ? 'checked' : '' }}><span class="switch-state"></span>
										</label>
									</div>
								</div>
							</div>

				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-right">Discount: </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                  <div class="input-group-prepend">
				                    <span class="input-group-text">N</span>
				                  </div>
				                  <input type="number" class="form-control" name="discount" id="discount" value="{{ $booking->discount }}" min="0" >
				                </div>
				                @error('discount')
				                  <div class="error-message text-danger pl-1 mt-1">
				                    <small>{{ $message }}</small>
				                  </div>
				                @enderror
				              </div>
				            </div>

				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-right">Extra Charge: </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                  <div class="input-group-prepend">
				                    <span class="input-group-text">N</span>
				                  </div>
				                  <input type="number" class="form-control" name="extra_charge" id="extra_charge" value="{{ $booking->extra_charge }}" min="0">
				                </div>
				              </div>
				            </div>

				            <div class="mb-3 row">
				              <label class="col-sm-3 col-form-label text-right">Payment Status: </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <select class="form-control" id="payment_status" name="payment_status" required>
				                  <option value="1" @if ($booking->payment_status == 1) selected @endif >Full Payment</option>
				                  <option value="2" @if ($booking->payment_status == 2) selected @endif >Deposit</option>
				                  <option value="0" @if ($booking->payment_status == 0) selected @endif >Credit</option>
				                </select>
				                @error('payment_status')
				                  <div class="error-message text-danger pl-1 mt-1">
				                    <small>{{ $message }}</small>
				                  </div>
				                @enderror
				              </div>
				            </div>
				            
				            <div class="row mb-4 deposit" @if($booking->payment_status==0 || $booking->payment_status==1)style="display: none; @endif">
				              <label class="col-form-label col-md-3 text-right">Deposit: </sup></label>
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

				            <div class="mb-3 row" id="payment-method">
				              <label class="col-sm-3 col-form-label text-right">Payment Method:</sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <select class="form-control" id="payment_method" name="payment_method" required>
				                  <option value="Transfer" @if ($booking->payment_method == "Transfer") selected @endif > Transfer</option>
								  <option value="POS" @if ($booking->payment_method == "POS") selected @endif > POS</option>
								  <option value="Cash" @if ($booking->payment_method == "Cash") selected @endif > Cash</option>
				                </select>
				                @error('payment_method')
				                  <div class="error-message text-danger pl-1 mt-1">
				                    <small>{{ $message }}</small>
				                  </div>
				                @enderror
				              </div>
				            </div>
				        </section>  

						<section id="guest-info">
							<div class="mb-3 row">
			                    <label class="col-sm-3 col-form-label text-right"><h6>Guest </h6></sup></label>
			                    <div class="col-xl-5 col-sm-7 col-lg-8">
				                    <div class="guest_info">
				                    	<p class="mt-2">{{$booking->guest->salutation.' '.$booking->guest->first_name.' '.$booking->guest->last_name}}</p>
				                  		<p class="mt-2">Email: {{$booking->guest->email}}</p>
				                  		<p class="mt-2">Phone: {{$booking->guest->phone}}</p>
				                  		<p class="mt-2">Address: {{$booking->guest->address}}</p>
				                  		<p class="mt-2">Note: {{$booking->guest->phone}}</p>
				                  	</div>
			                    </div>
		                  	</div>
						</section>

						<section id="book">
				            <div class="mb-3 row">
				              <label class="col-sm-3 col-form-label text-right" for="note">Purpose:</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <input class="form-control" type="text" name="purpose" value="{{$booking->purpose}}" id="purpose">
				              </div>
				            </div>
				            <div class="mb-3 row">
				              <label class="col-sm-3 col-form-label text-right" for="note">Car Number:</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <input class="form-control" type="text" value="{{$booking->car_number}}" name="car_number" id="car_number">
				              </div>
				            </div>
				            <div class="mb-3 row">
				              <label class="col-sm-3 col-form-label text-right" for="note">Booking Note:</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <textarea class="form-control" rows="3" name="note" id="note">{{ $booking->note }}</textarea>
				              </div>
				            </div>
				            <hr>

					        <div class="mb-3 row mt-2">
					            <div class="col-md-12">
					              <button type="submit" class="btn btn-block btn-outline-primary px-5">UPDATE BOOKING</button>
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
        $('.btn-check').tooltip('enable')
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
        $('.btn-check').tooltip('disable')
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

    $('form').on('click', '.btn-check', function() {
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
        $('.btn-confirm').tooltip('disable')
      } else {
        $('.btn-check').tooltip('enable')
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

    $('form').on('click', '.btn-confirm', function() {
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
        	$('.btn-confirm').tooltip('enable')
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

    })  // end of document ready function 
</script>
@endsection