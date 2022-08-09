@extends('layouts.app')
@section('title', 'My Account')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('layouts.nav-account')
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @guest @if (Route::has('register'))
                        <div class="row">
                            <div class="col-sm-6 justify-content-center text-center mt-3">
                                <h2><strong>Belum Ada Akun</strong></h2>
                                <h5>Segera daftar diri anda dari sekrang untuk memulai belanja</h5>
                            </div>
                            <div class="col-sm-6">
                                <img src="image/logo.png" alt="">
                            </div>
                        </div>
                        @endif @else
                        @foreach($user as $u)
                        <div class="col-sm-6">
                            <img src="/storage/profile/{{$u->id}}/{{ $u->profile }}" style="width: 350px;">
                        </div>
                        <form class="col-sm-6">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">Nama :</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="nama" value="{{ $u->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-4 col-form-label">Username :</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="username" value="{{ $u->username }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email :</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="email" value="{{ $u->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-sm-4 col-form-label">Phone :</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="phone" value="{{ $u->phone }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-4 col-form-label">Address :</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="address" value="{{ $u->address }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dibuat" class="col-sm-4 col-form-label">Dibuat :</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="dibuat" value="{{ $u->created_at }}">
                                </div>
                            </div>
                            @endforeach
                            @endguest
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endSection