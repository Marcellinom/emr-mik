<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function compact;
use function view;

class AsesmenController extends Controller
{
    public function getAsesmenPage() {
        $data_antrian = DB::select("
            select p.nama, r.id as no_registrasi, p.no_rm, p.tanggal_lahir, r.status from riwayat r
            join pasien p on r.status = 'Asesmen Awal' and p.no_rm = r.no_rm
            order by r.created_at asc
        ");
        return view('asesmen_awal.index', compact('data_antrian'));
    }

    public function tambahAsesmen(Request $request) {

    }
}
