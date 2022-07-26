@extends('admin.layout')
@section('product', 'active')
@push('title')
   <title>Manage Product</title>
@endpush
 @section('content')
 @if(session()->has('sku_err'))
 <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
       {{ session('sku_err') }}
 </div>
 @endif
    <form action="{{ $url }}" method="post" novalidate="novalidate" enctype="multipart/form-data" class="form-dark">
        @csrf
        <script src="{{ url('ckeditor5/ckeditor.js') }}"></script>
        <div class="row">
         <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="mb10">Manage Product</h1>
                    <a href="product">
                        <button type="button" class="btn btn-success" >All Products</button>
                    </a>
                 <hr>
                     <div class="form-group">
                        <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="control-label mb-1">Name</label>
                            <input id="name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $product->name }}" required>
                            <span class="text-danger">
                            @error('name')
                                {{$message}}
                            @enderror
                            </span>
                             </div>
                             <div class="col-md-6">
                            <label for="slug" class="control-label mb-1">Slug</label>
                            <input id="slug" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $product->slug }}" required>
                            <span class="text-danger">
                                @error('slug')
                                {{$message}}
                                @enderror</span>
                        </div>
                       </div>
                        <div class="form-group">
                            <label for="file" class="control-label mb-1">Image</label>
                            <input id="file" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" value="{{ $product->image }}" >
                            <img width="150px" src="{{ asset('storage/media/'.$product['image']) }}" alt="" style="margin-top: 10px">
                            @if ( $product->id==NULL)
                            <span class="text-danger">
                                @error('image')
                                {{$message}}
                                @enderror</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="category_id" class="control-label mb-1">Category</label>
                                    <select id="category_id" name="category_id" type="text" class="form-control" required>
                                        <option value="">--Select Category--</option>
                                        @foreach ($categories as $category)
                                        @if($product->category_id == $category->id)
                                           <option selected value="{{ $category->id }}">
                                        @else

                                        <option  value="{{$category->id }}">
                                            @endif
                                            {{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                        <span class="text-danger">
                                        @error('category')
                                        {{$message}}
                                        @enderror</span>
                                </div>
                                {{-- <div class="col-md-4">
                                    <label for="brand" class="control-label mb-1">Brand</label>
                                    <input id="brand" name="brand" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $product->brand }}" required>
                                    <span class="text-danger">
                                        @error('brand')
                                        {{$message}}
                                        @enderror</span>
                                </div> --}}
                                  <div class="col-md-4">
                                    <label for="brand" class="control-label mb-1">Brand</label>
                                    <select id="brand" name="brand" type="text" class="form-control" required>
                                        <option value="">--Select Brand--</option>
                                        @foreach ($brands as $brand)
                                        @if($product->brand == $brand->id)
                                           <option selected value="{{ $brand->id }}">
                                        @else

                                        <option  value="{{$brand->id }}">
                                            @endif
                                            {{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                        <span class="text-danger">
                                        @error('brand')
                                        {{$message}}
                                        @enderror</span>
                                </div>
                                <div class="col-md-4">
                                    <label for="model" class="control-label mb-1">Model</label>
                                    <input id="model" name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $product->model }}" required>
                                    <span class="text-danger">
                                        @error('model')
                                        {{$message}}
                                        @enderror</span>
                                </div>
                            </div>
                            <label for="short_desc" class="control-label mb-1">Short Description</label>
                            <textarea id="short_desc" name="short_desc" type="text" class="form-control" aria-required="true" aria-invalid="false"  required>{{ $product->short_desc }}</textarea>
                            <span class="text-danger">
                                @error('short_desc')
                                {{$message}}
                                @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="desc" class="control-label mb-1">Description</label>
                            <textarea id="desc" name="desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{ $product->desc }}</textarea>
                            <span class="text-danger">
                                @error('desc')
                                {{$message}}
                                @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="keywords" class="control-label mb-1">Keywords</label>
                                <textarea id="keywords" name="keywords" type="text" class="form-control" aria-required="true" aria-invalid="false"  required>{{ $product->keywords }}</textarea>
                                <span class="text-danger">
                                    @error('keywords')
                                    {{$message}}
                                    @enderror</span>
                                </div>
                            <div class="form-group">
                                <label for="technical_specifications" class="control-label mb-1">Technical Specifications</label>
                                <textarea id="technical_specifications" name="technical_specifications" type="text" class="form-control" aria-required="true" aria-invalid="false"  required>{{ $product->technical_specifications }}</textarea>
                                <span class="text-danger">
                                @error('technical_specifications')
                                    {{$message}}
                                        @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="uses" class="control-label mb-1">Uses</label>
                                    <textarea id="uses" name="uses" type="text" class="form-control" aria-required="true" aria-invalid="false"  required>{{ $product->uses }}</textarea>
                                    <span class="text-danger">
                                        @error('uses')
                                        {{$message}}
                                        @enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="warranty" class="control-label mb-1">Warranty</label>
                                        <input id="warranty" name="warranty" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $product->warranty }}" required></input>
                                        <span class="text-danger">
                                            @error('warranty')
                                            {{$message}}
                                            @enderror</span>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-md-3">
                                            <label for="lead_time" class="control-label mb-1">Lead Time</label>
                                            <input id="lead_time" name="lead_time" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $product->lead_time }}" required>
                                            <span class="text-danger">
                                                @error('lead_time')
                                                {{$message}}
                                                @enderror</span>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="tax_id" class="control-label mb-1">Tax</label>
                                                <select id="tax_id" name="tax_id" type="text" class="form-control" required>
                                                    <option value="">--Select Tax Type--</option>
                                                    @foreach ($taxes as $tax)
                                                    @if($product->tax_id == $tax->id)
                                                       <option selected value="{{ $tax->id }}">
                                                    @else

                                                    <option  value="{{$tax->id }}">
                                                        @endif
                                                        {{ $tax->tax_desc }}</option>
                                                    @endforeach
                                                </select>
                                                    <span class="text-danger">
                                                    @error('tax_id')
                                                    {{$message}}
                                                    @enderror</span>
                                                </div>

                                                 <div class="col-md-3">

                                                    <label for="is_promo" class="control-label mb-1">IS Promo</label>
                                                    <select id="is_promo" name="is_promo" type="text" class="form-control" required>
                                                        @if ($product->is_promo==1)
                                                        <option selected value="1">Yes</option>
                                                        <option value="2">No</option>
                                                        @else
                                                        <option value="1">Yes</option>
                                                        <option selected value="0">No</option>
                                                        @endif
                                                    </select>
                                                 </div>
                                                 <div class="col-md-3">
                                                    <label for="is_featured" class="control-label mb-1">IS Featured</label>
                                                    <select id="is_featured" name="is_featured" type="text" class="form-control" required>
                                                        @if ($product->is_featured == 1)
                                                        <option selected value="1">Yes</option>
                                                        <option value="0">No</option>
                                                        @else
                                                        <option value="1">Yes</option>
                                                        <option selected value="0">No</option>
                                                        @endif
                                                    </select>
                                                 </div>
                                                 <div class="col-md-3">
                                                    <label for="is_tranding" class="control-label mb-1">IS Tranding</label>
                                                    <select id="is_tranding" name="is_tranding" type="text" class="form-control" required>
                                                        @if ($product->is_tranding==1)
                                                        <option selected value="1">Yes</option>
                                                        <option value="0">No</option>
                                                        @else
                                                        <option value="1">Yes</option>
                                                        <option selected value="0">No</option>
                                                        @endif
                                                    </select>
                                                 </div>
                                                 <div class="col-md-3">
                                                    <label for="is_discounted" class="control-label mb-1">IS Discounted</label>
                                                    <select id="is_discounted" name="is_discounted" type="text" class="form-control" required>
                                                        @if ($product->is_discounted == 1)
                                                        <option selected value="1">Yes</option>
                                                        <option value="0">No</option>
                                                        @else
                                                        <option value="1">Yes</option>
                                                        <option selected value="0">No</option>
                                                        @endif
                                                    </select>
                                                 </div>
                                            </div>
                                        </div>

                        {{-- <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                {{ $button }}
                               </button>
                        </div> --}}

                </div>
            </div>
        </div>
        </div>
        </div>
        {{-- product images --}}
        <h2 class="mb10">Product Images</h2>
        <div class="row mt-4" >
            <div class="col-lg-12"  id="product_img_1">
                <div class="card" >
                  <div class="card-body" >
                    <div class="form-group">
                        <div class="row">
                            @foreach ($productImgArr as $key=>$val )
                            @php
                                 $productImg = (array)$val;

                            @endphp
                            <input id="pimgid" type="hidden" name="pimgid[]" value="{{$productImg['id']}}" >
                            <div class="col-md-4">
                                <label for="images" class="control-label mb-1"></label>
                                <input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false"  >
                                <span class="text-danger">
                                    @error('images')
                                    {{$message}}
                                    @enderror</span>
                                    @if ($productImg['images'] != NULL)
                                    <img width="150px" src="{{ asset('storage/media/'.$productImg['images']) }}" alt="" style="margin-top: 10px">
                                    @endif
                             </div>
                            <div class="col-md-2" style="margin-top: 32px">
                                @if ($key>0)
                                <a href="product_img_delete/{{ $product->id }}/{{$productImg['id']}}">
                                    <button id="payment-button" type="button" class="btn btn-danger btn-md " >
                                        <i class="fa fa-minus"></i>
                                        Remove
                                    </button>
                                </a>

                             @else
                             <button id="payment-button" type="button" class="btn btn-success btn-md " onclick="add_img_more()" >
                                <i class="fa fa-plus"></i>
                                  Add More
                            </button>
                            @endif
                            </div>
                        @endforeach
                        </div>
                  </div>
                </div>
            </div>

            </div>
        </div>
          {{-- product attributes --}}
        <h2 class="mb10">Product Attributes</h2>
        <div class="row mt-4" >
            <div class="col-lg-12"  id="product_attr_1">
                @foreach ($productAttrArr as $key=>$val )
                 @php
                      $productArr = (array)$val;
                 @endphp
                 <input id="paid" type="hidden" name="paid[]" value="{{$productArr['id']}}" >
                <div class="card" >
                  <div class="card-body" >
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="sku" class="control-label mb-1">SKU</label>
                                <input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $productArr['sku'] }}" required>
                                <span class="text-danger">
                                    @error('sku')
                                    {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-md-2">
                                <label for="mrp" class="control-label mb-1">MRP</label>
                                <input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{  $productArr['mrp'] }}" required>
                                <span class="text-danger">
                                    @error('mrp')
                                    {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-md-2">
                                <label for="price" class="control-label mb-1">Price</label>
                                <input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{  $productArr['price'] }}" required>
                                <span class="text-danger">
                                    @error('price')
                                    {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-md-3">
                                <label for="size_id" class="control-label mb-1">Size</label>
                                <select id="size_id" name="size_id[]" type="text" class="form-control" required>
                                    <option value="">Select-Size</option>
                                    @foreach ($sizes as $size)
                                    @if( $productArr['size_id'] == $size->id)
                                       <option selected value="{{ $size->id }}">
                                    @else
                                       <option  value="{{$size->id }}">
                                        @endif
                                        {{ $size->size }}</option>
                                    @endforeach
                                </select>
                                    <span class="text-danger">
                                    @error('size')
                                    {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-md-3">
                                <label for="color_id" class="control-label mb-1">color</label>
                                <select id="color_id" name="color_id[]" type="text" class="form-control" required>
                                    <option value="">Select-Color</option>
                                    @foreach ($colors as $color)
                                    @if( $productArr['color_id'] == $color->id)
                                       <option selected value="{{ $color->id }}">
                                    @else

                                    <option  value="{{$color->id }}">
                                        @endif
                                         {{ $color->color }}</option>
                                    @endforeach
                                </select>
                                    <span class="text-danger">
                                    @error('color')
                                    {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-md-2">
                                <label for="qty" class="control-label mb-1">Qty</label>
                                <input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{  $productArr['qty'] }}" required>
                                <span class="text-danger">
                                    @error('qty')
                                    {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-md-4">
                                <label for="attr_image" class="control-label mb-1">Attribute Image</label>
                                <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false"  >
                                <span class="text-danger">
                                    @error('attr_image')
                                    {{$message}}
                                    @enderror</span>
                                    @if ($productArr['attr_image'] != NULL)
                                    <img width="150px" src="{{ asset('storage/media/'.$productArr['attr_image']) }}" alt="" style="margin-top: 10px">
                                    @endif

                            </div>
                            <div class="col-md-2" style="margin-top: 32px">
                                @if ($key>0)
                                <a href="product_attr_delete/{{ $product->id }}/{{$productArr['id']}}">
                                    <button id="payment-button" type="button" class="btn btn-danger btn-md " >
                                        <i class="fa fa-minus"></i>
                                        Remove
                                    </button>
                                </a>

                             @else
                             <button id="payment-button" type="button" class="btn btn-success btn-md " onclick="addmore()" >
                                <i class="fa fa-plus"></i>
                                Add More
                            </button>
                            @endif
                            </div>
                        </div>
                  </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
        <div class="row mt-4" >
        <div class="col-lg-12">
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                {{ $button }}
               </button>
        </div>
        </div>
        </form>
<script>
    var loop_count = 1;
    function addmore()
    {
        loop_count++;

       var html='<div class="row mt-1" ><div class="col-lg-12" ><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"> <div class="form-group"> <div class="row"><input id="paid" type="hidden" name="paid[]">';
        html+='<div class="col-md-2"><label for="sku" class="control-label mb-1"> SKU</label><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

       html+='<div class="col-md-2"><label for="mrp" class="control-label mb-1"> MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

       html+='<div class="col-md-2"><label for="price" class="control-label mb-1"> Price</label><input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

       var size_id_html = jQuery('#size_id').html();

        size_id_html = size_id_html.replace("selected", " ");

       html+='<div class="col-md-3"><label for="size_id" class="control-label mb-1">Size</label><select id="size_id" name="size_id[]" type="text" class="form-control" >'+size_id_html+' </select></div>';

       var color_id_html = jQuery('#color_id').html();

       color_id_html = color_id_html.replace("selected", " ");

       html+='<div class="col-md-3"><label for="color_id" class="control-label mb-1">Color</label><select id="color_id" name="color_id[]" type="text" class="form-control" >'+color_id_html+' </select></div>';

       html+='<div class="col-md-2"><label for="qty" class="control-label mb-1"> Qty</label><input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

       html+=' <div class="col-md-4"><label for="attr_image" class="control-label mb-1">Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" value="{{ $product->image }}" > </div>';


       html+=' <div class="col-md-2" style="margin-top: 34px"><button id="payment-button" type="button" class="btn btn-danger btn-md " onclick="remove_more('+loop_count+')" ><i class="fa fa-minus"></i> Remove</button></div>';

       html+='</div></div></div></div></div></div>';



           jQuery('#product_attr_1').append(html);
        }

        function remove_more(loop_count)
        {
            jQuery('#product_attr_'+loop_count).remove();
        }
        function add_img_more()
        {
            loop_count++;
            var html = '<div class="row mt-1" ><div class="col-lg-12" ><div class="card" id="product_img_'+loop_count+'"><div class="card-body"> <div class="form-group"> <div class="row"><input id="pimgid" type="hidden" name="pimgid[]">';

            html+=' <div class="col-md-4"><label for="images" class="control-label mb-1">Images</label><input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" ></div>';

            html+=' <div class="col-md-2" style="margin-top: 34px"><button id="payment-button" type="button" class="btn btn-danger btn-md " onclick="remove_img_more('+loop_count+')" ><i class="fa fa-minus"></i> Remove</button>';

            html+='</div></div></div></div></div></div>';

            jQuery('#product_img_1').append(html);
        }
        function remove_img_more(loop_count)
        {
            jQuery('#product_img_'+loop_count).remove();
        }

        CKEDITOR.replace('desc');

</script>
@endsection
