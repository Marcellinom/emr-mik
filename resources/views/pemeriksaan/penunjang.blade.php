@extends('layouts.master')
@extends('pemeriksaan.navbar-atas')

@section('content-header')
    Pemeriksaan
@endsection

@section('content-header-specific')
    <i class="bi bi-person-plus-fill"></i> Penunjang
@endsection

@section('content-body')
    <form id="form-penunjang" action="/pemeriksaan/penunjang" method="post">
        @csrf
        <input type="hidden" name="id_riwayat" value="{{$id}}">
    <div class="container">
            @include('tabel-util.tabel-laboratorium')
            @include('tabel-util.tabel-radiologi')
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
            $("#form-penunjang").submit()
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
@endsection
