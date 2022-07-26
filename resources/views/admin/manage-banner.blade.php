@extends('admin.layout')
@section('banner', 'active')
@push('title')
   <title>Manage Banner</title>
@endpush
 @section('content')

        <h1 class="mb10" >Manage Home Banner</h1>
        <a href="banner">
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
                            <label for="btn_text" class="control-label mb-1">Button Text</label>
                            <input id="btn_text" name="btn_text" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $banner->btn_text }}" required>
                            <span class="text-danger">
                            @error('btn_text')
                                {{$message}}
                            @enderror
                            </span>
                        </div>
                        <div class="col-md-4">
                            <label for="btn_link" class="control-label mb-1">Button Link</label>
                            <input id="btn_link" name="btn_link" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $banner->btn_link }}" required>
                            <span class="text-danger">
                                @error('btn_link')
                                {{$message}}
                                @enderror</span>
                        </div>
                        <div class="col-md-4">
                            <label for="tag_line" class="control-label mb-1">Tag Line</label>
                            <input id="tag_line" name="tag_line" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $banner->tag_line }}" required>
                            <span class="text-danger">
                                @error('tag_line')
                                {{$message}}
                                @enderror</span>
                        </div>
                        <div class="col-md-4">
                            <label for="banner_heading" class="control-label mb-1">Heading</label>
                            <input id="banner_heading" name="banner_heading" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $banner->banner_heading }}" required>
                            <span class="text-danger">
                                @error('banner_heading')
                                {{$message}}
                                @enderror</span>
                        </div>
                        <div class="col-md-4">
                            <label for="banner_desc" class="control-label mb-1">Short Description</label>
                            <input id="banner_desc" name="banner_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $banner->banner_desc }}" required>
                            <span class="text-danger">
                                @error('banner_desc')
                                {{$message}}
                                @enderror</span>
                        </div>
                        <div class="col-md-4">
                            <label for="image" class="control-label mb-1">Image</label>
                            <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                            <img width="150px" src="{{ asset('storage/media/banner/'.$banner->image) }}" alt="" style="margin-top: 10px">
                            @if ( $banner->id==NULL)
                            <span class="text-danger">
                                @error('image')
                                {{$message}}
                                @enderror</span>
                            @endif
                        </div>
                        </div>
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                {{ $button }}
                               </button>
                        </div>
                 </form>
                </div>
            </div>
        </div>
        </div>
        </div>
@endsection
