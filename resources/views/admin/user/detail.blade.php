@extends('admin.layouts.app')
@section('title', 'Detail User')

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
<div id="t-edit-user">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Detail User</h3>
                        <form action="/admin/{{ $user->id }}/deleteUser" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" value="{{ $user->username }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="phone" value="{{ $user->phone }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address" value="{{ $user->address }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"><label for="roles">Roles</label></div>
                                <div class="col-sm-10">
                                    @foreach($roles as $role)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="roles" name="roles[]" value="{{ $role->id }}" @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                        <label class="form-check-label" for="roles">
                                            {{$role->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-danger d-flex justify-content-center">Delete</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection