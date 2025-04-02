@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>&#128230 Product Management</h2>

        <a href="{{ route('admin.product.create') }}" class="btn btn-primary mb-3">&#10133 Add Product</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Discount Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>₹{{ $product->price }}</td>
                        <td>₹{{ $product->discount_price }}</td>
                        <td>
                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning btn-sm">&#9999 Edit</a>
                            <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">&#10060 Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
