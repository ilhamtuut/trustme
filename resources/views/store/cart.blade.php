@extends('store.components.index')
@section('title', 'Cart')
@section('pagesStore')
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h3 class="cart-page-title">Your Cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-content table-responsive cart-table-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Until Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $use)
                            <tr>
                                <td class="product-thumbnail">
                                    @foreach($use->product->image->take(1) as $useWislistProduct)
                                    <a href="{{url('store/detail')}}?q={{$use->product->slug}}">
                                        <img src="{{$useWislistProduct->path}}" alt="Wishlist"
                                            class="img-responsive ml-15px img-fluid" />
                                    </a>
                                    @endforeach
                                </td>
                                <td class="product-name"><a href="#">{{$use->product->name}}</a></td>
                                <td class="product-price-cart"><span class="amount">Rp{{$use->product->price}}</span>
                                </td>
                                <td class="product-price-cart"><span class="amount">{{$use->qty}}</span>
                                </td>
                                <td class="product-price-cart"><span class="amount">Rp{{$use->total}}</span>
                                </td>
                                <form id="index-cart-post-{{$use->product->id}}" action="{{ url('store/cart/post') }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$use->product->id}}" />
                                    <input type="hidden" name="status" value="remove" />
                                    <td class="product-remove">
                                        <a href="#" href="#"
                                            onclick="event.preventDefault(); document.getElementById('index-cart-post-{{$use->product->id}}').submit();"><i
                                                class="fa fa-times"></i></a>

                                    </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-shiping-update-wrapper d-flex justify-content-end">
                            <div class="cart-clear">
                                <a href="{{url('store/checkout')}}">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scriptsStore')
@endsection
@endsection