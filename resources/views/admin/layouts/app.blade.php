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
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/styleAdmin.css">
    <link rel="stylesheet" href="/font/css/font-awesome.min.css">
</head>

<body>
    <div id="app">
        <div class="navigation">
            <ul>
                <li>
                    <a class="" href="{{ url('/admin') }}">
                        <span class="icon"> <i class="fa fa-dashboard"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ url('/admin') }}">
                        <span class="icon"> <i class="fa fa-dashboard"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ url('/admin/product') }}">
                        <span class="icon"> <i class="fa fa-archive"></i></span>
                        <span class="title">Product</span>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ url('/admin/user') }}">
                        <span class="icon"><i class="fa fa-group"></i></span>
                        <span class="title">User</span>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ url('/admin/order') }}">
                        <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                        <span class="title">Order</span>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ url('/admin/pesan') }}">
                        <span class="icon"><i class="fa fa-inbox"></i></span>
                        <span class="title">Messagge</span>
                    </a>
                </li>
                <li>
                    <a class="" href="#">
                        <span class="icon"><i class="fa fa-cogs"></i></span>
                        <span class="title">Set Carousel</span>
                    </a>
                </li>
            </ul>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Keuangan <i class="fa fa-line-chart"></i></a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action <i class="fa fa-"></i></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link <i class="fa fa-"></i></a>
                </div>
            </li> -->
        </div>
        <!-- Topbar -->
        <div id="nav-admin">
            <div class="topbar">
                <div class="toggle"><i class="fa fa-bars"></i></div>
                <div class="search">
                    <label for="">
                        <input type="text" placeholder="Search here">
                        <i class="fa fa-search"></i>
                    </label>
                </div>
                <ul class="navbar-nav" style="font-weight: bold;">
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
                            <a class="dropdown-item" href="{{ url('/') }}">
                                Winih
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

    </div>
    <div id="wrapper">
        <div class="container-fluid">
            <main class="admin">
                @yield('container')
            </main>
        </div>
    </div>
    <script>
        // Toggle
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let bar = document.querySelector('#nav-admin');
        let content = document.querySelector('#wrapper');

        toggle.onclick = function() {
            navigation.classList.toggle('active');
            bar.classList.toggle('active');
            content.classList.toggle('active');
        }

        // add_class_active
        let list = document.querySelectorAll('.navigation li');

        function activeLink() {
            list.forEach((item) =>
                item.classList.remove('hovered'));
            this.classList.add('hovered');
        }
        list.forEach((item) =>
            item.addEventListener('mouseover', activeLink));
    </script>
</body>

</html>