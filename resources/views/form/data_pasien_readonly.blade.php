@php
    $placeholder = 'The standard Lorem Ipsum passage, used since the 1500s
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."

    Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC
    "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"

    1914 translation by H. Rackham
    "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a tri

    vial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"

    Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC
    "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."

    1914 translation by H. Rackham
    "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."'
@endphp

@extends('layouts.master')

@section('content-header')
    Master Data
@endsection

@section('content-header-specific')
    <i class="bi bi-person-plus-fill"></i> Detail Pasien
@endsection

@section('prestyles')
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
        .wrapper {
            position: relative;
            width: 400px;
            height: 200px;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid black;
        }
        .signature-pad {
            position: absolute;
            left: 0;
            top: 0;
            width:400px;
            height:200px;
        }
    </style>
@endsection

@section('prescripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
@endsection

@section('navbar-kanan')
    <div style="box-shadow:0 .6rem 1rem rgba(0,0,0,.15); background-color: white; padding: 10px; border: 1px solid black; border-radius: 10px">
        <i class="bi bi-info-circle"></i> <span style="font-weight: bold">Persetujuan Umum</span>
        <br><br>
        (<span class="text-danger">*</span>) Wajib ditandatangani oleh pasien / pendamping
        <br>
        <a id="show_form_persetujuan" class="btn btn-primary text-white" data-toggle="modal">Lihat</a>
    </div>
    <div style="box-shadow:0 .6rem 1rem rgba(0,0,0,.15); background-color: white; padding: 10px; border: 1px solid black; border-radius: 10px">
        <i class="bi bi-info-circle"></i> <span style="font-weight: bold">Rekam Medis</span>
        <br><br>
        Riwayat Berobat Pasien
        <br>
        <a href="/pasien/{{$data->no_rm}}/riwayat" class="btn btn-primary text-white">Lihat</a>
    </div>
@endsection

@section('scripts')
    <script>
        $(":input").prop("disabled", true);
        const data = @json($data);

        for (let i in data) {
            $(`#${i}`).val(data[i])
        }
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });

        signaturePad.fromDataURL(data.signature)
        $("#show_form_persetujuan").click((e) => {
            e.preventDefault()

            let input_element = document.querySelectorAll('input')


            $("#nama_confirm").text($("#nama").val())
            $("#alamat_confirm").text($("#alamat").val())
            $("#no_telp_confirm").text($("#no_telp").val())

            $("#persetujuan").modal('show')
        })
    </script>
@endsection

@section('content-body')
    {{--    modal persetujuan pasien--}}
    <div class="modal fade" id="persetujuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 1140px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-primary" class="modal-title" id="exampleModalLongTitle">Form Persetujuan Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="data-pasien-confirm">
                        <table>
                            <tr>
                                <td>Nama Pasien</td>
                                <td>: <span id="nama_confirm"></span></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: <span id="alamat_confirm"></span></td>
                            </tr>
                            <tr>
                                <td>No Telepon</td>
                                <td>: <span id="no_telp_confirm"></span></td>
                            </tr>
                        </table>
                    </div>
                    <h3 style="text-align: center">Lorem Ipsum</h3>
                    {{$placeholder}}

                    <div class="wrapper">
                        <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary text-white" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
    <form id="data-pasien" method="post" action="pasien">
        @csrf
        <input type="hidden" id="signature" name="signature">
        <h5 class="text-primary">Data Pasien</h5>
        <div class="container">
            <div class="form-item">
                <label>Nama Lengkap <span class="text-danger">*</span> </label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-item">
                <label>Nama Keluarga <span class="text-danger">*</span> </label>
                <input type="text" id="nama_keluarga" name="nama_keluarga" required>
            </div>
            <div class="form-item">
                <label>NIK <span class="text-danger">*</span> </label>
                <input type="number" id="nik" name="nik" required>
            </div>
            <div class="form-item">
                <label>No Identitas Lain <span class="text-danger">*</span> </label>
                <input type="text" id="no_identitas_lain" name="no_identitas_lain" required>
            </div>
            <div class="form-item">
                <label>Jenis Kelamin <span class="text-danger">*</span> </label>
                <select id="jenis_kelamin" name="jenis_kelamin" form="data-pasien" required>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-item">
                <label>Tempat Lahir <span class="text-danger">*</span> </label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" required>
            </div>
            <div class="form-item">
                <label>Tanggal Lahir <span class="text-danger">*</span> </label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>
            <div class="form-item">
                <label>Umur <span class="text-danger">*</span> </label>
                <input type="number" id="umur" name="umur" required>
            </div>
            <div class="form-item">
                <label>Nama Ibu Kandung <span class="text-danger">*</span> </label>
                <input type="text" id="nama_ibu" name="nama_ibu" required>
            </div>
            <div class="form-item">
                <label>No Telp Pribadi <span class="text-danger">*</span> </label>
                <input type="number" id="no_telp" name="no_telp" required>
            </div>
            <div class="form-item">
                <label>No Telp Rumah <span class="text-danger">*</span> </label>
                <input type="number" id="no_telp_rumah" name="no_telp_rumah" required>
            </div>
            <div class="form-item">
                <label>Agama <span class="text-danger">*</span> </label>
                <select id="agama" name="agama" form="data-pasien" required>
                    <option value="Katolik">Katolik</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Islam">Islam</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghuchu">Konghuchu</option>
                </select>
            </div>
            <div class="form-item">
                <label>Pendidikan <span class="text-danger">*</span> </label>
                <select id="pendidikan" name="pendidikan" form="data-pasien" required>
                    <option value="Belum Sekolah">Belum Sekolah</option>
                    <option value="TK">TK</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>
            <div class="form-item">
                <label>Status Pernikahan <span class="text-danger">*</span> </label>
                <select id="status_pernikahan" name="status_pernikahan" form="data-pasien" required>
                    <option value="Belum Menikah">Belum Menikah</option>
                    <option value="Sudah Menikah">Sudah Menikah</option>
                </select>
            </div>
            <div class="form-item">
                <label>Golongan Darah <span class="text-danger">*</span> </label>
                <select id="gol_darah" name="gol_darah" form="data-pasien" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="AB-">AB-</option>
                    <option value="O">O</option>
                    <option value="Rh-null">Rh-null</option>
                    <option value="P">P</option>
                    <option value="Bombay">Bombay</option>
                </select>
            </div>
            <div class="form-item">
                <label>Pekerjaan <span class="text-danger">*</span> </label>
                <input type="text" id="pekerjaan" name="pekerjaan" required>
            </div>
        </div>
        <hr>
        <h5 class="text-primary">Suku</h5>
        <div class="container">
            <div class="form-item">
                <label>Nama Suku</label>
                <input type="text" id="suku" name="suku">
            </div>
            <div class="form-item">
                <label>Bahasa yang Dikuasai</label>
                <input type="text" id="bahasa" name="bahasa">
            </div>
            <div class="form-item">
                <label>Kewarganegaraan</label>
                <input type="text" id="kewarganegaraan" name="kewarganegaraan">
            </div>
        </div>
        <hr>
        <h5 class="text-primary">Alamat</h5>

        {{--                                gw taro sini, soalnya kejauhan diatas :v--}}
        <style>
            .container-alamat {
                display: flex;
                gap: 15px;
            }
            .form-item-alamat label {
                font-size: 0.9em;
                color: #555;
                margin-bottom: 5px;
                flex: 0 1 auto;
            }
            .form-item-alamat input {
                padding: 5px;
                font-size: 1em;
                border: 1px solid #ccc;
                border-radius: 4px;
                flex: 1;
            }
            .form-item-alamat {
                display: flex;
                flex-direction: column;
            }
        </style>

        <div class="container-alamat">
            <div class="form-item-alamat" style="width: 70%">
                <label>Alamat <span class="text-danger">*</span> </label>
                <input type="text" id="alamat" name="alamat" required>
            </div>
            <div class="form-item-alamat" style="width: 10%">
                <label>RW <span class="text-danger">*</span> </label>
                <input type="text" id="rw" name="rw" required>
            </div>
            <div class="form-item-alamat" style="width: 10%">
                <label>RT <span class="text-danger">*</span> </label>
                <input type="text" id="rt" name="rt" required>
            </div>
            <div class="form-item-alamat" style="width: 10%">
                <label>Kode Pos <span class="text-danger">*</span> </label>
                <input type="number" id="kode_pos" name="kode_pos" required>
            </div>
        </div>
    </form>
@endsection
