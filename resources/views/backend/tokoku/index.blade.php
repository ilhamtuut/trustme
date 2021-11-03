@extends('layouts.backend',['active'=>'index','page'=>'tokoku'])

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
Tokoku
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Tokoku</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
  <div class="card-header align-items-center border-0 bg-success">
    <h3 class="card-title align-items-start flex-column">
        <span class="font-weight-bolder text-white">Tokoku</span>
        <span class="mt-3 font-weight-bold font-size-sm">Balance : {{number_format($saldo)}} DC</span>
    </h3>
</div>
  <!--begin::Form-->
    <form class="form" action="{{route('tokoku.buy')}}" method="POST">
        <div class="card-body">
            @csrf
            <div class="form-group">
                <label>Phone Number</label>
                <input id="phone_number" type="text" name="phone_number" placeholder="Phone Number" class="form-control" autocomplete="off">
                <p class="mt-1 text-danger hidden" id="error-phone_number">Please check your Phone Number</p>
            </div>
            <div class="form-group">
                <label>Select Item</label>
                <select id="item" name="item" style="width: 100%;" class="form-control select2">
                    <option value="">Select Item</option>
                    <option value="pulsa">Pulsa</option>
                    <option value="paket_data">Paket Data</option>
                </select>
            </div>
            <div class="form-group hidden" id="view_pulsa">
                <label>Select Pulsa</label>
                <select id="item_pulsa" style="width: 100%;" class="form-control select2">
                    <option value="">Select Pulsa</option>
                </select>
            </div>
            <div class="form-group hidden" id="view_paket_data">
                <label>Select Paket Data</label>
                <select id="item_paket_data" style="width: 100%;" class="form-control select2">
                    <option value="">Select Paket Data</option>
                </select>
            </div>
            <div class="form-group">
                <label>Amount DC</label>
                <input id="item_id" name="item_id" type="text" class="form-control hidden">
                <input id="item_price" name="item_price" type="text" class="form-control hidden">
                <input id="item_name" name="item_name" type="text" class="form-control hidden">
                <input id="amount" type="text" name="amount_dc" readonly placeholder="Amount DC" class="form-control">
            </div>
            <div class="form-group">
                <label>Fee {{$fee*100}}%</label>
                <input id="fee" type="text" name="fee" readonly placeholder="Fee" class="form-control">
            </div>
            <div class="form-group">
                <label>Total</label>
                <input id="total" type="text" name="total" readonly placeholder="Total" class="form-control">
            </div>
            <div class="form-group">
                <label>Security Password</label>
                <input id="security_password" name="security_password" type="password" placeholder="Security Password" class="form-control" autocomplete="off">
            </div>
        </div>
        <div class="card-footer text-right">
            <div id="action">
                <button id="btn_action" type="submit" class="btn btn-light-success mr-2">Submit</button>
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
    var amount = 0,price = {{$price}},fee = {{$fee}};
    $('#phone_number').on('keyup change',function () {
        $('#error-phone_number').addClass('hidden');
        var phone_number = $(this).val();
        if(phone_number.length > 8){
            $.ajax({
                url:'{{ route('tokoku.item') }}',
                type:'GET',
                data:{
                    phone_number:phone_number
                },
                success:function(data) {
                    if(data.data.pulsa.length > 0){
                        var item_pulsa = [];
                        $('#item_pulsa').empty();
                        $('#item_pulsa').append('<option value="">Select Pulsa</option>');
                        $.each(data.data.pulsa, function(i, item) {
                            item_pulsa[i] = "<option value='" + item.id + "' data-price='"+ item.harga +"' data-item='"+ item.nama_paket +"'>" + item.nama_paket + " ["+ addCommas(item.harga) +" IDR]</option>";
                        });
                        $('#item_pulsa').append(item_pulsa);
                    }else{
                        $('#error-phone_number').removeClass('hidden');
                    }

                    if(data.data.paket_data.length > 0){
                        var item_paket_data = [];
                        $('#item_paket_data').empty();
                        $('#item_paket_data').append('<option value="">Select Pulsa</option>');
                        $.each(data.data.paket_data, function(i, item) {
                            item_paket_data[i] = "<option value='" + item.id + "' data-price='"+ item.harga +"'data-item='"+ item.nama_paket +"'>" + item.nama_paket + " ["+ addCommas(item.harga) +" IDR]</option>";
                        });
                        $('#item_paket_data').append(item_paket_data);
                    }else{
                        $('#error-phone_number').removeClass('hidden');
                    }
                },
            });
        }
    });

    $('#item').on('change', function(){
        var value = $(this).val();
        $('#amount').val('');
        $('#fee').val('');
        $('#total').val('');
        if(value == 'pulsa'){
            $('#view_pulsa').removeClass('hidden');
            $('#view_paket_data').addClass('hidden');
        }else if(value == 'paket_data'){
            $('#view_pulsa').addClass('hidden');
            $('#view_paket_data').removeClass('hidden');
        }else{
            $('#view_pulsa').addClass('hidden');
            $('#view_paket_data').addClass('hidden');
        }
    });

    $('#item_pulsa').on('change', function(){
        var value = $(this).find(':selected').data('price');
        amount = (value/price) + 0.00000001;
        var amountFee = amount * fee;
        var total = amount + amountFee
        $('#item_id').val($(this).val());
        $('#item_name').val($(this).find(':selected').data('item'));
        $('#item_price').val(value);
        $('#amount').val(parseFloat(amount).toFixed(8));
        $('#fee').val(parseFloat(amountFee).toFixed(8));
        $('#total').val(parseFloat(total).toFixed(8));
    });

    $('#item_paket_data').on('change', function(){
        var value = $(this).find(':selected').data('price');
        amount = (value/price) + 0.00000001;
        var amountFee = amount * fee;
        var total = amount + amountFee
        $('#item_id').val($(this).val());
        $('#item_name').val($(this).find(':selected').data('item'));
        $('#item_price').val(value);
        $('#amount').val(parseFloat(amount).toFixed(8));
        $('#fee').val(parseFloat(amountFee).toFixed(8));
        $('#total').val(parseFloat(total).toFixed(8));
    });

    $('#btn_action').on('click',function () {
        $('#action').addClass('hidden');
        $('#loader').removeClass('hidden');
    });

    $('#btn_clear').on('click',function () {
      $(".select2").val("").trigger("change");
      $('#amount').val('');
      $('#fee').val('');
      $('#total').val('');
      $('#phone_number').val('');
      $('#security_password').val('');
    });
</script>
@endsection
