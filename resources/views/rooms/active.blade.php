@extends('layouts.simple.master')
@section('title', 'Active Rooms')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/rating.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Checked In Rooms</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Rooms</li>
<li class="breadcrumb-item active">Active</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-body">
               <div class="table-responsive product-table">
                  <table class="display" id="basic-1">
                     <thead>
                        <tr>
                           <th>Number</th>
                           <th>Type</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           @foreach($rooms as $room)
                           <td>{{$room->number}}</td>
                           <td>{{$room->type->name}}</td>
                           <td class="font-success">Occupied</td>
                           <td>
                              <button class="btn btn-success btn-xs" type="button" title="">Edit</button>
                              <button class="btn btn-danger btn-xs" type="button" title="">Delete</button>
                           </td>
                           @endforeach
                        </tr>
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
<script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/product-list-custom.js')}}"></script>
@endsection