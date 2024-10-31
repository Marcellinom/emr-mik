<?php

namespace App\Http\Controllers;

use App\Models\AsesmenAwal;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function compact;
use function redirect;
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

    public function invokeAsesmen(Request $request) {
        $id_registrasi = $request->query('id_registrasi');
        return redirect('isi_asesmen')->with('id_registrasi', $id_registrasi);
    }

    public function tambahAsesmen(Request $request) {
        DB::table('riwayat')->where('id', $request->input('id_riwayat'))
            ->update([
                'status' =>'Pemeriksaan'
            ]);
        AsesmenAwal::create($request->input());
        return redirect('antrian_asesmen');
    }
}
