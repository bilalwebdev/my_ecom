@extends('frontEnd.layout')
@push('title')
    <title>Category</title>
@endpush
@section('content')
    <!-- catg header banner section -->
    {{-- <section id="aa-catg-head-banner">
    <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>Fashion</h2>
         <ol class="breadcrumb">
           <li><a href="index.html">Home</a></li>
           <li class="active">Women</li>
         </ol>
       </div>
      </div>
    </div>
   </section> --}}
    <!-- / catg header banner section -->

    <!-- product category -->
    <section id="aa-product-category">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
                    <div class="aa-product-catg-content">
                        <div class="aa-product-catg-head">
                            <div class="aa-product-catg-head-left">
                                <form action="" class="aa-sort-form">
                                    <label for="">Sort by</label>
                                    <select name="" onchange="sort()" id="sort_by">
                                        <option value="1" selected="Default">Default</option>
                                        <option value="name">Name</option>
                                        <option value="price_asc">Price - Asc</option>
                                        <option value="price_desc">Price - Desc</option>
                                        <option value="date">Date</option>
                                    </select>
                                </form>
                            </div>
                            <div class="aa-product-catg-head-right">
                                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                                <a id="list-catg" href="#" onclick="listAlign()"><span class="fa fa-list"></span></a>
                            </div>
                        </div>
                        <div class="aa-product-catg-body">
                            <ul class="aa-product-catg">
                                <!-- start single product item -->

                                @if (isset($products[0]))
                                    @foreach ($products as $cat_product)
                                        <li>
                                            <figure>
                                                <a class="aa-product-img"
                                                    href="{{ url('product/' . $cat_product->slug) }}"><img
                                                        src="{{ asset('storage/media/' . $cat_product->image) }}"
                                                        alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn"href="javascript:void(0)"
                                                    onclick="home_add_to_cart('{{ $cat_product->id }}', '{{ $category_product_attr[$cat_product->id][0]->size }}', '{{ $category_product_attr[$cat_product->id][0]->color }}')"><span
                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a
                                                            href="{{ url('product/' . $cat_product->slug) }}">{{ $cat_product->name }}</a>
                                                    </h4>
                                                    <span class="aa-product-price">Rs
                                                        {{ $category_product_attr[$cat_product->id][0]->price }}</span><span
                                                        class="aa-product-price"><del>{{ $category_product_attr[$cat_product->id][0]->mrp }}</del></span>
                                                        <span  class="aa-product-descrip hide_desc" id="pro_desc">{!! $cat_product->short_desc !!}</span>
                                                </figcaption>
                                            </figure>
                                            <!-- product badge -->
                                            {{-- <span class="aa-badge aa-sale" href="#">SALE!</span> --}}
                                        </li>
                                    @endforeach
                                @else
                                <div class="alert alert-info ml-4" role="alert" style="justify-content: center">
                                    No product in category this yet!
                                </div>
                                @endif

                            </ul>

                        </div>
                        <div class="aa-product-catg-pagination">
                            <nav>
                                <ul class="pagination">
                                    {{ $products->links('pagination::bootstrap-4') }}
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
                    <aside class="aa-sidebar">
                        <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Category</h3>
                            <ul class="aa-catg-nav">
                                @foreach ($categories as $category)
                                    @if ($slug == $category->category_slug)
                                        <li><a href="{{ url('category/' . $category->category_slug) }}"
                                                class="active-category">{{ $category->category_name }}</a></li>
                                    @else
                                        <li><a
                                                href="{{ url('category/' . $category->category_slug) }}">{{ $category->category_name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <!-- single sidebar -->

                        <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Shop By Price</h3>
                            <!-- price range -->
                            <div class="aa-sidebar-price-range">
                                <form action="">
                                    <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                                    </div>
                                    <span id="skip-value-lower" class="example-val">200.00</span>
                                    <span id="skip-value-upper" class="example-val">1000.00</span>
                                    <button class="aa-filter-btn" type="button" onclick="price_filter()">Filter</button>
                                </form>
                            </div>

                        </div>
                        <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Shop By Color</h3>
                            <div class="aa-color-tag">
                                @foreach ($colors as $color)
                                    @if (in_array($color->id, $colorFilterArr))
                                        <a class="aa-color-{{ strtolower($color->color) }} active-color" id="clr"
                                            href="javascript:void(0)"
                                            onclick="color_filter('{{ $color->id }}', '1')"></a>
                                    @else
                                        <a class="aa-color-{{ strtolower($color->color) }} " href="javascript:void(0)"
                                            onclick="color_filter('{{ $color->id }}', '0')"></a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <!-- single sidebar -->
                        {{-- <div class="aa-sidebar-widget">
               <h3>Recently Views</h3>
               <div class="aa-recently-views">
                 <ul>
                   <li>
                     <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                     <div class="aa-cartbox-info">
                       <h4><a href="#">Product Name</a></h4>
                       <p>1 x $250</p>
                     </div>
                   </li>
                   <li>
                     <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                     <div class="aa-cartbox-info">
                       <h4><a href="#">Product Name</a></h4>
                       <p>1 x $250</p>
                     </div>
                   </li>
                    <li>
                     <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                     <div class="aa-cartbox-info">
                       <h4><a href="#">Product Name</a></h4>
                       <p>1 x $250</p>
                     </div>
                   </li>
                 </ul>
               </div>
             </div>
             <!-- single sidebar -->
             <div class="aa-sidebar-widget">
               <h3>Top Rated Products</h3>
               <div class="aa-recently-views">
                 <ul>
                   <li>
                     <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                     <div class="aa-cartbox-info">
                       <h4><a href="#">Product Name</a></h4>
                       <p>1 x $250</p>
                     </div>
                   </li>
                   <li>
                     <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                     <div class="aa-cartbox-info">
                       <h4><a href="#">Product Name</a></h4>
                       <p>1 x $250</p>
                     </div>
                   </li>
                    <li>
                     <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                     <div class="aa-cartbox-info">
                       <h4><a href="#">Product Name</a></h4>
                       <p>1 x $250</p>
                     </div>
                   </li>
                 </ul>
               </div>
             </div> --}}
                    </aside>
                </div>

            </div>
        </div>
    </section>
    <input type="hidden" id="qty" name="qty" value="1">
    {{-- <input type="hidden" id="slug" name="qty" value="{{ $slug }}"> --}}
    <form id="frmAddToCart">
        @csrf
        <input type="hidden" id="size_id" name="size">
        <input type="hidden" id="color_id" name="color">
        <input type="hidden" id="pqty" name="pqty">
        <input type="hidden" id="product_id" name="product_id">
    </form>
    <form id="categoryFilter">
        <input type="hidden" id="sort" name="sort">
    </form>
    <form id="priceFilter">
        <input type="hidden" id="min_price" name="min_price" value="{{ $min_price }}">
        <input type="hidden" id="max_price" name="max_price" value="{{ $max_price }}">
    </form>
    <form id="colorFilter">
        <input type="hidden" id="pro_color_id" name="pro_color_id" value="{{ $color_val }}">
    </form>
@endsection
