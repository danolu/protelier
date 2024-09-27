@extends('layouts.simple.master')
@section('title', 'Payments')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Payments</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>Payments</h5>
            </div>
            <div class="card-body">
               <div class="table-responsive product-table">
                  <table class="display" id="basic-1">
                     <thead>
                        <tr>
                           <th>S/N</th>
                           <th>Customer</th>
                           <th>Amount</th>
                           <th>Method</th>
                           <th>For</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($payments as $payment)
                        <tr>
                           <td>{{++$k}}</td>
                           <td>{{$payment->customer}}</td>
                           <td>N{{$payment->amount}}</td>
                           <td>{{$payment->method}}</td>
                           <td>{{$payment->description}} X{{$payment->quantity}}</td>
                           <td><a class="btn btn-success" href="{{route('payments.show', $payment->id)}}">View</a>
                           @can('payment')<a class="btn btn-danger" href="{{route('payments.destroy', $payment->id)}}">Delete</a>@endcan</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <!-- Individual column searching (text inputs) Ends-->
   </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/product-list-custom.js')}}"></script>
@endsection