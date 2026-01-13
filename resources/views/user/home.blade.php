@extends('layouts.user.app')

@section('title', 'Dashboard')

@section('content')
<section class="py-5 bg-light text-center">
    <div class="container">
        <h1 class="fw-bold mb-3">Selamat Datang di <span class="text-primary">TokoKu</span></h1>
        <p class="lead text-muted">Belanja mudah, cepat, dan terpercaya.</p>
        <a href="#produk" class="btn btn-primary btn-lg mt-3">Belanja Sekarang</a>
    </div>
</section>

<div class="container">
    <section id="produk" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Produk Unggulan</h2>
            <div class="row g-5 mt-3">
                {{-- Loop Produk dari Database --}}
                @forelse($products as $product)
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/'.$product->foto) }}" class="card-img-top" alt="{{ $product->nama }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->nama }}</h5>
                            <p class="card-text text-muted">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary">Detail Produk</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>Belum ada produk tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection