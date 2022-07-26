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
        <a href="manage-size">
            <button type="button" class="btn btn-success mt-3">Add Customer</button>
        </a>
        <div class="row m-t-30">
            <div class="col-lg-12">
            <div class="table-responsive m-b-40">
                <table class="table table-boderless table-data3">
                    <thead>
                        <tr>
                            <th>Feild</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td>{{$customer->name}}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{$customer->email}}</td>
                        </tr>
                        <tr>
                            <td><strong>Phone</strong></td>
                            <td>{{$customer->mobile}}</td>
                        </tr>
                        <tr>
                            <td><strong>Address</strong></td>
                            <td>{{$customer->address}}</td>
                        </tr>
                        <tr>
                            <td><strong>City</strong></td>
                            <td>{{$customer->city}}</td>
                        </tr>
                        <tr>
                            <td><strong>Country</strong></td>
                            <td>{{$customer->country}}</td>
                        </tr>
                        <tr>
                            <td><strong>Zip</strong></td>
                            <td>{{$customer->zip}}</td>
                        </tr>
                        <tr>
                            <td><strong>Company</strong></td>
                            <td>{{$customer->company}}</td>
                        </tr>
                        <tr>
                            <td><strong>GST</strong></td>
                            <td>{{$customer->gstin}}</td>
                        </tr>
                        <tr>
                            <td><strong>Created on</strong></td>
                            <td>{{$customer->created_at}}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated on</strong></td>
                            <td>{{$customer->updated_at}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 @endsection
