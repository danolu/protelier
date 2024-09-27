@extends('layouts.simple.master')
@section('title', 'Settings')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Settings</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 col-xl-6 xl-100">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-9">
              <div class="card">
                <div class="card-header">
                  <h5>Hotel Information</h5>
                </div>
                <form class="form theme-form" action="{{route('hotel.update')}}" method="POST">
                  @csrf
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Hotel Name</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" name="name" value="{{$hotel->name}}" required="">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Tagline</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" placeholder="e.g 'your best place to be'" value="{{$hotel->tagline}}" name="tagline">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Address</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{$hotel->address}}" required="" name="address">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Phone Number</label>
                          <div class="col-sm-9">
                            <input class="form-control digits" type="tel" name="phone" value="{{$hotel->phone}}" required="">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Alternate Phone Number</label>
                          <div class="col-sm-9">
                            <input class="form-control m-input digits" type="tel" name="alt_phone" value="{{$hotel->alt_phone}}">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="email" value="{{$hotel->email}}" name="email" required="">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Alternative Email</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="email" value="{{$hotel->alt_email}}" name="alt_email">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Website</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{$hotel->website}}" placeholder="e.g. 'hotel.com'" name="website">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="col-sm-9 offset-sm-3">
                      <button class="btn btn-outline-primary" type="submit">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="col-sm-9">
              <div class="card">
                <div class="card-header">
                  <h5>Hotel's Bank Details</h5>
                </div>
                <form class="form theme-form" action="{{route('bank.update')}}" method="POST">
                  @csrf
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Bank Name</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" placeholder="e.g. Zenith Bank" name="bank_name" value="{{$hotel->bank_name}}">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Bank Account Name</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{$hotel->account_name}}" name="account_name">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Bank Account Number</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="number" value="{{$hotel->account_number}}" name="account_number">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="col-sm-9 offset-sm-3">
                      <button class="btn btn-outline-primary" type="submit">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="card">
                <div class="card-header">
                  <h5>Customer Loyalty Settings</h5>
                </div>
                <form class="form theme-form" action="{{route('loyalty.update')}}" method="POST">
                  @csrf
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <div class="mb-3 row mb-0">
                          <label class="col-sm-3 col-form-label">Loyalty Percentage</label>
                          <div class="col-sm-9">
                            <input value="{{$hotel->loyalty_fraction}}" class="form-control" required name="loyalty_fraction" placeholder="Enter percentage of guest purchase that goes to loyalty bonus." />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="col-sm-9 offset-sm-3">
                      <button class="btn btn-outline-primary" type="submit">Update</button>
                    </div>
                  </div>
                </form>
              </div>
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