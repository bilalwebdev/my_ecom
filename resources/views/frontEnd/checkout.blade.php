@extends('frontEnd.layout')
@push('title')
    <title>Checkout</title>
@endpush
@section('content')
<section id="aa-catg-head-banner">
    <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Checkout Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li class="active">Checkout</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form id="frmPlaceOrder">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                    @if (!session()->has('FRONT_USER_LOGIN'))
                    <button type="button" class="aa-browse-btn" style="margin-bottom: 10px" data-toggle="modal" data-target="#login-modal">Login</button><br>OR<br>
                    @endif
                  <div class="panel-group" id="accordion">
                    <!-- Coupon section -->
                    <!-- Billing Details -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            User Details
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse in" aria-expanded="true" style="">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="name" placeholder="Name*" value="{{ $customers['name'] }}" required>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="email" name="email" placeholder="Email Address*"  value="{{ $customers['email'] }}" required>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" name="mobile" placeholder="Phone*"  value="{{ $customers['mobile'] }}" required>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3" name="address"  value="{{ $customers['address'] }}" required>Address*</textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="city" placeholder="City / Town*"  value="{{ $customers['city'] }}" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="district" placeholder="District*"  value="{{ $customers['state'] }}" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="zip" placeholder="Postcode / ZIP*"  value="{{ $customers['zip'] }}" required>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="checkout-right">
                  <h4>Order Summary</h4>
                  <div class="aa-order-summary-area">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      @php
                          $t_price = 0;
                      @endphp
                      <tbody>
                          @foreach ( $cart_items as $item)
                          <tr>
                            <td>{{ $item->name }} <strong> x {{ $item->qty }}</strong>
                                <br>
                               <span class="cart-color">{{ $item->color }}</span>
                            </td>

                            <td>RS {{ $item->price * $item->qty }}</td>
                          </tr>
                          @php
                          $t_price = $t_price+$item->qty* $item->price;
                      @endphp
                          @endforeach
                      </tbody>
                      <tfoot>
                        <tr class="hide show_coupon_box">
                          <th>Coupon Code <a href="javascript:void(0)" class="remove-coupon" onclick="removeCouponCode()">Remove</a></th>
                          <td id="coupon_code_name"></td>
                        </tr>
                          <tr>
                            <th>Total</th>
                            <td id="total_price">RS {{ $t_price }}</td>
                          </tr>
                      </tfoot>
                    </table>
                  </div>
                  <h4>Coupon Code</h4>
                  <div class="aa-payment-method coupon-code">
                      <form action="">
                        <input type="text" name="coupon_code" id="coupon_code" class="apply_coupon" placeholder="Coupon*" >
                        <input type="button" value="Apply Coupon" class="aa-browse-btn apply_coupon" onclick="applyCouponCode()">
                        <div id="coupon_code_msg_err"></div>
                        <div id="coupon_code_msg_success"></div>
                      </form>
                  </div>
                  <h4>Payment Method</h4>
                  <div class="aa-payment-method">
                    <label for="cashdelivery"><input type="radio" id="cashdelivery" name="payment_type" value="COD"> Cash on Delivery </label>
                    <label for="jazzcash"><input type="radio" id="jazzcash" name="payment_type" value="Gateway" checked> Via JazzCash </label>
                    <input type="submit" value="Place Order" class="aa-browse-btn" id="btnPlaceOrder">
                  </div>
                </div>
                <div id="order_placed_msg"></div>
              </div>
            </div>
            @csrf
          </form>
         </div>
       </div>
     </div>
   </div>
 </section>
@endsection
