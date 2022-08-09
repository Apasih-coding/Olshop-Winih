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
                <li class="breadcrumb-item">
                    <a href="{{ url('/myorders') }}">My Order</a>
                </li>
                <li class="breadcrumb-item active">
                    Payment
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body border-light bg-ligh">
                            <div class="text-center">
                                <h1 class=""><strong>@currency($order->total_price)</strong></h1>
                                <h5 class="text-muted ">{{ $product->name_product }}</h5>
                                <ul class="list-inline text-muted ">
                                    <li class="list-inline-item"><small class="text-uppercase">{{ $order->courier }}</small></li>
                                    <li class="list-inline-item"><small>{{ $order->paket }}</small></li>
                                </ul>
                                <ul class="list-inline text-muted ">
                                    <li class="list-inline-item"><small>{{ $order->total }} items</small></li>
                                    <li class="list-inline-item"><small>{{ $order->created_at->format('d-M-Y') }}</small></li>
                                </ul>
                            </div>
                            <form action="/myorders/{{$order->id}}/delete" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-block mb-3">Cancel Order</button>
                            </form>
                            <h4><u>Tujuan transfer</u></h4>
                            <ul class="list-inline d-flex justify-content-between">
                                <li class="list-inline-item ">Bank BRI</li>
                                <li class="list-inline-item ">3765088888987</li>
                                <li class="list-inline-item ">a/n Yami Sukehiro</li>
                            </ul>
                            <ul class="list-inline d-flex justify-content-between">
                                <li class="list-inline-item">Bank BCA</li>
                                <li class="list-inline-item">3765088888987</li>
                                <li class="list-inline-item">a/n Yami Sukehiro</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <form action="/myorders/{{$order->id}}/ConfirmBayar" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <form>
                            <h4>Data Transfer</h4>
                            <input type="hidden" name="order_id" value="{{$order->id}}">
                            <input type="hidden" name="user_id" value="{{$order->user_id}}">
                            <input type="hidden" name="product_id" value="{{$order->product_id}}">
                            <input type="hidden" name="total_price" value="{{$order->total_price}}">
                            <div class="form-group">
                                <label for="bank">Example label</label>
                                <select name="bank" id="bank" class="form-control @error('bank') is-invalid @enderror" required>
                                    <option selected disabled>-- Pilih Bank --</option>
                                    <option value="BRI">BRI</option>
                                    <option value="BCA">BCA</option>
                                    <option value="Mandiri">Mandiri</option>
                                    <option value="Syariah">Syariah</option>
                                </select>
                                @error('bank')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_rekening">No Rekening</label>
                                <input type="text" class="form-control @error('no_rekening') is-invalid @enderror" id="no_rekening" name="no_rekening" required placeholder="Example input">
                                @error('no_rekening')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tujuan_rekening">No Tujuan Rekening</label>
                                <input type="text" class="form-control @error('tujuan_rekening') is-invalid @enderror" id="tujuan_rekening" name="tujuan_rekening" required placeholder="Example input">
                                @error('tujuan_rekening')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_rekening">a/n Rekening</label>
                                <input type="text" class="form-control @error('nama_rekening') is-invalid @enderror" id="nama_rekening" name="nama_rekening" required placeholder="Example input">
                                @error('nama_rekening')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_transfer">Tanggal transfer</label>
                                <input type="date" class="form-control @error('tanggal_transfer') is-invalid @enderror" id="tanggal_transfer" name="tanggal_transfer" required placeholder="Another input">
                                @error('tanggal_transfer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="bukti_transfer">Bukti transfer</label>
                                <input type="file" class="form-control @error('bukti_transfer') is-invalid @enderror" id="bukti_transfer" name="bukti_transfer" value="" required placeholder="Another input">
                                @error('bukti_transfer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Konfirmasi bukti transfer</button>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection