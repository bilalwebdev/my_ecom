@extends('admin.layout')
@section('product', 'active')
@push('title')
   <title>Product</title>
@endpush
 @section('content')
 @if(session()->has('message'))
 <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{session('message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">x</span>
    </button>
</div>
    @endif

        <h1>Products</h1>
        <a href="manage-product">
            <button type="button" class="btn btn-success mt-3">
                <i class="fa fa-plus"></i>
                Add Product
            </button>
        </a>
        <div class="row m-t-30">
            <div class="col-md-12">
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3 ">
                    <thead>
                        <tr>
                            <th>SR#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $li=1;
                    @endphp
                        @foreach ($products as $list)
                        <tr>
                            <td>{{$li++}}</td>
                            <td>{{$list->name}}</td>
                            <td>{{$list->slug}}</td>
                            <td><img width="100px" src="{{ asset('storage/media/'.$list->image) }}" alt=""></td>

                            <td>
                               <a href="product/delete/{{$list->id}}">
                                    <button class="btn btn-danger">
                                        <i class="fa-solid fa-trash-can"></i>
                                        Delete
                                    </button>
                                </a>
                                <a href="manage-product/edit/{{$list->id}}">
                                    <button class="btn btn-success">Edit</button>
                                </a>
                                @if ($list->status==1)
                                <a href="product/status/0/{{$list->id}}">
                                    <button class="btn btn-info">Active</button>
                                </a>
                                @elseif ($list->status==0)
                                <a href="product/status/1/{{$list->id}}">
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
