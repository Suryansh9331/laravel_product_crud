{{-- @extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-primary">&#x1F4E6; All Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-success">&#x2795; Add Product</a>
    </div>

    @if ($message = session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Discount Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td class="text-success fw-bold">₹{{ number_format($product->price, 2) }}</td>
                            <td><span class="badge bg-secondary">{{ $product->quantity }}</span></td>
                            <td class="text-danger fw-bold">₹{{ number_format($product->discount_price, 2) }}</td>
                            <td>
                                @if ($product->image)
                                    <img src="{{ asset($product->image) }}" class="rounded" width="50" height="50">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">&#x1F441; View</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">&#x270F; Edit</a>
                                <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">&#x1F5D1; Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection --}}



@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-primary mb-4">📦 All Products</h1>
        @if ($message = session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg">
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}"
                            style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>

                            <p class="text-success fw-bold">Price: ₹{{ number_format($product->price, 2) }}</p>
                            <p class="text-danger fw-bold">Discount: ₹{{ number_format($product->discount_price, 2) }}</p>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">👁 View</a>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    {{-- <input type="number" name="quantity" value="1" min="1" class="form-control"> --}}
                                    <button type="submit" class="btn btn-primary mt-2">Add to Cart</button>
                                </form>




                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
