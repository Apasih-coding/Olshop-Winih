@extends('admin.layouts.app')
@section('title', 'Detail Product')

@section('container')
@if(session()->has('success'))
<div class="container">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('success') }}</strong> You can check in <strong><a href="{{ url('/product') }}">Product page.</a></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    Product
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container py-3">
    <div class="justify-content-between">
        <h3>Detail {{$product->name_product}}</h3>
        <form action="/product/{{ $product->slug }}/delete" method="POST">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
        </form>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col mb-6">
                        <div class="card">
                            <img src="{{ $product->takeImage }}" style="height: 200px;">
                        </div>
                    </div>
                    <div class="col mb-6">
                        <div class="card">
                            <img src="{{ $product->takeImage2 }}" style="height: 200px;">
                        </div>
                    </div>
                    <div class="col mb-6">
                        <div class="card">
                            <img src="{{ $product->takeImage3 }}" style="height: 200px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name_product }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $product->category->name }}</h6>
                    <p>Total Stok : {{ $product->total }}</p>
                    <p>Harga Beli : {{ $product->price_buy }}</p>
                    <p>Harga Jual : {{ $product->price_sell }}</p>
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Deskripsi :</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" readonly>{{ $product->desc }}</textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection