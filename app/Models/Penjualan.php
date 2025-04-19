<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Penjualan extends Model
{
    protected $fillable = [
        'tanggal',
        'total',
        'bayar',
        'kembalian',
    ];

    public function detail()
    {
        return $this->hasMany(PenjualanDetail::class);
    }
}
