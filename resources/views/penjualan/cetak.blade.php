<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <link rel="stylesheet" media="print" href="{{ asset('css/print.css') }}">
</head>
<body onload="window.print()">
    <div class="container">
        <div style="text-align: center;">
            <img src="{{ asset('images/ppkdjp_logo.png') }}" alt="Logo Toko" style="max-width: 80px; margin-bottom: 5px;">
            <h4>Toko Kelontong Madura</h4>
            <p class="small-text mb-0">Alamat Toko Anda</p>
            <p class="small-text mb-0">No. Telepon Toko Anda</p>
        </div>
        <hr>
        <p class="small-text align-left">Tanggal: {{ $penjualan->tanggal }}</p>
        <p class="small-text align-right">No. Transaksi: {{ $penjualan->id }}</p>
        <div class="clearfix"></div>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>Barang</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualan->detail as $item)
                <tr>
                    <td>{{ $item->barang->nama }}</td>
                    <td class="text-right">{{ $item->jumlah }}</td>
                    <td class="text-right">{{ number_format($item->harga) }}</td>
                    <td class="text-right">{{ number_format($item->subtotal) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <p class="text-right bold">Total: Rp {{ number_format($penjualan->total) }}</p>
        <p class="text-right">Bayar: Rp {{ number_format($penjualan->bayar) }}</p>
        <p class="text-right">Kembalian: Rp {{ number_format($penjualan->kembalian) }}</p>
        <hr>
        <p class="text-center">Terima kasih atas kunjungan Anda!</p>
        <p class="text-center small-text">Barang yang sudah dibeli tidak dapat dikembalikan.</p>
    </div>
</body>
</html>