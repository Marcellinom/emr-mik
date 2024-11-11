@extends('layouts.master')
@extends('pemeriksaan.navbar-atas')

@section('content-header')
    Pemeriksaan
@endsection

@section('content-header-specific')
    <i class="bi bi-person-plus-fill"></i> Soape
@endsection

@section('content-body')
    <form id="form-soape" action="/pemeriksaan/soape" method="post">
        @csrf
        <input type="hidden" name="riwayat_id" value="{{$id}}">
        <h5 class="text-primary"><i class="bi bi-info-circle"></i> SOAP</h5>
        <div class="container">
            <div class="form-item">
                <label>Subjektif <span class="text-danger">*</span> </label>
                <input type="text" id="subjektif" name="subjektif" required>
            </div>
            <div class="form-item">
                <label>asesmen <span class="text-danger">*</span> </label>
                <input type="text" id="asesmen" name="asesmen" required>
            </div>
            <div class="form-item">
                <label>objektif <span class="text-danger">*</span> </label>
                <input type="text" id="objektif" name="objektif" required>
            </div>
            <div class="form-item">
                <label>rencana <span class="text-danger">*</span> </label>
                <input type="text" id="rencana" name="rencana" required>
            </div>
        </div>
        <br>
        @include('tabel-util.tabel-diagnosa')
        <br>
        @include('tabel-util.tabel-tindakan')
        <br>
        @include('tabel-util.tabel-resep_obat')
        <br>
        <h5 class="text-primary">Edukasi</h5>
        <div class="checkbox-item">
            <input type="checkbox" name="penjelasan_penyakit" id="penjelasan_penyakit">
            <label for="keluarga">Penjelasan terkait penyakit; hasil pemeriksaan dan tindakan medis</label>
        </div>
        <div class="checkbox-item">
            <input type="checkbox" name="penjelasan_obat" id="penjelasan_obat">
            <label for="pekerjaan">Penjelasan terkait obat-obatan yang diberikan</label>
        </div>
        <div class="checkbox-item">
            <input type="checkbox" name="penjelasan_informed_consent" id="penjelasan_informed_consent">
            <label for="emosi">Penjelasan terkait Informed Consent</label>
        </div>
    </form>
    <div class="container">
        <button id="submit-btn" type="button" class="btn btn-success" style="margin-left: auto">Simpan</button>
    </div>
@endsection

@section('scripts')
    <script>
        $("#submit-btn").click((e) => {
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
            $("#form-soape").submit()
        })

        const data_soap = @json($data_soap)

        for (let i in data_soap) {
            let e = $(`#${i}`)
            if(e.attr('type') == 'checkbox') {
                e.prop('checked', data_soap[i]);
            } else {
                e.val(data_soap[i])
            }
        }
    </script>
@endsection

@section('prestyles')
    <link href="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .checkbox-item {
            display: flex;
            gap: 2px;
        }
        .checkbox-item label {
            font-size: 16px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px; /* space between items */
        }

        /* Form item styling */
        .form-item {
            flex: 1 1 calc(50% - 15px);
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #c7c7c7;
        }
        th {
            border: 0;
            background-color: #9ab4d0;
            color: white;
        }
    </style>
@endsection
@section('prescripts')
    <script src="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
