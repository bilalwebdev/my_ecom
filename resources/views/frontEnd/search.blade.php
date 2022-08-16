@extends('frontEnd.layout')
@push('title')
    <title>Search</title>
@endpush
@section('content')
    <section id="aa-product-category">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-8">
                    <div class="aa-product-catg-content">
                        <div class="aa-product-catg-body">
                            <ul class="aa-product-catg">
                                <!-- start single product item -->
                                @if ($products)
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
                                                </figcaption>
                                            </figure>
                                            <!-- product badge -->
                                            <span class="aa-badge aa-sale" href="#">SALE!</span>
                                        </li>
                                    @endforeach
                                @else
                                    No data found
                                @endif

                            </ul>
                        </div>
                        <div class="aa-product-catg-pagination">
                            <nav>
                                <ul class="pagination">
                                    <li>
                                        <a href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li>
                                        <a href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>


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
@endsection
