<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="#">TokoKu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#produk">Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Keranjang</a></li>
            </ul>
            @auth
                <a href="#" class="btn btn-primary ms-lg-3">{{ Auth::user()->name }}</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary ms-lg-3">Login</a>
            @endauth
        </div>
    </div>
</nav>