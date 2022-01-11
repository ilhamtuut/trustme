@extends('layouts.backend',['active'=>'holder','page'=>'bounty'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"></rect>
            <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16"></rect>
            <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero"></path>
        </g>
    </svg>
</span>
Bounty Spartan Coin
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Bounty</a>
  </li>
  <li class="breadcrumb-item">
      <a href="#" class="text-white text-hover-dark">Spartan Coin</a>
  </li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="col bg-warning px-6 py-3 rounded-sm mb-5">
            <span class="svg-icon svg-icon-3x svg-icon-white d-block my-2">
                <img src="{{asset('images/trust-icon.png')}}" width="40px" height="40px">
            </span>
            <span href="#" class="text-white font-weight-bold font-size-h6 mt-2">TRUSTME COIN <br>{{$my}}</span>
            <br><a class="text-white text-hover-white" href="{{route('balance.harvest')}}">More <i class="flaticon-shapes icon-xs text-white"></i></a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="col bg-primary px-6 py-3 rounded-sm mb-5">
            <span class="svg-icon svg-icon-3x svg-icon-white d-block my-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M18,16 L9,16 C8.44771525,16 8,15.5522847 8,15 C8,14.4477153 8.44771525,14 9,14 L17,14 C17.5522847,14 18,13.5522847 18,13 C18,12.4477153 17.5522847,12 17,12 L9,12 C7.34314575,12 6,13.3431458 6,15 C6,16.6568542 7.34314575,18 9,18 L19.5,18 C21,18 21,18.5 21,19 C21,19.5 21,20 19.5,20 L7,20 C4.790861,20 3,18.209139 3,16 L3,8 C3,5.790861 4.790861,4 7,4 L17,4 C19.209139,4 21,5.790861 21,8 L21,13.0000005 C21,14.6568542 19.6568542,16 18,16 Z" fill="#000000"/>
                    </g>
                </svg>
            </span>
            <span href="#" class="text-white font-weight-bold font-size-h6">SPARTAN<br><i class="fas fa-dollar-sign text-white"></i> {{$spartan}}</span>
            <br><a class="text-white text-hover-white" href="{{route('balance.spartan')}}">More <i class="flaticon-shapes icon-xs text-white"></i></a>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="col bg-danger px-6 py-3 rounded-sm mb-5">
            <span class="svg-icon svg-icon-3x svg-icon-white d-block my-2">
                <i class="fas fa-clock fa-3x text-white"></i>
            </span>
            <span href="#" class="text-white font-weight-bold font-size-h6">Hold Timer<br>{{$hold_timer}} Days</span>
        </div>
    </div>
</div>
@include('layouts.partials.alert')
<div class="card card-custom">
  <div class="card-header align-items-center bg-warning">
    <h3 class="card-title align-items-start flex-column">
      <span class="text-white">Bounty Spartan Coin</span>
    </h3>
    <div class="card-toolbar">
      <div class="dropdown dropdown-inline">
        <a href="{{route('bounty.history')}}" class="btn btn-light-warning btn-sm font-weight-bolder"><i class="flaticon-clock-2"></i> History</a>
        </a>
      </div>
    </div>
  </div>
  <!--begin::Form-->
    <div class="card-body">
        <form class="form" action="{{route('bounty.holder')}}" method="POST">
            @csrf
            <div class="form-group mb-8">
              <div class="alert alert-custom alert-default" role="alert">
                <div class="alert-icon">
                    <i class="fa fa-info-circle text-primary"></i>
                </div>
                <div class="alert-text">
                    <li>Hold Minimal {{$min}} TMC</li>
                    <li>1 TMC Get {{$rate}} SPARTAN</li>
                    <li>Hold Timer : {{$timer}} Days</li>
                    <li>Smart Contract Spartan Coin <span class="text-warning">{{$contract}}</span></li>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label">Amount (Trustme Coin)</label>
              <input id="amount" name="amount" class="form-control" placeholder="Amount (Trustme Coin)" min="1" type="number">
              <p id="error-amount" class="text-danger"></p>
            </div>

            <div class="form-group">
              <label class="control-label">Total (SPARTAN)</label>
              <input id="total" name="total" class="form-control" placeholder="Total (SPARTAN)" type="text" readonly>
              <p id="error-total" class="text-danger"></p>
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
    var min = {{$min}},
        price = {{$rate}};

    $('#amount').on('keyup change', function () {
        var value = parseInt($(this).val());
        $('#error-amount').html('');
        if(value >= min){
            var total = value * price;
            $('#total').val(addCommas(parseFloat(total).toFixed(8)));
        }else{
            $('#error-amount').html('Hold Minimal : {{$min}} TMC');
            $('#total').val('');
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
        $('#password').val('');
    }

</script>
@endsection
