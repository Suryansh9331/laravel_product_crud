@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-5 text-center">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-height: 300px;">
                @else
                    <p class="text-muted">No Image Available</p>
                @endif
            </div>

            <!-- Product Details -->
            <div class="col-md-7">
                <h1 class="mb-3 text-primary">#{{ $product->name }}</h1>
                <p class="text-muted">{{ $product->description }}</p>
                <h4 class="text-danger">Price: ₹{{ $product->price }}</h4>

                @if($product->discount_price)
                    <h5 class="text-success">Discount Price: ₹{{ $product->discount_price }}</h5>
                @endif

                <p class="fw-bold">Available Quantity: <span class="badge bg-secondary">{{ $product->quantity }}</span></p>

                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">⬅ Back to Products</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


