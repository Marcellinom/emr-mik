@extends('layouts.master')
@extends('pemeriksaan.navbar-atas')

@section('content-header')
    Pemeriksaan
@endsection

@section('content-header-specific')
    <i class="bi bi-person-plus-fill"></i> Asesmen Awal
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


@section('content-body')
    <input type="hidden" name="id_riwayat" value="{{Session::get('id_registrasi')}}" id="hidden-id-riwayat"disabled>
    <h5 class="text-primary">Tanda Vital</h5>
    <div class="container">
        @php
             $satuan_tanda_vital = [
                 "denyut_jantung" => "kali/menit",
                 "pernapasan" => "napas-menit",
                 "suhu" => "°C",
                 "tingkat_kesadaran" => "GCS",
                 "tekanan_darah_sistole" => "mmHg",
                 "tekanan_darah_distole" => "mmHg",
                 "berat_badan" => "kg",
                 "tinggi_badan" => "cm",
            ];
        @endphp
        @foreach($data_asesmen_awal['tanda_vital'] as $k => $v)
            <div class="form-item">
                <label>{{Str::title(str_replace('_', ' ', $k))}}</label>
                <input type="text" value="{{$v}} {{$satuan_tanda_vital[$k]}}" id="{{$k}}" disabled>
            </div>
        @endforeach
    </div>
    <h5 class="text-primary">Anamnesis</h5>
    <div class="container">
        @foreach($data_asesmen_awal['anamnesis'] as $k => $v)
            <div class="form-item flex-2-col">
                <label>{{Str::title(str_replace('_', ' ', $k))}}</label>
                <input type="text" value="{{$v ?? '-'}}" id="{{$k}}" disabled>
            </div>
        @endforeach
    </div>
    <hr>
    <div class="container">
        <button id="pemeriksaan-detail" data-toggle="modal" type="button" data-target="#head-to-toe" class="btn btn-primary">Pemeriksaan Head to Toe</button>
        <input id="semua-normal" type="checkbox"><span style="margin-top: auto; margin-bottom: auto">Semua Normal</span>
    </div>

    <div class="modal fade" id="head-to-toe" tabindex="-1" role="dialog"aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 1140px">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="text-primary">Pemeriksaan Head to Toe</h5>
                    <div class="container" id="form-head-to-toe">
                        @foreach($data_asesmen_awal['head-to-toe'] as $k => $v)
                            <div class="form-item">
                                <label>{{Str::title(str_replace('_', ' ', $k))}}</label>
                                <input type="text" value="{{$v ?? '-'}}" id="{{$k}}" disabled>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("input:checkbox").click(function() { return false; });
        let i_head_to_toe = document.getElementById('form-head-to-toe').querySelectorAll('input')
        let semua_normal = true
        for (e of i_head_to_toe) {
            if (e.value != '-' || e.value == null) {
                semua_normal = false
            }
        }
        if (semua_normal) {
            document.getElementById('semua-normal').checked = true
        }
    </script>
@endsection
