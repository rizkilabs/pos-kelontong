@extends('layout')

@section('content')
<div class="container mt-4">
  <h4>Transaksi Penjualan</h4>

  <!-- @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @elseif(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
  @endif -->

  <form method="POST" action="{{ route('penjualan.store') }}">
    @csrf

    <div id="barang-wrapper">
      <div class="row mb-2 barang-row">
        <div class="col-md-3">
          <select name="barang_id[]" class="form-select barang-select" required>
            <option value="">Pilih Barang</option>
            @foreach($barangs as $barang)
            <option value="{{ $barang->id }}"
              data-harga="{{ $barang->harga_ecer }}"
              data-nama="{{ $barang->nama }}">
              {{ $barang->nama }} (Stok: {{ $barang->stok }})
            </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2">
          <input type="number" name="jumlah[]" class="form-control jumlah" placeholder="Jumlah" required>
        </div>
        <div class="col-md-2">
          <input type="number" class="form-control harga" placeholder="Harga" readonly>
        </div>
        <div class="col-md-2">
          <input type="number" class="form-control subtotal" placeholder="Subtotal" readonly>
        </div>
        <div class="col-md-2">
          <button type="button" class="btn btn-danger remove-barang">Hapus</button>
        </div>
      </div>
    </div>

    <button type="button" id="tambah-barang" class="btn btn-secondary mb-3">+ Tambah Barang</button>

    <div class="row mt-3">
      <div class="col-md-4">
        <label>Total</label>
        <input type="number" id="total" class="form-control" readonly>
      </div>
      <div class="col-md-4">
        <label>Uang Dibayar</label>
        <input type="number" name="bayar" id="bayar" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label>Kembalian</label>
        <input type="number" id="kembalian" class="form-control" readonly>
      </div>
    </div>

    <div class="mt-4">
      <button class="btn btn-primary">Simpan Transaksi</button>
    </div>
  </form>
</div>

<script>
  document.getElementById('tambah-barang').addEventListener('click', function() {
    let wrapper = document.getElementById('barang-wrapper');
    let row = wrapper.querySelector('.barang-row').cloneNode(true);
    row.querySelector('select').value = '';
    row.querySelector('.jumlah').value = '';
    row.querySelector('.harga').value = '';
    row.querySelector('.subtotal').value = '';
    wrapper.appendChild(row);
  });

  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-barang')) {
      let rows = document.querySelectorAll('.barang-row');
      if (rows.length > 1) {
        e.target.closest('.barang-row').remove();
        hitungSemua();
      }
    }
  });

  function hitungSemua() {
    let total = 0;

    document.querySelectorAll('.barang-row').forEach(row => {
      let select = row.querySelector('select');
      let jumlahInput = row.querySelector('.jumlah');
      let hargaInput = row.querySelector('.harga');
      let subtotalInput = row.querySelector('.subtotal');

      let harga = parseInt(select.options[select.selectedIndex]?.getAttribute('data-harga') || 0);
      let jumlah = parseInt(jumlahInput.value || 0);
      let subtotal = harga * jumlah;

      hargaInput.value = harga;
      subtotalInput.value = subtotal;

      total += subtotal;
    });

    document.getElementById('total').value = total;

    let bayar = parseInt(document.getElementById('bayar').value || 0);
    let kembalian = bayar - total;
    document.getElementById('kembalian').value = kembalian >= 0 ? kembalian : 0;
  }

  document.addEventListener('input', hitungSemua);
  document.addEventListener('change', hitungSemua);
</script>
@endsection