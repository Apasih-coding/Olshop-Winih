@extends('layouts.orderNav')
@section('title', 'My Account')
@section('judul', 'Orderan dikirim')

@section('orders')
<div class="container-fluid">
    <div class="col-sm-12">
        <table class="table table-striped table-bordered table-hover table-order">
            <thead>
                <tr>
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
                    <td>{{ $res->total }} Unit</td>
                    <td>@currency($res->price)</td>
                    <td>{{ $res->receiver }}</td>
                    <td>{{ $res->alamat }}</td>
                    <td>{{ $res->courier }}</td>
                    <td>{{ $res->paket }}</td>
                    <td>@currency($res->ongkir)</td>
                    <td>@currency($res->total_price)</td>
                    <td><span class="badge badge-warning">{{ $status }}</span></td>
                    <td><a href="/myorders/{{ $res->id }}/detail" class="btn btn-info"><i class="fa fa-eye"></i> Details</a></td>
                    <td>
                        <form action="/myorders/ {{$res->id }}/receive" method="POST">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-success">Confirm</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endauth
            </tbody>
            <tfoot>
                <tr class="text-right">
                    <th colspan="7">Total belanja : </th>
                    <th colspan="2">@currency( $total_belanja) </th>
                </tr>
            </tfoot>
        </table>
        <small class="text-muted">*mohon confirm jika orderan telah diterima</small>
    </div>
</div>
@endSection