@extends('layouts.backend',['active'=>'add_member','page'=>'team'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="Stockholm-icons-/-Communication-/-Add-user" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
            <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero"></path>
        </g>
    </svg>
</span>
Add Member
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Membership</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Add Member</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
  <div class="card-header bg-warning">
    <h3 class="card-title text-white">
        <span class="svg-icon svg-icon-white svg-icon-sm mr-1">
            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Stockholm-icons-/-Communication-/-Add-user" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
                    <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                    <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero"></path>
                </g>
            </svg>
        </span>
        Add Member
    </h3>
  </div>
  <!--begin::Form-->
  <form class="form" action="{{route('program.register.add_member')}}" method="POST">
    <div class="card-body">
      @csrf
      {{-- <div class="form-group">
          <label>Package</label>
          <select id="package" name="package" style="width: 100%;" class="form-control select2">
            <option value="">Choose Package</option>
            @foreach($packages as $value)
              <option value="{{$value->id}}" data-amount="{{$value->amount}}">{{$value->name}} ~ ${{number_format($value->amount)}}</option>
            @endforeach
          </select>
      </div> --}}
      <div class="form-group">
          <label>Amount</label>
          <input id="amount" type="text" name="amount" placeholder="Amount" class="form-control">
      </div>
      <div class="form-group">
          <label>Composition Wallet</label>
          <select id="wallet" name="wallet" style="width: 100%;" class="form-control select2">
            <option value="">Choose Composition Wallet</option>
            @foreach($composition as $data)
              @if($data->name == 'Register 1')
                  <option value="{{$data->id}}" data-one="{{$data->one}}" data-two="{{$data->two}}" data-three="{{$data->three}}">Register Wallet {{$data->one*100}}%</option>
              @elseif($data->name == 'Register 2')
                  <option value="{{$data->id}}" data-one="{{$data->one}}" data-two="{{$data->two}}" data-three="{{$data->three}}">Register Wallet {{$data->one*100}}% & Trustme Coin {{$data->two*100}}%</option>
              @endif
            @endforeach
          </select>
      </div>
      <div class="form-group row hidden" id="grp_input">
          <div class="col-md-12">
              <div class="row">
                  <div class="hidden" id="input_bi">
                      <label>Register Wallet</label>
                      <input id="balance_income" type="text" readonly placeholder="Register Wallet" class="form-control">
                  </div>
                  <div class="hidden" id="input_bca">
                      <label>Trustme Coin</label>
                      <input id="balance_credit" type="text" readonly placeholder="Trustme Coin" class="form-control">
                  </div>
              </div>
          </div>
      </div>
      <div class="form-group">
        <label>Name</label>
        <input id="name" name="name" type="text" placeholder="Name" class="form-control">
      </div>
      <div class="form-group">
        <label>Username</label>
        <input id="username" name="username" type="text" placeholder="Username" class="form-control">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off" />
      </div>
      <div class="form-group">
        <label>Phone Number</label>
        <input class="form-control" type="text" placeholder="Phone Number" name="phone_number" autocomplete="off" />
      </div>
      <div class="form-group">
        <label>Password</label>
        <input class="form-control" type="password" placeholder="Password" name="password" />
      </div>
      <div class="form-group">
        <label>Security Password</label>
        <input id="password_package" name="security_password" type="password" placeholder="Security Password" class="form-control">
      </div>
    </div>
    <div class="card-footer text-right">
      <div id="buypackage">
        <button id="btn_buypackage" type="submit" class="btn btn-light-success mr-2">Submit</button>
        <button id="btn_clear" type="button" class="btn btn-light-danger">Cancel</button>
      </div>
      <div class="text-center hidden" id="loader">
        <i class="fa fa-spinner fa-spin"></i>
      </div>
    </div>
  </form>
  <!--end::Form-->
</div>
@endsection

@section('script')
<script type="text/javascript">
    var one,two,three,package,nomimal1,nomimal2,price = {{$price}};
    $('#package').on('change', function() {
        var value = $(this).val();
        if(value != ''){
            package = $(this).find(':selected').data('amount');
            var wallet = $('#wallet').val();
            if(wallet == 1){
                nomimal1 = package*one;
                nomimal2 = package*two;
                $('#grp_input').removeClass('hidden');
                $('#input_bi').removeClass('hidden col-md-6');
                $('#input_bi').addClass('col-md-12');
                $('#input_bca').addClass('hidden');
                $('#balance_income').val(addCommas(parseFloat(nomimal1).toFixed(2)));
                $('#balance_credit').val(addCommas(parseFloat(nomimal2).toFixed(8)));
            }else if(wallet == 2){
                nomimal1 = package*one;
                nomimal2 = (package*two) / price;
                $('#grp_input').removeClass('hidden');
                $('#input_bca').removeClass('hidden col-md-6');
                $('#input_bi').removeClass('hidden col-md-6 col-md-12');
                $('#input_bca').addClass('col-md-6');
                $('#input_bi').addClass('col-md-6');

                $('#balance_income').val(addCommas(parseFloat(nomimal1).toFixed(2)));
                $('#balance_credit').val(addCommas(parseFloat(nomimal2).toFixed(8)));
            }
        }else{
            $("#wallet").val("").trigger("change");
            $('#grp_input').addClass('hidden');
            package = 0;
        }
    });

    $('#amount').on('keyup change', function() {
        package = $(this).val();
        var value = $('#wallet').val();
        one = $('#wallet').find(':selected').data('one');
        two = $('#wallet').find(':selected').data('two');
        three = $('#wallet').find(':selected').data('three');
        if(parseInt(value) == 1){
            nomimal1 = package*one;
            nomimal2 = package*two;
            $('#grp_input').removeClass('hidden');
            $('#input_bi').removeClass('hidden col-md-6');
            $('#input_bi').addClass('col-md-12');
            $('#input_bca').addClass('hidden');

            $('#balance_income').val(addCommas(parseFloat(nomimal1).toFixed(2)));
            $('#balance_credit').val(addCommas(parseFloat(nomimal2).toFixed(2)));
        }else if(parseInt(value) == 2){
            nomimal1 = package*one;
            nomimal2 = (package*two) / price;
            $('#grp_input').removeClass('hidden');
            $('#input_bca').removeClass('hidden col-md-6');
            $('#input_bi').removeClass('hidden col-md-6 col-md-12');
            $('#input_bca').addClass('col-md-6');
            $('#input_bi').addClass('col-md-6');

            $('#balance_income').val(addCommas(parseFloat(nomimal1).toFixed(2)));
            $('#balance_credit').val(addCommas(parseFloat(nomimal2).toFixed(8)));
        }
    });

    $('#wallet').on('change', function() {
        var value = $(this).val();
        package = $('#amount').val();
        one = $(this).find(':selected').data('one');
        two = $(this).find(':selected').data('two');
        three = $(this).find(':selected').data('three');
        if(value == 1){
            nomimal1 = package*one;
            nomimal2 = package*two;
            $('#grp_input').removeClass('hidden');
            $('#input_bi').removeClass('hidden col-md-6');
            $('#input_bi').addClass('col-md-12');
            $('#input_bca').addClass('hidden');

            $('#balance_income').val(addCommas(parseFloat(nomimal1).toFixed(2)));
            $('#balance_credit').val(addCommas(parseFloat(nomimal2).toFixed(2)));
        }else if(value == 2){
            nomimal1 = package*one;
            nomimal2 = (package*two) / price;
            $('#grp_input').removeClass('hidden');
            $('#input_bca').removeClass('hidden col-md-6');
            $('#input_bi').removeClass('hidden col-md-6 col-md-12');
            $('#input_bca').addClass('col-md-6');
            $('#input_bi').addClass('col-md-6');

            $('#balance_income').val(addCommas(parseFloat(nomimal1).toFixed(2)));
            $('#balance_credit').val(addCommas(parseFloat(nomimal2).toFixed(8)));
        }
    });

    $('#btn_buypackage').on('click',function () {
        $('#buypackage').addClass('hidden');
        $('#loader').removeClass('hidden');

        if($('#password_package').val() == ''){
          $('#buypackage').removeClass('hidden');
          $('#loader').addClass('hidden');
        }
    });

    $('#btn_clear').on('click',function () {
      $("#package").val("").trigger("change");
      $("#wallet").val("").trigger("change");
      $('#grp_input').addClass('hidden');
      $('#amount').val('');
      $('#password_package').val('');
    });
</script>
@endsection
