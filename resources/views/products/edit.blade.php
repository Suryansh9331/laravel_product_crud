@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>
    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number"  name="quantity" class="form-control" value="{{ $product->quantity }}" required>
        </div>
        <div class="mb-3">
            <label>Discount Price</label>
            <input type="number" step="0.01" name="discount_price" class="form-control" value="{{ $product->discount_price }}">
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if($product->image)
                <img src="{{ asset($product->image) }}" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
@endsection
