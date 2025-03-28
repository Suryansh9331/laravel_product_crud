

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-primary mb-4">Order #{{ $order->id }}</h1>

        <h3>Total Price: ₹{{ number_format($order->total_price, 2) }}</h3>
        <h4>Status: {{ $order->status }}</h4>

        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>
                            <a href="{{ route('products.show', $item->product->id) }}" class="text-decoration-none">
                                {{ $item->product->name }}
                            </a>
                        </td>
                        <td><img src="{{ asset($item->product->image) }}" width="50"></td>
                        <td>₹{{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('products.index') }}" class="btn btn-success mt-3">Go to Home</a>
    </div>
@endsection
