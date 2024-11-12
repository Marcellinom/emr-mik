<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use App\Models\PenanggungJawab;
use App\Models\Potensi;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use ReflectionClass;
use stdClass;
use Throwable;
use function compact;
use function gettype;
use function json_encode;
use function redirect;
use function typeOf;
use function view;

class KonselingController extends Controller
{
    public function getKonselingPage() {
        // TODO: PLIS DI MASA DEPAN UBAH INI JADI API CALL AJA, ini buat contoh aja
        $list_diagnosa = DB::table('diagnosa')->get()->mapWithKeys(function ($item, int $key) {
            return [$item->id => $item];
        });
        $list_tindakan = DB::table("tindakan")->get()->mapWithKeys(function (object $item, int $key) {
            return [$item->id => $item];
        });

        $dokter = DB::select("
            select d.id, d.nama from dokter d
            join user_role u on u.user_id = ? and u.role_id = d.id
            limit 1
        ", [Auth::user()->id])[0];

        return view('konseling.index', compact('list_diagnosa', 'list_tindakan', 'dokter'));
    }

    /**
     * @throws Throwable
     */
    public function newKonseling(Request $request) {
        DB::beginTransaction();
        try {
            $penanggung_jawab = PenanggungJawab::create($request->input());
            // buat dulu riwayat medis pasien nya

            $riwayat = Riwayat::create([
                'no_rm' => $request->input('no_rm'),
                'id_dokter' => $request->input('id_dokter'),
                'id_penanggung_jawab' => $penanggung_jawab->id,
                'poliklinik_tujuan' => 'Poli Jiwa',
                'cara_masuk' => 'Datang Sendiri',
                'pembayaran' => 'Gratis',
                'status' => 'Pasien Pulang'
            ]);

            Konseling::create([
                'id_riwayat' => $riwayat->id,
                ...$request->input(),
                'klarifikasi_masalah' => json_encode($request->input('list_klarifikasi_masalah'))
            ]);

            $potensi = [];
            foreach ($request->input('potensi') ?? [] as $item) {
                $potensi[] = [
                    'id_riwayat' => $riwayat->id,
                    'kemampuan_khusus' => $item['kemampuan_khusus'],
                    'pengelolaan_emosi' => $item['pengelolaan_emosi'],
                    'pihak_pendukung' => $item['pihak_pendukung'],
                ];
            }

            DB::table('potensi')->insert($potensi);

            $riwayat_diagnosa_payload = [];
            $riwayat_tindakan_payload = [];
            foreach ($request->input('diagnosa') ?? [] as $item) {
                $riwayat_diagnosa_payload[] = [
                    'id_riwayat' => $riwayat->id,
                    'id_diagnosa' => $item
                ];
            }
            foreach ($request->input('tindakan') ?? [] as $item) {
                $riwayat_tindakan_payload[] = [
                    'id_riwayat' => $riwayat->id,
                    'id_tindakan' => $item
                ];
            }
            DB::table('riwayat_diagnosa')->insert($riwayat_diagnosa_payload);
            DB::table('riwayat_tindakan')->insert($riwayat_tindakan_payload);
        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return redirect('konseling');
    }
}
