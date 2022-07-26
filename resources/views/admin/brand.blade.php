@extends('admin.layout')
@section('brand', 'active')
@push('title')
   <title>Brand</title>
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
        <h1>Brands</h1>
        <a href="manage-brand">
            <button type="button" class="btn btn-success mt-3"><i class="fa fa-plus"></i> Add Brand</button>
        </a>
        <div class="row m-t-30">
            <div class="col-md-12">
            <div class="table-responsive m-b-40">
                <table class="table table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th>SR#</th>
                            <th>Brand Name</th>
                            <th>Brand Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $li=1;
                    @endphp
                        @foreach ($brands as $list)
                        <tr>
                            <td>{{$li++}}</td>
                            <td>{{$list->brand_name}}</td>
                            <td>
                                @if ($list->brand_image != NULL)
                                <img width="100px" src="{{ asset('storage/media/brands/'.$list->brand_image) }}">
                                @endif
                            </td>
                            <td>
                               <a href="brand/delete/{{$list->id}}">
                                    <button class="btn btn-danger">Delete</button>
                                </a>
                                <a href="manage-brand/edit/{{$list->id}}">
                                    <button class="btn btn-success">Edit</button>
                                </a>
                                @if ($list->status==1)
                                <a href="brand/status/0/{{$list->id}}">
                                    <button class="btn btn-info">Active</button>
                                </a>
                                @elseif ($list->status==0)
                                <a href="brand/status/1/{{$list->id}}">
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
