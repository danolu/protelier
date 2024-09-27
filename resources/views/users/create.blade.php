@extends('layouts.simple.master')
@section('title', 'Users')

@section('css')
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
      <div class="col-12">
         <div class="card">
            <div class="job-search">
               <div class="card-body pb-0">
                  <div class="media">
                     <div class="media-body">
                        <h4 class="f-w-600"><a href="#">Create User</a>
                        </h4>
                     </div>
                  </div>
                  <div class="job-description">
                     <h6 class="mb-0">Personal Details </h6>
                     <form action="{{route('users.store')}}" method="POST">
                      @csrf
                        <div class="modal-body">
                           <div class="mb-3">
                              <label class="col-form-label">Employee*</label>
                              <div class="input-group">
                                 <select class="form-control" name="employee_id" required="">
                                    <option hidden disabled selected>Choose Employee</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->first_name.' '.$employee->last_name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Email*:</label>
                              <input class="form-control" type="email" name="email" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Username*:</label>
                              <input class="form-control" type="text" name="username" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Password (minimum of six(6) characters)*:</label>
                              <input class="form-control" type="password" name="password" required>
                           </div>
                            <div class="mb-3">
                              <label class="col-form-label">Role*</label>
                              <div class="input-group">
                                 <select class="form-control" name='role' required="">
                                    <option hidden disabled selected>Choose role</option>
                                    <option value="receptionist">Receptionist</option>
                                    <option value="supervisor">Supervisor</option>
                                    <option value="manager">Manager</option>
                                    <option value="admin">Admin</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                     </form>
                  </div>
               </div>      
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection