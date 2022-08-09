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
                    Shoping Cart
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <!-- <form action="/myorders/add_order" method="POST" enctype="multipart/form-data"> -->
            <form action="/cart/{{$cart->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $cart->image }}" style="width: 300px;">
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3><strong><u>Detail Product</u></strong></h3>
                            </div>
                        </div>
                        <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                        <input type="hidden" name="user_id" value="{{ $cart->user_id }}">
                        <input type="hidden" name="image" value="{{ $cart->image }}">
                        <input type="hidden" name="paket" value="">
                        <input type="hidden" name="ongkir">
                        <div class="form-group row">
                            <label for="product_id" class="col-sm-3 col-form-label">Product ID</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="product_id" name="product_id" value="{{ $cart->product_id }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name_product" class="col-sm-3 col-form-label">Name Product</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="name_product" name="product_name" value="{{ $cart->name_product }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total" class="col-sm-3 col-form-label">Total Product</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="total" name="total" value="{{ $cart->total }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">Price Product</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="price" name="price" value="{{ $cart->price }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total_price" class="col-sm-3 col-form-label">Total Price</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="total_price" name="total_price" value="{{ $cart->price*$cart->total }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3><strong><u>Setting Order</u></strong></h3>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <h6>Nama Penerima</h6>
                                <input type="text" name="receiver" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <h6>Nomor dapat dihubungi</h6>
                                <input type="text" name="phone" class="form-control">
                            </div>
                        </div>
                        <h6>Kirim ke</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select name="province_to" class="form-control">
                                        <option value="" holder selected>-- Pilih Provinsi --</option>
                                        @foreach($province as $prov)
                                        <option value="{{$prov->id}}">{{$prov->province}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select name="destination" class="form-control">
                                        <option value="{{'province_id'}}" holder selected>-- Pilih Kota --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <textarea name="alamat" class="form-control" placeholder="Alamat lengkap(Kecamatan/RT/RW/Jalan) "></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <h6>Berat Paket</h6>
                                <input type="text" name="weight" class="form-control">
                                <small>*Dalam satuan gram(1700/1,7Kg)</small>
                            </div>
                            <div class="col-sm-6">
                                <h6>Pilih Kurir</h6>
                                <select name="courier" class="form-control">
                                    <option value="{{'province_id'}}" holder selected>-- Pilih Kurir --</option>
                                    @foreach($couriers as $courier)
                                    <option value="{{$courier->code}}">{{$courier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block">Cek Ongkos Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endSection