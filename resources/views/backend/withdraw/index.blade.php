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
      <span class="text-white mt-3 font-weight-bold font-size-sm">USD Wallet : <i class="text-white fas fa-euro-sign icon-sm"></i> {{$my}}</span>
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
      <div class="card card-custom">
        <!--begin::Card header-->
        <div class="card-header card-header-tabs-line nav-tabs-line-3x">
          <!--begin::Toolbar-->
          <div class="card-toolbar">
            <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
              <!--begin::Item-->
              <li class="nav-item mr-3">
                <a class="nav-link active" data-toggle="tab" href="#wd_bank">
                  <span class="nav-icon">
                    <span class="svg-icon">
                      <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <polygon points="0 0 24 0 24 24 0 24"></polygon>
                          <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                          <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                  </span>
                  <span class="nav-text font-size-lg">Bank</span>
                </a>
              </li>
              <!--end::Item-->
              <!--begin::Item-->
              <li class="nav-item mr-3">
                <a class="nav-link" data-toggle="tab" href="#wd_usdt">
                  <span class="nav-icon">
                    <span class="svg-icon">
                      <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24"></rect>
                          <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"></path>
                          <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3"></path>
                          <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3"></path>
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                  </span>
                  <span class="nav-text font-size-lg">USDT</span>
                </a>
              </li>
              <!--end::Item-->
            </ul>
          </div>
          <!--end::Toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body px-0">
            <div class="tab-content">
              <!--begin::Tab-->
              <div class="tab-pane show px-7 active" id="wd_bank" role="tabpanel">
                <!--begin::Row-->
                <form class="form" action="{{route('withdraw.send','bank')}}" method="POST">
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
                        @if(Auth::user()->mybank()->where('status',1)->first())
                          Bank Name : <span class="text-primary">{{Auth::user()->mybank()->where('status',1)->first()->bank->name}}</span> <br>
                          Bank Username : <span class="text-primary">{{Auth::user()->mybank()->where('status',1)->first()->username}}</span> <br>
                          Bank Account : <span class="text-primary">{{Auth::user()->mybank()->where('status',1)->first()->account}}</span>
                        @else
                          Please add your bank account first to make a withdrawal. <a href="{{route('bank.account')}}">Click Here</a>
                        @endif
                        <p>NOTE : Withdrawals will be processed within 2-3 days.</p>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Amount ($)</label>
                    <input id="amount" name="amount" class="form-control" placeholder="Amount ($)" min="1" type="number">
                    <p id="error-amount" class="text-danger"></p>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Total (IDR)</label>
                    <input id="total" name="total" class="form-control" placeholder="Total (IDR)" type="text" readonly>
                    <p id="error-total" class="text-danger"></p>
                  </div>

                  @if($fee > 0)
                    <div class="form-group">
                      <label class="control-label">Fee ({{$fee*100}}%)</label>
                      <input id="fee" class="form-control" placeholder="Fee (%)" type="text" readonly>
                    </div>
                  @endif

                  <div class="form-group">
                    <label class="control-label">Receive (IDR)</label>
                    <input id="receive" name="receive" class="form-control" placeholder="Receive (IDR)" type="text" readonly>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Security Password</label>
                    <input id="password" name="security_password" class="form-control" placeholder="Security Password" type="password">
                  </div>
                  <div class="card-footer text-right">
                    <div class="p-3" id="action">
                      <button id="btn_withdrawal" type="submit" class="btn btn-light-success waves-effect waves-light m-r-10">Submit</button>
                      <button id="btn_clear" type="button" class="btn btn-light-danger waves-effect waves-light">Cancel</button>
                    </div>

                    <div class="hidden" id="loader">
                      <i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>
                    </div>
                  </div>
                </form>
                <!--end::Row-->
              </div>
              <!--end::Tab-->
              <!--begin::Tab-->
              <div class="tab-pane px-7" id="wd_usdt" role="tabpanel">
                <!--begin::Body-->
                <form class="form" action="{{route('withdraw.send','usdt')}}" method="POST">
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
                        @if(Auth::user()->wallet()->where('status',1)->first())
                          Your USDT address : <span class="text-primary">{{Auth::user()->wallet()->where('status',1)->first()->address}}</span>
                        @else
                          Please add your USDT address first to make a withdrawal. <a href="{{route('usdt.myWallet')}}">Click Here</a>
                        @endif
                        <p>NOTE : Withdrawals will be processed within 2-3 days.</p>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Amount ($)</label>
                    <input id="amount_" name="amount" class="form-control" placeholder="Amount ($)" min="1" type="number">
                    <p id="error-amount_" class="text-danger"></p>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Total (USDT)</label>
                    <input id="total_" name="total" class="form-control" placeholder="Total (USDT)" type="text" readonly>
                    <p id="error-total" class="text-danger"></p>
                  </div>

                  @if($fee > 0)
                    <div class="form-group">
                      <label class="control-label">Fee ({{$fee*100}}%)</label>
                      <input id="fee_" class="form-control" placeholder="Fee (%)" type="text" readonly>
                    </div>
                  @endif

                  <div class="form-group">
                    <label class="control-label">Receive (USDT)</label>
                    <input id="receive_" name="usdt" class="form-control" placeholder="Receive (USDT)" type="text" readonly>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Security Password</label>
                    <input id="password_" name="security_password" class="form-control" placeholder="Security Password" type="password">
                  </div>
                  <div class="card-footer text-right">
                    <div class="p-3" id="action_">
                      <button id="btn_withdrawal_" type="submit" class="btn btn-light-success waves-effect waves-light m-r-10">Submit</button>
                      <button id="btn_clear_" type="button" class="btn btn-light-danger waves-effect waves-light">Cancel</button>
                    </div>

                    <div class="hidden" id="loader_">
                      <i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>
                    </div>
                  </div>
                </form>
              </div>
              <!--end::Tab-->
            </div>
        </div>
        <!--begin::Card body-->
      </div>
    </div>
  <!--end::Form-->
</div>
@endsection

@section('script')
<script type="text/javascript">
    var fee = {{$fee}},
        min = {{$min}},
        idr = {{$idr}},
        usdt = {{$usdt}};
    $('#amount').on('keyup change', function () {
      var value = parseInt($(this).val());
      $('#error-amount').html('');
      if(value >= min){
        var total = value * idr;
        var amountfee = total * fee;
        var receive = total - amountfee;
        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
        $('#fee').val(addCommas(parseFloat(amountfee).toFixed(2)));
        $('#receive').val(addCommas(parseFloat(receive).toFixed(2)));
      }else{
        $('#error-amount').html('Minimal Withdrawal : {{$min}} Euro');
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

    $('#amount_').on('keyup change', function () {
      var value = parseInt($(this).val());
      $('#error-amount_').html('');
      if(value >= min){
        var total = value * usdt;
        var amountfee = total * fee;
        var receive = total - amountfee;
        $('#total_').val(addCommas(parseFloat(total).toFixed(2)));
        $('#fee_').val(addCommas(parseFloat(amountfee).toFixed(2)));
        $('#receive_').val(addCommas(parseFloat(receive).toFixed(2)));
      }else{
        $('#error-amount_').html('Minimal Withdrawal : {{$min}} Euro');
        $('#receive_').val('');
      }
    });
    $('#btn_withdrawal_').on('click',function () {
      $('#action_').addClass('hidden');
      $('#loader_').removeClass('hidden');
    });

    $('#btn_clear_').on('click',function () {
      clear();
    });

    function clear() {
      $('#amount').val('');
      $('#receive').val('');
      $('#password').val('');
      $('#amount_').val('');
      $('#receive_').val('');
      $('#password_').val('');

      console.log('s');
    }

</script>
@endsection
