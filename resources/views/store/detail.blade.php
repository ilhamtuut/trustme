@extends('store.components.index')
@section('title', $product->name)
@section('pagesStore')
<div class="product-details-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                <div class="swiper-container zoom-top">
                    <div class="swiper-wrapper">
                        @foreach($product->image as $use)
                        <div class="swiper-slide">
                            <img class="img-responsive m-auto" src="{{$use->path}}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-container zoom-thumbs mt-3 mb-3">
                    <div class="swiper-wrapper">
                        @foreach($product->image as $use)
                        <div class="swiper-slide">
                            <img class="img-responsive m-auto" src="{{$use->path}}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                <div class="product-details-content quickview-content">
                    <h2>{{$product->name}}</h2>
                    <div class="pricing-meta">
                        <ul>
                            <li class="old-price not-cut">Rp {{$product->price}}</li>
                        </ul>
                    </div>
                    <div class="pro-details-rating-wrap">
                        <div class="rating-product">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <span class="read-review"><a class="reviews" href="#">( 5 Customer Review )</a></span>
                    </div>
                    <form action="{{ url('store/cart/post') }}" method="POST">
                        @csrf
                        <div class="pro-details-quality">
                            <input type="hidden" name="id" value="{{$product->id}}" />
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="qty" value="1" />
                            </div>
                            <div class="pro-details-cart">
                                <button class="add-cart" type="submit"> Add To
                                    Cart</button>
                            </div>
                    </form>
                    <div class="pro-details-compare-wishlist pro-details-wishlist ">
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('detail-wislist-post').submit();"
                            style="background-color: {{$product->wishlist == '1' ? '#fb5d5d' : '#474747'}};">
                            <i class="pe-7s-like"></i></span>
                            <form id="detail-wislist-post" action="{{ url('store/wishlist/post') }}" method="POST"
                                style="display: none;">
                                <input name="id" value="{{$product->id}}" />
                                @csrf
                            </form>
                        </a>
                    </div>
                </div>
                <div class="pro-details-sku-info pro-details-same-style  d-flex">
                    <span>STOCK: </span>
                    <ul class="d-flex">
                        <li>
                            <span class="text-muted">{{$product->stock}}</span>
                        </li>
                    </ul>
                </div>
                <div class="pro-details-categories-info pro-details-same-style d-flex">
                    <span>Categories: {{$product->categorie->name}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav">
                <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                <a data-bs-toggle="tab" href="#des-details3">Reviews (02)</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p>
                            {{$product->description}}

                        </p>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="review-wrapper">
                                <div class="single-review">
                                    <div class="review-img">
                                        <img src="assets/images/review-image/1.png" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
                                                </div>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="review-left">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>
                                                Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Suspendisse viverra ed viverra. Mauris ullarper
                                                euismod vehicula. Phasellus quam nisi, congue id nulla.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-review child-review">
                                    <div class="review-img">
                                        <img src="assets/images/review-image/2.png" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
                                                </div>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="review-left">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Sus pen disse viverra ed viverra. Mauris ullarper
                                                euismod vehicula.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="ratting-form-wrapper pl-50">
                                <h3>Add a Review</h3>
                                <div class="ratting-form">
                                    <form action="#">
                                        <div class="star-box">
                                            <span>Your rating:</span>
                                            <div class="rating-product">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="rating-form-style">
                                                    <input placeholder="Name" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="rating-form-style">
                                                    <input placeholder="Email" type="email" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="Your Review" placeholder="Message"></textarea>
                                                    <button class="btn btn-primary btn-hover-color-primary "
                                                        type="submit" value="Submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="related-product-area pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30px0px line-height-1">
                    <h2 class="title m-0">Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="tab-content mb-30px0px">
                    <div class="tab-pane fade show active" id="tab-product--all">
                        <div class="row">
                            @foreach($related as $use)
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
                                                onclick="event.preventDefault(); document.getElementById('index-detail-post-{{$use->id}}').submit();"
                                                style="background-color: {{$use->wishlist == '1' ? '#fb5d5d' : '#474747'}};">
                                                <i class="pe-7s-like"></i>
                                                <form id="index-detail-post-{{$use->id}}" action="{{ url('store/wishlist/post') }}"
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
                                            <span class="new">Rp{{$use->price}}</span>
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