@extends('layouts.auth.master')
@section('title', 'Payment Invoice')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Payments</li>
<li class="breadcrumb-item active">Receipt</li>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>PAYMENT RECEIPT</h5>
            </div>
            <div class="card-body">
               <div class="invoice">
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
                           <h3>ID >>> #000{{$payment->id}}</h3>
                           <p>Issue Date: <span>{{date("d-m-y", strtotime($payment->created_at))}}</span>                                                         
                        </div>
                        <!-- End Title-->
                     </div>
                  </div>
                  <hr>
                     <!-- End InvoiceTop-->
                     <div class="row">
                        <div class="col-md-6">
                           <div class="m-l-20 m-4">
                              <h6>Customer: {{$payment->customer}}</h6>
                              <p>Payment Method: {{$payment->method}}</p>
                           </div>
                        </div>
                     </div>
                     <!-- End Invoice Mid-->
                     <hr>
                     <div>
                        <div class="table-responsive invoice-table" id="table">
                           <table class="table table-bordered table-striped">
                              <tbody>
                                 <tr>
                                    <td class="item">
                                       <h5 class="p-2 mb-0">Item Description</h5>
                                    </td>
                                    <td class="subtotal">
                                       <h5 class="p-2 mb-0 text-right">Amount</h5>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <p class="p-2 m-0">{{$payment->description}}X{{$payment->quantity}}</p>
                                    </td>
                                    <td>
                                       <p class="itemtext text-right">N{{number_format($payment->amount)}}</p>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <h6 class="p-2 m-0 text-right">Total</h6>
                                    </td>
                                    <td>
                                       <h6 class="itemtext text-right">N{{number_format($payment->amount)}}</h6>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <!-- End Table-->
                        <div class="row">
                           <div class="col-md-12">
                              <div class="m-4 d-flex justify-content-between">
                                 <p>
                                    {{$hotel->address}} <br>
                                    {{$hotel->phone}}, {{$hotel->alt_phone}}
                                 </p>
                                 <p>
                                    {{$hotel->website}} <br>
                                    {{$hotel->email}}
                                 </p>
                              </div>
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
<script>
window.onload = function() {
    window.print();
}; 
</script>
@endsection