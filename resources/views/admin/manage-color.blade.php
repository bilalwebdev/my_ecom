@extends('admin.layout')
@section('color', 'active')
@push('title')
   <title>Manage Color</title>
@endpush
 @section('content')
        <h1 class="mb10">Manage Color</h1>
        <a href="color">
            <button type="button" class="btn btn-success">Back</button>
        </a>
        <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">

                    <form action="{{ $url }}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <label for="color" class="control-label mb-1">Color Name</label>
                            <input id="color" name="color" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $color->color }}" required>
                            <span class="text-danger">
                            @error('color')
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
