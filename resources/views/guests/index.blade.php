@extends('layouts.simple.master')
@section('title', 'Guests')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Guests</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>Guests</h5>
               <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#createguest">Create New Guest</a>
            </div>
            <div class="modal fade" id="createguest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Create New Guest</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <form action="{{route('guests.store')}}" method="POST">
                      @csrf
                        <div class="modal-body">
                           <div class="mb-3">
                              <label class="col-form-label">Salutation*:</label>
                              <select class="form-control" name="salutation">
                                 <option hidden disabled selected>Select Salutation</option>
                                 <option value="Mr">Mr</option>
                                 <option value="Mrs">Mrs</option>
                                 <option value="Miss">Miss</option>
                                 <option value="Dr">Dr</option>
                                 <option value="Engr.">Engr.</option>
                                 <option value="Barr.">Barr.</option>
                              </select>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">First name*:</label>
                              <input class="form-control" type="text" name="first_name" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Last name*:</label>
                              <input class="form-control" type="text" name="last_name" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Email:</label>
                              <input class="form-control" type="email" name="email">
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Phone*:</label>
                              <input class="form-control" type="tel" name="phone" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Address:</label>
                              <input class="form-control" type="text" name="address">
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">NIN / Passport Number:</label>
                              <input class="form-control" type="number" name="nin">
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Emergency Contact:</label>
                              <input class="form-control" type="tel" name="emergency_contact">
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Note:</label>
                              <textarea class="form-control" name="note"></textarea>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive product-table">
                  <table class="display" id="basic-1">
                     <thead>
                        <tr>
                           <th>S/N</th>
                           <th>Name</th>
                           <th>Phone Number</th>
                           <th>Status</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($guests as $guest)
                        <tr>
                           <td>{{++$k}}</td>
                           <td>{{$guest->first_name.' '.$guest->last_name}}</td>
                           <td>{{$guest->phone}}</td>
                           @if($guest->status==1)
                           <td class="font-secondary"> Out</td>
                           @elseif($guest->status==2) 
                           <td class="font-success"> In</td>
                           @endif
                           <td>
                              <a href="{{route('guests.show', $guest->id)}}" class="btn btn-xs btn-info">View</a>
                              <a href="{{route('guests.edit', $guest->id)}}" class="btn btn-xs btn-success">Edit</a>
                              @can('delete guest') 
                              <a class="btn btn-xs btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$guest->id}}">Delete</a>
                              @endcan('delete guest')
                           </td>
                           @can('delete guest')
                           <div class="modal fade" id="delete{{$guest->id}}" tabindex="-1" role="dialog" aria-labelledby="delete{{$guest->id}}" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title">Deletion Confirmation</h5>
                                       <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                       <p>Are you sure you want to delete this guest?.</p>
                                    </div>
                                    <div class="modal-footer">
                                    <form action="{{route('guests.destroy', $guest->id)}}" method="POST">
                                       @method('delete')
                                       @csrf
                                       <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                       <button class="btn btn-secondary" type="submit">Delete Guest</button>
                                    </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @endcan
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