@extends('layouts.user.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    </div>
                    
                    <h2 class="fw-bold text-success">Pesanan Berhasil!</h2>
                    <p class="text-muted">ID Pesanan Anda: <strong>{{ $order->id }}</strong></p>
                    <hr>

                    <div class="alert alert-info text-start mt-4">
                        <h5 class="fw-bold"><i class="bi bi-info-circle me-2"></i>Instruksi Pembayaran</h5>
                        <p class="mb-1">Silakan lakukan transfer tepat sebesar:</p>
                        <h4 class="fw-bold text-primary">Rp {{ number_format($order->total, 0, ',', '.') }}</h4>
                        <p class="mt-3 mb-1">Ke Rekening Berikut:</p>
                        <p class="mb-0"><strong>Bank BCA: 1234567890 (a.n TokoKu)</strong></p>
                    </div>

                    <div class="mt-5 text-start">
                        <h5 class="fw-bold">Upload Bukti Transfer</h5>
                        <p class="text-muted small">Format: JPG, PNG, atau PDF (Maks 2MB)</p>
                        
                        <form action="{{ route('checkout.updatePaymentProof', $order->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <input type="file" name="bukti_pembayaran" class="form-control @error('bukti_pembayaran') is-invalid @enderror" required>
                                @error('bukti_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Kirim Bukti Pembayaran</button>
                            </div>
                        </form>
                    </div>

                    <a href="{{ route('home') }}" class="btn btn-link mt-3 text-decoration-none">Kembali Belanja</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection