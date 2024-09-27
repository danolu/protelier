@extends('layouts.simple.master')
@section('title', 'Room Types')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Room Types</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>Room Types</h5>
               <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#createroomtype">+ New Room Type</a>
            </div>
            <div class="modal fade" id="createroomtype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Room Type</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <form action="{{route('roomtypes.store')}}" method="POST">
                      @csrf
                        <div class="modal-body">
                           <div class="mb-3">
                              <label class="col-form-label">Name*:</label>
                              <input class="form-control" type="text" name="name" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Number of beds*:</label>
                              <input class="form-control" type="number" name="number_of_beds" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Rate(N)*:</label>
                              <input class="form-control" type="number" name="rate" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Caution(N)*:</label>
                              <input class="form-control" type="number" name="caution" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Bed Type:</label>
                              <input class="form-control" type="text" name="bed_type">
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Adult Capacity*:</label>
                              <input class="form-control" type="number" name="adult_capacity" required="">
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Children Capacity*:</label>
                              <input class="form-control" type="number" name="children_capacity" required="">
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Description:</label>
                              <textarea class="form-control" type="text" name="description"></textarea> 
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
                           <th>Rate</th>
                           <th>Caution</th>
                           <th>Adult</th>
                           <th>Children</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($roomtypes as $roomtype)
                        <tr>
                           <td>{{++$k}}</td>
                           <td>{{$roomtype->name}}</td>
                           <td>N{{number_format($roomtype->rate)}}</td>
                           <td>N{{number_format($roomtype->caution)}}</td>
                           <td>{{$roomtype->adult_capacity}}</td>
                           <td>{{$roomtype->children_capacity}}</td>
                           <td>
                              <a class="btn btn-success btn-xs" target="_blank" href="{{route('roomtypes.show', $roomtype->id)}}">View</a>
                              <a class="btn btn-info btn-xs" href="#" data-bs-toggle="modal" data-bs-target="#edit{{$roomtype->id}}">Edit</a>
                              <a class="btn btn-danger btn-xs" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$roomtype->id}}">Delete</a>
                           </td>
                        </tr>
                        <div class="modal fade" id="delete{{$roomtype->id}}" tabindex="-1" role="dialog" aria-labelledby="delete{{$roomtype->id}}" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Delete {{$roomtype->name}}</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <p>Are you sure you want to delete {{$roomtype->name}}?.</p>
                                 </div>
                                 <div class="modal-footer">
                                 <form action="{{route('roomtypes.destroy', $roomtype->id)}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit">Delete</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal fade" id="edit{{$roomtype->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit {{$roomtype->name}}</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <form action="{{route('roomtypes.update', $roomtype->id)}}" method="POST">
                                  @csrf
                                  @method('patch')
                                    <div class="modal-body">
                                       <div class="mb-3">
                                          <label class="col-form-label">Name*:</label>
                                          <input class="form-control" value="{{$roomtype->name}}" type="text" name="name" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Number of beds*:</label>
                                          <input class="form-control" type="number" value="{{$roomtype->number_of_beds}}" name="number_of_beds" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Rate(N)*:</label>
                                          <input class="form-control" type="number" name="rate" value="{{$roomtype->rate}}" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Caution(N)*:</label>
                                          <input class="form-control" type="number" name="caution" value="{{$roomtype->caution}}" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Bed Type:</label>
                                          <input class="form-control" type="text" name="bed_type" value="{{$roomtype->bed_type}}">
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Adult Capacity*:</label>
                                          <input class="form-control" type="number" name="adult_capacity" value="{{$roomtype->adult_capacity}}" required="">
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Children Capacity*:</label>
                                          <input class="form-control" type="number" name="children_capacity" value="{{$roomtype->children_capacity}}" required="">
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Description:</label>
                                          <textarea class="form-control" type="text" name="description">{{$roomtype->description}}</textarea> 
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                       <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                 </form>
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

