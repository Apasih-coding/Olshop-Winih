@extends('layouts.app')
@section('title', 'Products Winih Q')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    Products
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div id="product-category" class="card mb-4">
                <div class="card-header text-center">
                    Product Category
                </div>
                @include('layouts.form-PupukCategory')
            </div>
            <div id="product-category" class="card mb-4">
                <div class="card-header text-center">
                    Benih Category
                </div>
                @include('layouts.form-BenihCategory')
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                @foreach($product as $p)
                <div class="col-sm-3 mb-4">
                    <div class="card text-center">
                        <img src="{{ $p->takeImage }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6 class="card-title">{{ $p->name_product }}</h6>
                            <p class="card-text">@currency($p->price_sell)</p>
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
                                <a href="/{{ $p->slug }}" class="btn btn-secondary d-inline" style="width: 100px;">Detail</a>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $product->links() }}
            </div>
        </div>
    </div>
</div>
@endSection