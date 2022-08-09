@extends('admin.layouts.app')
@section('title', 'Detail User')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/order') }}">Order</a>
                </li>
                <li class="breadcrumb-item active">
                    Details Order
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="col-sm-3 offset-sm-4">
        <h3><u>Detail order</u></h3>
    </div>
    <div class="row mt-3 mb-3">
        <div class="col-sm-4">
            <img src="{{ $product->takeImage }}" style="width: 350px;height: 370px;" alt="">
        </div>
        <div class="col-sm-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Produk : {{ $product->name_product }}</li>
                <li class="list-group-item">Harga satuan : @currency($order->price)</li>
                <li class="list-group-item">Unit Barang : {{ $order->total }} unit</li>
                <li class="list-group-item">Nama Penerima : {{ $order->receiver }}</li>
                <li class="list-group-item">Alamat Penerima : {{ $order->alamat }}, {{ $city->city_name }}</li>
                <li class="list-group-item">Telefon Penerima : {{ $order->phone }}</li>
            </ul>
        </div>
        <div class="col-sm-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Total Harga : @currency($order->price*$order->total)</li>
                <li class="list-group-item ">Kurir : <span class="text-uppercase">{{ $order->courier }}</span></li>
                <li class="list-group-item">Paket : {{ $order->paket }}</li>
                <li class="list-group-item">Berat : {{ $order->berat }}g</li>
                <li class="list-group-item">Ongkos Kirim : @currency($order->ongkir)</li>
                <li class="list-group-item">Total Bayar : @currency($order->total_price)</li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="col-sm-3 offset-sm-4 mt-3">
        <h3><u>Detail Pemesan</u></h3>
    </div>
    <div class="row mt-3">
        <div class="col-sm-4">
            <img src="{{ $user->takeImage }}" style="height: 370px;width:350px;" alt="">
        </div>
        <div class="col-sm-8">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Nama : {{ $user->name }}</li>
                <li class="list-group-item">Username : {{ $user->username }}</li>
                <li class="list-group-item">Email : {{ $user->email  }}</li>
                <li class="list-group-item">Telefon Pemesan : {{ $user->phone }}</li>
                <li class="list-group-item">Alamat Pemesan : {{ $user->address }}</li>
            </ul>
        </div>
    </div>
</div>
@endSection