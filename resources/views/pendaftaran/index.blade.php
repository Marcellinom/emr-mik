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
    <style>
        /* Container styling */
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px; /* space between items */
        }

        /* Form item styling */
        .form-item {
            flex: 1 1 calc(33.33% - 20px); /* 3 items per row with gap */
            display: flex;
            flex-direction: column;
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

@section('prescripts')
    <script src="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.js"></script>
@endsection

@section('content-body')
    <a class="btn btn-primary" href="tambah_pasien"><i class="bi bi-person-plus-fill"></i> Tambah Pasien Baru</a>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target=".new-antrian">Daftarkan Pasien</button>
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
                    <button class="btn btn-primary">edit</button>
                    <button class="btn btn-warning">cetak</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="modals">
        <div class="modal fade new-antrian" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        Daftarkan antrian baru pasien
                    </div>
                    <div class="modal-body">
                        <form id="form-pendaftaran" action="pendaftaran" method="post">
                            @csrf
                            <div class="container">
                                <div class="form-item">
                                    <label>Pasien <span class="text-danger">*</span> </label>
                                    <input type="text" id="search_pasien" placeholder="cari nama pasien" autocomplete="off" hidden>
                                    <div style="display: flex; gap: 10px" id="pasien">
                                        <a href="#" id="search-btn-pasien"><i class="bi bi-search"></i></a>
                                        <select id="res_pasien" name="no_rm" style="width: 100%" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-item">
                                    <label>Nama Penanggung Jawab <span class="text-danger">*</span> </label>
                                    <input type="text" id="nama_penanggung_jawab" name="nama_penanggung_jawab" required>
                                </div>
                                <div class="form-item">
                                    <label>Telp Penanggung Jawab <span class="text-danger">*</span> </label>
                                    <input type="number" id="no_telp_penanggung_jawab" name="no_telp_penanggung_jawab" required>
                                </div>
                                <div class="form-item">
                                    <label>Hubungan dengan Pasien <span class="text-danger">*</span> </label>
                                    <input type="text" id="hubungan_dengan_pasien" name="hubungan_dengan_pasien" required>
                                </div>
                                <div class="form-item">
                                    <label>Poliklinik Tujuan <span class="text-danger">*</span> </label>
                                    <input type="text" id="poliklinik_tujuan" name="poliklinik_tujuan" required>
                                </div>
                                <div class="form-item">
                                    <label>Dokter <span class="text-danger">*</span> </label>
                                    <input type="text" id="search_dokter" placeholder="cari nama dokter" autocomplete="off" hidden>
                                    <div style="display: flex; gap: 10px" id="dokter">
                                        <a href="#" id="search-btn-dokter"><i class="bi bi-search"></i></a>
                                        <select id="res_dokter" name="id_dokter" style="width: 100%" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-item">
                                    <label>Cara Masuk <span class="text-danger">*</span> </label>
                                    <input type="text" id="cara_masuk" name="cara_masuk" required>
                                </div>
                                <div class="form-item">
                                    <label>Pembayaran <span class="text-danger">*</span> </label>
                                    <input type="text" id="pembayaran" name="pembayaran" required>
                                </div>
                                <div class="form-item">
                                    <label>No Asuransi/BPJS <span class="text-danger">*</span> </label>
                                    <input type="text" id="no_asuransi" name="no_asuransi" required>
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

        let typingTimer
        $('#search_pasien').on('keyup', () => {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(searchPasien, 1000);  // 5 detik selesai typing baru ngesearch
        })
        $('#search_dokter').on('keyup', () => {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(searchDokter, 1000);  // 5 detik selesai typing baru ngesearch
        })

        $("#search-btn-pasien").on("click", (e) => {
            $("#pasien").attr("hidden", true)
            $('#search_pasien').removeAttr("hidden")
            e.preventDefault()
        })
        $("#search-btn-dokter").on("click", (e) => {
            $("#dokter").attr("hidden", true)
            $('#search_dokter').removeAttr("hidden")
            e.preventDefault()
        })

        function searchPasien() {
            $.ajax({
                url: `/api/pasien_by_name?name=${$('#search_pasien').val()}`,
                type: "GET",
                dataType: "json", // Expect JSON data in response
                success: function(response) {
                    $("#res_pasien").empty()
                    for (v of response.data) {
                        $("#res_pasien").append(`<option value=${v.no_rm}>${v.nama}</option>`)
                    }
                    console.log(response)
                },
                error: function(xhr, status, error) {
                    alert(error.toString())
                },
                complete: function () {
                    $("#pasien").removeAttr("hidden")
                    $('#search_pasien').attr("hidden", true)
                }
            })
        }
        function searchDokter() {
            $.ajax({
                url: `/api/dokter_by_name?name=${$('#search_dokter').val()}`,
                type: "GET",
                dataType: "json", // Expect JSON data in response
                success: function(response) {
                    for (v of response.data) {
                        $("#res_dokter").empty()
                        $("#res_dokter").append(`<option value=${v.id}>${v.nama}</option>`)
                    }
                    console.log(response)
                },
                error: function(xhr, status, error) {
                    alert(error.toString())
                },
                complete: function () {
                    $("#dokter").removeAttr("hidden")
                    $('#search_dokter').attr("hidden", true)
                }
            })
        }
        new DataTable('#antrian', {
            order: [[4, 'asc']]
        });
    </script>
@endsection
