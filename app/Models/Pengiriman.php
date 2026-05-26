<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';

    protected $fillable = [
        'kode_pesanan',
        'nama_pelanggan',
        'ekspedisi',
        'no_resi',
        'ongkir',
        'status_pengiriman'
    ];
}
