@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>🗑️ Trashed Products</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Deleted At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>₹{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->deleted_at->format('d M Y, h:i A') }}</td>
                    <td>
                        <form method="POST" action="{{ route('products.restore', $product->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Restore</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
