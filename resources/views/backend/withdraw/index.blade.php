@extends('layouts.backend',['active'=>'wd','page'=>'withdraw'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <polygon points="0 0 24 0 24 24 0 24"/>
          <rect fill="#000000" opacity="0.3" transform="translate(13.000000, 6.000000) rotate(-450.000000) translate(-13.000000, -6.000000) " x="12" y="8.8817842e-16" width="2" height="12" rx="1"/>
          <path d="M9.79289322,3.79289322 C10.1834175,3.40236893 10.8165825,3.40236893 11.2071068,3.79289322 C11.5976311,4.18341751 11.5976311,4.81658249 11.2071068,5.20710678 L8.20710678,8.20710678 C7.81658249,8.59763107 7.18341751,8.59763107 6.79289322,8.20710678 L3.79289322,5.20710678 C3.40236893,4.81658249 3.40236893,4.18341751 3.79289322,3.79289322 C4.18341751,3.40236893 4.81658249,3.40236893 5.20710678,3.79289322 L7.5,6.08578644 L9.79289322,3.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(7.500000, 6.000000) rotate(-270.000000) translate(-7.500000, -6.000000) "/>
          <rect fill="#000000" opacity="0.3" transform="translate(11.000000, 18.000000) scale(1, -1) rotate(90.000000) translate(-11.000000, -18.000000) " x="10" y="12" width="2" height="12" rx="1"/>
          <path d="M18.7928932,15.7928932 C19.1834175,15.4023689 19.8165825,15.4023689 20.2071068,15.7928932 C20.5976311,16.1834175 20.5976311,16.8165825 20.2071068,17.2071068 L17.2071068,20.2071068 C16.8165825,20.5976311 16.1834175,20.5976311 15.7928932,20.2071068 L12.7928932,17.2071068 C12.4023689,16.8165825 12.4023689,16.1834175 12.7928932,15.7928932 C13.1834175,15.4023689 13.8165825,15.4023689 14.2071068,15.7928932 L16.5,18.0857864 L18.7928932,15.7928932 Z" fill="#000000" fill-rule="nonzero" transform="translate(16.500000, 18.000000) scale(1, -1) rotate(270.000000) translate(-16.500000, -18.000000) "/>
      </g>
  </svg>
</span>
Withdraw
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Wallets</a>
  </li>
  <li class="breadcrumb-item">
      <a href="#" class="text-white text-hover-dark">Withdraw</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
  <div class="card-header align-items-center bg-warning">
    <h3 class="card-title align-items-start flex-column">
      <span class="text-white">Withdraw</span>
      <span class="text-white mt-3 font-weight-bold font-size-sm">Trustme Coin : {{$my}}</span>
    </h3>
    <div class="card-toolbar">
      <div class="dropdown dropdown-inline">
        <a href="{{route('withdraw.history')}}" class="btn btn-light-warning btn-sm font-weight-bolder"><i class="flaticon-clock-2"></i> History</a>
        </a>
      </div>
    </div>
  </div>
  <!--begin::Form-->
    <div class="card-body">
        <form class="form" action="{{route('withdraw.send','trustme')}}" method="POST">
            @csrf
            <div class="form-group mb-8">
              <div class="alert alert-custom alert-default" role="alert">
                <div class="alert-icon">
                  <span class="svg-icon svg-icon-primary svg-icon-xl">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"></path>
                        <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </div>
                <div class="alert-text">
                  <p>NOTE : Withdrawals will be processed within 2-3 days.</p>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Trustme Coin address</label>
              <input id="address" name="address" value="{{$address}}" @if($address) readonly @endif class="form-control" placeholder="Trustme Coin address" type="text">
              <p id="error-address" class="text-danger"></p>
            </div>

            <div class="form-group">
              <label class="control-label">Amount ($)</label>
              <input id="amount" name="amount" class="form-control" placeholder="Amount ($)" min="1" type="number">
              <p id="error-amount" class="text-danger"></p>
            </div>

            <div class="form-group">
              <label class="control-label">Total (Trustme Coin)</label>
              <input id="total" name="total" class="form-control" placeholder="Total (Trustme Coin)" type="text" readonly>
              <p id="error-total" class="text-danger"></p>
            </div>

            @if($fee > 0)
              <div class="form-group">
                <label class="control-label">Fee ({{$fee*100}}%)</label>
                <input id="fee" class="form-control" placeholder="Fee (%)" type="text" readonly>
              </div>
            @endif

            <div class="form-group">
              <label class="control-label">Receive (Trustme Coin)</label>
              <input id="receive" class="form-control" placeholder="Receive (Trustme Coin)" type="text" readonly>
            </div>

            <div class="form-group">
              <label class="control-label">Security Password</label>
              <input id="password" name="security_password" class="form-control" placeholder="Security Password" type="password">
            </div>
            <div class="card-footer text-right">
              <div class="" id="action">
                <button id="btn_withdrawal" type="submit" class="btn btn-light-success waves-effect waves-light m-r-10">Submit</button>
                <button id="btn_clear" type="button" class="btn btn-light-danger waves-effect waves-light">Cancel</button>
              </div>

              <div class="hidden" id="loader">
                <i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>
              </div>
            </div>
        </form>
    </div>
  <!--end::Form-->
</div>
@endsection

@section('script')
<script type="text/javascript">
    var fee = {{$fee}},
        min = {{$min}},
        price = {{$price}};

    $('#amount').on('keyup change', function () {
      var value = parseInt($(this).val());
      $('#error-amount').html('');
      if(value >= min){
        var total = value * price;
        var amountfee = total * fee;
        var receive = total - amountfee;
        $('#total').val(addCommas(parseFloat(total).toFixed(8)));
        $('#fee').val(addCommas(parseFloat(amountfee).toFixed(8)));
        $('#receive').val(addCommas(parseFloat(receive).toFixed(8)));
      }else{
        $('#error-amount').html('Minimal Withdrawal : {{$min}} TC');
        $('#receive').val('');
      }
    });
    $('#btn_withdrawal').on('click',function () {
      $('#action').addClass('hidden');
      $('#loader').removeClass('hidden');
    });

    $('#btn_clear').on('click',function () {
      clear();
    });

    function clear() {
      $('#amount').val('');
      $('#total').val('');
      $('#fee').val('');
      $('#receive').val('');
      $('#password').val('');
    }

</script>
@endsection
