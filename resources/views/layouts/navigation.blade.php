<div id="navigate">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="/image/logo.png">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-menu" aria-controls="nav-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav-menu">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item{{ request()->is('/') ? ' active' : '' }}">
                        <a class="nav-link" href="{{ url('/') }}">Home </a>
                    </li>
                    <li class="nav-item{{ request()->is('product') ? ' active' : '' }}">
                        <a class="nav-link" href="{{ url('/product') }}">Product</a>
                    </li>
                    <li class="nav-item{{ request()->is('cart') ? ' active' : '' }}">
                        <a class="nav-link" href="{{ url('/cart') }}">Shoping Cart</a>
                    </li>
                    <li class="nav-item{{ request()->is('about') ? ' active' : '' }}">
                        <a class="nav-link" href="{{ url('/about') }}">About Us</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="GET" action="search">
                    <input class="form-control" type="search" name="search" placeholder="Search">
                    <button class="btn btn-outline my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </div>
</div>