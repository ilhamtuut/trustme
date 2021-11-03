<div class="offcanvas-overlay"></div>
<div id="offcanvas-wishlist" class="offcanvas offcanvas-wishlist">
    <div class="inner">
        <div class="head">
            <span class="title">Wishlist</span>
            <button class="offcanvas-close">×</button>
        </div>
        <div class="body customScroll">
            <ul class="minicart-product-list">
                @foreach($productWislist as $useWislist)
                <li>
                    <a href="{{url('store/detail')}}?q={{$useWislist->product->slug}}" class="image">
                        @foreach($useWislist->product->image->take(1) as $useWislistProduct)
                        <img src="{{$useWislistProduct->path}}" alt="Product" class="img-fluid" />
                        @endforeach
                    </a>
                    <div class="content">
                        <a href="{{url('store/detail')}}?q={{$useWislist->product->slug}}" class="title">{{$useWislist->product->name}}</a>
                        <span class="quantity-price"><span class="amount">Rp
                                {{$useWislist->product->price}}</span></span>
                        <a href="#" class="remove"
                            onclick="event.preventDefault(); document.getElementById('right-wislist-post-{{$useWislist->product->id}}').submit();">
                            <form id="right-wislist-post-{{$useWislist->product->id}}"
                                action="{{ url('store/wishlist/post') }}" method="POST" style="display: none;">
                                <input name="id" value="{{$useWislist->product->id}}" />
                                @csrf
                            </form>
                            ×
                        </a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="foot">
            <div class="buttons">
                <a href="{{url('store/wishlist')}}" class="btn btn-dark btn-hover-primary mt-30px">view wishlist</a>
            </div>
        </div>
    </div>
</div>
<div id="offcanvas-cart" class="offcanvas offcanvas-cart">
    <div class="inner">
        <div class="head">
            <span class="title">Cart</span>
            <button class="offcanvas-close">×</button>
        </div>
        <div class="body customScroll">
            <ul class="minicart-product-list">
                @foreach($productCart as $useCart)
                <li>
                    <a href="{{url('store/detail')}}?q={{$useCart->product->slug}}" class="image">
                        @foreach($useCart->product->image->take(1) as $useCartProduct)
                        <img src="{{$useCartProduct->path}}" alt="Product" class="img-fluid" />
                        @endforeach
                    </a>
                    <div class="content">
                        <a href="{{url('store/detail')}}?q={{$useCart->product->slug}}" class="title">{{$useCart->product->name}}</a>
                                <span class="quantity-price">{{$useCart->qty}} x <span class="amount">Rp{{$useCart->product->price}}</span></span>
                        <a href="#" class="remove"
                            onclick="event.preventDefault(); document.getElementById('right-cart-post-{{$useCart->product->id}}').submit();">
                            <form id="right-cart-post-{{$useCart->product->id}}"
                                action="{{ url('store/cart/post') }}" method="POST" style="display: none;">
                                <input name="id" value="{{$useCart->product->id}}" />
                                <input name="status" value="remove" />
                                @csrf
                            </form>
                            ×
                        </a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="foot">
            <div class="buttons mt-30px">
                <a href="{{url('store/cart')}}" class="btn btn-dark btn-hover-primary mb-30px">view cart</a>
                <a href="{{url('store/checkout')}}" class="btn btn-outline-dark current-btn">checkout</a>
            </div>
        </div>
    </div>
</div>