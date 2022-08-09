@extends('admin.layouts.app')
@section('title', 'Insert Data')
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
<div id="form-insert">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Insert Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="/product/store" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">Image Product 1</label>
                                <div class="col-sm-10 custom-file">
                                    <input type="file" class="form-control custom-file-input @error('image') is-invalid @enderror" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image2" class="col-sm-2 col-form-label">Image Product 2</label>
                                <div class="col-sm-10 custom-file">
                                    <input type="file" class="form-control custom-file-input @error('image2') is-invalid @enderror" id="image2" name="image2">
                                    <label class="custom-file-label" for="image2">Choose file</label>
                                    @error('image2')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image3" class="col-sm-2 col-form-label">Image Product 3</label>
                                <div class="col-sm-10 custom-file">
                                    <input type="file" class="form-control custom-file-input @error('image3') is-invalid @enderror" id="image3" name="image3">
                                    <label class="custom-file-label" for="image3">Choose file</label>
                                    @error('image3')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name_product" class="col-sm-2 col-form-label">Name Product</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name_product') is-invalid @enderror" id="name_product" name="name_product">
                                    @error('name_product')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="category" name="category">
                                        @foreach($categories as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total" class="col-sm-2 col-form-label">Total</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('total') is-invalid @enderror" id="total" name="total">
                                    @error('total')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="beli" class="col-sm-2 col-form-label">Harga Beli</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('price_buy') is-invalid @enderror" id="beli" name="price_buy">
                                    @error('price_buy')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('price_sell') is-invalid @enderror" id="harga" name="price_sell">
                                    @error('price_sell')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desc" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" rows="5"></textarea>
                                    @error('desc')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Insert Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop