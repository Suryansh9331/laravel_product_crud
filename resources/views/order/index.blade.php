@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-primary mb-4">&#128220; My Orders</h1>

    @if($orders->count() > 0)
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>₹{{ number_format($order->total_price, 2) }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        
                        <td>
                            <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center">No orders placed yet.</p>
    @endif
</div>
@endsection
