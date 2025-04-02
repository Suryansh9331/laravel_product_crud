@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-primary mb-4">  &#128220; Order Summary</h1>

    <div class="card p-4 shadow-lg">
        <h3>Subtotal: ₹{{ number_format($subtotal, 2) }}</h3>
        <h4>Shipping Charge: ₹{{ number_format($shipping, 2) }}</h4>
        <h2>Total Amount: ₹{{ number_format($total, 2) }}</h2>

        <h4 class="mt-4"> Order Items:</h4>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td><img src="{{ asset($item->product->image) }}" width="50"></td>
                        <td>₹{{ number_format($item->product->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('order.place') }}" method="POST">
            @csrf
            <input type="hidden" name="total" value ="{{$total}}">
            <button type="submit" class="btn btn-success mt-3"> Confirm & Place Order</button>
        </form>
    </div>
</div>
@endsection
