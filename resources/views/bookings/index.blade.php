@extends('layouts.simple.master')
@section('title', 'Bookings')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Bookings</li>
<li class="breadcrumb-item active">All</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between">
					<h5>Bookings</h5>
					<a class="btn btn-primary text-left" href="{{route('bookings.create')}}">+ Booking</a>
				</div>

				<div class="card-body">
					<div class="dt-ext table-responsive">
						<table class="display" id="export-button">
							<thead>
								<tr>
									<th>#</th>
									<th>Booking Number</th>
									<th>Room(s)</th>
									<th>Guest</th>
									<th>CheckIn</th>
									<th>CheckOut</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($bookings as $k => $booking)
								<tr>
									<td>{{++$k}}</td>
									<td>{{$booking->booking_id}}</td>
									<td>
										@foreach ($booking->rooms as $i => $room)
										{{$booking->rooms[$i]->room_type->name.'-'.$booking->rooms[$i]->number}}<br> 
										@endforeach
									</td>
									<td>{{$booking->guest->first_name.' '.$booking->guest->last_name}}</td>
									<td>{{date("d-m-y", strtotime($booking->checkin))}}</td>
									<td>{{date("d-m-y", strtotime($booking->checkout))}}</td>
									@if($booking->status==0)
									<td class="text-danger">Cancelled</td>
									<td><a href="{{route('bookings.show', $booking->id)}}" class="btn btn-info btn-xs">View</a></td>
									@elseif($booking->status==1)
									<td class="text-warning">Awaiting Checkin</td>
									<td>
										<a href="{{route('bookings.show', $booking->id)}}" class="btn btn-info btn-xs">View</a>
										<a href="{{route('bookings.edit', $booking->id)}}" class="btn btn-secondary btn-xs">Edit</a>
										<a href="{{route('checkin', $booking->id)}}" class="btn btn-success btn-xs">Check in</a>
										<a href="#" data-bs-toggle="modal" data-bs-target="#cancel{{$booking->id}}" class="btn btn-danger btn-xs">Cancel</a>
									</td>
									@elseif($booking->status==2)
									<td class="text-success">Checked In</td>
									<td>
										<a class="btn btn-xs btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#checkout{{$booking->id}}">Check out</a>
										<a href="{{route('bookings.show', $booking->id)}}" class="btn btn-xs btn-info">View</a>
										<a href="{{route('bookings.edit', $booking->id)}}" class="btn btn-secondary btn-xs">Edit</a>
										<a href="#" data-bs-toggle="modal" data-bs-target="#cancel{{$booking->id}}" class="btn btn-xs btn-success">Cancel</a>
									</td>
									@elseif($booking->status==3)
									<td>Checked Out</td>
									<td><a href="{{route('bookings.show', $booking->id)}}" class="btn btn-xs btn-info">View</a></td>
									@endif
								</tr>
								<div class="modal fade" id="checkout{{$booking->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					               <div class="modal-dialog" role="document">
					                  <div class="modal-content">
					                     <div class="modal-header">
					                        <h5 class="modal-title" id="exampleModalLabel2">Checkout</h5>
					                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					                     </div>
					                     <form method="POST" action="{{route('checkout', $booking->id)}}">
					                      @csrf
					                        <div class="modal-body">
					                           <div class="mb-3">
					                              <label class="col-form-label">Property Damage Cost:</label>
					                              <input class="form-control" type="number" name="property_damage_cost">
					                           </div>
					                           <div class="mb-3">
					                              <label class="col-form-label">Note:</label>
					                              <textarea class="form-control" name="note">{{$booking->note}}</textarea>
					                           </div>
					                        </div>
					                        <div class="modal-footer">
					                           <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					                           <button class="btn btn-primary" type="submit">Checkout</button>
					                        </div>
					                     </form>
					                  </div>
					               </div>
					            </div>
					            <div class="modal fade" id="cancel{{$booking->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					               <div class="modal-dialog" role="document">
					                  <div class="modal-content">
					                     <div class="modal-header">
					                        <h5 class="modal-title" id="exampleModalLabel2">Checkout</h5>
					                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					                     </div>
					                     <form method="POST" action="{{route('bookings.cancel', $booking->id)}}">
					                      @csrf
					                        <div class="modal-footer">
					                           <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					                           <button class="btn btn-primary" type="submit">Cancel</button>
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
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/custom.js')}}"></script>
@endsection