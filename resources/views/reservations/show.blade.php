@extends('layouts.simple.master')
@section('title', 'Booking')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')<li class="breadcrumb-item active">Booking</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-header b-l-primary d-flex justify-content-between">
            <h5>Booking Details</h5>
            <div>
               @if($booking->status==1 || $booking->status==2)
               <a class="btn btn-outline-info" href="{{route('bookings.edit', $booking->id)}}">Edit Booking</a>
               @endif
               @if($booking->status!=0 && $booking->payment_status==1)
               <a class="btn btn-outline-success" href="{{route('bookings.details', $booking->id)}}">Receipt</a>
               @endif 
               @if($booking->status==1)
               <a class="btn btn-outline-primary" href="{{route('checkin', $booking->id)}}">Checkin</a>
               @elseif($booking->status==2)
               <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#checkout">Checkout</a>
               @endif 
               @if($booking->status==1 || $booking->status==2)
               <a class="btn btn-warning" href="#" data-bs-toggle="modal" data-bs-target="#cancel">Cancel</a> 
               @endif
               @can('delete booking')
               <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete">Delete</a>  
               @endcan
            </div>      
         </div>
         <div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel2">Checkout</h5>
                     <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  </div>
                  <form method="POST" action="{{route('checkout', $booking->id)}}">
                   @csrf
                     <div class="modal-body">
                        <div class="mb-3">
                           <label class="col-form-label">Property Damage Cost:</label>
                           <input class="form-control" type="number" name="property_damage_cost">
                        </div>
                        <div class="mb-3">
                           <label class="col-form-label">Note:</label>
                           <textarea class="form-control" name="note">{{$booking->note}}</textarea>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Checkout</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel2">Delete Booking</h5>
                     <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  </div>
                  <form method="POST" action="{{route('bookings.destroy', $booking->id)}}">
                  @method('delete')
                   @csrf
                     <div class="modal-body">
                        <h6>Are you sure you want to delete booking?</h6>
                     </div>
                     <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Delete</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel2">Cancel Booking</h5>
                     <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  </div>
                  <form method="POST" action="{{route('bookings.cancel', $booking->id)}}">
                   @csrf
                     <div class="modal-body">
                        <h6>Are you sure you want to cancel booking?</h6>
                     </div>
                     <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Cancel</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="card-body">
            <h6>Booking Number</h6>
            <p>{{$booking->booking_id}}</p>

            <h6>Booking Date</h6>
            <p>{{date("d-m-y", strtotime($booking->created_at))}}</p>
            
            <h6>Checkin</h6>
            <p>{{date('d-m-Y', strtotime($booking->checkin))}}</p>

            <h6>Checkout</h6>
            <p>{{date('d-m-Y', strtotime($booking->checkout))}}</p>

            <h6>Duration</h6>
            <p>{{(strtotime($booking->checkout) - strtotime($booking->checkin))/60/60/24}} Nights</p>

            <h6>Occupants</h6>
            <p>Adults: {{$booking->adults}}</p>
            <p>Children: {{$booking->children}}</p>

            <h6>Guest</h6>
            <p>{{$booking->guest->first_name.' '.$booking->guest->last_name}}</p>

            <h6>Car Number</h6>
            @if($booking->car_number)
            <p>{{$booking->car_number}}</p>
            @else
            <p>No car number was resgistered for guest for this booking</p>
            @endif

            <h6>@if($booking->rooms->count()==1) Room @else Rooms @endif</h6> 
            @foreach ($booking->rooms as $i => $room) 
            <p>{{$booking->rooms[$i]->room_type->name.' - Room '.$booking->rooms[$i]->number}}</p>
            @endforeach

            <h6>Charge</h6>
            <p>N{{number_format($booking->charge)}}</p>

            <h6>Discount</h6>
            <p>@if($booking->discount==0) None @else N{{number_format($booking->discount)}} @endif</p>

            <h6>Extra Charge</h6>
            <p>@if($booking->extra_charge==0) None @else N{{number_format($booking->extra_charge)}} @endif</p>

            <h6>Payable</h6>
            <p>N{{number_format($booking->payable)}}</p>

            <h6>Payment Status</h6>
            @if($booking->payment_status==1)
            <p class="text-success">Fully Paid</p>
            <h6>Payment Method</h6>
            <p>{{$booking->payment_method}}</p>
            @elseif($booking->payment_status==2)
            <p class="text-success">Deposit</p>
            <h6>Outstanding</h6>
            <p class="text-success">{{number_format($booking->outstanding)}}</p>
            @elseif($booking->payment_status==0)
            <p class="text-success">Unpaid</p>
            @elseif($booking->payment_status==3)
            <p class="text-success">Refunded</p>
            @endif

            <h6>Caution</h6>
            <p>N{{number_format($booking->caution)}}</p>

            <h6>Caution Status</h6>
            <p>@if($booking->caution_status==0) <span class="text-danger">Unpaid</span> @elseif($booking->caution_status==1) <span class="text-success">Paid</span> @elseif($booking->caution_status==3) <span class="text-info">Refunded</span>@endif</p>

            <h6>Booking Status</h6>
            @if($booking->status==0)
            <p class="text-danger">Cancelled: {{date('d-m-Y', strtotime($booking->cancellation_date))}}</p>
            @elseif($booking->status==1)
            <p class="text-warning">Awaiting Checkin</p>
            @elseif($booking->status==2)
            <p class="text-success">Checked In: {{date('d-m-Y', strtotime($booking->checked_in))}}</p>
            @elseif($booking->status==3)
            <p class="text-info">Checked Out: {{date('d-m-Y', strtotime($booking->checked_out))}}</p>
            <h6>Property Damage Cost</h6>
            @if($booking->property_damage_cost)
            <p>N{{$booking->property_damage_cost}}</p>
            @else
            <p>No property damage was recorded for guest</p>
            @endif
            @endif
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection