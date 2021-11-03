@extends('layouts.backend',['active'=>'convert','page'=>'convert'])

@section('page-title')
<i class="flaticon2-hourglass text-white"></i>
Convert
@endsection

@section('breaTCrumb')
  <li class="breaTCrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breaTCrumb-item">
      <a href="" class="text-white text-hover-dark">Wallets</a>
  </li>
  <li class="breaTCrumb-item">
      <a href="" class="text-white text-hover-dark">Convert</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
  <div class="card-header align-items-center bg-warning">
    <h3 class="card-title align-items-start flex-column">
      <span class="text-white">Convert USD Wallet to Trustme Coin</span>
      <span class="text-white mt-3 font-weight-bold font-size-sm">USD Wallet : <i class="text-white fas fa-dollar-sign icon-sm"></i> {{$my}}</span>
    </h3>
    <div class="card-toolbar">
      <div class="dropdown dropdown-inline">
        <a href="{{route('convert.history')}}" class="btn btn-light-warning btn-sm font-weight-bolder"><i class="flaticon-clock-2"></i> History</a>
        </a>
      </div>
    </div>
  </div>
  <!--begin::Form-->
  <form class="form" action="{{route('convert.send')}}" method="POST">
    <div class="card-body">
      <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
          <div class="alert-text">Note : 1 TC = ${{$price}} </div>
      </div>
      @csrf
      <div class="form-group">
        <label class="control-label">Amount ($)</label>
        <input id="amount" name="amount" class="form-control" placeholder="Amount" min="1" type="number">
        <p id="error-amount" class="text-danger"></p>
      </div>

      <div class="form-group">
        <label class="control-label">Trustme Coin (TC)</label>
        <input id="receive" name="receive" class="form-control" placeholder="Trustme Coin (TC)" type="text" readonly>
        @if($fee > 0)
            <p class="text-danger mb-0">Fee {{$fee*100}}%</p>
        @endif
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
    var kurs = {{$price}}, fee = {{$fee}};
    $('#amount').on('keyup change', function () {
      var value = $(this).val();
      if(value){
        var amountfee = value * fee;
        var receive = value - amountfee;
        var total = receive/kurs;
        $('#receive').val(addCommas(parseFloat(total).toFixed(8)));
      }else{
        $('#receive').val('');
      }
    });

    function clear() {
      $('#amount').val('');
      $('#receive').val('');
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
