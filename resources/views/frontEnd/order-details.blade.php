@extends('frontEnd.layout')
@push('title')
    <title>My Orders</title>
@endpush
@section('content')
<section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="col-md-6">
                <div class="user-details">
                    <h2>User Details</h2>
                  Name: <span>{{ $order_details[0]->username }}</span>
                  <br>
                  Address: <span>{{ $order_details[0]->address }}</span>
                  <br>
                  City: <span>{{ $order_details[0]->city }}</span>
                  <br>
                  District: <span>{{ $order_details[0]->district }}</span>
                  <br>
                  Zip: <span>{{ $order_details[0]->pin_code }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="order-details">
                    <h2>Order Details</h2>
                  Order Status: <span>{{ $order_details[0]->order_status }}</span>
                  <br>
                  Payment Status: <span>{{ $order_details[0]->payment_status }}</span>
                  <br>
                  Payment Type: <span>{{ $order_details[0]->payment_type }}</span>
                  <br>
                   <?php
                   if($order_details[0]->payment_id)
                   {
                       echo ' Payment ID: '.$order_details[0]->payment_id;
                   }
                    ?>
                    Track Details: <span>{{ $order_details[0]->track_details }}</span>
                    <br>
                </div>
            </div>
            <div class="cart-view-table">
              <form action="">
                  @if(isset($order_details[0]))
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th>Product</th>
                         <th>Image</th>
                         <th>Size</th>
                         <th>Color</th>
                         <th>Price</th>
                         <th>Qty</th>
                         <th>Total</th>
                       </tr>
                     </thead>
                     <tbody>
                         @php
                             $total=0;
                         @endphp
                         @foreach ($order_details as $data)
                            <td>{{ $data->name }}</td>
                            <td><a href="{{ url('product/'.$data->slug) }}"><img src="{{ url('storage/media/'.$data->image) }}" alt="img"></a></td>
                            <td>{{ $data->size }}</td>
                            <td>{{ $data->color }}</td>
                            <td>{{ $data->price }}</td>
                            <td>{{ $data->qty }}</td>
                            <td>Rs {{ $data->price*$data->qty }}</td>
                          </tr>
                          @php
                              $total+=$data->price*$data->qty;
                          @endphp
                         @endforeach
                       </tbody>
                   </table>
                 </div>
              </form>
              <div class="cart-view-total">
                <table class="aa-totals-table">
                  <tbody>
                    <tr>
                      <th>Total</th>
                      <td>{{ $total }}</td>
                    </tr>
                    @php
                        if($order_details[0]->coupon_value>0)
                        {
                            echo ' <tr>
                           <th>Coupon<span class="coupon-msg">('.$order_details[0]->coupon_code.')</span></th>
                           <td> - '.$order_details[0]->coupon_value.'</td>
                           </tr>';

                        $total-=$order_details[0]->coupon_value;
                        echo ' <tr>
                           <th>Final Total</th>
                           <td>'.$total.'</td>
                           </tr>';
                        }
                    @endphp
                  </tbody>
                </table>
              </div>
              <!-- Cart Total view -->
              @else
              <div class="row order-placed" >

                <h2>You have not ordered yet :(</h2>
            </div>
             @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
