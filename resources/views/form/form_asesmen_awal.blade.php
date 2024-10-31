@extends('layouts.master')

@section('content-header')
    Asesmen Awal
@endsection

@section('content-header-specific')
    <i class="bi bi-person-plus-fill"></i> Pengisian Data
@endsection

@section('prescripts')
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px; /* space between items */
        }

        /* Form item styling */
        .form-item {
            flex: 1 1 calc(25% - 15px);
            display: flex;
            flex-direction: column;
        }

        .flex-2-col {
            flex: 1 1 calc(50% - 20px);
        }

        /* Label styling */
        .form-item label {
            font-size: 0.9em;
            color: #555;
            margin-bottom: 5px;
        }

        /* Input styling */
        .form-item input,select {
            padding: 5px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
@endsection

@section('content-body')
    <form method="post" action="asesmen">
        <h5 class="text-primary">Tanda Vital</h5>
        <div class="container">
            <div class="form-item">
                <label>Denyut Jantung <span class="text-danger">*</span> </label>
                <input type="text" placeholder="kali/menit" id="denyut_jantung" name="denyut_jantung" required>
            </div>
            <div class="form-item">
                <label>Pernapasan <span class="text-danger">*</span> </label>
                <input type="text" placeholder="napas-menit" id="pernapasan" name="pernapasan" required>
            </div>
            <div class="form-item">
                <label>Suhu <span class="text-danger">*</span> </label>
                <input type="text" placeholder="°C" id="suhu" name="suhu" required>
            </div>
            <div class="form-item">
                <label>Tingkat Kesadaran <span class="text-danger">*</span> </label>
                <input type="text" placeholder="CGS" id="tingkat_kesadaran" name="tingkat_kesadaran" required>
            </div>
            <div class="form-item">
                <label>Tekanan Darah *Sistole <span class="text-danger">*</span> </label>
                <input type="text" placeholder="mmHg" id="tekanan_darah_sistole" name="tekanan_darah_sistole" required>
            </div>
            <div class="form-item">
                <label>Tekanan Darah *Distole <span class="text-danger">*</span> </label>
                <input type="text" placeholder="mmHg" id="tekanan_darah_distole" name="tekanan_darah_distole" required>
            </div>
            <div class="form-item">
                <label>Berat Badan <span class="text-danger">*</span> </label>
                <input type="text" placeholder="kg" id="berat_badan" name="berat_badan" required>
            </div>
            <div class="form-item">
                <label>Tinggi Badan <span class="text-danger">*</span> </label>
                <input type="text" placeholder="cm" id="tinggi_badan" name="tinggi_badan" required>
            </div>
        </div>
        <h5 class="text-primary">Anamnesis</h5>
        <div class="container">
            <div class="form-item flex-2-col">
                <label>Keluhan Utama <span class="text-danger">*</span> </label>
                <input type="text" id="keluhan_utama" name="keluhan_utama" required>
            </div>
            <div class="form-item flex-2-col">
                <label>Riwayat Alergi Obat <span class="text-danger">*</span> </label>
                <input type="text" id="riwayat_alergi_obat" name="riwayat_alergi_obat" required>
            </div>
            <div class="form-item flex-2-col">
                <label>Riwayat Penyakit <span class="text-danger">*</span> </label>
                <input type="text" id="riwayat_penyakit" name="riwayat_penyakit" required>
            </div>
            <div class="form-item flex-2-col">
                <label>Riwayat Pengobatan <span class="text-danger">*</span> </label>
                <input type="text" id="riwayat_pengobatan" name="riwayat_pengobatan" required>
            </div>
        </div>
        <hr>
        <div class="container">
            <button data-toggle="modal" type="button" data-target="#head-to-toe" class="btn btn-primary">Pemeriksaan Head to Toe</button>
            <input type="checkbox"><span style="margin-top: auto; margin-bottom: auto">Semua Normal</span>
            <button type="button" class="btn btn-primary" style="margin-left: auto">Save changes</button>
        </div>

        <div class="modal fade" id="head-to-toe" tabindex="-1" role="dialog"aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 1140px">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5 class="text-primary">Pemeriksaan Head to Toe</h5>
                        <div class="container">
                            <div class="form-item">
                                <label>Kepala <span class="text-danger">*</span> </label>
                                <input type="text" id="kepala" name="kepala" required>
                            </div>
                            <div class="form-item">
                                <label>Lidah <span class="text-danger">*</span> </label>
                                <input type="text" id="lidah" name="lidah" required>
                            </div>
                            <div class="form-item">
                                <label>Punggung <span class="text-danger">*</span> </label>
                                <input type="text" id="punggung" name="punggung" required>
                            </div>
                            <div class="form-item">
                                <label>Kuku Tangan <span class="text-danger">*</span> </label>
                                <input type="text" id="kuku_tangan" name="kuku_tangan" required>
                            </div>
                            <div class="form-item">
                                <label>Mata <span class="text-danger">*</span> </label>
                                <input type="text" id="mata" name="mata" required>
                            </div>
                            <div class="form-item">
                                <label>Langit-Langit <span class="text-danger">*</span> </label>
                                <input type="text" id="langit_langit" name="langit_langit" required>
                            </div>
                            <div class="form-item">
                                <label>Perut <span class="text-danger">*</span> </label>
                                <input type="text" id="perut" name="perut" required>
                            </div>
                            <div class="form-item">
                                <label>Persendian Tangan <span class="text-danger">*</span> </label>
                                <input type="text" id="persendian_tangan" name="persendian_tangan" required>
                            </div>
                            <div class="form-item">
                                <label>Telinga <span class="text-danger">*</span> </label>
                                <input type="text" id="telinga" name="telinga" required>
                            </div>
                            <div class="form-item">
                                <label>Leher <span class="text-danger">*</span> </label>
                                <input type="text" id="leher" name="leher" required>
                            </div>
                            <div class="form-item">
                                <label>Genital <span class="text-danger">*</span> </label>
                                <input type="text" id="genital" name="genital" required>
                            </div>
                            <div class="form-item">
                                <label>Tungkai Atas <span class="text-danger">*</span> </label>
                                <input type="text" id="tungkai_atas" name="tungkai_atas" required>
                            </div>
                            <div class="form-item">
                                <label>Hidung <span class="text-danger">*</span> </label>
                                <input type="text" id="hidung" name="hidung" required>
                            </div>
                            <div class="form-item">
                                <label>Tenggorokan <span class="text-danger">*</span> </label>
                                <input type="text" id="tenggorokan" name="tenggorokan" required>
                            </div>
                            <div class="form-item">
                                <label>Anus/Dubur <span class="text-danger">*</span> </label>
                                <input type="text" id="anus_dubur" name="anus_dubur" required>
                            </div>
                            <div class="form-item">
                                <label>Tungkai Bawah <span class="text-danger">*</span> </label>
                                <input type="text" id="tungkai_bawah" name="tungkai_bawah" required>
                            </div>
                            <div class="form-item">
                                <label>Rambut <span class="text-danger">*</span> </label>
                                <input type="text" id="rambut" name="rambut" required>
                            </div>
                            <div class="form-item">
                                <label>Tongsil <span class="text-danger">*</span> </label>
                                <input type="text" id="tongsil" name="tongsil" required>
                            </div>
                            <div class="form-item">
                                <label>Lengan Atas <span class="text-danger">*</span> </label>
                                <input type="text" id="lengan_atas" name="lengan_atas" required>
                            </div>
                            <div class="form-item">
                                <label>Jari Kaki <span class="text-danger">*</span> </label>
                                <input type="text" id="jari_kaki" name="jari_kaki" required>
                            </div>
                            <div class="form-item">
                                <label>Bibir <span class="text-danger">*</span> </label>
                                <input type="text" id="bibir" name="bibir" required>
                            </div>
                            <div class="form-item">
                                <label>Dada <span class="text-danger">*</span> </label>
                                <input type="text" id="dada" name="dada" required>
                            </div>
                            <div class="form-item">
                                <label>Lengan Bawah <span class="text-danger">*</span> </label>
                                <input type="text" id="lengan_bawah" name="lengan_bawah" required>
                            </div>
                            <div class="form-item">
                                <label>Kuku Kaki <span class="text-danger">*</span> </label>
                                <input type="text" id="kuku_kaki" name="kuku_kaki" required>
                            </div>
                            <div class="form-item">
                                <label>Gigi Geligi <span class="text-danger">*</span> </label>
                                <input type="text" id="gigi_geligi" name="gigi_geligi" required>
                            </div>
                            <div class="form-item">
                                <label>Payudara <span class="text-danger">*</span> </label>
                                <input type="text" id="payudara" name="payudara" required>
                            </div>
                            <div class="form-item">
                                <label>Jari Tangan <span class="text-danger">*</span> </label>
                                <input type="text" id="jari_tangan" name="jari_tangan" required>
                            </div>
                            <div class="form-item">
                                <label>Persendian Kaki <span class="text-danger">*</span> </label>
                                <input type="text" id="persendian_kaki" name="persendian_kaki" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="submit-btn" data-dismiss="modal">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
