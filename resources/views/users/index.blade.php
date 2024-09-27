@extends('layouts.simple.master')
@section('title', 'Users')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Users</li>
<li class="breadcrumb-item active">All</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>Users</h5>
               <a class="btn btn-primary" href="{{route('users.create')}}">+ New User</a>
            </div>
            <div class="card-body">
               <div class="table-responsive product-table">
                  <table class="display" id="basic-1">
                     <thead>
                        <tr>
                           <th>S/N</th>
                           <th>Name</th>
                           <th>Username</th>
                           <th>Email</th>
                           <th>Role</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($users as $user)
                        <tr>
                           <td>{{++$k}}</td>
                           <td>{{$user->employee->first_name.' '.$user->employee->last_name}}</td>
                           <td>{{$user->username}}</td>
                           <td>{{$user->email}}</td>
                           <td>{{$user->getRoleNames()->implode('')}}</td>
                           <td>
                              <a class="btn btn-info btn-xs" href="{{route('users.edit', $user->id)}}">Edit</a>
                              <a class="btn btn-danger btn-xs" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$user->id}}">Delete</a>
                           </td>
                        </tr>
                        <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="delete{{$user->id}}" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Delete {{'@'.$user->username}}</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                 </div>
                                 <div class="modal-body">
                                    <p>Are you sure you want to delete {{'@'.$user->username}}?.</p>
                                 </div>
                                 <div class="modal-footer">
                                 <form action="{{route('users.destroy', $user->id)}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit">Delete Room</button>
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