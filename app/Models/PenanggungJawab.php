<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenanggungJawab extends Model
{
    use HasFactory;
    protected $table = 'penanggung_jawab';
    protected $fillable = [
        'nama_penanggung_jawab',
        'no_telp_penanggung_jawab',
        'hubungan_dengan_pasien',
        "jenis_kelamin",
        "tanggal_lahir",
        "pendidikan",
        "pekerjaan",
    ];
}
