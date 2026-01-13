<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User - Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    {{-- Panggil Navbar yang tadi dibuat --}}
    @include('components.user.navbar')

    {{-- Area ini akan berubah-ubah isinya (Home, Cart, Checkout) --}}
    @yield('content')

    {{-- Panggil Footer yang tadi dibuat --}}
    @include('components.user.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>