<h5 class="text-primary">Obat</h5>

<div class="container" style="flex-wrap: nowrap">
    <table>
        <thead>
            <th>No</th>
            <th>Kode Obat</th>
            <th>Nama Obat</th>
            <th>Sediaan Obat</th>
            <th>Aturan Pakai</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </thead>
        <tbody id="obat-body"></tbody>
    </table>
    <div style="float: right; padding-bottom: 10px">
        <a class="btn btn-info text-white" data-toggle="modal" data-target="#data-obat">Tambah</a>
    </div>
</div>

<div class="modal fade" id="data-obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 75%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-primary">Tambah Resep Obat</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="form-item">
                        <label>Pilih Obat </label>
                        <select name="no_rm" id="cari_obat" required>
                        </select>
                    </div>
                    <div class="form-item">
                        <label>Sediaan Obat</label>
                        <input type="text" disabled id="sediaan_obat" class="form-obat">
                    </div>
                    <div class="form-item">
                        <label>Aturan Pakai </label>
                        <input type="text" id="aturan_pakai" class="form-obat" placeholder="Isi aturan pakai obat">
                    </div>
                    <div class="form-item">
                        <label>Jumlah</label>
                        <input type="number" id="jumlah" class="form-obat" placeholder="isi jumlah pemakaian">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="simpan-obat" type="button" class="btn btn-success text-white" data-dismiss="modal">Simpan</a>
            </div>
        </div>
    </div>
</div>

<script>
    const data_pasien = {}
    $("#cari_obat").select2({
        tags: false,
        allowClear: true,
        dropdownParent: $("#data-obat"),
        minimumInputLength: 2,
        width: "100%",
        placeholder: "Cari data obat",
        ajax: {
            delay: 500,
            url: function (params) {
                return '/api/obat_by_name?name=' + params.term;
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
</script>

<script>
    new DataTable('#list-obat');

    let i = 1
    $("#simpan-obat").click(e => {
        let kemampuan_khusus = $("#kemampuan_khusus").val()
        let pengelolaan_emosi = $("#pengelolaan_emosi").val()
        let pihak_pendukung = $("#pihak_pendukung").val()

        if ((kemampuan_khusus == null &&
            pengelolaan_emosi == null &&
            pihak_pendukung == null) || (
            kemampuan_khusus == "" &&
            pengelolaan_emosi == "" &&
            pihak_pendukung == ""
        )
        ) return

        $("#obat-body").append(`
                <tr id="obat-${i}">
                    <td>${i}</td>
                    <td>${kemampuan_khusus}</td>
                    <td>${pengelolaan_emosi}</td>
                    <td>${pihak_pendukung}</td>
                    <td><button type="button" class="btn btn-danger" onclick="hapusObat('${i}')">hapus</button></td>
                    <input type='hidden' name="obat[${i}][kemampuan_khusus]" value="${kemampuan_khusus}">
                    <input type='hidden' name="obat[${i}][pengelolaan_emosi]" value="${pengelolaan_emosi}">
                    <input type='hidden' name="obat[${i}][pihak_pendukung]" value="${pihak_pendukung}">
                </tr>
        `)
        i++
        for (let c of document.getElementsByClassName('form-obat')) {
            c.value = null
        }
    })
    function hapusObat(id) {
        document.getElementById(`obat-${id}`).remove();
    }
</script>
