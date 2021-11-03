@extends('layouts.app')

@section('content')
    <div class="login-forgot1">
      <div class="text-center mb-10">
        <h3>Reset Your Password</h3>
      </div>
        @include('layouts.partials.alert')
      <form class="form" id="kt_login_reset_form" action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group mb-5">
          <input class="form-control form-control-solid h-auto py-4 px-8" type="text" placeholder="Username" name="username" autocomplete="off" />
        </div>
        <div class="form-group mb-5">
          <input class="form-control form-control-solid h-auto py-4 px-8" type="password" placeholder="New Password" name="password" autocomplete="off" />
        </div>
        <div class="form-group mb-5">
          <input class="form-control form-control-solid h-auto py-4 px-8" type="password" placeholder="Confirm New Password" name="password_confirmation" autocomplete="off" />
        </div>
        <div class="form-group d-flex flex-wrap flex-center mt-10">
          <button id="kt_login_reset_submit" type="submit" class="btn btn-success btn-block font-weight-bold">Submit</button>
        </div>
      </form>
    </div>
@endsection
