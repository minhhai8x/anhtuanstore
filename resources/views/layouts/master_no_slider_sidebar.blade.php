<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="{{ asset('layouts/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('layouts/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('layouts/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('layouts/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('layouts/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('layouts/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('layouts/css/responsive.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
</head><!--/head-->

<body>
    <!--header-->
    @include("layouts.partial.top")

    <!--container-->
    @include('layouts.main_section_container', ['id' => $id])

    @include("layouts.partial.footer")
    <!--/Footer-->

    <script src="{{ asset('layouts/js/jquery.js') }}"></script>
    <script src="{{ asset('layouts/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('layouts/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('layouts/js/price-range.js') }}"></script>
    <script src="{{ asset('layouts/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('layouts/js/main.js') }}"></script>

    @yield('page-js-script')
</body>
</html>
