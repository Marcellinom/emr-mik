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
                <table id="list-potensi" style="width:100%" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Kemampuan Khusus</th>
                        <th>Pengelolaan Emosi</th>
                        <th>Pihak Pendukung</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_potensi as $v)
                        <tr>
                            <td>{{$v->id}}</td>
                            <td>{{$v->kemampuan_khusus}}</td>
                            <td>{{$v->pengelolaan_emosi}}</td>
                            <td>{{$v->pihak_pendukung}}</td>
                            <td><input class="potensi-terpilih-confirm" value="{{$v->id}}" type="checkbox"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a id="simpan-potensi" type="button" class="btn btn-success text-white" data-dismiss="modal">Simpan</a>
            </div>
        </div>
    </div>
</div>

<script>
    new DataTable('#list-potensi');
    const potensi_all = @json($list_potensi)

    $("#simpan-potensi").click(e => {
        let i = 1
        $("#potensi-body").empty()
        for (let c of document.getElementsByClassName("potensi-terpilih-confirm")) {
            if (!c.checked) continue
            let d = potensi_all[c.value]
            $("#potensi-body").append(`
                <tr id="potensi-${i}">
                    <td>${i}</td>
                    <td>${d.kemampuan_khusus}</td>
                    <td>${d.pengelolaan_emosi}</td>
                    <td>${d.pihak_pendukung}</td>
                    <td><button type="button" class="btn btn-danger" onclick="hapusPotensi('${i}')">hapus</button></td>
                    <input type='hidden' name="potensi[]" value="${c.value}">
                </tr>
            `)
            i++
        }
    })
    function hapusPotensi(id) {
        document.getElementById(`potensi-${id}`).remove();
    }
</script>
