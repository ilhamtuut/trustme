@extends('store.components.index')
@section('title', 'Order items')
@section('pagesStore')
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h3 class="cart-page-title">Your Order items</h3>
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
                                <th>Cost</th>
                                <th>Subtotal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $use)
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
                                <td class="product-price-cart"><span class="amount">Rp{{$use->cost}}</span>
                                </td>
                                <td class="product-price-cart"><span class="amount">Rp{{$use->total + $use->cost}}</span>
                                </td>
                                <td class="product-price-cart"><span class="amount">{{$use->status}}</span>
                                </td>
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