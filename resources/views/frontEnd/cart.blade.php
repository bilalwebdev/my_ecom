@extends('frontEnd.layout')
@push('title')
    <title>Cart</title>
@endpush
@section('content')
<section id="aa-catg-head-banner">
    <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>Cart Page</h2>
         <ol class="breadcrumb">
           <li><a href="index.html">Home</a></li>
           <li class="active">Cart</li>
         </ol>
       </div>
      </div>
    </div>
   </section>
   <!-- / catg header banner section -->

  <!-- Cart view section -->
  <section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table">
              <form action="">
                  @if(isset($cart_data[0]))
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th></th>
                         <th></th>
                         <th>Product</th>
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Total</th>
                       </tr>
                     </thead>
                     <tbody>
                         @php
                            $total=0;
                         @endphp
                         @foreach ($cart_data as $data)
                         <tr id="cart_box{{ $data->attr_id }}">
                            <td><a class="remove" href="javascript:void(0)" onclick="deleteCartProduct('{{ $data->pid }}', '{{ $data->size }}', '{{ $data->color }}' ,'{{ $data->attr_id }}')"><fa class="fa fa-close"></fa></a></td>
                            <td><a href="{{ url('product/'.$data->slug) }}"><img src="{{ url('storage/media/'.$data->image) }}" alt="img"></a></td>
                            <td><a class="aa-cart-title" href="{{ url('product/'.$data->slug) }}">{{ $data->name }}</a>
                                <br>
                                <span class="">{{ $data->color }}</span>
                                <br>
                                <span class="">{{ $data->size }}</span>
                            </td>
                            <td>Rs {{ $data->price }}</td>
                            <td><input class="aa-cart-quantity" type="number" id="qty{{ $data->attr_id }}" value="{{ $data->qty }}" onchange="updateQty('{{ $data->pid }}', '{{ $data->size }}', '{{ $data->color }}' ,'{{ $data->attr_id }}', '{{ $data->price }}')"></td>
                            <td id="total_price_{{ $data->attr_id }}">Rs {{ $data->price*$data->qty }}</td>
                          </tr>
                          @php
                            $total+=$data->price*$data->qty;
                          @endphp
                         @endforeach
                       {{-- <tr>
                         <td colspan="6" class="aa-cart-view-bottom">
                           <div class="aa-cart-coupon">
                             <input class="aa-coupon-code" type="text" placeholder="Coupon">
                             <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                           </div>
                           <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                         </td>
                       </tr> --}}
                       </tbody>
                   </table>
                 </div>
              </form>
              <!-- Cart Total view -->
              <div class="cart-view-total">
                <a href="{{ url('/checkout') }}" class="aa-cart-view-btn">Proced to Checkout</a>
              </div>
              @else
              <div class="row order-placed" >

                <h2>Your cart is empty :(</h2>
            </div>
             @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <input type="hidden" id="qty" name="qty" value="1">
  <form  id="frmAddToCart">
    @csrf
    <input type="hidden" id="size_id" name="size">
    <input type="hidden" id="color_id" name="color">
    <input type="hidden" id="pqty" name="pqty">
    <input type="hidden" id="product_id" name="product_id">
</form>
@endsection
