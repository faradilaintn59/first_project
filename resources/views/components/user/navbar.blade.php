<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">TokoKu</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#produk">Produk</a>
                </li>

                {{-- Menu Khusus Jika Sudah  --}}
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">Keranjang</a>
                    </li>
                @endauth
            </ul>

            <div class="d-flex align-items-center">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary ms-lg-3">Login</a>
                @endguest

                @auth
                    {{-- Tombol Dashboard Khusus Admin --}}
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-danger btn-sm ms-lg-3">Panel Admin</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="ms-lg-3">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">
                            Logout ({{ Auth::user()->name }})
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>