@extends('admin.layouts.app')
@section('title', 'Manage User')

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
                    Users
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container py-3">
    <h3>Daftar User</h3>
</div>
<div id="t-user">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Profile</th>
                                    <th>Email</th>
                                    <th>Uername</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $u)
                                <tr>
                                    <td>{{ $u->id }}</td>
                                    <td>
                                        <div class="imgBox">
                                            <img src=" /storage/profile/{{$u->id}}/{{ $u->profile }}" alt="image/logo.png">
                                        </div>
                                    </td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->username }}</td>
                                    <td>{{ implode(', ',$u->roles()->get()->pluck('name')->toArray()) }}</td>
                                    <td>
                                        <a href="/admin/{{ $u->id }}/detailUser" class="btn btn-info">Detail</a>
                                        @can('edit-user')
                                        <a href="/admin/{{ $u->id }}/editUser" class="btn btn-warning">Edit</a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection