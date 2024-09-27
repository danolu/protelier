@extends('layouts.simple.master')
@section('title', 'Guest')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Guest</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-header b-l-primary d-flex justify-content-between">
            <h5>Guest Details</h5>
            <div>
               <a class="btn btn-info" href="{{route('guests.edit', $guest->id)}}">Edit</a>
               @can('delete guest')
               <a class="btn btn-outline-primary" href="#" data-bs-toggle="modal" data-bs-target="#delete">Delete</a>
               @endcan 
            </div>      
         </div>
         @can('delete guest')
		   <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete{{$guest->id}}" aria-hidden="true">
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
         <div class="card-body">
            <h6>Name</h6>
            <p>{{$guest->salutation.' '.$guest->first_name.' '.$guest->last_name}}</p>
            <h6>Email</h6>
            @if($guest->email)
            <p>{{$guest->email}}</p>
            @else
            <p>No email available for guest</p>
            @endif
            <h6>Phone</h6> 
            <p>{{$guest->phone}}</p>
            <h6>Address</h6>
            @if($guest->address)
            <p>{{$guest->address}}</p>
            @else
            <p>No address available for guest</p>
            @endif
            <h6>NIN / Passport Number</h6>
            @if($guest->nin)
            <p>{{$guest->nin}}</p>
            @else
            <p>No identification number available for guest</p>
            @endif
            <h6>Outstanding</h6>
            @if($guest->oustanding>0)
            <p class="text-danger">N{{number_format($guest->outstanding)}}</p>
            @else
            <p class="text-success">None</p>
            @endif
            <h6>Note</h6>
            @if($guest->note)
            <p>{{$guest->note}}</p>
            @else
            <p>No note available for this guest.</p>
            @endif
            <h6>Created</h6>
            <p>{{date('d-m-Y', strtotime($guest->created_at))}}</p>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection