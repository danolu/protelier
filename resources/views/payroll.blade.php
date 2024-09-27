@extends('layouts.simple.master')
@section('title', 'Payroll')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Payroll</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>Payroll</h5>
            </div>
            <div class="card-body">
               <div class="table-responsive product-table">
                  <table class="display" id="basic-1">
                     <thead>
                        <tr>
                           <th>S/N</th>
                           <th>Employee</th>
                           <th>Designation</th>
                           <th>Salary</th>
                           <th>Bank</th>
                           <th>Account Number</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($employees as $employee)
                        <tr>
                           <td>{{++$k}}</td>
                           <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                           <td>{{$employee->designation}}</td>
                           <td>N{{number_format($employee->salary)}}</td>
                           <td>{{$employee->bank_name}}</td>
                           <td>{{$employee->bank_account_number}}</td>
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