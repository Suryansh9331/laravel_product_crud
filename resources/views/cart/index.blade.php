@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-4">Your Cart</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>₹{{ number_format($item->price, 2) }}</td>
                        <td>
                             
                                    <div class="d-flex">
                                        
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="type" value="decreament">
                                        <input type="hidden" name="quantity" value="1">
            
                                        <button type="submit" class="btn btn-primary btn-sm">-</button>
                                    </form>

                                        <input type="number" name="quantity" value="{{ $item->quantity }}"min="1">
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="type" value="increament">
                                        <input type="hidden" name="quantity" value="1">
            
                                        <button type="submit" class="btn btn-primary btn-sm">+</button>
                                    </form>
                                </div>


                        </td>
                        <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
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
        {{-- <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a> --}}
    </div>
@endsection
