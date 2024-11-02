@extends('layouts.master')
@extends('pemeriksaan.navbar-atas')

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


@section('content-body')

@endsection
