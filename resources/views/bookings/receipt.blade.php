@extends('layouts.auth.master')
@section('title', 'Booking Receipt')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')<li class="breadcrumb-item active">Booking</li>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>BOOKING RECEIPT</h5>
            </div>
            <div class="card-body">
               <div class="invoice">
                  <div>
                     <div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="media">
                           <div class="media-left"><img class="media-object img-60" src="{{asset('assets/images/logo-icon.png')}}" alt=""></div>
                           <div class="media-body m-l-20">
                              <h4 class="media-heading">{{$hotel->name}}</h4>
                              <p>{{$hotel->tagline}}</p>
                           </div>
                        </div>
                        <!-- End Info-->
                     </div>
                     <div class="col-sm-6">
                        <div class="text-md-right">
                           <h3> {{$booking->booking_id}}</h3>
                           <p>Date: <span>{{date("d-m-y", strtotime($booking->created_at))}}</span>                                                         
                        </div>
                        <!-- End Title-->
                     </div>
                  </div>
                     <hr>
                     <!-- End InvoiceTop-->
                     <div class="row">
                        <div class="col-md-5">
                           <div class="media">
                              <div class="media-body m-l-20">
                                 <h4 class="media-heading">Guest: {{$booking->guest->first_name.' '.$booking->guest->last_name}}</h4>
                                 <p>@if ($booking->guest->email){{$booking->guest->email}}<br> @endif <span>{{$booking->guest->phone}}</span></p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-7">
                           <div class="text-md-start" id="project">
                              @if($booking->caution_status==1)
                              <p>*Caution fee of N{{number_format($booking->caution)}} is refundable during checkout if no damage is made <br>
                              @endif
                              *VAT is included in room rate <br> Payment Method: {{$booking->payment_method}}</p>
                           </div>
                        </div>
                     </div>
                     <hr>
                     <!-- End Invoice Mid-->
                     <div>
                        <div class="table-responsive invoice-table" id="table">
                           <table class="table table-bordered table-striped">
                              <tbody>
                                 <tr>
                                    <td class="item">
                                       <h6 class="p-2 mb-0">@if($booking->rooms->count()==1) Room @else Rooms @endif Description</h6>
                                    </td>
                                    <td class="Rate">
                                       <h6 class="p-2 mb-0 text-center">Duration</h6>
                                    </td>
                                    <td class="Rate">
                                       <h6 class="p-2 mb-0 text-center">Checkin</h6>
                                    </td>
                                    <td class="Rate">
                                       <h6 class="p-2 mb-0 text-center">Checkout</h6>
                                    </td>
                                    <td class="subtotal text-start">
                                       <h6 class="p-2 mb-0">Rate</h6>
                                    </td>
                                 </tr>
                                 @foreach ($booking->rooms as $i => $room)
                                 <tr>
                                    <td>
                                       <label class="p-2">
                                       {{$booking->rooms[$i]->room_type->name.' - Room '.$booking->rooms[$i]->number}}<br> 
                                      </label>
                                    </td>
                                    <td>
                                       <p class="itemtext p-2 text-center">{{(strtotime($booking->checkout) - strtotime($booking->checkin))/60/60/24}} Nights</p>
                                    </td>
                                    <td>
                                       <p class="itemtext p-2 text-center">{{date('d-m-Y', strtotime($booking->checkin))}}</p>
                                    </td>
                                    <td>
                                       <p class="itemtext p-2 text-center">{{date('d-m-Y', strtotime($booking->checkout))}}</p>
                                    </td>
                                    <td>
                                       <p class="itemtext p-2 text-start">N{{number_format($booking->charge/$booking->rooms->count())}}</p>
                                    </td>
                                 </tr>
                                  @endforeach
                                  @if($booking->discount>0)
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                       <p class="itemtext p-2 text-center"><strong>Discount</strong></p>
                                    </td>
                                    <td>
                                       <p class="itemtext p-2 text-start">-N{{number_format($booking->discount)}}</p>
                                    </td>
                                 </tr>
                                 @endif
                                 @if($booking->extra_charge>0)
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                       <p class="itemtext p-2 text-center"><strong>Extra Charge</strong></p>
                                    </td>
                                    <td>
                                       <p class="itemtext p-2 text-start">N{{number_format($booking->extra_charge)}}</p>
                                    </td>
                                 </tr>
                                 @endif
                                 <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="Rate">
                                       <h6 class="mb-0 p-2 text-center">Total</h6>
                                    </td>
                                    <td class="payment">
                                       <h6 class="mb-0 p-2 text-start">N{{number_format($booking->payable)}}</h6>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <!-- End Table-->
                        <div class="row">
                           <div class="col-md-8">
                              <div>
                                 <p class="legal"><strong>Thank you for your lodging with us!</strong>  We hope you enjoy your stay. </p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- End InvoiceBot-->
                  </div>
                  <!-- End Invoice-->
                  <!-- End Invoice Holder-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/print.js')}}"></script>
<script>window.onload = function() {
    window.print();
}; 
</script>
@endsection