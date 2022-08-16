@extends('frontEnd.layout')
@push('title')
    <title>My Orders</title>
@endpush
@section('content')
<section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="">
          <div class="cart-view-area">
            <div class="cart-view-table">
              <form action="">
                  @if(isset($orders[0]))
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th>Order ID</th>
                         <th>Status</th>
                         <th>Total Amount</th>
                         <th>Payment Type</th>
                         <th>Payment Status</th>
                         <th >Placed on</th>

                       </tr>
                     </thead>
                     <tbody>
                         @foreach ($orders as $data)
                         <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->order_status }}</td>
                            <td>Rs {{ $data->total_amt }}</td>
                            <td>{{ $data->payment_type }}</td>
                            <td>{{ $data->payment_status }}</td>
                            <td>{{ $data->added_on }}</td>
                            <td><a href="{{ url('order-detail/'.$data->id) }}"><span class="btn btn-primary">View Details</span></a></td>
                          </tr>
                         @endforeach
                       </tbody>
                   </table>
                 </div>
              </form>
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
