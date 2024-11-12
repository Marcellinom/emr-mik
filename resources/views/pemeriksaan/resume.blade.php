@extends('layouts.master')
@extends('pemeriksaan.navbar-atas')

@section('content-header')
    Pemeriksaan
@endsection

@section('content-header-specific')
    <i class="bi bi-person-plus-fill"></i> Penunjang
@endsection

@section('prescripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
@endsection

@section('content-body')
    <form id="form-resume-medis" action="/pemeriksaan/resume_medis" method="post">
        @csrf
        <input type="hidden" name="id_riwayat" id="id_riwayat" value="{{$id}}">
        <div class="container">
            @include('pemeriksaan.navbar-kanan')
            <div class="form-item">
                <label>Tanggal <span class="text-danger">*</span> </label>
                <input type="datetime-local" id="tanggal" disabled value="{{$tanggal}}">
            </div>
            <div class="form-item">
                <label>Cara Masuk <span class="text-danger">*</span> </label>
                <input type="text" id="cara_masuk" disabled value="{{$cara_masuk}}">
            </div>
            <div class="form-item">
                <label>Status Pulang <span class="text-danger">*</span> </label>
                <select id="status_pulang" name="status_pulang" required>
                    <option value="{{$row_resume->status_pulang}}" selected disabled hidden>{{$row_resume->status_pulang}}</option>
                    <option value="Pulang">Pulang</option>
                    <option value="Meninggal">Meninggal</option>
                    <option value="Konsultasi Kembali">Konsultasi Kembali</option>
                    <option value="Dirujuk">Dirujuk</option>
                </select>
            </div>
            <button id="submit-btn" type="button" class="btn btn-success" style="margin-left: auto">Simpan dan Akhiri Pemeriksaan</button>
        </div>
        <input type="hidden" id="input_ttd_resume_medis" name="ttd_resume_medis">
        <input type="hidden" id="input_ttd_informed_consent" name="ttd_informed_consent">
    </form>
@endsection

@section('scripts')
    <script>
        $("#submit-btn").click((e) => {
            e.preventDefault()
            let sp = $("#status_pulang").val()
            if (sp == "" || sp == null) {
                alert('harus isi status pulang!')
                return
            }
            for (let i in ttd_pad) {
                if (ttd_pad[i].isEmpty()) continue
                let data = ttd_pad[i].toDataURL('image/png');
                $(`#input_${i}`).val(data)
            }
            $("#form-resume-medis").submit()
        })
    </script>
@endsection

@section('prestyles')
    <link href="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.css" rel="stylesheet">
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
            flex: 1 1 calc(33.33% - 20px);
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
