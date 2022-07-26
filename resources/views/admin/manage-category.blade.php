@extends('admin.layout')
@section('cate', 'active')
@push('title')
   <title>Manage Category</title>
@endpush
 @section('content')

        <h1 class="mb10" >Manage Category</h1>
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
                            <label for="category_name" class="control-label mb-1">Category Name</label>
                            <input id="category_name" name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $category->category_name }}" required>
                            <span class="text-danger">
                            @error('category_name')
                                {{$message}}
                            @enderror
                            </span>
                        </div>
                        <div class="col-md-4">
                            <label for="parent_category_id" class="control-label mb-1">Parent Category</label>
                            <select id="parent_category_id" name="parent_category_id" type="text" class="form-control" required>
                                <option value="0">--Select Category--</option>
                                @foreach ($categories as $list)
                                // {{-- @php
                                //  print_r($category->id);
                                //  die();
                                // @endphp --}}
                                 @if($list->id == $category->parent_category_id)
                                   <option selected value="{{ $list->id }}">
                                 @else
                                 <option  value="{{$list->id }}">
                                 @endif
                                  {{ $list->category_name }}</option>
                                @endforeach
                              </select>
                                <span class="text-danger">
                                @error('category')
                                {{$message}}
                                @enderror</span>
                        </div>
                        <div class="col-md-4">
                            <label for="category_slug" class="control-label mb-1">Category Slug</label>
                            <input id="category_slug" name="category_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $category->category_slug }}" required>
                            <span class="text-danger">
                                @error('category_slug')
                                {{$message}}
                                @enderror</span>
                        </div>
                        <div class="col-md-4">
                            <label for="category_image" class="control-label mb-1">Image</label>
                            <input id="category_image" name="category_image" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                            <img width="150px" src="{{ asset('storage/media/category/'.$category->category_image) }}" alt="" style="margin-top: 10px">
                            @if ( $category->id==NULL)
                            <span class="text-danger">
                                @error('category_image')
                                {{$message}}
                                @enderror</span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="is_home" class="control-label mb-1">Add to Home Page</label>
                            @if ($category->is_home == 1)
                            <input id="is_home" name="is_home" type="checkbox" aria-required="true" aria-invalid="false" style="margin-top: 45px" checked>
                            @else
                            <input id="is_home" name="is_home" type="checkbox" aria-required="true" aria-invalid="false" style="margin-top: 45px">
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
