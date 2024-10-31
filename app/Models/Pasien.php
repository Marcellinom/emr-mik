<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $fillable = [
        'nama',
        'nama_keluarga',
        'nik',
        'no_identitas_lain',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'umur',
        'nama_ibu',
        'no_telp',
        'no_telp_rumah',
        'agama',
        'pendidikan',
        'status_pernikahan',
        'gol_darah',
        'pekerjaan',
        'suku',
        'bahasa',
        'kewarganegaraan',
        'alamat',
        'rw',
        'rt',
        'kode_pos',
        'signature',
    ];

    public function riwayat(): HasMany
    {
        return $this->hasMany('riwayat', 'no_rm', 'no_rm');
    }
}
