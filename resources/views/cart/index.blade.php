@extends('layouts.user.app')
@section('title', 'Keranjang Pesanan')
@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Keranjang Pesanan</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($cart as $id => $item)
            @php $total = $item['harga'] * $item['quantity']; $grandTotal += $total; @endphp
            <tr>
                <td>
                    <img src="{{ asset('storage/'.$item['foto']) }}" width="60" class="me-2">
                    {{ $item['nama'] }}
                </td>
                <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control w-25 me-2">
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </form>
                </td>
                <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="table-light">
                <td colspan="3" class="text-end fw-bold">Grand Total:</td>
                <td colspan="2" class="fw-bold text-primary">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('home') }}" class="btn btn-secondary">Lanjut Belanja</a>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-lg">Lanjut ke Pembayaran</a>
    </div>
    @else
    <div class="alert alert-warning text-center py-5">
        <h4>Keranjang kamu masih kosong 🛒</h4>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Mulai Belanja</a>
    </div>
    @endif
</div>
@endsection