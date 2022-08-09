<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <h4>Pages</h4>
                <ul>
                    <li><a href="/cart">Shopping Cart</a></li>
                    <li><a href="/about">Contact Us</a></li>
                    <li><a href="/poduct">Product</a></li>
                    <li><a href="/myaccount">My Account</a></li>
                </ul>
                <hr>
                <h4>User Section</h4>
                <ul>
                    @guest
                    <li>
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li>
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li>
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="/myaccount">@if (Route::has('register')) Profile @endif</a>
                    </li>
                    @endguest
                </ul>
                <hr class="hidden-md hidden-lg hidden-sm">

            </div>
            <div class="col-sm-6 col-md-3">
                <h4>Top Products Categories</h4>
                <form action="{{ route('search.pupuk') }}" method="GET">
                    <div class="category">
                        <input type="hidden" name="pupuk" value="1">
                        <button type="submit" class="btn btn-link categoty">Pupuk</button>
                    </div>
                </form>
                <form action="{{ route('search.benih') }}" method="GET">
                    <div class="category">
                        <input type="hidden" name="benih" value="2">
                        <button type="submit" class="btn btn-link categoty">Benih</button>
                    </div>
                </form>
                <form action="{{ route('search.peralatan') }}" method="GET">
                    <div class="category">
                        <input type="hidden" name="peralatan" value="3">
                        <button type="submit" class="btn btn-link categoty">Peralatan</button>
                    </div>
                </form>
                <hr class="hidden-md hidden-lg">
            </div>


            <div class="col-sm-6 col-md-3">
                <h4>Find Us :</h4>
                <p>
                    <strong>Winih Q inc.</strong>
                    <br />Wangon
                    <br />Banyumas
                    <br />0821-5840-9257
                    <br />anuapayah1@gmail.com
                    <br /><strong>Ond-Tha</strong>
                </p>
                <a href="/about">Check Our Contact Page</a>
                <hr class="hidden-md hidden-lg">
            </div>

            <div class="col-sm-6 col-md-3">
                <h4>Get The News</h4>
                <p class="text-muted">
                    Don't miss our latest update product.
                </p>
                <form action="" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="email">
                        <span class="input-group-btn">
                            <input type="submit" value="subscribe" class="btn btn-default">
                        </span>
                    </div>
                </form>
                <hr>
                <h4>Keep In Touch</h4>
                <p class="social">
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-instagram"></a>
                    <a href="#" class="fa fa-google-plus"></a>
                    <a href="#" class="fa fa-envelope"></a>
                </p>
            </div>

        </div>
    </div>
</footer>
<div id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; 2020 Winih Q All Rights Reserve</p>
            </div>
            <div class="col-md-6">
                <p class="text-right">Theme by : Ond-Tha</p>
            </div>
        </div>
    </div>
</div>