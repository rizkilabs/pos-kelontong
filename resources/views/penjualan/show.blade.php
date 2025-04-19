@extends('layout')

@section('content')
<div class="container mt-4">
    <h4>Struk Transaksi</h4>

    <a href="{{ route('penjualan.cetak', $penjualan->id) }}" target="_blank" class="btn btn-secondary mb-3">🖨️ Cetak Struk</a>

    <div class="card p-3" style="max-width: 400px">
        <h5>Toko Kelontong Madura</h5>
        <p><small>Tanggal: {{ $penjualan->tanggal }}</small></p>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualan->detail as $item)
                <tr>
                    <td>{{ $item->barang->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ number_format($item->harga) }}</td>
                    <td>{{ number_format($item->subtotal) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Total:</strong> Rp {{ number_format($penjualan->total) }}</p>
        <p><strong>Bayar:</strong> Rp {{ number_format($penjualan->bayar) }}</p>
        <p><strong>Kembalian:</strong> Rp {{ number_format($penjualan->kembalian) }}</p>
    </div>
</div>
@endsection
