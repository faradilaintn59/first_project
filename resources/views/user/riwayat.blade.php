@extends('layouts.user.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Riwayat Pesanan</h2>

    {{-- Cek apakah variabel $orders ada isinya --}}
    @if($orders->isEmpty())
        <div class="alert alert-info">Belum ada pesanan.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th> {{-- Ubah dari Kode Order jadi Nama Produk --}}
                    <th>Tanggal</th>
                    <th>Total Belanja</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- $item di sini adalah satu baris OrderProduct --}}
                @foreach($orders as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    
                    {{-- 1. Ambil Nama Produk (Masuk ke relasi product) --}}
                    <td>
                        {{ $item->product->nama ?? 'Produk dihapus' }}
                    </td> 
                    
                    {{-- 2. Ambil Tanggal (Masuk ke relasi order dulu) --}}
                    <td>
                        {{ $item->order->tanggal ?? '-' }}
                    </td> 
                    
                    {{-- 3. Ambil Total (Masuk ke relasi order dulu) --}}
                    <td>
                        Rp {{ number_format($item->order->total ?? 0, 0, ',', '.') }}
                    </td>
                    
                    {{-- 4. Ambil Status (Masuk ke relasi order dulu) --}}
                    <td>
                        @php $status = $item->order->status_pembayaran ?? 'unknown'; @endphp
                        
                        @if($status === 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($status === 'lunas')
                            <span class="badge bg-success">Lunas</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($status) }}</span>
                        @endif
                    </td>

                    {{-- 5. Tombol Aksi --}}
                    <td>
                        @if(($item->order->status_pembayaran ?? '') === 'pending')
                            <a href="{{ route('checkout.sukses') }}" class="btn btn-sm btn-primary">
                                Upload Bukti
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="/" class="btn btn-secondary mt-3">Kembali ke Beranda</a>
</div>
@endsection