@extends('admin.layout')
@section('order', 'active')
@push('title')
   <title>Orders</title>
@endpush
 @section('content')
 @if(session()->has('message'))
 <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{session('message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
    @endif
        <h1>Orders</h1>
        <div class="row m-t-30">
            <div class="col-lg-12">
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Details</th>
                            <th>Total Amount</th>
                            <th>Order Status</th>
                            <th>Payment Type</th>
                            <th>Payment Status</th>
                            <th>Placed On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->username}}<br>
                                {{$list->email}}<br>
                                {{$list->mobile}}<br>
                                {{$list->address}},  {{$list->city}},  {{$list->district}},  {{$list->pin_code}}<br>
                            </td>
                            <td>{{$list->total_amt}}</td>
                            @if ($list->order_status == 'Failed')
                            <td class="denied">{{$list->order_status}}</td>
                            @else
                            <td class="process">{{$list->order_status}}</td>
                            @endif
                            <td>{{$list->payment_type}}</td>
                            @if ($list->payment_status == 'Failed')
                            <td class="denied">{{$list->payment_status}}</td>
                            @else
                            <td class="process">{{$list->payment_status}}</td>
                            @endif
                            <td>{{$list->added_on}}</td>
                            <td>
                                <a href="order-details/{{$list->id}}">
                                    <button class="btn btn-info">View</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 @endsection
