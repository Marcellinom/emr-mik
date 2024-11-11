<?php

namespace App\Http\Controllers;

use App\Models\PenanggungJawab;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use function compact;
use function redirect;
use function view;

class PendaftaranController extends Controller
{
    public function getPendaftaran() {
        $data_antrian = DB::select("
            select r.no_antrian,
            p.nama, r.id as no_registrasi, p.no_rm, p.tanggal_lahir, r.status from riwayat r
            join pasien p on r.status != 'Pasien Pulang' and p.no_rm = r.no_rm
            order by r.created_at asc
        ");

        return view('pendaftaran.index', compact('data_antrian'));
    }

    /**
     * @throws Throwable
     */
    public function newPendaftaran(Request $request) {
        DB::beginTransaction();
        try {
            $penanggung_jawab = PenanggungJawab::create($request->input());
            Riwayat::create([
                'id_penanggung_jawab' => $penanggung_jawab->id,
                ...$request->input(),
                'no_antrian' => DB::table('riwayat')->where('status', '!=', 'Pasien Pulang')->count() + 1]
            );
        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return redirect('pendaftaran');
    }

    public function hapusRiwayat(Request $request) {
        DB::table('riwayat')->where('id', $request->input('id'))->delete();
    }
}
