<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $table = 'riwayat';

    protected $fillable = [
        'no_rm',
        'id_dokter',
        'id_penanggung_jawab',
        'poliklinik_tujuan',
        'cara_masuk',
        'pembayaran',
        'no_asuransi',
        'status',
    ];
}
