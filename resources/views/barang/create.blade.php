@extends('layout')
@section('content')
<div class="container mt-3">
  <h4>Tambah Barang</h4>
  <form method="POST" action="{{ route('barang.store') }}" enc>
    @csrf
    <div class="form-group">
      <label>Gambar Barang (opsional)</label>
      <input type="file" name="gambar" class="form-control">
    </div>
    <div class="form-group">
      <label>Nama Barang</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Stok</label>
      <input type="number" name="stok" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Harga Ecer</label>
      <input type="number" name="harga_ecer" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Harga Grosir</label>
      <input type="number" name="harga_grosir" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Satuan</label>
      <input type="text" name="satuan" class="form-control" required>
    </div>
    <button class="btn btn-primary mt-2">Simpan</button>
  </form>
</div>
@endsection
