<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konseling extends Model
{
    use HasFactory;

    protected $table = 'konseling';

    protected $fillable = [
        "id_riwayat",
        "keluhan",
        "riwayat_kasus",
        "asesmen",
        "dinamika_psikologi",
        "prioritas_intervensi",
        "intervensi",
        "rencana_intervensi_lanjutan",
        "klarifikasi_masalah",
    ];
}
