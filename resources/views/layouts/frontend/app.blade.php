<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('tittle'){{ config('app.name', 'Laravel') }}</title>

   
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('public/assets/frontend') }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/frontend') }}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/frontend') }}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/frontend') }}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/frontend') }}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/frontend') }}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/frontend') }}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/frontend') }}/css/style.css" type="text/css">


    @stack('css')

</head>
<body>

    @include('layouts.frontend.partial.header')

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            <li><a href="#">Fresh Meat</a></li>
                            <li><a href="#">Vegetables</a></li>
                            <li><a href="#">Fruit & Nut Gifts</a></li>
                            <li><a href="#">Fresh Berries</a></li>
                            <li><a href="#">Ocean Foods</a></li>
                            <li><a href="#">Butter & Eggs</a></li>
                            <li><a href="#">Fastfood</a></li>
                            <li><a href="#">Fresh Onion</a></li>
                            <li><a href="#">Papayaya & Crisps</a></li>
                            <li><a href="#">Oatmeal</a></li>
                            <li><a href="#">Fresh Bananas</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>


    @yield('content')

@include('layouts.frontend.partial.footer')


<!-- SCIPTS -->
   <script src="{{ asset('public/assets/frontend') }}/js/jquery-3.3.1.min.js"></script>
   <script src="{{ asset('public/assets/frontend') }}/js/bootstrap.min.js"></script>
   <script src="{{ asset('public/assets/frontend') }}/js/jquery.nice-select.min.js"></script>
   <script src="{{ asset('public/assets/frontend') }}/js/jquery-ui.min.js"></script>
   <script src="{{ asset('public/assets/frontend') }}/js/jquery.slicknav.js"></script>
   <script src="{{ asset('public/assets/frontend') }}/js/mixitup.min.js"></script>
   <script src="{{ asset('public/assets/frontend') }}/js/owl.carousel.min.js"></script>
   <script src="{{ asset('public/assets/frontend') }}/js/main.js"></script>

   @stack('js')
</body>
</html>

