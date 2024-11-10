<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function base64_encode;
use function compact;
use function dd;
use function redirect;
use function response;
use function route;
use function view;

class MasterDataController extends Controller
{
    public function getPasien() {
        $data_pasien = DB::select("
            select p.no_rm, p.nama, r.poliklinik_tujuan, r.nama_dokter, r.created_at from pasien p
            left join (
                select d.nama as nama_dokter, no_rm, poliklinik_tujuan, created_at,
                       ROW_NUMBER() over(partition by no_rm order by created_at desc) as latest
                from riwayat
                join dokter d on id_dokter = d.id
                group by nama, nama_dokter, no_rm, poliklinik_tujuan, created_at
            ) r on r.no_rm = p.no_rm and latest = 1
        ");

        return view("master_data.pasien", compact('data_pasien'));
    }

    public function getDetailPasien($id) {
        $data = DB::table('pasien')->where('no_rm', $id)->first();
        return view('form.data_pasien_readonly', compact('data'));
    }

    public function getPasienByIdRegistrasi(Request $request) {
        $id = $request->query('id_registrasi');
        $res = DB::select("
            select p.nama, p.nik, p.jenis_kelamin, p.tanggal_lahir, p.no_rm, r.poliklinik_tujuan, d.nama as nama_dokter from pasien p
            join riwayat r on r.id = ? and r.no_rm = p.no_rm
            left join dokter d on d.id = r.id_dokter
            limit 1
        ", [$id]);
        return response()->json([
            'data' => $res
        ]);
    }

    public function getPasienByName(Request $request) {
        $name = $request->query('name');
        $res = DB::select("
            select no_rm, nama, nik, jenis_kelamin, tanggal_lahir from pasien where nama like ?
        ", ["%".$name."%"]);

        return response()->json([
            'data' => $res
        ]);
    }

    public function getDokterByName(Request $request) {
        $name = $request->query("name");
        $res = DB::select("
            select id, nama from dokter where nama like ?
        ", ["%".$name."%"]);

        return response()->json([
            'data' => $res
        ]);
    }

    public function getObatByName(Request $request) {

    }

    public function newPasien(Request $request) {
        Pasien::create($request->input());
        return redirect('pasien');
    }

    public function getObat() {
        return view("master_data.obat");
    }

    public function getPesananObat() {
        return view("master_data.pesanan_obat");
    }
}
