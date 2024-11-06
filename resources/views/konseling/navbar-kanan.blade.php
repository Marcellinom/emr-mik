@section('navbar-kanan')
    <style>
        .checkbox-item {
            display: flex;
            gap: 2px;
        }
        .checkbox-item label {
            font-size: 16px;
        }
    </style>

    <div style="box-shadow:0 .6rem 1rem rgba(0,0,0,.15); background-color: white; padding: 10px; border: 1px solid black; border-radius: 10px">
        <i class="bi bi-info-circle"></i> <span style="font-weight: bold">Data Keluarga</span>
        <br><br>
        <span class="text-danger">*</span> Wajib memasukan data keluarga terkait
        <br>
        <button id="add-keluarga" class="btn btn-primary text-white" data-toggle="modal" data-target="#modal-tambah-keluarga">Tambah</button>
    </div>
    <br>
    <div style="box-shadow:0 .6rem 1rem rgba(0,0,0,.15); background-color: white; padding: 10px; border: 1px solid black; border-radius: 10px">
        <i class="bi bi-info-circle"></i> <span style="font-weight: bold">Klarifikasi Masalah</span>
        <br><br>
        <span class="text-danger">*</span> Wajib diisi terkait permasalahan yang dialami
        <br>
        <div id="klarifikasi_masalah" class="flex-row" style="margin-top: 20px">
            <div class="checkbox-item">
                <input type="checkbox" id="Keluarga/Pasangan">
                <label for="keluarga">Keluarga/Pasangan</label>
            </div>
            <div class="checkbox-item">
                <input type="checkbox" id="Pekerjaan">
                <label for="pekerjaan">Pekerjaan</label>
            </div>
            <div class="checkbox-item">
                <input type="checkbox" id="Pengelolaan Emosi">
                <label for="emosi">Pengelolaan Emosi</label>
            </div>
            <div class="checkbox-item">
                <input type="checkbox" id="Relasi Sosial">
                <label for="relasi">Relasi Sosial</label>
            </div>
            <div class="checkbox-item">
                <input type="checkbox" id="Pendidikan">
                <label for="pendidikan">Pendidikan</label>
            </div>
            <div class="checkbox-item">
                <input type="checkbox" id="Finansial">
                <label for="finansial">Finansial</label>
            </div>
            <div class="checkbox-item">
                <input type="checkbox" id="Lainnya">
                <label for="lainnya">Masalah Lainnya</label>
            </div>
        </div>
    </div>
@endsection

<div class="modal fade" id="modal-tambah-keluarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-primary">Tambah Data Keluarga</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-keluarga">
                    <div class="form-item">
                        <label>Nama Lengkap <span class="text-danger">*</span> </label>
                        <input type="text" id="nama" name="nama_penanggung_jawab" required>
                    </div>
                    <div class="form-item">
                        <label>Hubungan Keluarga <span class="text-danger">*</span> </label>
                        <input type="text" id="nama" name="hubungan_dengan_pasien" required>
                    </div>
                    <div class="form-item">
                        <label>Jenis Kelamin <span class="text-danger">*</span> </label>
                        <select id="jenis_kelamin" name="jenis_kelamin" form="data-pasien" required>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label>Tanggal Lahir <span class="text-danger">*</span> </label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
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
                        <label>Pekerjaan <span class="text-danger">*</span> </label>
                        <input type="text" id="pekerjaan" name="pekerjaan" required>
                    </div>
                    <div class="form-item">
                        <label>Telp Penanggung Jawab <span class="text-danger">*</span> </label>
                        <input type="number" id="no_telp_penanggung_jawab" name="no_telp_penanggung_jawab" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="simpan-keluarga" type="button" class="btn btn-success text-white" data-dismiss="modal">Simpan</a>
            </div>
        </div>
    </div>
</div>

<script>
    $("#simpan-keluarga").click(e => {
        let add_keluarga = $("#add-keluarga")
        add_keluarga.html("edit")
        add_keluarga.removeClass("btn-primary")
        add_keluarga.addClass("btn-warning")
    })
</script>

<style>
    .container-keluarga {
        display: flex;
        flex-wrap: wrap;
        gap: 15px; /* space between items */
    }
    .form-item {
        flex: 1 1 calc(33.33% - 20px); /* 3 items per row with gap */
        display: flex;
        flex-direction: column;
    }
    .form-item label {
        font-size: 0.9em;
        color: #555;
        margin-bottom: 5px;
    }
</style>
