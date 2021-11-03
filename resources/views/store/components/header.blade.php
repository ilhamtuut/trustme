<div class="alert-store"></div>
<header>
        <div class="header-main sticky-nav ">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-auto align-self-center">
                        <div class="header-logo">
                            <a href="{{url('store')}}"><img class="logo-header" src="{{asset('images/dcoin.png')}}" alt="Site Logo" /></a>
                        </div>
                    </div>
                    <div class="space-header col align-self-center d-none d-lg-block">
                    </div>
                    <div class="col col-lg-auto align-self-center pl-0">
                        <div class="header-actions">
                            @if(Auth::check())
                            <a href="{{url('/home')}}" class="header-action-btn login-btn">Dashboard</a>
                            <a href="{{url('store/checkout-list')}}" class="header-action-btn login-btn">Orders</a>
                            @else
                            <a href="{{url('/login')}}" class="header-action-btn login-btn">Sign In</a>   
                            @endif
                            <a href="#" class="header-action-btn" data-bs-toggle="modal" data-bs-target="#searchActive">
                                <i class="pe-7s-search"></i>
                            </a>
                            @if(Auth::check())
                            <a href="#offcanvas-wishlist" class="header-action-btn offcanvas-toggle">
                                <i class="pe-7s-like"></i>
                            </a>
                            <a href="#offcanvas-cart"
                                class="header-action-btn header-action-btn-cart offcanvas-toggle pr-0">
                                <i class="pe-7s-shopbag"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </header>