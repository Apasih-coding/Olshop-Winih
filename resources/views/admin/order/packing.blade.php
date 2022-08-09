@extends('admin.layouts.orderNav')
@section('title', 'Manage Order')
@section('judul', 'Daftar Order dikemas')

@section('content_order')
<div id="t-order">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User Name</th>
                            <th>Product ID</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Courier</th>
                            <th>Paket</th>
                            <th>Ongkir</th>
                            <th>Total bayar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $o)
                        <tr>
                            <td>{{ $o->id }}</td>
                            <td>{{ $o->user->name }}</td>
                            <td>{{ $o->product_id }}</td>
                            <td>@currency($o->price)</td>
                            <td>{{ $o->total }}</td>
                            <td>{{ $o->courier }}</td>
                            <td>{{ $o->paket }}</td>
                            <td>{{ $o->ongkir }}</td>
                            <td>@currency($o->total_price)</td>
                            <td><span class="badge badge-warning">{{ $status }}</span>
                                <a href="/admin/{{ $o->id }}/detailOrder" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                            </td>
                            <td>
                                @can('edit-user')
                                <form action="/admin/{{ $o->id }}/deliver" method="post">
                                    @method('patch')
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Kirim</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="text-right">
                            <th colspan="7">Total belanja : </th>
                            <th colspan="2">@currency( $total_belanja) </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endSection