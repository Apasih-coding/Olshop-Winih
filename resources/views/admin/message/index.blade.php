@extends('admin.layouts.app')
@section('title', 'Manage Message')

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
                    Message
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container py-3">
    <h3>Daftar Message</h3>
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
                                    <th>Uername</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesan as $u)
                                <tr>
                                    <td>{{ $u->id }}</td>
                                    <td>{{ $u->username }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->subject }}</td>
                                    <td>{{ $u->description }}</td>
                                    <td>
                                        <a href="/admin/{{ $u->id }}/detailPesan" class="btn btn-info">Detail</a>
                                        <!-- @can('edit-user')
                                        <a href="/admin/{{ $u->id }}/editPesan" class="btn btn-warning">Edit</a>
                                        @endcan -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $pesan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection