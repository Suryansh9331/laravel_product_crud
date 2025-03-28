@extends('layouts.app')

@section('content')
    <h1>Add Product</h1>
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Discount Price</label>
            <input type="number" step="0.01" name="discount_price" class="form-control">
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control"  required>
        </div>
        <button type="submit" class="btn btn-success">Add Product</button>
    </form>
@endsection
