@extends('admin.layout')
@section('brand', 'active')
@push('title')
   <title>Manage Category</title>
@endpush
 @section('content')
        <h1 class="mb10">Manage Category</h1>
        <a href="category">
            <button type="button" class="btn btn-success">Back</button>
        </a>
        <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">

                    <form action="{{ $url }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-4">
                            <label for="brand_name" class="control-label mb-1">Brand Name</label>
                            <input id="brand_name" name="brand_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $brand->brand_name }}" required>
                            <span class="text-danger">
                            @error('brand_name')
                                {{$message}}
                            @enderror
                            </span>
                        </div>
                        <div class="col-md-4">
                            <label for="brand_image" class="control-label mb-1">Brand Image</label>
                            <input id="brand_image" name="brand_image" type="file" class="form-control" aria-required="true" aria-invalid="false" value="{{ $brand->brand_image }}" >
                            <img width="150px" src="{{ asset('storage/media/brands/'.$brand->brand_image) }}" alt="" style="margin-top: 10px">
                            <span class="text-danger">
                                @error('brand_image')
                                {{$message}}
                                @enderror</span>
                        </div>
                        <div class="col-md-4">
                        <label for="is_home" class="control-label mb-1">Add to Home Page</label>
                        <input id="is_home" name="is_home" type="checkbox" aria-required="true" aria-invalid="false" style="margin-top: 45px" {{ $is_home_show }}>
                     </div>
                    </div>
                   </div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        {{ $button }}
                </button>
                </div>
                    </form>
            </div>
        </div>
        </div>
        </div>
@endsection
