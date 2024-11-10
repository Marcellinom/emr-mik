@extends('layouts.master')
<style>
    #info-pasien-atas {
        display: flex;
        align-items: center;
    }
    .profile-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
    }

    .info {
        flex-grow: 1;
    }

    .info h3 {
        margin: 0;
        font-size: 1.2em;
        font-weight: bold;
    }

    .info p {
        margin: 4px 0;
        color: #666;
    }

    .kanan {
        text-align: right;
        font-size: 0.9em;
        font-weight: bold;
        margin-top: auto;
        color: #333;
    }

    .btn-group button {
        background-color: #5ba8e2; /* Green background */
        color: black; /* White text */
        padding: 1px 15px; /* Some padding */
        float: left; /* Float the buttons side by side */
    }
    input[type="checkbox"] {
        width: 1.5em;
        height: 1.5em;
    }
</style>
@section('content-body-upper')
    <div class="container">
        <div id="cari-pasien-container" class="form-item">
            <label>Cari Pasien <span class="text-danger">*</span> </label>
            <select name="no_rm" id="cari_pasien" required>
            </select>
        </div>
    </div>
    <div id="info-pasien-atas" hidden>
        <object class="profile-img" data="{{asset('person-sick.jpg')}}" type="image/png">
            {{--        di masa depan kalau mau implemen foto user, img tag dibawah adalah icon default jika foto diatas gaada--}}
            <img class="profile-img" src="{{asset('person-sick.jpg')}}">
        </object>
        <div class="info">
            <h3 id="info-nama"></h3>
            <p id="info-rm"></p>
            <p id="info-nik"></p>
            <p id="info-kelamin-lahir"></p>
            <div class="btn-group">
                <button id="info-dr" style="border-bottom-left-radius: 16px; border-top-left-radius: 16px; border-right: 1px black" disabled>{{$dokter->nama}}</button>
                <button id="info-poli" style="border-bottom-right-radius: 16px; border-top-right-radius: 16px" disabled>Poli Jiwa</button>
            </div>
        </div>
    </div>

    <script>
        const data_pasien = {}
        $("#cari_pasien").select2({
            tags: false,
            allowClear: true,
            dropdownParent: $("#cari-pasien-container"),
            minimumInputLength: 2,
            width: "100%",
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
                        data_pasien[v.no_rm] = v
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

        $("#cari_pasien").on('select2:select', (e) => {
            let d = data_pasien[e.params.data.id]
            $("#info-nama").html(d.nama)
            $("#info-rm").html(`RM${pad(d.no_rm, 8)}`)
            $("#info-nik").html(d.nik)
            $("#info-kelamin-lahir").html(`${d.jenis_kelamin == "L" ? "Laki-Laki" : "Perempuan"} ${formatDateAndAge(d.tanggal_lahir)}`)
            $("#info-pasien-atas").removeAttr("hidden")
            $("#no_rm").val(e.params.data.id)
            $("#form-konseling").removeAttr("hidden")
            $("#pilih-pasien-notice").attr("hidden", true)
        })

        function pad(num, size) {
            var s = "00000000" + num;
            return s.substr(s.length-size);
        }
        function formatDateAndAge(dateString) {
            const months = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            // Parse the date
            const birthDate = new Date(dateString);
            const day = birthDate.getDate();
            const month = months[birthDate.getMonth()];
            const year = birthDate.getFullYear();

            // Calculate the age
            const today = new Date();
            let age = today.getFullYear() - year;
            if (
                today.getMonth() < birthDate.getMonth() ||
                (today.getMonth() === birthDate.getMonth() && today.getDate() < day)
            ) {
                age--;
            }

            // Format the date and age string
            return `${day} ${month} ${year} ${age} Tahun`;
        }
    </script>
@endsection

@section('content-body')
    <span id="pilih-pasien-notice"><h5 class="text-primary">Mohon pilih pasien terlebih dahulu</h5></span>
    <form id="form-konseling" method="post" action="konseling" hidden>
        @csrf
        <input type="hidden" id="no_rm" name="no_rm">
        <input type="hidden" id="id_dokter" name="id_dokter" value="{{$dokter->id}}">
        @include('konseling.navbar-kanan')
        @include('konseling.form-text-atas')
        <br>
        @include('tabel-util.tabel-diagnosa')
        <br>
        @include('tabel-util.tabel-tindakan')
        <br>
        @include('tabel-util.tabel-potensi-diri')
    </form>
    <div class="container">
        <button id="submit-btn" type="button" class="btn btn-success" style="margin-left: auto">Simpan</button>
    </div>
@endsection

@section('scripts')
    <script>
        const form = $("#form-konseling")
        $("#submit-btn").click(e => {
            e.preventDefault()
            for (let v of document.querySelectorAll("#klarifikasi_masalah input[type=checkbox]")) {
                if (v.checked) {
                    form.append(`<input type='text' name='list_klarifikasi_masalah[]' value='${v.id}'>`)
                }
            }

            form.submit()
        })
    </script>
@endsection

@section('prestyles')
    <link href="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
