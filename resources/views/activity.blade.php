@extends('layouts.simple.master')
@section('title', 'Activity')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Activity Log</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>Activity Log</h5>
            </div>
            <div class="card-body">
               <div class="table-responsive product-table">
                  <table class="display" id="basic-1">
                     <thead>
                        <tr>
                           <th>Activity</th>
                           <th>Time</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($activities as $activity)
                        <tr>
                           <td><a href="{{route('employees.show', $activity->user->employee->id)}}" target="_blank" class="text-secondary"> {{$activity->user->employee->first_name}}</a> {{$activity->activity}}</td>
                           <td>  {{date("D-d-M-Y", strtotime($activity->created_at))}} <span>| {{date("h:i:a", strtotime($activity->created_at))}}</span></td>
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

