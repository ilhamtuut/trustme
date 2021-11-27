@extends('layouts.backend',['active'=>'deposit','page'=>'deposit'])

@section('page-title')
<i class="far fa-credit-card text-white"></i>
Deposit
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Wallets</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Deposit</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
  <div class="card-header align-items-center bg-warning">
    <h3 class="card-title align-items-start flex-column">
      <span class="text-white">Deposit Trustme Coin</span>
    </h3>
    <div class="card-toolbar">
      <div class="dropdown dropdown-inline">
        <a href="{{route('deposit.history')}}" class="btn btn-light-warning btn-sm font-weight-bolder"><i class="flaticon-clock-2"></i> History</a>
        </a>
      </div>
    </div>
  </div>
  <!--begin::Form-->
  <form class="form" action="{{route('deposit.send')}}" method="POST">
    <div class="card-body">
      <div class="text-center mb-5" role="alert">
            <h4>Receiver Address TC</h4>
            <img width="150px" src="{{asset('images/receive.png')}}"> <br>
            Please send the balance to the address <span>{{$address}} <i class="fa fa-copy text-success cursor-pointer" onclick="copyToClipboard('{{$address}}')"></i></span> first, then fill in the transfer amount and txid/hash below and wait for confirmation from us.
      </div>
      @csrf

      <div class="form-group">
        <label class="control-label">TXID/Hash</label>
        <input id="txid" name="txid" class="form-control" placeholder="TXID/Hash" type="text">
      </div>
      
      <div class="form-group">
        <label class="control-label">Amount (TC)</label>
        <input id="amount" name="amount" class="form-control" placeholder="Amount" min="1" type="number">
        <p id="error-amount" class="text-danger"></p>
      </div>

      <div class="form-group">
        <label class="control-label">Security Password</label>
        <input id="password" name="security_password" class="form-control" placeholder="Security Password" type="password">
      </div>
    </div>
    <div class="card-footer text-right">
      <div class="p-3" id="action">
        <button id="btn_convert" type="submit" class="btn btn-light-success waves-effect waves-light m-r-10">Submit</button>
        <button id="btn_clear" type="button" class="btn btn-light-danger waves-effect waves-light">Cancel</button>
      </div>

      <div class="hidden" id="loader">
        <i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>
      </div>
    </div>
   </form>
  <!--end::Form-->
</div>
@endsection

@section('script')
<script type="text/javascript">
    function clear() {
      $('#amount').val('');
      $('#txid').val('');
      $('#password').val('');
    }

    $('#btn_convert').on('click',function () {
      $('#action').addClass('hidden');
      $('#loader').removeClass('hidden');
    });

    $('#btn_clear').on('click',function () {
      clear();
    });
</script>
@endsection
