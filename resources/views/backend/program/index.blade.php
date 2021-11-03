@extends('layouts.backend',['active'=>'invest','page'=>'program'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <rect x="0" y="0" width="24" height="24"/>
          <path d="M22,17 L22,21 C22,22.1045695 21.1045695,23 20,23 L4,23 C2.8954305,23 2,22.1045695 2,21 L2,17 L6.27924078,17 L6.82339262,18.6324555 C7.09562072,19.4491398 7.8598984,20 8.72075922,20 L15.381966,20 C16.1395101,20 16.8320364,19.5719952 17.1708204,18.8944272 L18.118034,17 L22,17 Z" fill="#000000"/>
          <path d="M2.5625,15 L5.92654389,9.01947752 C6.2807805,8.38972356 6.94714834,8 7.66969497,8 L16.330305,8 C17.0528517,8 17.7192195,8.38972356 18.0734561,9.01947752 L21.4375,15 L18.118034,15 C17.3604899,15 16.6679636,15.4280048 16.3291796,16.1055728 L15.381966,18 L8.72075922,18 L8.17660738,16.3675445 C7.90437928,15.5508602 7.1401016,15 6.27924078,15 L2.5625,15 Z" fill="#000000" opacity="0.3"/>
          <path d="M11.1288761,0.733697713 L11.1288761,2.69017121 L9.12120481,2.69017121 C8.84506244,2.69017121 8.62120481,2.91402884 8.62120481,3.19017121 L8.62120481,4.21346991 C8.62120481,4.48961229 8.84506244,4.71346991 9.12120481,4.71346991 L11.1288761,4.71346991 L11.1288761,6.66994341 C11.1288761,6.94608579 11.3527337,7.16994341 11.6288761,7.16994341 C11.7471877,7.16994341 11.8616664,7.12798964 11.951961,7.05154023 L15.4576222,4.08341738 C15.6683723,3.90498251 15.6945689,3.58948575 15.5161341,3.37873564 C15.4982803,3.35764848 15.4787093,3.33807751 15.4576222,3.32022374 L11.951961,0.352100892 C11.7412109,0.173666017 11.4257142,0.199862688 11.2472793,0.410612793 C11.1708299,0.500907473 11.1288761,0.615386087 11.1288761,0.733697713 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.959697, 3.661508) rotate(-270.000000) translate(-11.959697, -3.661508) "/>
      </g>
  </svg>
</span>
Invest
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Investments</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Invest</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
  <div class="card-header bg-warning">
    <h3 class="card-title text-white">
        <span class="svg-icon svg-icon-white svg-icon-sm mr-1">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M22,17 L22,21 C22,22.1045695 21.1045695,23 20,23 L4,23 C2.8954305,23 2,22.1045695 2,21 L2,17 L6.27924078,17 L6.82339262,18.6324555 C7.09562072,19.4491398 7.8598984,20 8.72075922,20 L15.381966,20 C16.1395101,20 16.8320364,19.5719952 17.1708204,18.8944272 L18.118034,17 L22,17 Z" fill="#000000"/>
                    <path d="M2.5625,15 L5.92654389,9.01947752 C6.2807805,8.38972356 6.94714834,8 7.66969497,8 L16.330305,8 C17.0528517,8 17.7192195,8.38972356 18.0734561,9.01947752 L21.4375,15 L18.118034,15 C17.3604899,15 16.6679636,15.4280048 16.3291796,16.1055728 L15.381966,18 L8.72075922,18 L8.17660738,16.3675445 C7.90437928,15.5508602 7.1401016,15 6.27924078,15 L2.5625,15 Z" fill="#000000" opacity="0.3"/>
                    <path d="M11.1288761,0.733697713 L11.1288761,2.69017121 L9.12120481,2.69017121 C8.84506244,2.69017121 8.62120481,2.91402884 8.62120481,3.19017121 L8.62120481,4.21346991 C8.62120481,4.48961229 8.84506244,4.71346991 9.12120481,4.71346991 L11.1288761,4.71346991 L11.1288761,6.66994341 C11.1288761,6.94608579 11.3527337,7.16994341 11.6288761,7.16994341 C11.7471877,7.16994341 11.8616664,7.12798964 11.951961,7.05154023 L15.4576222,4.08341738 C15.6683723,3.90498251 15.6945689,3.58948575 15.5161341,3.37873564 C15.4982803,3.35764848 15.4787093,3.33807751 15.4576222,3.32022374 L11.951961,0.352100892 C11.7412109,0.173666017 11.4257142,0.199862688 11.2472793,0.410612793 C11.1708299,0.500907473 11.1288761,0.615386087 11.1288761,0.733697713 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.959697, 3.661508) rotate(-270.000000) translate(-11.959697, -3.661508) "/>
                </g>
            </svg>
        </span> Invest
    </h3>
  </div>
  <!--begin::Form-->
  <form class="form" action="{{route('program.register')}}" method="POST">
    <div class="card-body">
      @csrf
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
    var one,two,three,package,nomimal1,nomimal2, plan = '{{request()->plan}}',price = {{$price}};
    if(plan){
      package = $('#package').find(':selected').data('amount');
    }
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
            $('#balance_credit').val(addCommas(parseFloat(nomimal2).toFixed(8)));
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
            $('#balance_credit').val(addCommas(parseFloat(nomimal2).toFixed(8)));
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
