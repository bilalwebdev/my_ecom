@extends('admin.layout')
@section('size', 'active')
@push('title')
   <title>Size</title>
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
        <h1>Sizes</h1>
        <a href="manage-size">
            <button type="button" class="btn btn-success mt-3"><i class="fa fa-plus"></i> Add Size</button>
        </a>
        <div class="row m-t-30">
            <div class="col-lg-12">
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead class="thead-dark">
                        <tr>
                            <th>SR#</th>
                            <th>Size</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $li=1;
                        @endphp
                        @foreach ($sizes as $list)
                        <tr>
                            <td>{{$li++}}</td>
                            <td>{{$list->size}}</td>
                            <td>
                               <a href="size/delete/{{$list->id}}">
                                    <button class="btn btn-danger">Delete</button>
                                </a>
                                <a href="manage-size/edit/{{$list->id}}">
                                    <button class="btn btn-success">Edit</button>
                                </a>
                                @if ($list->status==1)
                                <a href="size/status/0/{{$list->id}}">
                                    <button class="btn btn-info">Active</button>
                                </a>
                                @elseif ($list->status==0)
                                <a href="size/status/1/{{$list->id}}">
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
