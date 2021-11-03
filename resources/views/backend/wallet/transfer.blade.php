@extends('layouts.backend',['active'=>'convert','page'=>'convert'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M10.9,2 C11.4522847,2 11.9,2.44771525 11.9,3 C11.9,3.55228475 11.4522847,4 10.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,16 C20,15.4477153 20.4477153,15 21,15 C21.5522847,15 22,15.4477153 22,16 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L10.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M24.0690576,13.8973499 C24.0690576,13.1346331 24.2324969,10.1246259 21.8580869,7.73659596 C20.2600137,6.12944276 17.8683518,5.85068794 15.0081639,5.72356847 L15.0081639,1.83791555 C15.0081639,1.42370199 14.6723775,1.08791555 14.2581639,1.08791555 C14.0718537,1.08791555 13.892213,1.15726043 13.7542266,1.28244533 L7.24606818,7.18681951 C6.93929045,7.46513642 6.9162184,7.93944934 7.1945353,8.24622707 C7.20914339,8.26232899 7.22444472,8.27778811 7.24039592,8.29256062 L13.7485543,14.3198102 C14.0524605,14.6012598 14.5269852,14.5830551 14.8084348,14.2791489 C14.9368329,14.140506 15.0081639,13.9585047 15.0081639,13.7695393 L15.0081639,9.90761477 C16.8241562,9.95755456 18.1177196,10.0730665 19.2929978,10.4469645 C20.9778605,10.9829796 22.2816185,12.4994368 23.2042718,14.996336 L23.2043032,14.9963244 C23.313119,15.2908036 23.5938372,15.4863432 23.9077781,15.4863432 L24.0735976,15.4863432 C24.0735976,15.0278051 24.0690576,14.3014082 24.0690576,13.8973499 Z" fill="#000000" fill-rule="nonzero" transform="translate(15.536799, 8.287129) scale(-1, 1) translate(-15.536799, -8.287129) "/>
    </g>
  </svg>
</span>
Transfer {{str_replace('_', ' ', $type)}}
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Wallets</a>
  </li>
  <li class="breadcrumb-item">
      <a href="#" class="text-white text-hover-dark">Transfer {{str_replace('_', ' ', $type)}}</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
  <div class="card-header align-items-center bg-warning">
    <h3 class="card-title align-items-start flex-column">
      <span class="text-white">Transfer {{str_replace('_', ' ', $type)}}</span>
      <span class="text-white mt-3 font-weight-bold font-size-sm">Balance : @if($type == 'trustme_coin') {{number_format($saldo->balance,8)}} TC @else <i class="fas fa-dollar-sign text-white icon-sm"></i> {{number_format($saldo->balance,2)}} @endif</span>
    </h3>
    <div class="card-toolbar">
      <div class="dropdown dropdown-inline">
        @php
          if($type == 'trustme_coin'){
            $link = route('balance.harvest');
          }elseif($type == 'pin'){
            $link = route('balance.pin');
          }elseif($type == 'usd_wallet'){
            $link = route('balance.my');
          }else{
            $link = route('balance.register');
          }
        @endphp
        <a href="{{ $link }}" class="btn btn-light-warning btn-sm font-weight-bolder"><i class="flaticon-clock-2"></i> History</a>
      </div>
    </div>
  </div>
  <!--begin::Form-->
  <form class="form" action="{{route('transfer.send',$type)}}" method="POST">
    <div class="card-body">
      @csrf
      	<div class="form-group mt-2">
	        <label> Username</label>
	        <input class="form-control" id="username" name="username" type="text" placeholder="Username">
	        <p class="text-danger" id="username-error"></p>
	    </div>
	    <div class="form-group hidden" id="usr_show">
	        <label> Recipient Name</label>
	        <input class="form-control" style="background-color: #fff;" id="name" type="text" placeholder="Recipient Name" readonly>
	        <p class="text-danger" id="name_error"></p>
	    </div>
	    <div class="form-group">
	        <label> Amount</label>
	        <input class="form-control" id="amount" name="amount" type="text" placeholder="Amount">
	        <p class="text-danger" id="amount-error"></p>
	    </div>
	    <div class="form-group">
	        <label> Security Password</label>
	        <input class="form-control" id="password" name="security_password" placeholder="Security Password" type="password">
	        <p class="text-danger" id="password-error"></p>
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
@endsection

@section('script')
<script type="text/javascript">
    $('#username').on('keyup',function (e) {
        e.preventDefault();
        $.ajax({
          type: 'GET',
          url: '{{ route('transfer.check') }}',
          data: {username : this.value},
          dataType: 'json',
          success: function(response){
            if(response.success){
              $('#usr_show').removeClass('hidden');
              $('#name').val(response.name);
            }else{
              $('#usr_show').addClass('hidden');
              $('#name').val('');
            }
          }
        });
    });

    $('#btn_transfer').on('click',function () {
      $('#action').addClass('hidden');
      $('#loader').removeClass('hidden');
    });

    $('#btn_clear').on('click',function () {
      $('#usr_show').addClass('hidden');
      $('#username').val('');
      $('#amount').val('');
      $('#password').val('');
    });
</script>
@endsection
