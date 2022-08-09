@extends('layouts.app')
@section('title', 'Winih Q')

@section('content')
<!-- Carousel -->
<div class="container">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="image/1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="image/2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="image/3.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<!-- Product? -->
<div id="page-product">
    <div class="container-fluid">
        <div class="justify-content-center">
            <div class="col-4 offset-md-4">
                <div class="card card-page text-center">
                    <p>Our Latest Product</p>
                </div>
            </div>
        </div>
        <div class="row card-product">
            @foreach($product as $p)
            <div class="col-sm-2">
                <div class="card mb-3">
                    <img class="card-img-top" src="{{ $p->takeImage }}" alt="Card image cap">
                    <div class="card-body text-center">
                        <h6 class="card-title">{{ $p->name_product }}</h6>
                        <p class="card-text"><small class="text-muted">@currency($p->price_sell)</small></p>
                        <div class="row justify-content-center">
                            @guest @if(Route::has('register'))
                            <a href="{{ route('login') }}" class="btn btn-info">Add to cart</a>
                            @endif @else
                            @auth
                            <form action="/cart/add_cart" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $p->id }}">
                                <input type="hidden" name="name_product" value="{{ $p->name_product }}">
                                <input type="hidden" name="image" value="{{ $p->takeImage }}">
                                <input type="hidden" name="total" value="1">
                                <input type="hidden" name="price" value="{{ $p->price_sell }}">
                                <button type="submit" class="btn btn-info">Add to cart</button>
                                @endguest
                                @endauth
                                <a href="/{{ $p->slug }}" class="btn btn-default d-inline" style="width: 100px;">Detail</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endSection