@extends('layouts.simple.master')
@section('title', 'Available Rooms')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Available Rooms</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Rooms</li>
<li class="breadcrumb-item active">Available</li>
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
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($rooms as $room)
                        <tr>
                           <td>{{$room->number}}</td>
                           <td>{{$room->room_type->name}}</td>
                           <td>
                              <a class="btn btn-success btn-xs" href="{{route('rooms.book', $room->id)}}">Book</a>
                              <a class="btn btn-warning btn-xs" href="{{route('rooms.deactivate', $room->id)}}">Deactivate</a>
                           </td>
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