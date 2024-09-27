@extends('layouts.simple.master')
@section('title', 'Rooms')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Rooms</li>
<li class="breadcrumb-item active">All</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>Rooms</h5>
               <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#createroom">Create New Room</a>
            </div>
            <div class="modal fade" id="createroom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Create Room</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <form action="{{route('rooms.store')}}" method="POST">
                      @csrf
                        <div class="modal-body">
                           <div class="mb-3">
                              <label class="col-form-label">Room Number*:</label>
                              <input class="form-control" type="number" name="number" placeholder="Room number must be unique" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Room Type*</label>
                              <div class="input-group">
                                 <select class="form-control" name='room_type_id' required="">
                                    <option selected disabled hidden> Select room type</option>
                                 @foreach ($roomtypes as $roomtype)
                                    <option value="{{$roomtype->id}}">{{ $roomtype->name }}</option>
                                 @endforeach 
                                 </select>
                              </div>
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
                           <th>Number</th>
                           <th>Type</th>
                           <th>Status</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($rooms as $room)
                        <tr>
                           <td>{{$room->number}}</td>
                           <td>{{$room->room_type->name}}</td>
                           @if($room->status==0)
                           <td class="font-danger">Unvailable</td>
                           @elseif($room->status==1)
                           <td class="font-info">Available</td>
                           @elseif($room->status==2)
                           <td class="font-warning">Booked</td>
                           @elseif($room->status==3)
                           <td class="font-success">Checked In</td>
                           @endif
                           <td>
                              @if($room->status==0)
                                 <a class="btn btn-success btn-xs" href="{{route('rooms.activate', $room->id)}}">Activate</a>
                              @elseif($room->status==1)
                                 <a class="btn btn-warning btn-xs" href="{{route('rooms.deactivate', $room->id)}}">Deactivate</a>
                              @endif
                              <a class="btn btn-success btn-xs" href="#" data-bs-toggle="modal" data-bs-target="#editroom{{$room->id}}">Edit</a>
                              @if($room->status==0||$room->status==1)
                              <a class="btn btn-danger btn-xs" href="#" data-bs-toggle="modal" data-bs-target="#deleteroom{{$room->id}}">Delete</a>
                              @endif
                           </td>
                        </tr>
                        <div class="modal fade" id="deleteroom{{$room->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteroom{{$room->id}}" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Deletion Confirmation</h5>
                                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                 </div>
                                 <div class="modal-body">
                                    <p>Are you sure you want to delete this room?.</p>
                                 </div>
                                 <div class="modal-footer">
                                 <form action="{{route('rooms.destroy', $room->id)}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit">Delete Room</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal fade" id="editroom{{$room->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">Edit Room</h5>
                                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                 </div>
                                 <form action="{{route('rooms.update', $room->id)}}" method="POST">
                                  @csrf
                                  @method('patch')
                                    <div class="modal-body">
                                       <div class="mb-3">
                                          <label class="col-form-label">Number*:</label>
                                          <input class="form-control" type="number" name="number" value="{{$room->number}}" readonly="" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Room Type*</label>
                                          <div class="input-group">
                                             <select class="form-control" name='room_type_id' required="">
                                             @foreach ($roomtypes as $roomtype)
                                             @if($room->room_type->id==$roomtype->id)
                                                <option value="{{$roomtype->id}}" selected="">{{ $roomtype->name }}</option>
                                             @else
                                                <option value="{{$roomtype->id}}">{{ $roomtype->name }}</option>
                                             @endif
                                             @endforeach 
                                             </select>
                                          </div>
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