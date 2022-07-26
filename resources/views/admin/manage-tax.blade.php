@extends('admin.layout')
@section('tax', 'active')
@push('title')
   <title>Manage Tax</title>
@endpush
 @section('content')
        <h1 class="mb10">Manage Tax</h1>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tax_value" class="control-label mb-1">Tax Value</label>
                                    <input id="tax_value" name="tax_value" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $tax->tax_value }}" required>
                                    <span class="text-danger">
                                    @error('tax_value')
                                        {{$message}}
                                    @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <label for="tax_desc" class="control-label mb-1">Tax Desc</label>
                                    <input id="tax_desc" name="tax_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $tax->tax_desc }}" required>
                                    <span class="text-danger">
                                    @error('tax_desc')
                                        {{$message}}
                                    @enderror
                                    </span>
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
