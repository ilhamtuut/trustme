<head>
    <meta name="keywords" content="{{config('app.name')}},@yield('title')">
    <meta name="description" content="{{config('app.name')}},@yield('title')">
    <meta name="author" content="{{config('app.name')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(Request::path() == '/')
    <title>{{config('app.name')}}</title>
    @else
    <title>{{config('app.name')}} - @yield('title')</title>
    @endif
    <link rel="shortcut icon" href="{{asset('assets-store/lbr/images/favicon/favicon.ico')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('assets-store/lbr/css/vendor/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets-store/lbr/css/vendor/pe-icon-7-stroke.css')}}" />
    <link rel="stylesheet" href="{{asset('assets-store/lbr/css/vendor/font.awesome.css')}}" />
    <link rel="stylesheet" href="{{asset('assets-store/lbr/css/plugins/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('assets-store/lbr/css/plugins/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets-store/lbr/css/plugins/jquery-ui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets-store/lbr/css/plugins/nice-select.css')}}" />
    <link rel="stylesheet" href="{{asset('assets-store/lbr/css/plugins/venobox.css')}}" />
    <link rel="stylesheet" href="{{asset('assets-store/lbr/css/plugins/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets-store/lbr/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('assets-store/main.css')}}" />
</head>