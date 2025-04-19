@extends('layout')
@section('content')
<div class="container mt-3">
  <h4>Data Barang</h4>
  <a href="{{ route('barang.create') }}" class="btn btn-success mb-2">+ Tambah</a>
  <table class="table table-bordered">
    <tr>
      <th>Gambar</th>
      <th>Nama</th>
      <th>Stok</th>
      <th>Harga Ecer</th>
      <th>Aksi</th>
    </tr>
    @foreach($barang as $b)
    <tr>
      <td>
        @if($b->gambar)
        <img src="{{ asset('gambar/' . $b->gambar) }}" alt="Gambar Barang" width="60">
        @endif
      <td>{{ $b->nama }}</td>
      <td>{{ $b->stok }}</td>
      <td>{{ $b->harga_ecer }}</td>
      <td>-</td>
    </tr>
    @endforeach
  </table>
</div>
@endsection