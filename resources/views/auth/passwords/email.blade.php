@extends('layouts.app')

@section('content')
    <div class="login-forgot1">
      <div class="text-center mb-10">
        <h3>Forgotten Password ?</h3>
        <div class="text-white font-weight-bold">Enter your username to reset your password</div>
      </div>
        @include('layouts.partials.alert')
      <form class="form" id="kt_login_forgot_form" action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="form-group mb-10">
          <input class="form-control form-control-solid h-auto py-4 px-8" type="text" placeholder="Username" name="username" autocomplete="off" />
        </div>
        <div class="form-group d-flex flex-wrap flex-center mt-10">
          <button id="kt_login_forgot_submit" type="submit" class="btn btn-success btn-block font-weight-bold">Request</button>
        </div>
      </form>
    </div>
    <div class="text-center mt-5">
      <span class="opacity-70 text-muted">Back to</span>
      <a href="{{route('login')}}" class="text-white text-hover-white font-weight-bold">Sign In!</a>
    </div>
@endsection
