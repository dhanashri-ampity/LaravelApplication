<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="{{ route('products.index') }}">🛒 Product Inventory</a>
        <!-- Notification dropdown (optional, see below) -->
    </nav>

    <!-- Notification List -->
    @if(auth()->check())
        <div class="container mt-2">
            <div class="alert alert-info p-2">
                <strong>Notifications:</strong>
                <ul class="mb-0">
                    @forelse(auth()->user()->notifications as $notification)
                        <li>{{ $notification->data['message'] }}</li>
                    @empty
                        <li>No notifications.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    @endif

    <main class="py-4">
        @yield('content')
    </main>

    <!-- @if(session('success'))
    <div class="alert alert-success container">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger container">
            {{ session('error') }}
        </div>
    @endif    -->

</body>
</html>
