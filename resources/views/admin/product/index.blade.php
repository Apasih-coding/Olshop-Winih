@extends('admin.layouts.app')
@section('title', 'Manage Product')

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
                    Products
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container py-3">
    <div class="row justify-content-between">
        <h3 class="ml-3">Daftar Product</h3>
        <a href="/product/create" class="btn btn-primary float-right mr-4">
            <i class="fa fa-plus"> Insert Product</i>
        </a>
    </div>
</div>
<div id="t-produk">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Name</th>
                                    <th>Total</th>
                                    <th>harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td><img src="{{ $p->takeImage }}" style="height: 100px;"></td>
                                    <td>{{ $p->name_product }}</td>
                                    <td>{{ $p->total }}</td>
                                    <td>{{ $p->price_sell }}</td>
                                    <td>
                                        <a href="/admin/{{ $p->slug }}/detailProduct" class="btn btn-info">Detail</a>
                                        @can('edit-user')
                                        <a href="/admin/{{ $p->slug }}/edit" class="btn btn-warning">Edit</a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <form action="/admin/product/sorting-category" method="GET">
                                    <div class="input-group col-sm-5 offset-sm-7 mb-3">
                                        <select class="custom-select" id="category" name="category">
                                            <option selected disabled>Choose category</option>
                                            @foreach($category as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-info">Sorting</button>
                                        </div>
                                    </div>
                                </form>
                            </tfoot>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $product->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection