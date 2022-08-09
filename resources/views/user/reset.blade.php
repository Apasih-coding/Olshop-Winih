@extends('layouts.app')
@section('title', 'Edit My Password')

@section('content')
@if(session()->has('error'))
<div class="container-fluid">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('error') }}</strong> You can check in <strong><a href="{{ url('/product') }}">Product page.</a></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Password</div>

                <div class="card-body">
                    <form method="POST" action="/myaccount/{{Auth::user()->id}}/edit-password">
                        @csrf
                        @method('patch')

                        <div class="form-group row">
                            <label for="oldPassword" class="col-md-4 col-form-label text-md-right">Password Lama</label>

                            <div class="col-md-6">
                                <input id="oldPassword" type="text" class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword">

                                @error('oldPassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password Baru</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection