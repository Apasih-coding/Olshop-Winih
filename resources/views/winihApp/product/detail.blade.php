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
                <div class="col-md-6">
                    <div class="card">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ $product->takeImage }}" class="d-block w-100" alt="/img/logo.png">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ $product->takeImage2 }}" class="d-block w-100" alt="/img/logo.png">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ $product->takeImage3 }}" class="d-block w-100" alt="/img/logo.png">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="title">
                                <h1>{{$product->name_product}}</h1>
                            </div>
                            <div class="price">
                                <p>@currency($product->price_sell)</p>
                            </div>
                            <form action="/cart/add_cart" method="POST" class="mt-5">
                                @csrf
                                <div class="form-group row">
                                    <label for="total" class="col-sm-4 col-form-label">Total Produk :</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="total" name="total" required>
                                    </div>
                                </div>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="name_product" value="{{ $product->name_product }}">
                                <input type="hidden" name="image" value="{{ $product->takeImage }}">
                                <input type="hidden" name="price" value="{{ $product->price_sell }}">
                                <!-- <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label text-left">Unit :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="unit">
                                            <option>PCS</option>
                                            <option>PACK</option>
                                            <option>LUSIN</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="offset-md-3 col-md-6">
                                    @guest @if(Route::has('register'))
                                    <a href="{{ route('login') }}" class="btn btn-info">Add to cart</a>
                                    @endif @else
                                    <button type="submit" name="submit" class="btn btn-primary">Add to cart</button>
                                    @endguest
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid prod-detail">
    <div class="offset-md-3 col-md-9">
        <div class="card">
            <div class="card-body">
                <h1>{{ $product->name_product }}</h1>
                <p class="price">{{ $product->price }}</p>
                <p>{{ $product->desc }}</p>
            </div>
        </div>
    </div>
</div>

@endSection