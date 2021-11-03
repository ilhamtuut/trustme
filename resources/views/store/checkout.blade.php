@extends('store.components.index')
@section('title', 'Check Out')
@section('pagesStore')
<div class="checkout-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="billing-info-wrap">
                    <h3>Billing Details</h3>
                    <form id="checkout-post" action="{{ url('store/checkout/post') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label>Name</label>
                                    <input disabled value="{{Auth::User()->name}}" type="text" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Phone</label>
                                    <input disabled name="phone" value="{{Auth::User()->phone_number}}" type="text" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Email Address</label>
                                    <input disabled name="email" value="{{Auth::User()->email}}" type="text" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Province</label>
                                    <select class="js-example-basic-single" name="province">
                                        @foreach($provinsi as $useProvinsi)
                                        <option value="{{$useProvinsi['province_id']}}">{{$useProvinsi['province']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4 select-city-data">
                                    <label>City</label>
                                    <select disabled class="select-city" name="city">
                                        <option class="city-class-option">Select Province Before</option>
                                    </select>
                                    <span class="form-text text-danger">{{ $errors->form->first('city') }}</span>
                                </div>
                            </div>
                          
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Postcode / ZIP</label>
                                    <input disabled name="zip" type="number" />
                                    <span class="form-text text-danger">{{ $errors->form->first('zip') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="additional-info-wrap">
                            <div class="additional-info">
                                <label>Additional information / Detail Address</label>
                                <textarea placeholder="Notes about your order, e.g. special notes for delivery. "
                                    name="information"></textarea>
                                <span class="form-text text-danger">{{ $errors->form->first('information') }}</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                <div class="your-order-area">
                    <div class="d-flex justify-content-between">
                        <h3 class="cart-page-title">Your Cart items</h3>
                        <h6 class="cart-page-title text-primary">Balance:
                            {{Auth::user()->balance->where('description','Dinasty Coin')->first()->balance,8}} DC
                        </h6>
                    </div>
                    <div class="your-order-wrap gray-bg-4">
                        <div class="your-order-product-info">
                            <div class="your-order-top">
                                <ul>
                                    <li>Product</li>
                                    <li>Total</li>
                                </ul>
                            </div>
                            <div class="your-order-middle">
                                <ul>
                                    @foreach($cart as $use)
                                    <li><span class="order-middle-left">{{$use->product->name}} X {{$use->qty}}</span>
                                        <span class="order-price">Rp{{$use->total}} </span>
                                    </li>
                                </ul>
                                @endforeach
                            </div>
                            <div class="your-order-bottom">
                                <ul>
                                    <li class="your-order-shipping">Shipping</li>
                                    <li class="your-order-shipping-data"></li>
                                </ul>
                            </div>
                            <div class="your-order-total">
                                <ul>
                                    <li class="order-total">Total</li>
                                    <li class="order-total-data"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="payment-method">
                            <p>Please send a check additional information / detail address, store street, store town,
                                store postcode.</p>
                        </div>
                        <div class="Place-order mt-25">
                            <a disabled class="btn-hover"
                                onclick="event.preventDefault(); document.getElementById('checkout-post').submit();"
                                href="#">Place Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scriptsStore')
    <script>
    function selectcityStatus(data){
        var option = $('<option></option>').text(data);
        $(".select-city-data").find('.select2-selection__rendered').empty().append(option);
    }
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $('.js-example-basic-single').on('change', function(e) {
            selectcityStatus('load...');
            $('.select-city').prop("disabled", true);
            $('.city-class-option').val('');
            $.ajax({
                url : "{{url('store/city')}}?q=" + this.value,
                type: "GET",
                dataType:"json",
                success: function(data){
                    $.map(data, function (item) {
                        $('.select-city').append(`
                            <option value='${JSON.stringify(item)}'>${item.city_name}</option>
                        `);
                    })
                    selectcityStatus('Select City');
                    $('.city-class-option').text('Select City');
                    $('.select-city').prop("disabled", false);
                },
                error: function (data, status, err){
                console.log("err city");
                }
            });
        });
        $('.select-city').select2();
        $('.select-city').on('change', function(e) {
            var code = JSON.parse(this.value);
            $('input[name=zip').val(code.postal_code);
            $.ajax({
                url : "{{url('store/cost')}}?q=" + code.city_id,
                type: "GET",
                dataType:"json",
                success: function(data){
                    if(data == 0){
                        $('.order-total-data').html("balance not enagod");
                        return;     
                    }
                    $('.your-order-shipping-data').html(data.cost+' DC');
                    $('.order-total-data').html(data.total+' DC');
                },
                error: function (data, status, err){
                console.log("err cost");
                }
            });
        });
    });
    </script>
    @endsection
    @endsection