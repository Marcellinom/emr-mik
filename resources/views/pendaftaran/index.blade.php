@extends('layouts.master')

@section('content-header')
    Pendaftaran
@endsection

@section('content-header-specific')
    <i class="bi bi-person-raised-hand"></i> Daftar Antrian
@endsection

@section('prestyles')
    <link href="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/components/spinners/">
{{--    dynamic select tag with search bar --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Container styling */
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px; /* space between items */
        }

        /* Form item styling */
        .item {
            flex: 1 1 calc(33.33% - 20px); /* 3 items per row with gap */
            display: flex;
            flex-direction: column;
        }

        /* Label styling */
        .item label {
            font-size: 0.9em;
            color: #555;
            margin-bottom: 5px;
        }

        /* Input styling */
        .item input {
            padding: 5px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
@endsection

@section('prescripts')
    <script src="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content-body')
    <a class="btn btn-primary" href="tambah_pasien"><i class="bi bi-person-plus-fill"></i> Tambah Pasien Baru</a>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#new-antrian">Daftarkan Pasien</button>
    <table id="antrian" style="width:100%" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Nama Pasien</th>
            <th>No Registrasi</th>
            <th>No RM</th>
            <th>Tanggal Lahir</th>
            <th>No Antrian</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data_antrian as $i => $row)
            <tr>
                <td>{{$row->nama}}</td>
                <td>{{sprintf("REG%08d", $row->no_registrasi)}}</td>
                <td>{{sprintf("RM%08d", $row->no_rm)}}</td>
                <td>{{$row->tanggal_lahir}}</td>
                <td class="text-danger">{{sprintf("A%02d", $row->no_antrian)}}</td>
                <td>
                    <button class="btn btn-warning">cetak</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="modals">
        <div class="modal fade" id="new-antrian" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        Daftarkan antrian baru pasien
                    </div>
                    <div class="modal-body">
                        <form id="form-pendaftaran" action="pendaftaran" method="post">
                            @csrf
                            <div class="container">
                                <div class="item">
                                    <label>Pasien <span class="text-danger">*</span> </label>
                                    <select name="no_rm" id="cari_pasien" required>
                                    </select>
                                </div>
                                <div class="item">
                                    <label>Nama Penanggung Jawab <span class="text-danger">*</span> </label>
                                    <input type="text" id="nama_penanggung_jawab" name="nama_penanggung_jawab" required>
                                </div>
                                <div class="item">
                                    <label>Telp Penanggung Jawab <span class="text-danger">*</span> </label>
                                    <input type="number" id="no_telp_penanggung_jawab" name="no_telp_penanggung_jawab" required>
                                </div>
                                <div class="item">
                                    <label>Hubungan dengan Pasien <span class="text-danger">*</span> </label>
                                    <input type="text" id="hubungan_dengan_pasien" name="hubungan_dengan_pasien" required>
                                </div>
                                <div class="item">
                                    <label>Poliklinik Tujuan <span class="text-danger">*</span> </label>
                                    <input type="text" id="poliklinik_tujuan" name="poliklinik_tujuan" required>
                                </div>
                                <div class="item">
                                    <label>Dokter <span class="text-danger">*</span> </label>
                                    <select name="id_dokter" id="cari_dokter" required>
                                    </select>
                                </div>
                                <div class="item">
                                    <label>Cara Masuk <span class="text-danger">*</span> </label>
                                    <input type="text" id="cara_masuk" name="cara_masuk" required>
                                </div>
                                <div class="item">
                                    <label>Pembayaran <span class="text-danger">*</span> </label>
                                    <input type="text" id="pembayaran" name="pembayaran" required>
                                </div>
                                <div class="item">
                                    <label>No Asuransi/BPJS</label>
                                    <input type="text" id="no_asuransi" name="no_asuransi">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="daftar" type="button" class="btn btn-success">Daftarkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // validation
        $("#daftar").click(e => {
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
            $("#form-pendaftaran").submit()
        })

        $("#cari_pasien").select2({
            tags: false,
            dropdownParent: $('#new-antrian'),
            allowClear: true,
            minimumInputLength: 2,
            ajax: {
                delay: 500,
                url: function (params) {
                    return '/api/pasien_by_name?name=' + params.term;
                },
                type: "GET",
                dataType: "json", // Expect JSON data in response
                processResults: function(data) {
                    let datas = []
                    for (v of data.data) {
                        datas.push({
                            id: v.no_rm,
                            text: v.nama
                        })
                    }
                    return {
                        results: datas
                    }
                },
                error: function(xhr, status, error) {
                    alert(error.toString())
                }
            }
        });

        $("#cari_dokter").select2({
            tags: false,
            dropdownParent: $('#new-antrian'),
            allowClear: true,
            minimumInputLength: 2,
            ajax: {
                delay: 500,
                url: function (params) {
                    return '/api/dokter_by_name?name=' + params.term;
                },
                type: "GET",
                dataType: "json", // Expect JSON data in response
                processResults: function(data) {
                    let datas = []
                    for (v of data.data) {
                        datas.push({
                            id: v.id,
                            text: v.nama
                        })
                    }
                    return {
                        results: datas
                    }
                },
                error: function(xhr, status, error) {
                    alert(error.toString())
                }
            }
        });
        new DataTable('#antrian', {
            order: [[4, 'asc']]
        });
    </script>
@endsection
