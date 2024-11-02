<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmenAwal extends Model
{
    use HasFactory;

    protected $table = 'asesmen_awal';
    protected $fillable = [
        "id_riwayat",
        "denyut_jantung",
        "pernapasan",
        "suhu",
        "tingkat_kesadaran",
        "tekanan_darah_sistole",
        "tekanan_darah_distole",
        "berat_badan",
        "tinggi_badan",
        "keluhan_utama",
        "riwayat_alergi_obat",
        "riwayat_penyakit",
        "riwayat_pengobatan",
        "kepala",
        "lidah",
        "punggung",
        "kuku_tangan",
        "mata",
        "langit_langit",
        "perut",
        "persendian_tangan",
        "telinga",
        "leher",
        "genital",
        "tungkai_atas",
        "hidung",
        "tenggorokan",
        "anus_dubur",
        "tungkai_bawah",
        "rambut",
        "tongsil",
        "lengan_atas",
        "jari_kaki",
        "bibir",
        "dada",
        "lengan_bawah",
        "kuku_kaki",
        "gigi_geligi",
        "payudara",
        "jari_tangan",
        "persendian_kaki",
    ];
}
