@extends('layouts.app')
@section('title', 'Edit My Account')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('layouts.nav-account')
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @auth
                        <form action="/myaccount/{{ $user->id }}/edit" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            @method('patch')
                            @csrf
                            <div class="form-group row">
                                <label for="profile" class="col-sm-2 col-form-label">profile :</label>
                                <div class="col-sm-4">
                                    <input type="file" class="form-control @error('profile') is-invalid @enderror" id="profile" name="profile" value="{{ $user->profile }}">
                                    @error('profile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <img src="/storage/profile/{{$user->id}}/{{ $user->profile }}" style="height: 50px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nama :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ $user->username }}">
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email :</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-sm-2 col-form-label">Phone :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $user->phone }}">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 col-form-label">Address :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $user->address }}">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Edit Account</button>
                                </div>
                            </div>
                            @endauth
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endSection