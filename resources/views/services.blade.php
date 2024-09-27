@extends('layouts.simple.master')
@section('title', 'Services')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Services</li>
<li class="breadcrumb-item active">All</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>Services</h5>
               @can('edit services')
               <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#createservice">+ New Service</a>
               @endcan
            </div>
            @can('edit services')
            <div class="modal fade" id="createservice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Create New Service</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <form action="{{route('services.store')}}" method="POST">
                      @csrf
                        <div class="modal-body">
                           <div class="mb-3">
                              <label class="col-form-label">Name*:</label>
                              <input class="form-control" type="text" name="name" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Unit Price (N)*:</label>
                              <input class="form-control" type="number" name="price" required>
                           </div>
                            <div class="mb-3">
                              <label class="col-form-label">Status*</label>
                              <div class="input-group">
                                 <select class="form-control" name='status' required="">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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
            @endcan
            <div class="card-body">
               <div class="table-responsive product-table">
                  <table class="display" id="basic-1">
                     <thead>
                        <tr>
                           <th>Name</th>
                           <th>Cost</th>
                           <th>Status</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($services as $service)
                        <tr>
                           <td>{{$service->name}}</td>
                           <td>{{$service->price}}</td>
                           <td>@if($service->status==1) <span class="text-success">Active</span> @else <span class="text-danger">Inactive</span> @endif</td>
                           <td>
                              <a class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#book{{$service->id}}">Book</a> 
                              @can('edit services')
                              <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#edit{{$service->id}}">Edit</a>
                              <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$service->id}}">Delete</a>
                              @endcan
                           </td>
                        </tr>
                        @can('edit services')
                        <div class="modal fade" id="delete{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="delete{{$service->id}}" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Delete {{$service->name}}</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <p>Are you sure you want to delete {{$service->name}}?.</p>
                                 </div>
                                 <div class="modal-footer">
                                 <form action="{{route('services.destroy', $service->id)}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit">Delete Service</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal fade" id="edit{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">Edit {{$service->name}}</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <form action="{{route('services.update', $service->id)}}" method="POST">
                                  @csrf
                                  @method('patch')
                                    <div class="modal-body">
                                       <div class="mb-3">
                                          <label class="col-form-label">Name*:</label>
                                          <input class="form-control" type="text" value="{{$service->name}}" name="name" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Unit Price (N)*:</label>
                                          <input class="form-control" type="number" value="{{$service->price}}" name="price" required>
                                       </div>
                                        <div class="mb-3">
                                          <label class="col-form-label">Status*</label>
                                          <div class="input-group">
                                             <select class="form-control" name='status' required="">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
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
                        @endcan
                        <div class="modal fade" id="book{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">Book {{$service->name}}</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <form action="{{route('services.book')}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                       <input class="form-control" type="hidden" name="service" value="{{$service->name}}" required>
                                       <div class="mb-3">
                                          <label class="col-form-label">Customer*:</label>
                                          <input class="form-control" type="text" name="customer" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Unit Price (N)*:</label>
                                          <input class="form-control" type="number" value="{{$service->price}}" name="price" readonly required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Quantity*:</label>
                                          <input class="form-control" type="number" name="quantity" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Discount (N)*:</label>
                                          <input class="form-control" type="number" name="discount" value="0" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Payment Method*</label>
                                          <div class="input-group">
                                             <select class="form-control" name='method' required="">
                                                <option value="Transfer">Transfer</option>
                                                <option value="POS">POS</option>
                                                <option value="Cash">Cash</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                       <button class="btn btn-primary" type="submit">Book</button>
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