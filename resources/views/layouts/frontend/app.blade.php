<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('tittle'){{ config('app.name', 'Laravel') }}</title>

    <!-- Font -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

    <!-- Stylesheets -->

    <link href="{{asset('public/assets/frontend')}}/common-css/bootstrap.css" rel="stylesheet">

    <link href="{{asset('public/assets/frontend')}}/common-css/swiper.css" rel="stylesheet">

    <link href="{{asset('public/assets/frontend')}}/common-css/ionicons.css" rel="stylesheet">


    @stack('css')

</head>
<body>
@include('layouts.frontend.partial.header')

@yield('content')


@include('layouts.frontend.partial.footer')


<!-- SCIPTS -->

<script src="{{asset('public/assets/frontend')}}/common-js/jquery-3.1.1.min.js"></script>

<script src="{{asset('public/assets/frontend')}}/common-js/tether.min.js"></script>

<script src="{{asset('public/assets/frontend')}}/common-js/bootstrap.js"></script>

<script src="{{asset('public/assets/frontend')}}/common-js/swiper.js"></script>

<script src="{{asset('public/assets/frontend')}}/common-js/scripts.js"></script>
</body>
</html>

