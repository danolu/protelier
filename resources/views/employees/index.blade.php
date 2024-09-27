@extends('layouts.simple.master')
@section('title', 'Employees')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Employees</li>
<li class="breadcrumb-item active">All</li>
@endsection

@section('content')
@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>Employees</h5>
            	<a class="btn btn-primary" href="{{route('employees.create')}}">+ New Employee</a>
            </div>
            <div class="card-body">
               <div class="table-responsive product-table">
                  <table class="display" id="basic-1">
                     <thead>
                        <tr>
                        	<th></th>
                           	<th>Employee</th>
                           	<th>Designation</th>
                           	<th>Phone</th>
                           	<th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($employees as $employee)
                        <tr>
                        	<td>{{++$k}}</td>
                           	<td>{{$employee->first_name}} {{$employee->last_name}}</td>
                           	<td>{{$employee->designation}}</td>
                           	<td>{{$employee->phone}}</td>
                           	<td>
                           	<a href="{{route('employees.show', $employee->id)}}" class="btn btn-success">View</a>
                           	<a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$employee->id}}">Delete</a>
                       		</td>
                        </tr>
                        <div class="modal fade" id="delete{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="delete{{$employee->id}}" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Delete {{$employee->first_name}} {{$employee->last_name}}</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                 </div>
                                 <div class="modal-body">
                                    <p>Are you sure you want to delete {{$employee->first_name}} {{$employee->last_name}}?.</p>
                                 </div>
                                 <div class="modal-footer">
                                 <form action="{{route('employees.destroy', $employee->id)}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit">Delete</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                        </div>
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