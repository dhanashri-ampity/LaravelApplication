<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="{{ route('products.index') }}">🛒 Product Inventory</a>
    </nav>
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
