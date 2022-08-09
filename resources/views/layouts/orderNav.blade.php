<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/font/css/font-awesome.min.css">
</head>

<body>
    <div id="app">
        <div id="nav-top">
            <nav class="navbar navbar-expand-md navbar-light shadow-sm fixed-top">
                <div class="container-fluid">
                    <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Winih') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                    <div class="guest mr-auto">
                        <a href="/myaccount" class="btn btn-success text-white">
                            Welcome : @guest @if (Route::has('register')) Guest @endif @else {{ Auth::user()->name }} @endguest
                        </a>
                        @guest @if (Route::has('register'))
                        <p class="d-inline">0 items in your cart</p>
                        @endif @else
                        <p class="d-inline">{{ Auth::user()->cart->collect()->count() }} items in your cart</p>
                        @endguest
                    </div>

                    <div class="navbar-nav" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <!-- <ul class="navbar-nav mr-auto"> -->

                        <!-- </ul> -->

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    @can('admin-user')
                                    <a class="dropdown-item" href="{{ url('/admin') }}">
                                        Admin
                                    </a>
                                    @endcan
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        @include('layouts.navigation')
        <main class="py-4">
            <div id="nav-order">
                <div class="container-fluid">
                    <div class="text-center">
                        <h3><strong>@yield('judul')</strong></h3>
                    </div>
                    <div class="card text-center">
                        <div class="card-header">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item{{ request()->is('/myorders') ? ' active' : '' }}">
                                    <a class="nav-link " href="{{ url('/myorders') }}">Orderan saya</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('/myorders/paid') ? ' active' : '' }}" href="/myorders/paid">Orderan dibayar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('/myorders/packing') ? ' active' : '' }} " href="/myorders/packing">Orderan dikemas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('/myorders/deliver') ? ' active' : '' }}" href="/myorders/deliver">Orderan dikirim</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('/myorders/success') ? ' active' : '' }}" href="/myorders/success">Orderan sukses</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            @yield('orders')
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('layouts.footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('select[name="province_to"]').on('change', function() {
                var cityId = $(this).val();
                if (cityId) {
                    $.ajax({
                        url: '/cart/getData/' + cityId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="destination"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="destination"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="destination"]').empty();
                }
            });
            $('select[name="courier"]').on('change', function() {
                var cityId = $(this).val();
                if (cityId) {
                    $.ajax({
                        url: '/cart/getPaket/' + cityId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="paket"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="paket"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="paket"]').empty();
                }
            });
        });
    </script>


</body>

</html>