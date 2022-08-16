@extends('admin.layout')
@section('customer', 'active')
@push('title')
   <title>Customer</title>
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
        <h1>Customers</h1>
        <div class="row m-t-30">
            <div class="col-lg-12">
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead class="thead-dark">
                        <tr>
                            <th>SR#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $li=1;
                        @endphp
                        @foreach ($customers as $list)
                        <tr>
                            <td>{{$li++}}</td>
                            <td>{{$list->name}}</td>
                            <td>{{$list->email}}</td>
                            <td>{{$list->mobile}}</td>
                            <td>{{$list->city}}</td>
                            <td>
                                {{-- <a href="name/delete/{{$list->id}}">
                                    <button class="btn btn-danger">Delete</button>
                                </a> --}}
                                <a href="show-customer/show/{{$list->id}}">
                                    <button class="btn btn-success">View</button>
                                </a>
                                @if ($list->status==1)
                                <a href="customer/status/0/{{$list->id}}">
                                    <button class="btn btn-info">Active</button>
                                </a>
                                @elseif ($list->status==0)
                                <a href="customer/status/1/{{$list->id}}">
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
