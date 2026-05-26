<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'pelanggan_id',
        'no_invoice',
        'total_tagihan',
        'metode_pembayaran',
        'jumlah_dibayar',
        'bukti_pembayaran',
        'tanggal_bayar',
        'status_pembayaran'
    ];
}