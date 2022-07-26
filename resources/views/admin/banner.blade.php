@extends('admin.layout')
@section('banner', 'active')
@push('title')
   <title>Banner</title>
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
        <h1>Banners</h1>
        <a href="manage-banner">
            <button type="button" class="btn btn-success mt-3"><i class="fa fa-plus"></i> Add Banner</button>
        </a>
        <div class="row m-t-30">
            <div class="col-md-12">
            <div class="table-responsive m-b-40">
                <table class="table table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th>SR#</th>
                            <th>Btn Text</th>
                            <th>Btn Link</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $li=1;
                    @endphp
                        @foreach ($home_banners as $list)
                        <tr>
                            <td>{{$li++}}</td>
                            <td>{{$list->btn_text}}</td>
                            <td>{{$list->btn_link}}</td>
                            <td>
                                @if ($list->image != NULL)
                                <img width="100px" src="{{ asset('storage/media/banner/'.$list->image) }}" alt="{{$list->btn_text}}">
                                @endif
                            </td>
                            <td>
                               <a href="banner/delete/{{$list->id}}">
                                    <button class="btn btn-danger">Delete</button>
                                </a>
                                <a href="manage-banner/edit/{{$list->id}}">
                                    <button class="btn btn-success">Edit</button>
                                </a>
                                @if($list->status==1)
                                <a href="banner/status/0/{{$list->id}}">
                                    <button class="btn btn-info">Active</button>
                                </a>
                                @elseif($list->status==0)
                                <a href="banner/status/1/{{$list->id}}">
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
