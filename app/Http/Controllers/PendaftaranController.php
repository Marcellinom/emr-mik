<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function compact;
use function redirect;
use function view;

class PendaftaranController extends Controller
{
    public function getPendaftaran() {
        $today_timestamp = Carbon::today()->timestamp;
        $data_antrian = DB::select("
            select p.nama, r.id as no_registrasi, p.no_rm, p.tanggal_lahir, r.status from riwayat r
            join pasien p on r.status != 'Pasien Pulang' and p.no_rm = r.no_rm
            where unix_timestamp(r.created_at) > ?
            order by r.created_at asc
        ", [$today_timestamp]);

        return view('pendaftaran.index', compact('data_antrian'));
    }

    public function newPendaftaran(Request $request) {
        Riwayat::create($request->input());
        return redirect('pendaftaran');
    }
}
