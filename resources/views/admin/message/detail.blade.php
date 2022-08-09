@extends('admin.layouts.app')
@section('title', 'Detail Product')

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
                    Product
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container py-3">
    <div class="d-flex justify-content-between">
        <h3>Detail pesan dari User ID <i>{{$message->id}}</i></h3>
        <form action="/admin/pesan/{{ $message->id }}/delete" method="POST">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
        </form>
    </div>
</div>
<div id="detail_message">
    <div class="container">
        <div class="cards_message">
            <div class="cards">
                <div class="cards-content">
                    <div class="value">{{ $message->username }}</div>
                    <div class="value-name">Username</div>
                </div>
                <div class="icon-card">
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="cards">
                <div class="cards-content">
                    <div class="value">{{ $message->email }}</div>
                    <div class="value-name">E-mail</div>
                </div>
                <div class="icon-card">
                    <i class="fa fa-envelope"></i>
                </div>
            </div>
            <div class="cards">
                <div class="cards-content">
                    <div class="value">{{ $message->product }}</div>
                    <div class="value-name">Product</div>
                </div>
                <div class="icon-card">
                    <i class="fa fa-archive"></i>
                </div>
            </div>
            <div class="cards">
                <div class="cards-content">
                    <div class="value">{{ $message->subject }}</div>
                    <div class="value-name">Subject</div>
                </div>
                <div class="icon-card">
                    <i class="fa fa-sticky-note"></i>
                </div>
            </div>
            <div class="cards">
                <div class="cards-content">
                    <div class="value">{{ $message->description }}</div>
                    <div class="value-name">Comment</div>
                </div>
                <div class="icon-card">
                    <i class="fa fa-commenting"></i>
                </div>
            </div>
            <div class="cards">
                <div class="cards-content">
                    <div class="value">{{ $message->created_at->format('d-M-Y') }}</div>
                    <div class="value-name">Tanggal</div>
                </div>
                <div class="icon-card">
                    <i class="fa fa-calendar-check-o"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@endSection