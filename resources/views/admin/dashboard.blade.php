@extends('admin.layouts.app')
@section('title', 'Dashboard Admin')

@section('container')
<div class="cardsBox">
    <div class="cards">
        <div>
            <div class="value">1,375</div>
            <div class="value-name">Daily Views</div>
        </div>
        <div class="icon-card">
            <i class="fa fa-eye"></i>
        </div>
    </div>
    <div class="cards">
        <div>
            <div class="value">{{$order->collect()->count()}}</div>
            <div class="value-name">Sales</div>
        </div>
        <div class="icon-card">
            <i class="fa fa-shopping-cart"></i>
        </div>
    </div>
    <div class="cards">
        <div>
            <div class="value">{{$message->collect()->count()}}</div>
            <div class="value-name">Comments</div>
        </div>
        <div class="icon-card">
            <i class="fa fa-comments"></i>
        </div>
    </div>
    <div class="cards">
        <div>
            <div class="value">@currency( $total_belanja)</div>
            <div class="value-name">Earning</div>
        </div>
        <div class="icon-card">
            <i class="fa fa-money"></i>
        </div>
    </div>
</div>
<div class="details">
    <div class="order">
        <div class="cardHeader">
            <h2>Recent Order</h2>
            <a href="/admin/order" class="buttons">Viev all</a>
        </div>
        <table>
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Price</td>
                    <td>Tanggal</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                @foreach($order as $data)
                <tr>
                    <td>{{ $data->product->name_product }}</td>
                    <td>@currency($data->total_price)</td>
                    <td>{{$data->created_at->format('d-M-Y')}}</td>
                    <td><span class="status {{$data->status->name}}">{{$data->status->name}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="customers">
        <div class="cardHeader">
            <h2>Recent Customers</h2>
        </div>
        <table>
            @foreach($user as $data)
            <tr>
                <td>
                    <div class="imgBox"><img src="/storage/profile/{{$data->id}}/{{$data->profile}}"></div>
                </td>
                <td>
                    <h4>{{$data->name}} <br><span>{{$data->username}}</span></h4>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endSection