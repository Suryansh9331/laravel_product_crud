


@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-primary mb-4 text-center">&#x1F4E6; All Products</h1> {{-- 📦 Emoji for Box --}}

        @if ($message = session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden h-100">
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}"
                            style="height: 220px; object-fit: cover;">

                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                            <p class="card-text text-muted flex-grow-1" style="max-height: 60px; overflow: hidden;">
                                {{ Str::limit($product->description, 80) }}
                            </p>

                            <p class="text-success fw-bold mb-1">Price: ₹{{ number_format($product->price, 2) }}</p>
                            <p class="text-danger fw-bold">Discount: ₹{{ number_format($product->discount_price, 2) }}</p>

                            <div class="mt-auto d-flex justify-content-center gap-2">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-info btn-sm px-3">
                                    &#x1F441; View 
                                </a>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm px-3">
                                        &#x1F6D2; Add to Cart 
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <style>
        .card {
            height: 100%; /* Ensures all cards have equal height */
            display: flex;
            flex-direction: column;
        }
        .card-body {
            flex-grow: 1; /* Ensures content adjusts dynamically */
            display: flex;
            flex-direction: column;
        }
        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection


