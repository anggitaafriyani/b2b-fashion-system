<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    // Sesuaikan nama tabel ini dengan yang ada di database lu
    protected $table = 'pelanggans'; 

    protected $fillable = [
        'name',
        'category',
        'status'
    ];
}