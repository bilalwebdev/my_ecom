@extends('frontEnd.layout')
@push('title')
    <title>Order Placed</title>
@endpush
@section('content')
    <section>
        <div class="container">
            <div class="row order-placed" >

                <h2>You order has placed successfully :)</h2>
                <h3>You order id is: #{{ session()->get('ORDER_ID') }}</h3>
            </div>
        </div>
    </section>

@endsection
