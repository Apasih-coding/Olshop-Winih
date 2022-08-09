@extends('layouts.app')
@section('title', 'About Us Winih Q')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    About Us
                </li>
            </ul>
        </div>
    </div>
</div>

<div id="about">
    <div class="container">
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center card-about justify-content-center">
                        <h2>About Us</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident sit beatae eaque, nulla magni numquam cupiditate corporis, libero, autem aut incidunt deleniti. Libero quos consequatur cumque perferendis ipsa, fuga tempora.</p>
                    </div>
                </div>
                <div class="col-md-6 float-right">
                    <img src="image/logo.png" alt="Image Error!">
                </div>
            </div>
        </div>
    </div>
</div>

<div id="Contact">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Contact Us</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/message/add">
                            @csrf
                            <div class="form-group row">
                                <label for="nama" class="offset-md-2 col-md-2">Username :</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Jhon Doe">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="offset-md-2 col-md-2">Email address :</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
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
                                    <textarea class="form-control" id="desc" name="desc" rows="8" placeholder="Order Lama ....."></textarea>
                                </div>
                            </div>
                            @guest @if(Route::has('register'))
                            <div class="col-md-10">
                                <a href="{{ route('login') }}" class="btn btn-primary float-right"> Kirim Pesan</a>
                            </div>
                            @endif @else
                            <div class="col-md-10">
                                <button class="btn btn-primary float-right" type="submit" name="submit">Kirim Pesan</button>
                            </div>
                            @endguest
                        </form>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection