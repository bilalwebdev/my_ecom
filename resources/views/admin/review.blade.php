@extends('admin.layout')
@section('review', 'active')
@push('title')
   <title>Reviews</title>
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

        <h1>Reviews</h1>
        <div class="row m-t-30">
            <div class="col-md-12">
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th>Added on</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->name}}</td>
                            <td>{{$list->p_name}}</td>
                            <td>{{$list->review}}</td>
                            <td>{{$list->rating}}</td>
                            <td>{{ \Carbon\Carbon::parse($list->added_on)->format('M-d-Y') }}</td>
                            <td>
                               <a href="admin/review/delete/{{$list->id}}">
                                    <button class="btn btn-danger">Delete</button>
                                </a>
                                @if ($list->status==1)
                                <a href="review/status/0/{{$list->id}}">
                                    <button class="btn btn-info">Active</button>
                                </a>
                                @elseif ($list->status==0)
                                <a href="review/status/1/{{$list->id}}">
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
