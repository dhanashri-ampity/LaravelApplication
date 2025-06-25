<!DOCTYPE html>
<html>
<head>
    <title>Laravel Task CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Task CRUD</a>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html> 