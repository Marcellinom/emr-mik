@extends('layouts.master')
@extends('master_data.navbar-atas-pasien')

@section('content-header')
    Pemeriksaan
@endsection

@section('content-header-specific')
    <i class="bi bi-person-plus-fill"></i> Soape
@endsection

@section('content-body')
    <h5 class="text-primary">Riwayat Berobat</h5>
    <div class="container" style="flex-wrap: nowrap">
        <table>
            <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Kunjungan</th>
                <th>Poli</th>
                <th>Dokter</th>
                <th>Resume</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
                @foreach($riwayat as $i => $item)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$item->tanggal_kunjungan}}</td>
                        <td>{{$item->poli}}</td>
                        <td>{{$item->dokter}}</td>
                        <td><button class="btn btn-{{$item->resume ? "success" : "warning"}}" disabled>{{$item->resume ? "Sudah Ditandatangani" : "Belum Ditandatangani"}}</button></td>
                        <td><a href="/pemeriksaan/asesmen_awal/{{$item->id}}" class="btn btn-primary text-white">Lihat</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('prestyles')
    <link href="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.css" rel="stylesheet">
    <style>
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

@section('scripts')
    <script>
        new DataTable('#list-diagnosis');
    </script>
@endsection
