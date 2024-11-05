<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;
use function compact;
use function view;

class KonselingController extends Controller
{
    public function getKonselingPage() {
        // PLIS DI MASA DEPAN UBAH INI JADI API CALL AJA, ini buat contoh aja
        $diagnosa_1 = new stdClass();
        $diagnosa_1->id = "K36.0";
        $diagnosa_1->nama = "OTHER APPENDICTIS";

        $diagnosa_2 = new stdClass();
        $diagnosa_2->id = "K302.0";
        $diagnosa_2->nama = "AUTISME";

        $diagnosa_3 = new stdClass();
        $diagnosa_3->id = "K40.0";
        $diagnosa_3->nama = "DOWN SYNDROME";
        $list_diagnosa = ["K36.0" => $diagnosa_1, "K302.0" => $diagnosa_2, "K40.0" => $diagnosa_3];

        $tindakan_1 = new stdClass();
        $tindakan_1->id = "K123.0";
        $tindakan_1->nama = "RAWAT INAP";

        $tindakan_2 = new stdClass();
        $tindakan_2->id = "K239.2";
        $tindakan_2->nama = "LOBOTOMI";

        $tindakan_3 = new stdClass();
        $tindakan_3->id = "K59.0";
        $tindakan_3->nama = "TABOK";
        $list_tindakan = ["K123.0" => $tindakan_1, "K239.2" => $tindakan_2, "K59.0" => $tindakan_3];

        $potensi_1 = new stdClass();
        $potensi_1->id = 1;
        $potensi_1->kemampuan_khusus = "TELEPATI";
        $potensi_1->pengelolaan_emosi = "BAIK";
        $potensi_1->pihak_pendukung = "KELUARGA";

        $potensi_2 = new stdClass();
        $potensi_2->id = 2;
        $potensi_2->kemampuan_khusus = "CLAIRVOYANT";
        $potensi_2->pengelolaan_emosi = "JELEK";
        $potensi_2->pihak_pendukung = "TEMAN";
        $list_potensi = [1 => $potensi_1, 2 => $potensi_2];

        return view('konseling.index', compact('list_diagnosa', 'list_potensi', 'list_tindakan'));
    }
}
