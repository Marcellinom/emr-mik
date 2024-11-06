<h5 class="text-primary">Potensi</h5>

<div class="container" style="flex-wrap: nowrap">
    <table>
        <thead>
            <th>No</th>
            <th>Kemampuan Khusus</th>
            <th>Pengelolaan Emosi</th>
            <th>Pihak Pendukung</th>
            <th>Aksi</th>
        </thead>
        <tbody id="potensi-body"></tbody>
    </table>
    <div style="float: right; padding-bottom: 10px">
        <a class="btn btn-info text-white" data-toggle="modal" data-target="#data-potensi">Tambah</a>
    </div>
</div>

<div class="modal fade" id="data-potensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 75%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-primary">Tambah Potensi Diri</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="form-item">
                        <label>Kemampuan Khusus </label>
                        <textarea id="kemampuan_khusus" class="form-potensi" placeholder="Isi kemampuan khusus yang dimiliki"></textarea>
                    </div>
                    <div class="form-item">
                        <label>Pengelolaan Emosi</label>
                        <textarea id="pengelolaan_emosi" class="form-potensi" placeholder="isi nilai pengelolaan emosi konsultan"></textarea>
                    </div>
                    <div class="form-item">
                        <label>Pihak Pendukung</label>
                        <textarea id="pihak_pendukung" class="form-potensi" placeholder="isi pihak yang mendukung"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="simpan-potensi" type="button" class="btn btn-success text-white" data-dismiss="modal">Simpan</a>
            </div>
        </div>
    </div>
</div>

<script>
    new DataTable('#list-potensi');
    const potensi_all = []

    let i = 1
    $("#simpan-potensi").click(e => {
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

        $("#potensi-body").append(`
                <tr id="potensi-${i}">
                    <td>${i}</td>
                    <td>${kemampuan_khusus}</td>
                    <td>${pengelolaan_emosi}</td>
                    <td>${pihak_pendukung}</td>
                    <td><button type="button" class="btn btn-danger" onclick="hapusPotensi('${i}')">hapus</button></td>
                    <input type='hidden' name="potensi[${i}][kemampuan_khusus]" value="${kemampuan_khusus}">
                    <input type='hidden' name="potensi[${i}][pengelolaan_emosi]" value="${pengelolaan_emosi}">
                    <input type='hidden' name="potensi[${i}][pihak_pendukung]" value="${pihak_pendukung}">
                </tr>
        `)
        i++
        for (let c of document.getElementsByClassName('form-potensi')) {
            c.value = null
        }
    })
    function hapusPotensi(id) {
        document.getElementById(`potensi-${id}`).remove();
    }
</script>
