@extends('layouts.backend',['active'=>'by_admin','page'=>'package'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <polygon fill="#000000" opacity="0.3" points="6 3 18 3 20 6.5 4 6.5"/>
            <path d="M6,5 L18,5 C19.1045695,5 20,5.8954305 20,7 L20,19 C20,20.1045695 19.1045695,21 18,21 L6,21 C4.8954305,21 4,20.1045695 4,19 L4,7 C4,5.8954305 4.8954305,5 6,5 Z M9,9 C8.44771525,9 8,9.44771525 8,10 C8,10.5522847 8.44771525,11 9,11 L15,11 C15.5522847,11 16,10.5522847 16,10 C16,9.44771525 15.5522847,9 15,9 L9,9 Z" fill="#000000"/>
        </g>
    </svg>
</span>
Register Plan By Admin
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Plan</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Register Plan By Admin</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
  <div class="card-header bg-warning">
    <h3 class="card-title text-white">Register to Member</h3>
  </div>
    <!--begin::Form-->
    <form class="form" action="{{route('program.register_byadmin')}}" method="POST">
        <div class="card-body">
        @csrf
        <div class="form-group">
            <label class="control-label">Username</label>
            <input id="username" name="username" class="form-control" required="required" placeholder="Username" type="text">
            <ul class="list-gpfrm" id="hdTuto_search"></ul>
        </div>
        <div class="form-group">
            <label>Amount</label>
            <input id="amount" type="text" name="amount" placeholder="Amount" class="form-control">
        </div>
        {{-- <div class="form-group">
            <label>Select Plan</label>
            <select id="package" name="package" style="width: 100%;" class="form-control select2">
                <option value="">Choose Plan</option>
                @foreach($packages as $value)
                <option value="{{$value->id}}" data-amount="{{$value->amount}}">{{$value->name}} ~ ($){{number_format($value->amount)}}</option>
                @endforeach
            </select>
        </div> --}}

        <div class="form-group">
            <label>Security Password</label>
            <input id="password" name="security_password" type="password" required="required" placeholder="Security Password" class="form-control">
        </div>
        </div>
        <div class="card-footer text-right">
        <div class="p-3" id="action">
            <button id="btn_transfer" type="submit" class="btn btn-light-success waves-effect waves-light m-r-10">Submit</button>
            <button id="btn_clear" type="button" class="btn btn-light-danger waves-effect waves-light">Cancel</button>
        </div>

        <div class="hidden" id="loader">
            <i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>
        </div>
        </div>
    </form>
    <!--end::Form-->
</div>

<style type="text/css">
    #hdTuto_search{
        display: none;
        padding-inline-start: 10px;
    }
    .list-gpfrm-list a{
        text-decoration: none !important;
    }
    .list-gpfrm li{
        color: #fff;
        cursor: pointer;
        padding: 10px;
    }
    .list-gpfrm{
        list-style-type: none;
        background: #40c5bd;
    }
    .list-gpfrm li:hover{
        color: #fff;
        background-color: #40c5bd;
    }
</style>
@endsection

@section('script')
<script type="text/javascript">

  $('#btn_buypackage').on('click',function () {
    $('#action').addClass('hidden');
    $('#loader').removeClass('hidden');

    if($('#password').val() == ''){
      $('#action').removeClass('hidden');
      $('#loader').addClass('hidden');
    }
  });

  $('#btn_clear').on('click',function () {
    $('#password').val("");
  });

  $(document).ready(function(){
    $('#username').keyup(function(e){
        e.preventDefault();
        if(this.value == ''){
            $('#hdTuto_search').hide();
        }else{
            $.ajax({
              type: 'GET',
              url: '{{ route('user.get_user') }}',
              data: {search : this.value},
              dataType: 'json',
              success: function(response){
                if(response.error){
                }else{
                  $('#hdTuto_search').show().html(response.data);
                }
              }
            });
        }
    });

    $(document).on('click', '.list-gpfrm-list', function(e){
        e.preventDefault();
        $('#hdTuto_search').hide();
        var fullname = $(this).data('fullname');
        var id = $(this).data('id');
        $('#username').val(fullname);
    });
  });
</script>
@endsection
