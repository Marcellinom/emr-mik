<h5 class="text-primary">Radiologi</h5>
<div class="container" style="flex-wrap: nowrap">
    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Radiologi</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody id="radiologi-body">
        </tbody>
    </table>
    <div style="float: right; padding-bottom: 10px">
        <a class="btn btn-info text-white" data-toggle="modal" data-target="#data-radiologi">Tambah</a>
    </div>
</div>

<div class="modal fade" id="data-radiologi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-primary">Tambah Radiologi</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="list-radiologi" style="width:100%" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Radiologi</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_radiologi as $v)
                        <tr>
                            <td>{{$v->id}}</td>
                            <td>{{$v->nama}}</td>
                            <td><input class="radiologi-terpilih-confirm" value="{{$v->id}}" type="checkbox"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a id="simpan-radiologi" type="button" class="btn btn-success text-white" data-dismiss="modal">Simpan</a>
            </div>
        </div>
    </div>
</div>

<script>
    new DataTable('#list-radiologi');
    const radiologi_all = @json($list_radiologi)

    $("#simpan-radiologi").click(e => {
        let i = 1
        $("#radiologi-body").empty()
        for (let c of document.getElementsByClassName("radiologi-terpilih-confirm")) {
            if (!c.checked) continue
            let d = radiologi_all[c.value]
            $("#radiologi-body").append(`
                <tr id="radiologi-${i}">
                    <td>${i}</td>
                    <td>${d.id}</td>
                    <td>${d.nama}</td>
                    <td><button type="button" class="btn btn-danger" onclick="hapusRadiologi('${i}')">hapus</button></td>
                    <input type='hidden' name="radiologi[]" value="${c.value}">
                </tr>
            `)
            i++
        }
    })
    function hapusRadiologi(id) {
        document.getElementById(`radiologi-${id}`).remove();
    }
    @if(isset($data_radiologi))
        i = 1
        for (d of @json($data_radiologi)) {
            $("#radiologi-body").append(`
                    <tr id="radiologi-${i}">
                        <td>${i}</td>
                        <td>${d.id}</td>
                        <td>${d.nama}</td>
                        <td><button type="button" class="btn btn-danger" onclick="hapusRadiologi('${i}')">hapus</button></td>
                        <input type='hidden' name="radiologi[]" value="${d.id}">
                    </tr>
                `)
            i++
        }
    @endif
</script>
