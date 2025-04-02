


@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">&#128722; My Cart</h1>

        @if(session('message'))
            <div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show text-center" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <script>
            // Auto-hide alert messages after 3 seconds
            setTimeout(function() {
                let alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    alert.style.transition = "opacity 0.5s";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 500);
                });
            }, 2000);
        </script>

        @if($cartItems->count() > 0)
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $subtotal = 0; @endphp
                    @foreach ($cartItems as $item)
                        @php 
                            $productTotal = $item->quantity * $item->product->price;
                            $subtotal += $productTotal;
                        @endphp
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>₹{{ number_format($item->product->price, 2) }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="type" value="decreament">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-primary btn-sm">-</button>
                                    </form>

                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                        class="form-control text-center mx-2 w-25" readonly>

                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="type" value="increament">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-primary btn-sm">+</button>
                                    </form>
                                </div>
                            </td>
                            <td>₹{{ number_format($productTotal, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @php 
                $shipping = 50; // Flat shipping charge
                $total = $subtotal + $shipping;
            @endphp

            <div class="card p-3 shadow-lg">
                <h4>Subtotal: ₹{{ number_format($subtotal, 2) }}</h4>
                <h5>Shipping Charge: ₹{{ number_format($shipping, 2) }}</h5>
                <h3>Total Amount: ₹{{ number_format($total, 2) }}</h3>
                <a href="{{ route('order.summary') }}" class="btn btn-success mt-3">Proceed to Checkout</a>
            </div>

        @else
            <p class="text-center">Your cart is empty.</p>
        @endif
    </div>
@endsection
