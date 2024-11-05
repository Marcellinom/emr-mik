@extends('layouts.master')

@section('content-header')
    Asesmen Awal
@endsection

@section('content-header-specific')
    <i class="bi bi-person-plus-fill"></i> Pengisian Data
@endsection

@section('prestyles')
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

@section('scripts')
    <script>
        $("#semua-normal").click(e => {
            if($("#semua-normal").is(":checked")) {
                $("#pemeriksaan-detail").hide()

                for(let i of document.getElementById("form-head-to-toe").querySelectorAll('input')) {
                    i.value = null
                }
            } else {
                $("#pemeriksaan-detail").show()
            }
        })
        $("#submit-btn").click(e => {
            e.preventDefault()
            let input_element = document.querySelectorAll('input')
            for (let input of input_element) {
                if (input.required) {
                    if (input.value == null || input.value == "") {
                        alert("mohon isi semua form yang memiliki simbol (*)")
                        return
                    }
                }
            }
            let id_riwayat = $("#hidden-id-riwayat").val()
            if (id_riwayat == "" || id_riwayat == null) {
                alert("terjadi kesalahan, id riwayat tidak ditemukan")
            }
            $("#form-asesmen").submit()
        })
    </script>
@endsection

@section('content-body')
    <form id="form-asesmen" method="post" action="asesmen">
        @csrf
        <input type="hidden" name="id_riwayat" value="{{Session::get('id_registrasi')}}" id="hidden-id-riwayat">
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
                <input type="text" placeholder="GCS" id="tingkat_kesadaran" name="tingkat_kesadaran" required>
            </div>
            <div class="form-item">
                <label>Tekanan Darah *Sistole <span class="text-danger">*</span> </label>
                <input type="text" placeholder="mmHg" id="tekanan_darah_sistole" name="tekanan_darah_sistole" required>
            </div>
            <div class="form-item">
                <label>Tekanan Darah *Diastole <span class="text-danger">*</span> </label>
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
                <label>Riwayat Alergi Obat</label>
                <input type="text" id="riwayat_alergi_obat" name="riwayat_alergi_obat">
            </div>
            <div class="form-item flex-2-col">
                <label>Riwayat Penyakit</label>
                <input type="text" id="riwayat_penyakit" name="riwayat_penyakit">
            </div>
            <div class="form-item flex-2-col">
                <label>Riwayat Pengobatan</label>
                <input type="text" id="riwayat_pengobatan" name="riwayat_pengobatan">
            </div>
        </div>
        <hr>
        <div class="container">
            <button id="pemeriksaan-detail" data-toggle="modal" type="button" data-target="#head-to-toe" class="btn btn-primary">Pemeriksaan Head to Toe</button>
            <input id="semua-normal" type="checkbox"><span style="margin-top: auto; margin-bottom: auto">Semua Normal</span>
            <button id="submit-btn" type="button" class="btn btn-success" style="margin-left: auto">Simpan</button>
        </div>

        <div class="modal fade" id="head-to-toe" tabindex="-1" role="dialog"aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 1140px">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5 class="text-primary">Pemeriksaan Head to Toe</h5>
                        <div class="container" id="form-head-to-toe">
                            <div class="form-item">
                                <label>Kepala  </label>
                                <input type="text" id="kepala" name="kepala" >
                            </div>
                            <div class="form-item">
                                <label>Lidah  </label>
                                <input type="text" id="lidah" name="lidah" >
                            </div>
                            <div class="form-item">
                                <label>Punggung  </label>
                                <input type="text" id="punggung" name="punggung" >
                            </div>
                            <div class="form-item">
                                <label>Kuku Tangan  </label>
                                <input type="text" id="kuku_tangan" name="kuku_tangan" >
                            </div>
                            <div class="form-item">
                                <label>Mata  </label>
                                <input type="text" id="mata" name="mata" >
                            </div>
                            <div class="form-item">
                                <label>Langit-Langit  </label>
                                <input type="text" id="langit_langit" name="langit_langit" >
                            </div>
                            <div class="form-item">
                                <label>Perut  </label>
                                <input type="text" id="perut" name="perut" >
                            </div>
                            <div class="form-item">
                                <label>Persendian Tangan  </label>
                                <input type="text" id="persendian_tangan" name="persendian_tangan" >
                            </div>
                            <div class="form-item">
                                <label>Telinga  </label>
                                <input type="text" id="telinga" name="telinga" >
                            </div>
                            <div class="form-item">
                                <label>Leher  </label>
                                <input type="text" id="leher" name="leher" >
                            </div>
                            <div class="form-item">
                                <label>Genital  </label>
                                <input type="text" id="genital" name="genital" >
                            </div>
                            <div class="form-item">
                                <label>Tungkai Atas  </label>
                                <input type="text" id="tungkai_atas" name="tungkai_atas" >
                            </div>
                            <div class="form-item">
                                <label>Hidung  </label>
                                <input type="text" id="hidung" name="hidung" >
                            </div>
                            <div class="form-item">
                                <label>Tenggorokan  </label>
                                <input type="text" id="tenggorokan" name="tenggorokan" >
                            </div>
                            <div class="form-item">
                                <label>Anus/Dubur  </label>
                                <input type="text" id="anus_dubur" name="anus_dubur" >
                            </div>
                            <div class="form-item">
                                <label>Tungkai Bawah  </label>
                                <input type="text" id="tungkai_bawah" name="tungkai_bawah" >
                            </div>
                            <div class="form-item">
                                <label>Rambut  </label>
                                <input type="text" id="rambut" name="rambut" >
                            </div>
                            <div class="form-item">
                                <label>Tongsil  </label>
                                <input type="text" id="tongsil" name="tongsil" >
                            </div>
                            <div class="form-item">
                                <label>Lengan Atas  </label>
                                <input type="text" id="lengan_atas" name="lengan_atas" >
                            </div>
                            <div class="form-item">
                                <label>Jari Kaki  </label>
                                <input type="text" id="jari_kaki" name="jari_kaki" >
                            </div>
                            <div class="form-item">
                                <label>Bibir  </label>
                                <input type="text" id="bibir" name="bibir" >
                            </div>
                            <div class="form-item">
                                <label>Dada  </label>
                                <input type="text" id="dada" name="dada" >
                            </div>
                            <div class="form-item">
                                <label>Lengan Bawah  </label>
                                <input type="text" id="lengan_bawah" name="lengan_bawah" >
                            </div>
                            <div class="form-item">
                                <label>Kuku Kaki  </label>
                                <input type="text" id="kuku_kaki" name="kuku_kaki" >
                            </div>
                            <div class="form-item">
                                <label>Gigi Geligi  </label>
                                <input type="text" id="gigi_geligi" name="gigi_geligi" >
                            </div>
                            <div class="form-item">
                                <label>Payudara  </label>
                                <input type="text" id="payudara" name="payudara" >
                            </div>
                            <div class="form-item">
                                <label>Jari Tangan  </label>
                                <input type="text" id="jari_tangan" name="jari_tangan" >
                            </div>
                            <div class="form-item">
                                <label>Persendian Kaki  </label>
                                <input type="text" id="persendian_kaki" name="persendian_kaki" >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
