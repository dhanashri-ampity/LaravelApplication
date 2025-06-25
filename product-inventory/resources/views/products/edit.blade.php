@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">✏️ Edit Product</h4>
            <a href="{{ route('products.index') }}" class="btn btn-light btn-sm">← Back to Products</a>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Product Name:</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (₹):</label>
                    <input type="number" step="0.01" name="price" id="price"
                        class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price', $product->price) }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock Quantity:</label>
                    <input type="number" name="stock" id="stock"
                        class="form-control @error('stock') is-invalid @enderror"
                        value="{{ old('stock', $product->stock) }}" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-success rounded-3">
                        💾 Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection