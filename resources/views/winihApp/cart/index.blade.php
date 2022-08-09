@extends('layouts.app')
@section('title', 'Products Winih Q')

@section('content')
<div class="container">
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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Shoping Carts</h1>
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th colspan="2">Product Name</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Ubah</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Procces Shopping</th>
                            </tr>
                        </thead>
                        <tbody>
                            @auth
                            @foreach($cart as $c)
                            <tr>
                                <th>
                                    <img src="{{ $c->image }}" class="img-rounded" style="width: 120px; height: 120px;">
                                </th>
                                <th scope="row" class="align-middle">{{ $c->name_product }}</th>
                                <td class="align-middle">{{ $c->total }}</td>
                                <td class="align-middle">Rp. {{ number_format($c->price,0) }}</td>
                                <td class="align-middle">Pack</td>
                                <td class="align-middle">
                                    <div class="row action">
                                        <form action="/cart/{{ $c->id }}/tambah" method="POST">@method('patch') @csrf
                                            <div>
                                                <input type="hidden" name="total" id="total" value="{{$c->total}}">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </form>
                                        <form action="/cart/{{ $c->id }}/minus" method="POST">@method('patch') @csrf
                                            <div>
                                                <input type="hidden" name="total" id="total" value="{{$c->total}}">
                                                <button type="submit" class="btn btn-warning"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </form>
                                        <form action="/cart/{{ $c->id }}/delete" method="POST">@method('delete') @csrf
                                            <div>
                                                <input type="hidden" name="total" id="total" value="{{$c->total}}">
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                                <td class="align-middle">Rp. {{ number_format($c->price * $c->total,0) }}</td>
                                <td class="align-middle">
                                    <a href="/cart/{{ $c->id }}" class="btn btn-info">
                                        <i class="fa fa-credit-card-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="text-right">
                                <th colspan="5">Total : </th>
                                <th colspan="2">Rp. {{number_format( $total_price,0) }}</th>
                            </tr>
                        </tfoot>
                        @endauth
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="/product" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Continue Shopping</a>
                    </div>
                    <div class="col-md-6">
                        <a href="/myorders" class="btn btn-primary float-right ml-2"><i class="fa fa-shopping-bag"></i> My Order</a>
                        <a href="/cart" class="btn btn-secondary float-right"><i class="fa fa-refresh"></i> Update Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection