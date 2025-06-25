@extends('layout') 

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0">➕ Add New Product</h4>
                </div>

                <div class="card-body p-4">
                    {{-- Show validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <strong>Validation Errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>🔸 {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Main form for creating a product --}}
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf

                        {{-- Section for image upload --}}
                        <div class="mb-3">
                            <label for="imageInput" class="form-label fw-semibold">Product Image</label>
                            <input type="file" id="imageInput" class="form-control">
                            <span id="uploadStatus" class="form-text"></span>
                            {{-- This hidden input will hold the path of the uploaded image --}}
                            <input type="hidden" name="image" id="uploadedImagePath">
                        </div>

                        {{-- Product details --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Product Name</label>
                            <input type="text" name="name" class="form-control rounded-3" placeholder="Enter product name" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label fw-semibold">Price (₹)</label>
                            <input type="number" name="price" class="form-control rounded-3" placeholder="e.g. 499.99" step="0.01" required>
                        </div>

                        <div class="mb-4">
                            <label for="stock" class="form-label fw-semibold">Stock Quantity</label>
                            <input type="number" name="stock" class="form-control rounded-3" placeholder="e.g. 100" required>
                        </div>

                        {{-- Action buttons --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-3">
                                ← Back to List
                            </a>
                            <button type="submit" class="btn btn-primary px-4 rounded-3">
                                ✅ Create Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('imageInput');
    const uploadedImagePath = document.getElementById('uploadedImagePath');
    const uploadStatus = document.getElementById('uploadStatus');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) {
            return;
        }

        const formData = new FormData();
        formData.append('image', file);

        uploadStatus.textContent = 'Uploading...';
        uploadStatus.style.color = 'blue';

        fetch('/products/image-upload', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json' // Expect a JSON response
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.image_url) {
                uploadStatus.textContent = 'Upload successful!';
                uploadStatus.style.color = 'green';
                // Store the returned image path in the hidden input
                uploadedImagePath.value = data.image_url;
            } else {
                uploadStatus.textContent = 'Upload failed. Please try again.';
                uploadStatus.style.color = 'red';
                console.error('Upload Error:', data.message || 'Unknown error');
            }
        })
        .catch(error => {
            uploadStatus.textContent = 'An error occurred during upload.';
            uploadStatus.style.color = 'red';
            console.error('Fetch Error:', error);
        });
    });
});
</script>

@endsection
