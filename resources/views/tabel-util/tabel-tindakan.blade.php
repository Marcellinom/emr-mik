<h5 class="text-primary">Tindakan</h5>

<div class="container" style="flex-wrap: nowrap">
    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Kode-ICD-9</th>
            <th>Nama Tindakan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody id="tindakan-body">
        </tbody>
    </table>
    <div style="float: right; padding-bottom: 10px">
        <a class="btn btn-info text-white" data-toggle="modal" data-target="#data-tindakan">Tambah</a>
    </div>
</div>

<div class="modal fade" id="data-tindakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-primary">Tambah Tindakan</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="list-tindakan" style="width:100%" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Kode ICD-9</th>
                        <th>Nama Tindakan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_tindakan as $v)
                        <tr>
                            <td>{{$v->id}}</td>
                            <td>{{$v->nama}}</td>
                            <td><input class="tindakan-terpilih-confirm" value="{{$v->id}}" type="checkbox"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a id="simpan-tindakan" type="button" class="btn btn-success text-white" data-dismiss="modal">Simpan</a>
            </div>
        </div>
    </div>
</div>

<script>
    new DataTable('#list-tindakan');
    const tindakan_all = @json($list_tindakan)

    $("#simpan-tindakan").click(e => {
        let i = 1
        $("#tindakan-body").empty()
        for (let c of document.getElementsByClassName("tindakan-terpilih-confirm")) {
            if (!c.checked) continue
            let d = tindakan_all[c.value]
            $("#tindakan-body").append(`
                <tr id="tindakan-${i}">
                    <td>${i}</td>
                    <td>${d.id}</td>
                    <td>${d.nama}</td>
                    <td><button type="button" class="btn btn-danger" onclick="hapusTindakan('${i}')">hapus</button></td>
                    <input type='hidden' name="tindakan[]" value="${c.value}">
                </tr>
            `)
            i++
        }
    })
    function hapusTindakan(id) {
        document.getElementById(`tindakan-${id}`).remove();
    }
    @if(isset($data_tindakan))
        i = 0
        const data_tindakan = @json($data_tindakan)

        for (let d of data_tindakan) {
            $("#tindakan-body").append(`
                    <tr id="tindakan-${i}">
                        <td>${i+1}</td>
                        <td>${d.id}</td>
                        <td>${d.nama}</td>
                        <td><button type="button" class="btn btn-danger" onclick="hapusTindakan('${i}')">hapus</button></td>
                        <input type='hidden' name="tindakan[]" value="${d.id}">
                    </tr>
                `)
        i++
    }
    @endif
</script>
