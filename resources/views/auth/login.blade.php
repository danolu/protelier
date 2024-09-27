@extends('layouts.auth.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-xl-12 p-0">
         <div class="login-card">
            <div>
               <div><a class="logo text-start" href="{{ route('dashboard')}}"><img class="img-fluid for-light" src="{{asset('assets/images/logo.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('assets/images/logo_dark.png')}}" alt="looginpage"></a></div>
               <div class="login-main">
                  <form class="theme-form" method="POST" action="{{ route('login.submit') }}">
                     @csrf
                     <h4>Login</h4>
                     <div class="form-group">
                        <label class="col-form-label">Email Address / Username</label>
                        <input type="text" class="form-control required @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="current-password" placeholder="*********">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                        <div class="show-hide">
                           <span class="show">                         
                           </span>
                        </div>
                     </div>
                     <div class="form-group mb-0">
                        <div class="checkbox p-0">
                           <input id="checkbox1" type="checkbox">
                           <label class="text-muted" for="checkbox1">Remember password</label>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">SIGN IN</button>
                     </div>
                     <p class="mt-4 mb-0">Forgot password?<a class="ms-2" href="{{ route('password.request') }}">Reset</a></p>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection