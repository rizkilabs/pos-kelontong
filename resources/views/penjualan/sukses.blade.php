@extends('layout')

@section('content')
<div class="container mt-5 text-center">
    <div class="alert alert-success">
        <h4>Transaksi Berhasil!</h4>
        <p>Total: <strong>Rp {{ number_format($penjualan->total) }}</strong></p>
        <p>Kembalian: <strong>Rp {{ number_format($penjualan->kembalian) }}</strong></p>
    </div>

    <div class="mt-4">
        <a href="{{ route('penjualan.cetak', $penjualan->id) }}" target="_blank" class="btn btn-primary me-2">
            🖨️ Cetak Struk
        </a>
        <a href="{{ route('penjualan.create') }}" class="btn btn-secondary">
            ❌ Lewati / Transaksi Baru
        </a>
    </div>
</div>
@endsection
