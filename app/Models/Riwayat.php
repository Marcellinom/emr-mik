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
        'nama_penanggung_jawab',
        'no_telp_penanggung_jawab',
        'hubungan_dengan_pasien',
        'poliklinik_tujuan',
        'cara_masuk',
        'pembayaran',
        'no_asuransi',
    ];
}
