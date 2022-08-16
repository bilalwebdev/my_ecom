@extends('admin.layout')
@section('order', 'active')
@push('title')
    <title>Orders</title>
@endpush
@section('content')
    <h1>Order # {{ $order_details[0]->order_id  }}</h1>
    <div class="order-operation">
        <strong>Update Order Status</strong>
        <select name="order_status" id="order_status" class="form-control m-b-10" onchange="updateOrderStatus({{ $order_details[0]->id }})">
            <option value="0">--Select--</option>
            @foreach ($order_status as $status)
            @if ($order_details[0]->order_status == $status)
            <option value="{{ $status }}" selected>{{ $status }}</option>
            @else
            <option value="{{ $status }}">{{ $status }}</option>
            @endif
            @endforeach
        </select>
        <strong>Update Payment Status</strong>
        <select name="payment_status" id="payment_status" class="form-control m-b-10" onchange="updatePaymentStatus({{ $order_details[0]->id }})">
            <option value="0">--Select--</option>
            @foreach ($payment_status as $status)
            @if ($order_details[0]->payment_status == $status)
            <option value="{{ $status }}" selected>{{ $status }}</option>
            @else
            <option value="{{ $status }}">{{ $status }}</option>
            @endif
            @endforeach
        </select>
        <strong>Track Details</strong>
        <form method="post">
            @csrf
            <textarea name="track_details" id=""  rows="4" class="form-control">{{ $order_details[0]->track_details }}</textarea>
            <button type="submit"  class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
    <div class="row m-t-30">
                <div class="col-md-6 card">
                    <div class="user-details mb-4 mt-4">
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
                <div class="col-md-6 card">
                    <div class="order-details mb-4 mt-4">
                        <h2>Order Details</h2>
                        Order Status: <span>{{ $order_details[0]->order_status }}</span>
                        <br>
                        Payment Status: <span>{{ $order_details[0]->payment_status }}</span>
                        <br>
                        Payment Type: <span>{{ $order_details[0]->payment_type }}</span>
                        <br>
                        <?php
                        if ($order_details[0]->payment_id) {
                            echo ' Payment ID: ' . $order_details[0]->payment_id;
                        }
                        ?>
                    </div>
                </div>
            <div class="cart-view-table card col-md-12">
                    @if (isset($order_details[0]))
                        <div class="table-responsive">
                            <table class="table product">
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
                                        $total = 0;
                                    @endphp
                                    @foreach ($order_details as $data)
                                        <td>{{ $data->name }}</td>
                                        <td><a href="{{ url('product/' . $data->slug) }}"><img
                                                    src="{{ url('storage/media/' . $data->image) }}" alt="img"></a>
                                        </td>
                                        <td>{{ $data->size }}</td>
                                        <td>{{ $data->color }}</td>
                                        <td>{{ $data->price }}</td>
                                        <td>{{ $data->qty }}</td>
                                        <td>Rs {{ $data->price * $data->qty }}</td>
                                        </tr>
                                        @php
                                            $total += $data->price * $data->qty;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="cart-view-total">
                            <table class="aa-totals-table">
                        <tbody>
                            <tr>
                                <th>Total : - &nbsp;&nbsp;&nbsp;</th>
                                <td class="m-r-10">Rs {{ $total }}</td>
                            </tr>
                            @php
                                if ($order_details[0]->coupon_value > 0) {
                                    echo ' <tr>
                             <th>Coupon<span class="coupon-msg">(' .
                                        $order_details[0]->coupon_code .
                                        ') &nbsp;&nbsp;&nbsp;</span></th>
                             <td> Rs ' .
                                        $order_details[0]->coupon_value .
                                        '</td>
                             </tr>';

                                    $total -= $order_details[0]->coupon_value;
                                    echo ' <tr>
                             <th>Final Total &nbsp;&nbsp;&nbsp;</th>
                             <td> Rs ' .
                                        $total .
                                        '</td>
                             </tr>';
                                }
                            @endphp
                        </tbody>
                    </table>
                </div>
                @endif

                <hr>

            </div>
        </div>
    </div>

@endsection
