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
            <form action="">
                <div class="row">
                    <div class="col-sm-4">
                        <h5><u>Product</u></h5>
                        <div class="form-group row">
                            <label for="user" class="col-sm-4 col-form-label">Name Pemesan:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="user" name="user" value="@if (Route::has('register')){{ Auth::user()->name }}@endif">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="product_name" class="col-sm-4 col-form-label">Name Product:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="product_name" name="product_name" value="{{ $data['product_name'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Total Product:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="total" name="total" value="{{ $cart->total }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-4 col-form-label">Price Product:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="price" name="price" value="{{ $cart->price }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total_harga" class="col-sm-4 col-form-label">Total Price:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="total_harga" name="total_harga" value="{{ $cart->price*$cart->total }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h5><u>Penerima</u></h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="receiver" class="col-sm-4 col-form-label">Nama Penerima:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="receiver" name="receiver" value="{{ $data['receiver'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-4 col-form-label">Kontak Penerima:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="phone" name="phone" value="{{ $data['phone'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="city_id" class="col-sm-4 col-form-label">Kota / Kabupaten:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="city_id" name="city_id" value="{{ $city }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-4 col-form-label">Alamat Penerima:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="alamat" name="alamat" value="{{ $data['alamat'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="courier" class="col-sm-4 col-form-label">Ekspedisi:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="courier" name="courier" value="{{ $data['courier'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="berat" class="col-sm-4 col-form-label">Berat Barang:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="berat" name="berat" value="{{ $data['weight'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#Kurir">
                        Ganti kurir {{ $data['courier'] }}
                    </button>
                    <div class="modal fade" id="Kurir" tabindex="-1" role="dialog" aria-labelledby="KurirTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Pilih kuir</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach($couriers as $courier)
                                    <form action="/myorders/{{ $cart->id }}/change_ongkir" method="POST" enctype="multipart/form-data">
                                        @method('patch')
                                        @csrf
                                        <input type="hidden" name="service" value="{{ $courier->code }}">
                                        <button type="submit" class="btn btn-info btn-block mb-3">{{ $courier->name }}</button>

                                    </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Paket</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Estimasi</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kurir as $k)
                            <tr>
                                <td>{{$k['service']}}</td>
                                <td>{{$k['description']}}</td>
                                <td>
                                    <input type="hidden" name="ongkir" value="{{$k['cost'][0]['value']}}">
                                    {{$k['cost'][0]['value']}}
                                </td>
                                <td>{{$k['cost'][0]['etd']}}</td>
                                <td>{{$k['cost'][0]['note']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModalCenter">
                        Pilih Paket Pengiriman
                    </button>
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Pilih paket</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach($kurir as $k)
                                    <form action="/myorders/add_order" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="cart_id" value="{{ $data['cart_id'] }}">
                                        <input type="hidden" name="user_id" value="@if (Route::has('register')){{ Auth::user()->id }}@endif">
                                        <input type="hidden" name="product_id" value="{{ $data['product_id'] }}">
                                        <input type="hidden" name="total" value="{{ $cart->total }}">
                                        <input type="hidden" name="price" value="{{ $cart->price }}">
                                        <input type="hidden" name="receiver" value="{{ $data['receiver'] }}">
                                        <input type="hidden" name="phone" value="{{ $data['phone'] }}">
                                        <input type="hidden" name="city_id" value="{{ $data['destination'] }}">
                                        <input type="hidden" name="alamat" value="{{ $data['alamat'] }}">
                                        <input type="hidden" name="courier" value="{{ $data['courier'] }}">
                                        <input type="hidden" name="berat" value="{{ $data['weight'] }}">
                                        <input type="hidden" name="paket" value="{{$k['service']}}">
                                        <input type="hidden" name="ongkir" value="{{$k['cost'][0]['value']}}">
                                        <button type="submit" class="btn btn-info btn-block mb-3">{{$k['description']}} | {{$k['service']}} | @currency($k['cost'][0]['value']) | {{$k['cost'][0]['etd']}} days</button>

                                    </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endSection