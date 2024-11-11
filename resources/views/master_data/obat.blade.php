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
    <style>
        .btn-group button {
            background-color: #c2c2c2; /* Green background */
            color: black; /* White text */
            padding: 10px 24px; /* Some padding */
            cursor: pointer; /* Pointer/hand icon */
            float: left; /* Float the buttons side by side */
            border: 0;
        }
        #current:hover {
            cursor: not-allowed;
        }
    </style>
    <div class="btn-group">
        <button id="current" style="border-bottom-left-radius: 16px; border-top-left-radius: 16px; border: 1px solid black" disabled>✓ Daftar Obat</button>
        <a href="pesanan-obat"><button style="border-bottom-right-radius: 16px; border-top-right-radius: 16px">Pesanan Obat</button></a>

    </div>
{{--    <a class="btn btn-primary" href="pendaftaran"><i class="bi bi-person-plus-fill"></i> Tambah Daftar Obat</a>--}}

    <table id="obat" style="width:100%" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Kode Obat</th>
            <th>Nama Obat</th>
            <th>Kategori</th>
            <th>Sediaan Obat</th>
            <th>Jumlah Stok</th>
            <th>Kadaluarasa</th>
            <th>Sisa Hari</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>ONR00001</td>
            <td>TROGYL</td>
            <td>OBAT BEBAS TERBATAS</td>
            <td>TABLET</td>
            <td>30</td>
            <td>30/10/24</td>
            <td>5</td>
            <td></td>
        </tr>
        <tr>
            <td>2</td>
            <td>ONR00002</td>
            <td>AMBROXOL</td>
            <td>OBAT BEBAS</td>
            <td>TABLET</td>
            <td>22</td>
            <td>30/11/24</td>
            <td>36</td>
            <td></td>
        </tr>
        </tbody>
    </table>
    <div id="modals"></div>
    <script>
        new DataTable('#obat');
    </script>
@endsection
