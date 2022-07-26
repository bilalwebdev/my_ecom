@extends('admin.layout')
@section('size', 'active')
@push('title')
   <title>Manage Size</title>
@endpush
 @section('content')
        <h1 class="mb10">Manage Size</h1>
        <a href="size">
            <button type="button" class="btn btn-success">Back</button>
        </a>
        <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">

                    <form action="{{ $url }}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <label for="size" class="control-label mb-1">Size Name</label>
                            <input id="size" name="size" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $size->size }}" required>
                            <span class="text-danger">
                            @error('size')
                                {{$message}}
                            @enderror
                            </span>
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
