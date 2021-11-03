<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ config('app.name') }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <link href="{{asset('dist/assets/css/pages/login/classic/login-4.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('dist/assets/plugins/global/plugins.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('dist/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('dist/assets/css/style.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('dist/assets/css/themes/layout/header/base/light.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('dist/assets/css/themes/layout/header/menu/light.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('dist/assets/css/themes/layout/brand/dark.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('dist/assets/css/themes/layout/aside/dark.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{asset('images/dcoin.png')}}" />
    </head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <div class="d-flex flex-column flex-root">
            <div class="flex-row-fluid flex-column bgi-size-cover bgi-position-center bgi-no-repeat p-10 p-sm-30" style="background-image: url('{{asset('dist/assets/media/bg/bg-11.jpg')}}');">
                <h1 class="font-weight-boldest text-danger mt-15" style="font-size: 10rem">@yield('code')</h1>
                <p class="font-size-h1 text-white font-weight-normal">OOPS! @yield('message')</p>
                @yield('action')
            </div>
        </div>
        <script src="{{asset('dist/assets/plugins/global/plugins.bundle.js?v=7.0.5')}}"></script>
        <script src="{{asset('dist/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5')}}"></script>
    </body>
</html>


