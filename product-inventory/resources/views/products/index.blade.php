@extends('layout') {{-- if you're using a layout --}}
@section('content')



<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📦 Product List</h2>
        <div>
            <a href="{{ route('products.create') }}" class="btn btn-success rounded-3">
                ➕ Add Product
            </a>
            <a href="{{ route('products.trashed') }}" class="btn btn-warning btn-sm ms-1">
                🗑️ View Trashed Products
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success rounded-3">
            ✅ {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('products.index') }}">
        <input type="text" name="search" placeholder="Search by name" value="{{ request('search') }}">
        <input type="number" name="min_price" placeholder="Min price" value="{{ request('min_price') }}">
        <input type="number" name="max_price" placeholder="Max price" value="{{ request('max_price') }}">
        <button type="submit">Filter</button>
        <a href="{{ route('products.index') }}">Clear</a>
    </form>

    <div class="table-responsive shadow-sm rounded-4">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">📛 Name</th>
                    <th scope="col">💰 Price (₹)</th>
                    <th scope="col">📦 Stock</th>
                    <th scope="col" class="text-center">⚙️ Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $index => $product)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $product->name }}</td>
                        <td>₹{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td class="text-center">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning me-2">
                                ✏️ Edit
                            </a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure to delete this product?')">
                                    🗑️ Delete
                                </button>
                                

                            </form>
                        
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">No products available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
