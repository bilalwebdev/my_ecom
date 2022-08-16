@extends('frontEnd.layout')
@push('title')
    <title>
        {{ $product[0]->name }}
    </title>
@endpush
@section('content')
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        {{-- <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img"> --}}
        <div class="aa-catg-head-banner-area">
            {{-- <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>T-Shirt</h2>
         <ol class="breadcrumb">
           <li><a href="index.html">Home</a></li>
           <li><a href="#">Product</a></li>
           <li class="active">T-shirt</li>
         </ol>
       </div>
      </div> --}}
        </div>
    </section>
    <!-- / catg header banner section -->

    <!-- product category -->
    <section id="aa-product-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-product-details-area">
                        <div class="aa-product-details-content">
                            <div class="row">
                                <!-- Modal view slider -->
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class="aa-product-view-slider">
                                        <div id="demo-1" class="simpleLens-gallery-container">
                                            <div class="simpleLens-container">
                                                <div class="simpleLens-big-image-container"><a
                                                        data-lens-image="{{ asset('storage/media/' . $product[0]->image) }}"
                                                        class="simpleLens-lens-image"><img
                                                            src="{{ url('storage/media/' . $product[0]->image) }}"
                                                            style="background-color: gray"></a></div>
                                            </div>
                                            <div class="simpleLens-thumbnails-container">
                                                <a data-big-image="{{ asset('storage/media/' . $product[0]->image) }}"
                                                    data-lens-image="{{ asset('storage/media/' . $product[0]->image) }}"
                                                    class="simpleLens-thumbnail-wrapper" href="#"><img
                                                        src="{{ asset('storage/media/' . $product[0]->image) }}"
                                                        width="70px">
                                                </a>
                                                @if (isset($product_images[$product[0]->id][0]))
                                                    @foreach ($product_images[$product[0]->id] as $list)
                                                        <a data-big-image="{{ asset('storage/media/' . $list->images) }}"
                                                            data-lens-image="{{ asset('storage/media/' . $list->images) }}"
                                                            class="simpleLens-thumbnail-wrapper" href="#"><img
                                                                src="{{ asset('storage/media/' . $list->images) }}"
                                                                width="70px">
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal view content -->
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="aa-product-view-content">
                                        <h3>{{ $product[0]->name }}</h3>
                                        <div class="aa-price-block">
                                            <span class="aa-product-view-price"><del>Rs
                                                    {{ $product_attr[$product[0]->id][0]->mrp }}</del></span>
                                            <span class="aa-product-view-price">Rs
                                                {{ $product_attr[$product[0]->id][0]->price }}</span>
                                            <p>{!! $product[0]->short_desc !!}</p>
                                            @if ($product_attr[$product[0]->id][0]->size_id > 0)
                                            <h4>Size</h4>
                                            <div class="aa-prod-view-size">
                                                @php
                                                    foreach ($product_attr[$product[0]->id] as $attr) {
                                                        $product_sizes[] = $attr->size;
                                                    }
                                                    $product_sizes = array_unique($product_sizes);
                                                @endphp
                                                @foreach ($product_sizes as $size_list)
                                                    <a href="javascript:void(0)" onclick="showColor('{{ $size_list }}')"
                                                        id="size_{{ $size_list }}"
                                                        class="size_link">{{ $size_list }}</a>
                                                @endforeach
                                            </div>
                                            @endif
                                            @if ($product_attr[$product[0]->id][0]->color_id)
                                            <h4>Color</h4>
                                            <div class="aa-color-tag">
                                                @foreach ($product_attr[$product[0]->id] as $attr)
                                                    <a href="javascript:void(0)"
                                                        class="aa-color-{{ strtolower($attr->color) }} product_color size_{{ $attr->size }}"
                                                        onclick=change_product_image("{{ asset('storage/media/' . $attr->attr_image) }}","{{ $attr->color }}")></a>
                                                @endforeach
                                            </div>
                                            @endif
                                            <div class="aa-prod-quantity">
                                                <form action="">
                                                    <select id="qty" name="">
                                                        @for ($i = 1; $i <= 10; $i++)
                                                            <option value="{{ $i }}">{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </form>
                                                <p class="aa-prod-category">
                                                    Model: <a href="#">{{ $product[0]->model }}</a>
                                                </p>
                                                <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                                                @if ($product[0]->lead_time != null)
                                                    <p class="aa-product-delivery" style="margin-top: -10px;">Delivery Time:
                                                        <span
                                                            style="color: red;font-size: 14px; font-weight: bold;">{{ $product[0]->lead_time }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="aa-prod-view-bottom">
                                            <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="add_to_cart( '{{ $product[0]->id }}', '{{ $product_attr[$product[0]->id][0]->size_id }}',
                                             {{ $product_attr[$product[0]->id][0]->color_id }})">Add To Cart</a>
                                            {{-- <a class="aa-add-to-cart-btn" href="#">Wishlist</a>
                                            <a class="aa-add-to-cart-btn" href="#">Compare</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="aa-product-details-bottom">
                            <ul class="nav nav-tabs" id="myTab2">
                                <li class="active"><a href="#description" data-toggle="tab" aria-expanded="true">Description</a></li>
                                <li><a href="#tech" data-toggle="tab">Technical Specifications</a></li>
                                <li><a href="#uses" data-toggle="tab">Uses</a></li>
                                <li><a href="#warranty" data-toggle="tab">Warranty</a></li>
                                <li><a href="#review" data-toggle="tab">Reviews</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="description">
                                    {!!  $product[0]->desc !!}
                                </div>
                                    <div class="tab-pane fade" id="tech">
                                        {!! $product[0]->technical_specifications !!}
                                    </div>
                                    <div class="tab-pane fade" id="uses">
                                        {!! $product[0]->uses !!}
                                    </div>
                                    <div class="tab-pane fade" id="warranty">
                                        {!! $product[0]->warranty !!}
                                    </div>
                                    <div class="tab-pane fade" id="review">
                                        <div class="aa-product-review-area">
                                            @if(isset($product_reviews[0]))
                                            <h4>@php
                                                echo count($product_reviews)
                                            @endphp
                                                Review(S) for {{  $product[0]->name  }}</h4>
                                            @foreach ($product_reviews as $review)
                                            <ul class="aa-review-nav">
                                                <li>
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><strong>{{ $review->name }}</strong> -
                                                                <span>{{ \Carbon\Carbon::parse($review->added_on)->format('M-d-Y') }}</span></h4>
                                                                <div class="aa-product-rating">
                                                                    <span class="rating_txt">{{ $review->rating }}</span>
                                                                </div>
                                                            <p>{{ $review->review }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @endforeach
                                            @else
                                            <h2>No reviews yet!</h2>
                                            @endif
                                            <h4>Add a review</h4>

                                            <!-- review form -->
                                            <form class="aa-review-form" id="frmProductReview">
                                                <div class="aa-your-rating" style="margin-bottom: 15px">
                                                    <p>Your Rating</p>
                                                    <select name="rating" id="" class="form-control " required>
                                                        <option value="">--Select Rating--</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Very Good">Very Good</option>
                                                        <option value="Fantastic">Fantastic</option>
                                                        <option value="Bad">Bad</option>
                                                        <option value="Worst">Worst</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message">Your Review</label>
                                                    <textarea class="form-control" name="review" rows="3" id="message" required></textarea>
                                                </div>
                                                <input type="hidden" name="product_id" id="" value="{{ $product[0]->id }}">
                                                <button type="submit"   class="btn btn-default aa-review-submit">Submit</button>
                                                    @csrf
                                            </form>
                                            <div class="review-msg"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Related product -->
                        <div class="aa-product-related-item">
                            <h3 style="text-align: center">Related Products</h3>
                            <hr>
                            <ul class="aa-product-catg aa-related-item-slider">
                                <!-- start single product item -->
                                @if (isset($related_product))
                                    @foreach ($related_product as $product)
                                        <li>
                                            <figure>
                                                <a class="aa-product-img"
                                                    href="{{ url('product/' . $product->slug) }}"><img
                                                        src="{{ url('storage/media/' . $product->image) }}"
                                                        alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn"href="#"><span
                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a
                                                            href="#">{{ $product->name }}</a></h4>
                                                    <span class="aa-product-price">&nbsp;<del>
                                                            Rs{{ $related_product_attr[$product->id][0]->mrp }}</del></span>
                                                    <span
                                                        class="aa-product-price">Rs{{ $related_product_attr[$product->id][0]->price }}
                                                    </span>
                                                </figcaption>
                                            </figure>
                                        </li>
                                    @endforeach
                                @else
                                    <li>
                                        <div class="alert alert-info" role="alert" style="justify-content: center">
                                            No product in category this yet!
                                        </div>
                                    </li>
                                @endif
                                <!-- start single product item -->
                                {{-- <li>
                   <figure>
                     <a class="aa-product-img" href="#"><img src="img/women/girl-2.png" alt="polo shirt img"></a>
                     <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                       <h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
                       <span class="aa-product-price">$45.50</span>
                     </figcaption>
                   </figure>
                   <div class="aa-product-hvr-content">
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                     <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                   </div>
                   <!-- product badge -->
                    <span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
                 </li>
                 <!-- start single product item -->
                 <li>
                   <figure>
                     <a class="aa-product-img" href="#"><img src="img/man/t-shirt-1.png" alt="polo shirt img"></a>
                     <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                   </figure>
                   <figcaption>
                     <h4 class="aa-product-title"><a href="#">T-Shirt</a></h4>
                     <span class="aa-product-price">$45.50</span>
                   </figcaption>
                   <div class="aa-product-hvr-content">
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                     <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                   </div>
                   <!-- product badge -->
                    <span class="aa-badge aa-hot" href="#">HOT!</span>
                 </li>
                 <!-- start single product item -->
                 <li>
                   <figure>
                     <a class="aa-product-img" href="#"><img src="img/women/girl-3.png" alt="polo shirt img"></a>
                     <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                      <figcaption>
                       <h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
                       <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                     </figcaption>
                   </figure>
                   <div class="aa-product-hvr-content">
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                     <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                   </div>
                 </li>
                 <!-- start single product item -->
                 <li>
                   <figure>
                     <a class="aa-product-img" href="#"><img src="img/man/polo-shirt-1.png" alt="polo shirt img"></a>
                     <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                       <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                       <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                     </figcaption>
                   </figure>
                   <div class="aa-product-hvr-content">
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                     <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                   </div>
                 </li>
                 <!-- start single product item -->
                 <li>
                   <figure> --}}
                                {{-- <a class="aa-product-img" href="#"><img src="img/women/girl-4.png" alt="polo shirt img"></a>
                     <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                       <h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
                       <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                     </figcaption>
                   </figure>
                   <div class="aa-product-hvr-content">
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                     <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                   </div>
                   <!-- product badge -->
                   <span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
                 </li>
                 <!-- start single product item -->
                 <li>
                   <figure>
                     <a class="aa-product-img" href="#"><img src="img/man/polo-shirt-4.png" alt="polo shirt img"></a>
                     <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                      <figcaption>
                       <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                       <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                     </figcaption>
                   </figure>
                   <div class="aa-product-hvr-content">
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                     <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                   </div>
                   <!-- product badge -->
                   <span class="aa-badge aa-hot" href="#">HOT!</span>
                 </li>
                 <!-- start single product item -->
                 <li>
                   <figure>
                     <a class="aa-product-img" href="#"><img src="img/women/girl-1.png" alt="polo shirt img"></a>
                     <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                      <figcaption>
                       <h4 class="aa-product-title"><a href="#">This is Title</a></h4>
                       <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                     </figcaption>
                   </figure>
                   <div class="aa-product-hvr-content">
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                     <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                     <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                   </div>
                   <!-- product badge -->
                   <span class="aa-badge aa-sale" href="#">SALE!</span>
                 </li> --}}
                            </ul>
                           
                            <!-- / quick view modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / product category -->


    <!-- Subscribe section -->
    <section id="aa-subscribe">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-subscribe-area">
                        <h3>Subscribe our newsletter </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
                        <form action="" class="aa-subscribe-form">
                            <input type="email" name="" id="" placeholder="Enter your Email">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form  id="frmAddToCart">
        @csrf
        <input type="hidden" id="size_id" name="size">
        <input type="hidden" id="color_id" name="color">
        <input type="hidden" id="pqty" name="pqty">
        <input type="hidden" id="product_id" name="product_id">
    </form>
@endsection

