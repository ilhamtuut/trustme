@extends('layouts.app')

@section('content')
    <div class="login-signin">
      <div class="text-center mb-10">
        <h3 class="text-muted">Sign In To Member</h3>
        <div class="text-white font-weight-bold">Enter your details to login to your account:</div>
      </div>
      @include('layouts.partials.alert')
      <form class="form" id="kt_login_signin_form" action="{{route('login')}}" method="POST">
        @csrf
        <div class="form-group mb-5">
          <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Username" name="username" autocomplete="off" />
        </div>
        <div class="form-group mb-5">
          <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
        </div>
        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
          <div class="checkbox-inline">
            <label class="checkbox m-0 text-white">
            <input type="checkbox" name="remember" />
            <span></span>Remember me</label>
          </div>
          <a href="{{route('password.request')}}" class="text-white text-hover-white">Forget Password ?</a>
        </div>
        <div class="text-center">
          <button id="kt_login_signin_submit" class="btn btn-success btn-block font-weight-bold">Sign In</button>
        </div>
      </form>
      <div class="text-center mt-10">
        <span class="opacity-70 mr-4 text-muted">Don't have an account yet?</span>
        <a href="{{route('register')}}" class="text-white text-hover-white font-weight-bold">Sign Up!</a>
      </div>
    </div>
@endsection