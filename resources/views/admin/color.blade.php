@extends('admin.layout')
@section('color', 'active')
@push('title')
   <title>Color</title>
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
        <h1>Colors</h1>
        <a href="manage-color">
            <button type="button" class="btn btn-success mt-3">  <i class="fa fa-plus"></i> Add Color</button>
        </a>
        <div class="row m-t-30">
            <div class="col-lg-8">
            <div class="table-responsive m-b-40">
                <table class="table table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th>SR#</th>
                            <th>Color</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $li=1;
                    @endphp
                        @foreach ($colors as $list)
                        <tr>
                            <td>{{$li++}}</td>
                            <td>{{$list->color}}</td>
                            <td>
                               <a href="color/delete/{{$list->id}}">
                                    <button class="btn btn-danger">Delete</button>
                                </a>
                                <a href="manage-color/edit/{{$list->id}}">
                                    <button class="btn btn-success">Edit</button>
                                </a>
                                @if ($list->status==1)
                                <a href="color/status/0/{{$list->id}}">
                                    <button class="btn btn-info">Active</button>
                                </a>
                                @elseif ($list->status==0)
                                <a href="color/status/1/{{$list->id}}">
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
