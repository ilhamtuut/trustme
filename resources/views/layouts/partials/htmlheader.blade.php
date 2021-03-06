<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="{{ config('app.name') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}?v={{time()}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{asset('dist/assets/plugins/global/plugins.bundle.css')}}?v={{time()}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dist/assets/plugins/custom/prismjs/prismjs.bundle.css')}}?v={{time()}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dist/assets/css/style.bundle.css')}}?v={{time()}}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{asset('dist/assets/css/themes/layout/header/base/dark.css')}}?v={{time()}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dist/assets/css/themes/layout/header/menu/dark.css')}}?v={{time()}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dist/assets/css/themes/layout/brand/dark.css')}}?v={{time()}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dist/assets/css/themes/layout/aside/dark.css')}}?v={{time()}}" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{asset('images/trust-icon.png')}}" />
</head>
