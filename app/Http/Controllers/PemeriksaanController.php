<?php

namespace App\Http\Controllers;

use App\Models\AsesmenAwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use function compact;
use function dd;
use function redirect;
use function view;

class PemeriksaanController extends Controller
{
    public function getAntrianPemeriksaanPage() {
        $data_antrian = DB::select("
            select r.no_antrian, p.nama, r.id as no_registrasi, p.no_rm, r.status from riwayat r
            join pasien p on r.status = 'Pemeriksaan' and p.no_rm = r.no_rm
            order by r.created_at asc
        ");
        return view('pemeriksaan.index', compact('data_antrian'));
    }

    public function invokePemeriksaan(Request $request) {
        $id = $request->query('id_registrasi');
        return redirect("/pemeriksaan/asesmen_awal/{$id}");
    }

    public function dataAsesmenAwal($id) {
        $res = DB::table('asesmen_awal')->where('id_riwayat', $id)->first();
        $data_asesmen_awal = [];
        $data_asesmen_awal["id_riwayat"] = $res->id_riwayat;
        $data_asesmen_awal["tanda_vital"] = [];
        $data_asesmen_awal["anamnesis"] = [];
        $data_asesmen_awal["head-to-toe"] = [];

        foreach ($res as $key => $data) {
            $group = 0;
            switch ($key) {
                case 'id_riwayat':
                case 'created_at':
                case 'updated_at':
                    continue 2;
            }
            switch ($key) {
                case 'denyut_jantung':
                case 'pernapasan':
                case 'suhu':
                case 'tingkat_kesadaran':
                case 'tekanan_darah_sistole':
                case 'tekanan_darah_distole':
                case 'berat_badan':
                case 'tinggi_badan':
                    $group = "tanda_vital";
                    break;
                case 'keluhan_utama':
                case 'riwayat_alergi_obat':
                case 'riwayat_penyakit':
                case 'riwayat_pengobatan':
                    $group = "anamnesis";
                    break;
                default:
                    $group = "head-to-toe";
            }
            $data_asesmen_awal[$group] = [...$data_asesmen_awal[$group], $key => $data];
        }

        return view('pemeriksaan.asesmen_awal', compact('data_asesmen_awal', 'id'));
    }

    public function getSoape($id) {
        // TODO: PLIS DI MASA DEPAN UBAH INI JADI API CALL AJA, ini buat contoh aja
        $list_diagnosa = DB::table('diagnosa')->get()->mapWithKeys(function ($item, int $key) {
            return [$item->id => $item];
        });
        $list_tindakan = DB::table("tindakan")->get()->mapWithKeys(function (object $item, int $key) {
            return [$item->id => $item];
        });
        $data_soap = DB::table('soap')->where('id_riwayat', $id)->first();

        $data_diagnosa = DB::select("
            select id, nama from riwayat_diagnosa r
            join diagnosa d on r.id_riwayat = ? and d.id = r.id_diagnosa
        ", [$id]);
        $data_tindakan = DB::select("
            select id, nama from riwayat_tindakan r
            join tindakan d on r.id_riwayat = ? and d.id = r.id_tindakan
        ", [$id]);
        $data_obat = DB::select("
            select id, nama, sediaan_obat, aturan_pakai, jumlah from riwayat_obat r
            join obat d on r.id_riwayat = ? and d.id = r.id_obat
        ", [$id]);

        return view('pemeriksaan.soape', compact('id', 'list_diagnosa', 'list_tindakan',
            'data_soap', 'data_diagnosa', 'data_tindakan','data_obat'));
    }

    /**
     * @throws Throwable
     */
    public function newSoape(Request $request) {
        $riwayat_id = $request->input('riwayat_id');
        DB::beginTransaction();
        try {
            // delete dulu buat update value barunya
            DB::table('soap')->where('id_riwayat', $riwayat_id)->delete();
            DB::table('riwayat_diagnosa')->where('id_riwayat', $riwayat_id)->delete();
            DB::table('riwayat_tindakan')->where('id_riwayat', $riwayat_id)->delete();
            DB::table('riwayat_obat')->where('id_riwayat', $riwayat_id)->delete();

            DB::table('soap')->insert([
                [
                    'id_riwayat' => $riwayat_id,
                    'subjektif' => $request->input('subjektif'),
                    'asesmen' => $request->input('asesmen'),
                    'objektif' => $request->input('objektif'),
                    'rencana' => $request->input('rencana'),
                    'penjelasan_penyakit' => (bool)$request->input('penjelasan_penyakit'),
                    'penjelasan_obat' => (bool)$request->input('penjelasan_obat'),
                    'penjelasan_informed_consent' => (bool)$request->input('penjelasan_informed_consent')
                ]
            ]);
            $diagnosa_payload = [];
            $tindakan_payload = [];
            $obat_payload = [];
            foreach ($request->input('diagnosa') ?? [] as $item) {
                $diagnosa_payload[] = [
                    'id_riwayat' => $riwayat_id,
                    'id_diagnosa' => $item
                ];
            }
            foreach ($request->input('tindakan') ?? [] as $item) {
                $tindakan_payload[] = [
                    'id_riwayat' => $riwayat_id,
                    'id_tindakan' => $item
                ];
            }
            foreach ($request->input('obat') ?? [] as $item) {
                $obat_payload[] = [
                    'id_riwayat' => $riwayat_id,
                    'id_obat' => $item['id'],
                    'aturan_pakai' => $item['aturan_pakai'],
                    'jumlah' => (int)$item['jumlah']
                ];
            }
            DB::table('riwayat_diagnosa')->insert($diagnosa_payload);
            DB::table('riwayat_tindakan')->insert($tindakan_payload);
            DB::table('riwayat_obat')->insert($obat_payload);
        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return redirect("/pemeriksaan/soape/{$riwayat_id}");
    }

    public function getPenunjang($id) {
        $list_laboratorium = DB::table("laboratorium")->get()->mapWithKeys(function (object $item, int $key) {
            return [$item->id => $item];
        });
        $list_radiologi = DB::table("radiologi")->get()->mapWithKeys(function (object $item, int $key) {
            return [$item->id => $item];
        });

        return view('pemeriksaan.penunjang', compact('list_laboratorium', 'list_radiologi', 'id'));
    }
    public function getResumeMedis($id) {
        $row = DB::table('riwayat')->where('id', $id)->first();
        $cara_masuk = $row->cara_masuk;
        $tanggal = $row->created_at;
        return view('pemeriksaan.resume', compact('id', 'cara_masuk', 'tanggal'));
    }
}
