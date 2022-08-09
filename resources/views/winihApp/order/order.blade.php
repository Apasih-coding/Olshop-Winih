@extends('layouts.orderNav')
@section('title', 'My Account')
@section('judul', 'Orderan dibayar')

@section('orders')
<div class="container-fluid">
    <div class="col-sm-12">
        <table class="table table-striped table-bordered table-hover table-order">
            <thead>
                <tr>
                    <th>Product </th>
                    <th>Jumlah Barang</th>
                    <th>Harga</th>
                    <th>Nama Penerima</th>
                    <th>Alamat Penerima</th>
                    <th>Kurir</th>
                    <th>Paket</th>
                    <th>Ongkos Kirim</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @auth
                @foreach($order as $res)
                <tr>
                    <td>{{ $res->product_id }}</td>
                    <td>{{ $res->total }}</td>
                    <td>@currency($res->price)</td>
                    <td>{{ $res->receiver }}</td>
                    <td>{{ $res->alamat }}</td>
                    <td>{{ $res->courier }}</td>
                    <td>{{ $res->paket }}</td>
                    <td>@currency($res->ongkir)</td>
                    <td>@currency($res->total_price)</td>
                    <td><span class="badge badge-warning">{{ $status }}</span></td>
                    <td>
                        <a href="/myorders/{{ $res->id }}/detail" class="btn btn-info"><i class="fa fa-eye"></i> Details</a>
                    </td>
                </tr>
                @endforeach
                @endauth
            </tbody>
            <tfoot>
                <tr class="text-right">
                    <th colspan="7">Total belanja : </th>
                    <th colspan="2">@currency( $total_belanja) </th>
                    <th colspan="2">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                            Complain
                        </button>
                    </th>
                </tr>
            </tfoot>
        </table>
        @if(session()->has('success'))
        <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('success') }}</strong> You can contact us in<strong><a href="{{ url('/about') }}">About Us.</a></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
        <small class="text-muted">*click complain jika orderan belum dikemas dalam waktu estimasi yang sesuai paket</small>
    </div>
</div>
@endSection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Complain</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/message/add">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="offset-md-2 col-md-2">Username :</label>
                        <div class="col-md-6">
                            <input type="text" readonly class="form-control-plaintext" id="nama" name="nama" value="@guest @if(Route::has('register'))Guest @endif @else{{ Auth::user()->username }}@endguest">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="offset-md-2 col-md-2">Email address :</label>
                        <div class="col-md-6">
                            <input type="email" readonly class="form-control-plaintext" id="email" name="email" value="@guest @if(Route::has('register'))Guest @endif @else{{ Auth::user()->email }}@endguest">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="subject" class="offset-md-2 col-md-2">Nama Barang :</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="product" name="product" placeholder="Bayam Super">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="subject" class="offset-md-2 col-md-2">Subject :</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Keluhan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desc" class="offset-md-2 col-md-2">Deskripsi :</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="desc" name="desc" rows="8" placeholder="Orderan saya dengan estitmasi 3 hari belum dikemas........."></textarea>
                        </div>
                    </div>
                    <div class="col-md-10">
                        @guest @if(Route::has('register'))
                        <a href="{{route('login')}}" class="btn btn-primary float-right">Kirim Pesan</a>
                        @endif @else
                        <button class="btn btn-primary float-right" type="submit" name="submit">Kirim Pesan</button>
                        @endguest
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>