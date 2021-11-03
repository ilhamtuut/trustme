@extends('store.components.index')
@section('title', 'Wish List')
@section('pagesStore')
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h3 class="cart-page-title">Your wishlist items</h3>
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
                                <th>Add To Cart</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wishlist as $use)
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
                                <form id="index-wislist-post-{{$use->product->id}}"
                                    action="{{ url('store/cart/post') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$use->product->id}}" />
                                    <input type="hidden" name="status" value="wishlist" />
                                    <td class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qty" value="1" />
                                        </div>
                                    </td>
                                    <td class="product-wishlist-cart">
                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('index-wislist-post-{{$use->product->id}}').submit();">add
                                            to cart</a>
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scriptsStore')
@endsection
@endsection