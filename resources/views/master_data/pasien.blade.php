@extends('layouts.master')

@section('content-header')
    Master Data
@endsection

@section('content-header-specific')
    <i class="bi bi-people-fill"></i> Data Pasien
@endsection

@section('prestyles')
    <link href="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.css" rel="stylesheet">
@endsection

@section('prescripts')
    <script src="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.js"></script>
@endsection

@section('content-body')
        <a class="btn btn-primary" href="tambah_pasien"><i class="bi bi-person-plus-fill"></i> Tambah Pasien Baru</a>
        <table id="pasien" style="width:100%" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>No</th>
                <th>No RM</th>
                <th>Pasien</th>
                <th>Riwayat Poli</th>
                <th>Nama Dokter</th>
                <th>Kunjungan Terakhir</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data_pasien as $i => $row)
                <tr>
                    <td>{{$i + 1}}</td>
                    <td>{{sprintf("RM%08d", $row->no_rm)}}</td>
                    <td>{{$row->nama}}</td>
                    <td>{{$row->poliklinik_tujuan ?? "belum berkunjung"}}</td>
                    <td>{{$row->nama_dokter ?? "belum berkunjung"}}</td>
                    <td>{{$row->created_at ?? "belum berkunjung"}}</td>
                    <td>
                        <a href="/pasien/{{$row->no_rm}}" class="btn btn-primary">lihat</a>
{{--                        <button class="btn btn-warning">edit</button>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div id="modals"></div>
    <script>
        new DataTable('#pasien');
    </script>
@endsection
