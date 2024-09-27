@extends('layouts.simple.master')
@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
<div class="container-fluid">


   <hr><h6> Today in numbers </h6><hr> 
    <div class="row">
      <div class="col-sm-6 col-xl-3 col-lg-6">
          <div class="card small-widget">
            <div class="card-body bg-primary"> 
               <span class="f-w-500">Check-ins</span>
                <div class="d-flex align-items-end gap-1">
                    <h4 class="mb-0 mt-1">{{$checkins_today}}</h4>
                </div>
                <div class="bg-gradient"><i data-feather="log-in"></i>
                </div>
            </div>
        </div>
      </div>

      <div class="col-sm-6 col-xl-3 col-lg-6">
         <div class="card small-widget">
           <div class="card-body bg-primary"> 
              <span class="f-w-500">Bookings</span>
               <div class="d-flex align-items-end gap-1">
                   <h4 class="mb-0 mt-1">{{$bookings_today}}</h4>
               </div>
               <div class="bg-gradient"><i data-feather="lock"></i>
               </div>
           </div>
       </div>
     </div>


      <div class="col-sm-6 col-xl-3 col-lg-6">
         <div class="card small-widget">
           <div class="card-body bg-danger"> 
              <span class="f-w-500">Cancellations</span>
               <div class="d-flex align-items-end gap-1">
                   <h4 class="mb-0 mt-1">{{$cancellations_today}}</h4>
               </div>
               <div class="bg-gradient"><i data-feather="x-circle"></i>
               </div>
           </div>
       </div>
     </div>

      <div class="col-sm-6 col-xl-3 col-lg-6">
         <div class="card small-widget">
           <div class="card-body bg-secondary"> 
              <span class="f-w-500">Check-outs</span>
               <div class="d-flex align-items-end gap-1">
                   <h4 class="mb-0 mt-1">{{$checkouts_today}}</h4>
               </div>
               <div class="bg-gradient"><i data-feather="log-out"></i>
               </div>
           </div>
       </div>
     </div>

    </div>

  <div class="card">
    <div class="card-header">
       <h5>Sales</h5>
    </div>
    <div class="card-body">
      <div class="row">
         
        <div class="col-xl-6 xl-100 box-col-12">
           <div class="widget-joins card">
              <div class="row">
                  <div class="col-sm-6 pe-0">
                     <div class="card widget-1">
                        <div class="card-body">
                           <div class="widget-content">
                              <div>
                                 <span class="f-light">Today</span><h4>N{{number_format($sales_today)}}</h4>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 pe-0">
                     <div class="card widget-1">
                        <div class="card-body">
                           <div class="widget-content">
                              <div>
                                 <span class="f-light">This Week</span><h4>N{{number_format($sales_this_week)}}</h4>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-sm-6 pe-0">
                     <div class="card widget-1">
                        <div class="card-body">
                           <div class="widget-content">
                              <div>
                                 <span class="f-light">This Month</span><h4>N{{number_format($sales_this_month)}}</h4>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-sm-6 pe-0">
                     <div class="card widget-1">
                        <div class="card-body">
                           <div class="widget-content">
                              <div>
                                 <span class="f-light">This Year</span><h4>N{{number_format($sales_this_year)}}</h4>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
              </div>
           </div>
        </div>
      </div>
    </div>
  </div>

    <div class="row second-chart-list third-news-update">
      <div class="col-xl-8 xl-100 dashboard-sec box-col-12">
        <div class="card earning-card">
          <div class="card-body p-0">
            <div class="row m-0">
              <div class="col-xl-12 p-0">
                <div class="row border-top m-0">

                  <div class="col-xl-3 ps-0 col-md-6 col-sm-6">
                     <div class="card widget-1">
                        <div class="card-body">
                           <div class="widget-content">
                              <div class="widget-round secondary">
                                    <div class="bg-round">
                                       <i class="icofont icofont-money-bag"></i>
                                       <svg class="half-circle svg-fill">
                                          <use href="{{asset('assets/svg/icon-sprite.svg#halfcircle')}}"></use>
                                       </svg>
                                    </div>
                              </div>
                              <div>
                                    <h4>{{$available_rooms}}</h4><span class="f-light">Available Rooms</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-xl-3 ps-0 col-md-6 col-sm-6">
                     <div class="card widget-1">
                        <div class="card-body">
                           <div class="widget-content">
                              <div class="widget-round secondary">
                                    <div class="bg-round">
                                       <i class="icofont icofont-ui-home"></i>
                                       <svg class="half-circle svg-fill">
                                          <use href="{{asset('assets/svg/icon-sprite.svg#halfcircle')}}"></use>
                                       </svg>
                                    </div>
                              </div>
                              <div>
                                    <h4>{{$occupied_rooms}}</h4><span class="f-light">Occupied Rooms</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-xl-3 ps-0 col-md-6 col-sm-6">
                     <div class="card widget-1">
                        <div class="card-body">
                           <div class="widget-content">
                              <div class="widget-round secondary">
                                    <div class="bg-round">
                                       <i class="icofont icofont-ui-home"></i>
                                       <svg class="half-circle svg-fill">
                                          <use href="{{asset('assets/svg/icon-sprite.svg#halfcircle')}}"></use>
                                       </svg>
                                    </div>
                              </div>
                              <div>
                                    <h4>{{$booked_rooms}}</h4><span class="f-light">Booked Rooms</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-xl-3 ps-0 col-md-6 col-sm-6">
                     <div class="card widget-1">
                        <div class="card-body">
                           <div class="widget-content">
                              <div class="widget-round secondary">
                                    <div class="bg-round">
                                       <i class="icofont icofont-home"></i>
                                       <svg class="half-circle svg-fill">
                                          <use href="{{asset('assets/svg/icon-sprite.svg#halfcircle')}}"></use>
                                       </svg>
                                    </div>
                              </div>
                              <div>
                                    <h4>{{$unavailable_rooms}}</h4><span class="f-light">Unavailable Rooms</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-6 xl-100 box-col-12">
         <div class="card">
            <div class="card-header">
               <h5>RECENT BOOKINGS</h5>
               <div class="card-header-right d-flex">
                  <a class="btn btn-outline-secondary" href="{{route('bookings.index')}}">See all</a>
                  <ul class="list-unstyled card-option">
                     <li><i class="fa fa-spin fa-cog"></i></li>
                     <li><i class="icofont icofont-maximize full-card"></i></li>
                     <li><i class="icofont icofont-minus minimize-card"></i></li>
                     <li><i class="icofont icofont-refresh reload-card"></i></li>
                  </ul>
               </div>
            </div>
            <div class="card-body">
               <div class="user-status table-responsive">
                  <table class="table table-bordernone">
                     <thead>
                        <tr>
                            <th scope="col">Room (S) </th>
                            <th scope="col">Booking Date</th>
                            <th scope="col">Check In</th>
                            <th scope="col">Check Out</th>
                            <th scope="col">Charge (N)</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                          <td>@foreach ($booking->rooms as $i => $room)
                              {{$booking->rooms[$i]->room_type->name.'-'.$booking->rooms[$i]->number}}<br> 
                              @endforeach 
                           </td>
                          <td>{{date("d-m-y", strtotime($booking->created_at))}} </td>
                          <td>{{date("d-m-y", strtotime($booking->checkin))}}</td>
                          <td>{{date("d-m-y", strtotime($booking->checkout))}}</td>
                          <td class="font-primary">N{{number_format($booking->payable)}}</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head1" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
               </div>
            </div>
         </div>
      </div>
   </div>

    <div class="row">
      <div class="col-xl-12 notification box-col-6">
        <div class="card">
          <div class="card-header card-no-border">
            <div class="header-top">
              <h5 class="m-0">Recent Activity</h5>
              <div class="card-header-right-icon">
                <a href="{{route('activity')}}" class="btn btn-outline-primary">
                  See All
                </a>
              </div>
            </div>
          </div>
          @foreach($activities as $activity)
          <div class="card-body pt-0">
            <div class="media">
              <div class="media-body">
                <p>{{date("D-d-M-Y", strtotime($activity->created_at))}} <span>| {{date("h:i:a", strtotime($activity->created_at))}}</span></p>
                <h6><a href="{{route('employees.show', $activity->user->employee->id)}}" target="_blank" class="text-secondary"> {{$activity->user->employee->first_name}}</a> {{$activity->activity}}<span class="dot-notification"></span></h6>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
</div>

@endsection

@section('script')

<script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
<script src="{{asset('assets/js/height-equal.js')}}"></script>

@endsection