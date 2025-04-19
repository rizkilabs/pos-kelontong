<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::all();
        return view('penjualan.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $barang_ids = $request->barang_id;
            $jumlahs = $request->jumlah;
            $bayar = $request->bayar;
            $total = 0;
            $kembalian = 0;

            if (!is_array($barang_ids)) {
                $barang_ids = [$barang_ids];
            }
            if (!is_array($jumlahs)) {
                $jumlahs = [$jumlahs];
            }

            if (count($barang_ids) !== count($jumlahs)) {
                return back()->with('error', 'Data barang dan jumlah tidak sinkron.');
            }

            foreach ($barang_ids as $i => $id) {
                $barang = Barang::findOrFail($id);
                $jumlah = $jumlahs[$i];

                if ($barang->stok < $jumlah) {
                    return back()->with('error', 'Stok barang "' . $barang->nama . '" tidak cukup.');
                }

                $total += $barang->harga_ecer * $jumlah;
            }

            $kembalian = $bayar - $total;

            if ($kembalian < 0) {
                return back()->with('error', 'Uang bayar tidak cukup!');
            }

            $penjualan = Penjualan::create([
                'tanggal' => now(),
                'total' => $total,
                'bayar' => $bayar,
                'kembalian' => $kembalian,
            ]);

            foreach ($barang_ids as $i => $id) {
                $barang = Barang::findOrFail($id);
                $jumlah = $jumlahs[$i];

                $barang->stok -= $jumlah;
                $barang->save();

                PenjualanDetail::create([
                    'penjualan_id' => $penjualan->id,
                    'barang_id' => $barang->id,
                    'jumlah' => $jumlah,
                    'subtotal' => $barang->harga_ecer * $jumlah,
                ]);
            }

            return redirect()->route('penjualan.sukses', $penjualan->id);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    public function sukses($id)
    {
        $penjualan = Penjualan::with('detail.barang')->findOrFail($id);
        return view('penjualan.sukses', compact('penjualan'));
        // return redirect()->route('penjualan.cetak', $penjualan->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penjualan = Penjualan::with('detail.barang')->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    public function cetak($id)
    {
        $penjualan = Penjualan::with('detail.barang')->findOrFail($id);
        return view('penjualan.cetak', compact('penjualan'));
    }

    public function pdf($id)
    {
        $penjualan = Penjualan::with('detail.barang')->findOrFail($id);
        $pdf = Pdf::loadView('penjualan.cetak', compact('penjualan'));
        return $pdf->download('struk-penjualan-' . $id . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }
}
