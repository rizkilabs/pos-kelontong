<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'stok',
        'harga_ecer',
        'harga_grosir',
        'satuan',
        'gambar'
    ];
}
