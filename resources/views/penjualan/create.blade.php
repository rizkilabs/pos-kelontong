@extends('layout')
@section('content')
<div class="container mt-3">
  <h4>Transaksi Penjualan</h4>

  <form method="POST" action="{{ route('penjualan.store') }}">
    @csrf

    <div id="barang-wrapper">
      <div class="row mb-2 barang-row">
        <div class="col-6">
          <select name="barang_id[]" class="form-select" required>
            <option value="">Pilih Barang</option>
            @foreach($barangs as $barang)
              <option value="{{ $barang->id }}">
                {{ $barang->nama }} (Stok: {{ $barang->stok }})
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-3">
          <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" required>
        </div>
        <div class="col-3">
          <button type="button" class="btn btn-danger remove-barang">Hapus</button>
        </div>
      </div>
    </div>

    <button type="button" id="tambah-barang" class="btn btn-secondary mb-3">+ Tambah Barang</button>
    <br>
    <button class="btn btn-primary">Simpan Transaksi</button>
  </form>
</div>

<script>
  document.getElementById('tambah-barang').addEventListener('click', function () {
    let wrapper = document.getElementById('barang-wrapper');
    let row = wrapper.querySelector('.barang-row').cloneNode(true);
    row.querySelector('select').value = '';
    row.querySelector('input').value = '';
    wrapper.appendChild(row);
  });

  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-barang')) {
      let rows = document.querySelectorAll('.barang-row');
      if (rows.length > 1) {
        e.target.closest('.barang-row').remove();
      }
    }
  });
</script>
@endsection
