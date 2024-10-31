<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function compact;
use function view;

class FormController extends Controller
{
    public function getFormTambahPasien() {
        return view('form.form_tambah_pasien');
    }

    public function getIsiAsesmenPage(Request $request) {
        $id_registrasi = $request->query('id_registrasi');
        return view('form.form_asesmen_awal', compact('id_registrasi'));
    }
}
