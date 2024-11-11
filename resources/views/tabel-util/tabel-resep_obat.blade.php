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
                        <select id="cari_obat" required>
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
    const data_obat = {}
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
                    data_obat[v.id] = v
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
    $('#cari_obat').on("select2:select", function(e) {
        $("#sediaan_obat").val(data_obat[$('#cari_obat').val()].sediaan_obat)
    });
</script>

<script>
    new DataTable('#list-obat');

    let i = 0
    $("#simpan-obat").click(e => {
        let aturan = $("#aturan_pakai").val()
        let jumlah = $("#jumlah").val()
        let id_obat = $("#cari_obat").val()
        if ((aturan == "" &&
            jumlah == "" ) || (aturan == null &&
            jumlah == null)
        ) return

        $("#obat-body").append(`
                <tr id="obat-${i}">
                    <td>${i+1}</td>
                    <td>${id_obat}</td>
                    <td>${data_obat[id_obat].nama}</td>
                    <td>${data_obat[id_obat].sediaan_obat}</td>
                    <td>${aturan}</td>
                    <td>${jumlah}</td>
                    <td><button type="button" class="btn btn-danger" onclick="hapusObat('${i}')">hapus</button></td>
                    <input type='hidden' name="obat[${i}][id]" value="${id_obat}">
                    <input type='hidden' name="obat[${i}][aturan_pakai]" value="${aturan}">
                    <input type='hidden' name="obat[${i}][jumlah]" value="${jumlah}">
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

    @if(isset($data_tindakan))
        i = 0
        const resep_obat = @json($data_obat)

        for (let d of resep_obat) {
            $("#obat-body").append(`
                    <tr id="obat-${i}">
                        <td>${i+1}</td>
                        <td>${d.id}</td>
                        <td>${d.nama}</td>
                        <td>${d.sediaan_obat}</td>
                        <td>${d.aturan_pakai}</td>
                        <td>${d.jumlah}</td>
                        <td><button type="button" class="btn btn-danger" onclick="hapusObat('${i}')">hapus</button></td>
                        <input type='hidden' name="obat[${i}][id]" value="${d.id}">
                        <input type='hidden' name="obat[${i}][aturan_pakai]" value="${d.aturan_pakai}">
                        <input type='hidden' name="obat[${i}][jumlah]" value="${d.jumlah}">
                    </tr>
            `)
        i++
    }
    @endif
</script>
