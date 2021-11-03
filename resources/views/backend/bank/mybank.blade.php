@extends('layouts.backend',['page'=>'account','active'=>'my_account'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <rect x="0" y="0" width="24" height="24"/>
          <rect fill="#000000" opacity="0.3" x="2" y="4" width="20" height="5" rx="1"/>
          <path d="M5,7 L8,7 L8,21 L7,21 C5.8954305,21 5,20.1045695 5,19 L5,7 Z M19,7 L19,19 C19,20.1045695 18.1045695,21 17,21 L11,21 L11,7 L19,7 Z" fill="#000000"/>
      </g>
  </svg>
</span>
 My Bank
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="#" class="text-white text-hover-dark">My Bank</a>
  </li>
@endsection

@section('content')
<div class="card card-custom">
  <div class="card-body">
    <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">Tips : All the bank information filled must be consistent. Otherwise, your will not able to withdrawal.</div>
    </div>
    @include('layouts.partials.alert')
    <div class="row">
      @foreach($data as $key => $value)
        <div class="col-lg-6">
          <div class="card card-success m-b-1">
            <div class="card-body">
              <h3 class="m-b-2">{{$value->bank->name}} ({{$value->bank->code}})</h3>
              <span class="m-b-2">{{substr_replace($value->account, '****** ', 0, strlen($value->account)-3 )}} </span><br>
              <span class="m-b-2">{{strtoupper($value->username)}}</span><br>
              <a href="#" class="detail_info label label-lg label-light-success label-inline" data-toggle="modal" data-bank="{{$value->bank->name}} ({{$value->bank->code}})" data-account="{{$value->account}}" data-username="{{strtoupper($value->username)}}" data-target="#bank-info-modal">Show <i class="la la-eye text-success"></i></a>
              <a href="{{ route('bank.changeActive', $value->id) }}" class="label label-lg label-light-{{($value->status)?'success':'danger'}} label-inline">{{($value->status)?'Active':'Disactive'}} <i class="la la-star text-{{($value->status)?'success':'danger'}}"></i></a>
            </div>
          </div>
        </div>
      @endforeach
      <div class="col-lg-6">
        <div class="card card-success m-b-1" style="height: 152px;">
          <div class="card-body text-center p-10">
              <a href="#" data-toggle="modal" data-target="#add-bank-modal" class="text-success">
                <div class="font-20 mt-5">
                  <i class="fa fa-plus-circle text-success"></i>
                </div>
                <p>Add New Account</p>
              </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('backend.bank.modal_addbank')
@include('backend.bank.modal_bank_info')
@endsection
@section('script')
<script type="text/javascript">

  $('.detail_info').on('click',function(){
    $('#bank_info_name').html($(this).data('bank'));
    $('#bank_info_account').html($(this).data('account'));
    $('#bank_info_username').html($(this).data('username'));
  });

  $('#btn_submit').on('click',function(){
    $('#action').addClass('hidden');
    $('#spinner').removeClass('hidden');
  });
</script>
@endsection
