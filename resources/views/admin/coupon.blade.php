@extends('admin.layout')
@section('coupon', 'active')
@push('title')
   <title>Coupon</title>
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

        <h1>Coupons</h1>
        <a href="manage-coupon">
            <button type="button" class="btn btn-success mt-3"><i class="fa fa-plus"></i> Add Coupon</button>
        </a>
        <div class="row m-t-30">
            <div class="col-md-12">
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead class="thead-dark">
                        <tr>
                            <th>SR#</th>
                            <th>Coupon Title</th>
                            <th>Coupon Code</th>
                            <th>coupon Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $li=1;
                    @endphp
                        @foreach ($coupons as $list)
                        <tr>
                            <td>{{$li++}}</td>
                            <td>{{$list->title}}</td>
                            <td>{{$list->code}}</td>
                            <td>{{$list->value}}</td>
                            <td>
                               <a href="coupon/delete/{{$list->id}}">
                                    <button class="btn btn-danger">Delete</button>
                                </a>
                                <a href="manage-coupon/edit/{{$list->id}}">
                                    <button class="btn btn-success">Edit</button>
                                </a>
                                @if ($list->status==1)
                                <a href="coupon/status/0/{{$list->id}}">
                                    <button class="btn btn-info">Active</button>
                                </a>
                                @elseif ($list->status==0)
                                <a href="coupon/status/1/{{$list->id}}">
                                    <button class="btn btn-warning">Deactive</button>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 @endsection
