@extends('admin.layout')
@section('coupon', 'active')
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
                 <form action="{{ $url }}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="form-group mt-1">
                            <div class="row">
                            <div class="col-md-6">
                                <label for="title" class="control-label mb-1">Coupon Name</label>
                                <input id="title" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $coupon->title }}" required>
                                <span class="text-danger">
                                @error('title')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label for="code" class="control-label mb-1">Coupon Code</label>
                                <input id="code" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $coupon->code }}" required>
                                <span class="text-danger">
                                    @error('code')
                                    {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-md-6">
                                <label for="value" class="control-label mb-1">Coupon Value</label>
                                <input id="value" name="value" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $coupon->value }}" required>
                                <span class="text-danger">
                                    @error('value')
                                    {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-md-6">
                                <label for="type" class="control-label mb-1">Type</label>
                                <select id="type" name="type" type="text" class="form-control" required>
                                    @if ($coupon->type == 'Value')
                                    <option selected value="Value">Value</option>
                                    <option value="Per">Percentage</option>
                                    @else
                                    <option value="Value">Value</option>
                                    <option selected value="Per">Percentage</option>
                                    @endif
                                </select>
                             </div>
                             <div class="col-md-6">
                                <label for="min_order_amt" class="control-label mb-1">Min Order Amount</label>
                                <input id="min_order_amt" name="min_order_amt" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $coupon->min_order_amt }}" required>
                                <span class="text-danger">
                                    @error('min_order_amt')
                                    {{$message}}
                                    @enderror</span>
                            </div>
                             <div class="col-md-6">
                                <label for="is_one_time" class="control-label mb-1">IS One Time</label>
                                <select id="is_one_time" name="is_one_time" type="text" class="form-control" required>
                                    @if ($coupon->is_one_time == 1)
                                    <option selected value="1">Yes</option>
                                    <option value="2">No</option>
                                    @else
                                    <option value="1">Yes</option>
                                    <option selected value="2">No</option>
                                    @endif
                                </select>
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
