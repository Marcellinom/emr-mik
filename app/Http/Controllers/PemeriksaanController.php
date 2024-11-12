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

        $readonly = DB::table('riwayat')->where('id', $id)->first()?->status == "Pasien Pulang";

        return view('pemeriksaan.soape', compact('id', 'list_diagnosa', 'list_tindakan',
            'data_soap', 'data_diagnosa', 'data_tindakan','data_obat', 'readonly'));
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
        $data_lab = DB::select("
            select id, l.nama from riwayat_laboratorium r
            join laboratorium l on r.id_riwayat = ? and r.id_laboratorium = l.id
        ", [$id]);
        $data_radiologi = DB::select("
            select id, nama from riwayat_radiologi i
            join radiologi r on i.id_riwayat = ? and r.id = i.id_radiologi
        ", [$id]);

        $readonly = DB::table('riwayat')->where('id', $id)->first()?->status == "Pasien Pulang";

        return view('pemeriksaan.penunjang', compact('list_laboratorium', 'list_radiologi', 'id',
            'data_lab', 'data_radiologi', 'readonly'
        ));
    }

    /**
     * @throws Throwable
     */
    public function newPenunjang(Request $request) {
        $id = $request->input('id_riwayat');
        DB::beginTransaction();
        try {
            DB::table('riwayat_laboratorium')->where('id_riwayat', $id)->delete();
            DB::table('riwayat_radiologi')->where('id_riwayat', $id)->delete();

            $lab_payload = [];
            $radiologi_payload = [];
            foreach ($request->input('laboratorium') ?? []as $item) {
                $lab_payload[] = [
                    'id_riwayat' => $id,
                    'id_laboratorium' => $item
                ];
            }
            foreach ($request->input('radiologi') ?? []as $item) {
                $radiologi_payload[] = [
                    'id_riwayat' => $id,
                    'id_radiologi' => $item
                ];
            }
            DB::table('riwayat_laboratorium')->insert($lab_payload);
            DB::table('riwayat_radiologi')->insert($radiologi_payload);
        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return redirect("/pemeriksaan/penunjang/{$id}");
    }

    public function getResumeMedis($id) {
        $row = DB::table('riwayat')->where('id', $id)->first();
        $row_resume = DB::table('resume_medis')->where('id_riwayat', $id)->first();
        $cara_masuk = $row->cara_masuk;
        $tanggal = $row->created_at;
        $readonly = $row->status == "Pasien Pulang" && $row_resume->ttd_resume_medis !== null;
        return view('pemeriksaan.resume', compact('id', 'cara_masuk', 'tanggal', 'readonly', 'row_resume'));
    }

    public function newResumeMedis(Request $request) {
        DB::transaction(function () use ($request) {
            $row = DB::table('resume_medis')->where('id_riwayat', $request->input('id_riwayat'))->first();
            if ($row !== null) {
                $payload = [];
                if ($row->ttd_resume_medis === null) {
                    $payload['ttd_resume_medis'] = $request->input('ttd_resume_medis');
                }
                if ($row->ttd_informed_consent === null) {
                    $payload['ttd_informed_consent'] = $request->input('ttd_informed_consent');
                }
                DB::table('resume_medis')->where('id_riwayat', $request->input('id_riwayat'))
                    ->update($payload);
            } else {
                DB::table('resume_medis')->insert([
                    [
                        'id_riwayat' => $request->input('id_riwayat'),
                        'status_pulang' => $request->input('status_pulang'),
                        'ttd_resume_medis' => $request->input('ttd_resume_medis'),
                        'ttd_informed_consent' => $request->input('ttd_informed_consent')
                    ]
                ]);
                DB::table('riwayat')->where('id', $request->input('id_riwayat'))
                    ->update([
                        'status' => 'Pasien Pulang'
                ]);
            }
        });
        return redirect('/antrian_pemeriksaan');
    }
}
