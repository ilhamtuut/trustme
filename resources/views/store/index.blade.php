@extends('store.components.index')
@section('title', "Store")
@section('pagesStore')
<div class="section ">
    <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
        <div class="swiper-wrapper">
            <div class="hero-slide-item-2 slider-height swiper-slide d-flex bg-color1">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 align-self-center sm-center-view">
                            <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                <span class="category">Sale 45% Off</span>
                                <h2 class="title-1">Exclusive New<br> Offer 2021</h2>
                                <a href="#store-product" class="btn btn-lg btn-primary btn-hover-dark"> Shop
                                    Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div
                            class="col-xl-6 col-lg-7 col-md-7 col-sm-7 d-flex justify-content-center position-relative">
                            <div class="show-case">
                                <div class="hero-slide-image">
                                    <img src="{{asset('assets-store/lbr/images/slider-image/slider-2-1.png')}}"
                                        alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-slide-item-2 slider-height swiper-slide d-flex bg-color2">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 align-self-center sm-center-view">
                            <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                <span class="category">Sale 45% Off</span>
                                <h2 class="title-1">Exclusive New<br> Offer 2021</h2>
                                <a href="#store-product" class="btn btn-lg btn-primary btn-hover-dark"> Shop
                                    Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div
                            class="col-xl-6 col-lg-7 col-md-7 col-sm-7 d-flex justify-content-center position-relative">
                            <div class="show-case">
                                <div class="hero-slide-image">
                                    <img src="{{asset('assets-store/lbr/images/slider-image/slider-2-2.png')}}"
                                        alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination swiper-pagination-white"></div>
        <div class="swiper-buttons">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>
<div class="feature-area  mt-n-65px">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <div class="feature-icon">
                        <img src="{{asset('assets-store/lbr/images/icons/1.png')}}" alt="">
                    </div>
                    <div class="feature-content">
                        <h4 class="title">Free Shipping</h4>
                        <span class="sub-title">Capped at $39 per order</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-md-30px mb-lm-30px mt-lm-30px">
                <div class="single-feature">
                    <div class="feature-icon">
                        <img src="{{asset('assets-store/lbr/images/icons/2.png')}}" alt="">
                    </div>
                    <div class="feature-content">
                        <h4 class="title">Card Payments</h4>
                        <span class="sub-title">12 Months Installments</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <div class="feature-icon">
                        <img src="{{asset('assets-store/lbr/images/icons/3.png')}}" alt="">
                    </div>
                    <div class="feature-content">
                        <h4 class="title">Easy Returns</h4>
                        <span class="sub-title">Shop With Confidence</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pt-100px pb-100px" id="store-product">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-0">
                    <h2 class="title">Products</h2>
                    <div class="nav-center">
                        <ul class="product-tab-nav nav align-items-center justify-content-center">
                            @foreach($categorie as $use)
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                    href="#tab-product--all">{{$use->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="tab-content mb-30px0px">
                    <div class="tab-pane fade show active" id="tab-product--all">
                        <div class="row">
                            @foreach($product as $use)
                            <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                data-aos-delay="200">
                                <div class="product">
                                    <div class="thumb">
                                        <a href="{{url('store/detail')}}?q={{$use->slug}}" class="image">
                                            @foreach($use->image->take(1) as $useImage)
                                            <img src="{{$useImage->path}}" alt="Product" />
                                            @endforeach
                                        </a>
                                        <span class="badges">
                                            <span class="new">Stock: {{$use->stock}}</span>
                                        </span>
                                        <div class="actions">
                                            <a href="#" class="action wishlist"
                                                onclick="event.preventDefault(); document.getElementById('index-wislist-post-{{$use->id}}').submit();"
                                                style="background-color: {{$use->wishlist == '1' ? '#fb5d5d' : '#474747'}};">
                                                <i class="pe-7s-like"></i>
                                                <form id="index-wislist-post-{{$use->id}}" action="{{ url('store/wishlist/post') }}"
                                                    method="POST" style="display: none;">
                                                    <input name="id" value="{{$use->id}}" />
                                                    @csrf
                                                </form>
                                            </a>
                                        </div>
                                            <a href="{{url('store/detail')}}?q={{$use->slug}}" class="add-to-cart">
                                            Detail
                                            </a>
                                    </div>
                                    <div class="content">
                                        <span class="ratings">
                                            <span class="rating-wrap">
                                                <span class="star" style="width: 100%"></span>
                                            </span>
                                            <span class="rating-num">( 5 Review )</span>
                                        </span>
                                        <h5 class="title"><a href="single-product.html">{{$use->name}}
                                            </a>
                                        </h5>
                                        <span class="price">
                                            <span class="new">Rp {{$use->price}}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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