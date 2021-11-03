@extends('layouts.app')

@section('content')
    <div class="login-signup1">
      <div class="text-center mb-10">
        <h3 class="text-muted">Sign Up</h3>
        <div class="text-white font-weight-bold">Enter your details to create your account</div>
      </div>
        @include('layouts.partials.alert')
      <form class="form" id="kt_login_signup_form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group mb-5">
          <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Referal" name="referal" value="{{ ucfirst(Session::get('ref:user:username'))}}" @if(Session::get('ref:user:username')) readonly @endif/>
        </div>
        <div class="form-group mb-5">
          <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Username" name="username" />
        </div>
        <div class="form-group mb-5">
          <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Name" name="name" />
        </div>
        <div class="form-group mb-5">
          <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" />
        </div>
        <div class="form-group mb-5">
          <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Phone Number" name="phone_number" autocomplete="off" />
        </div>
        <div class="form-group mb-5">
          <div class="input-group input-group-solid">
            <input id="password" class="password-field form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
            <div class="input-group-append cursor-pointer"><span class="input-group-text"><i onclick="_callPasswordShow('password')" class="toggle-password far fa-eye icon-md"></i></span></div>
          </div>
        </div>
        <div class="form-group mb-5">
          <div class="input-group input-group-solid">
            <input id="security_password" class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Security Password" name="security_password" />
            <div class="input-group-append cursor-pointer"><span class="input-group-text"><i onclick="_callPasswordShow('security_password')" class="toggle-security_password far fa-eye icon-md"></i></span></div>
          </div>
        </div>
        <div class="form-group mb-5 text-left">
          <div class="checkbox-inline">
            <label class="checkbox m-0 text-muted">
            <input type="checkbox" name="agree" />
            <span></span>I Agree the
            <a href="#" class="text-white font-weight-bold ml-1">terms and conditions</a>.</label>
          </div>
          <div class="form-text text-muted text-center"></div>
        </div>
        <div class="form-group d-flex flex-wrap flex-center mt-10">
          <button id="kt_login_signup_submit" class="btn btn-success btn-block font-weight-bold">Sign Up</button>
        </div>
      </form>
    </div>
      <div class="text-center mt-5">
        <span class="opacity-70 mr-3 text-muted">Already account?</span>
        <a href="{{route('login')}}" class="text-white text-hover-white font-weight-bold">Sign In!</a>
      </div>
@endsection