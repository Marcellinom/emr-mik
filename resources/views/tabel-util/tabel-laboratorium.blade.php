<h5 class="text-primary">Laboratorium</h5>
<div class="container" style="flex-wrap: nowrap">
    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Laboratorium</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody id="laboratorium-body">
        </tbody>
    </table>
    <div style="float: right; padding-bottom: 10px">
        <a class="btn btn-info text-white" data-toggle="modal" data-target="#data-diagnosis">Tambah</a>
    </div>
</div>

<div class="modal fade" id="data-diagnosis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-primary">Tambah Laboratorium</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="list-diagnosis" style="width:100%" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Laboratorium</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_laboratorium as $v)
                        <tr>
                            <td>{{$v->id}}</td>
                            <td>{{$v->nama}}</td>
                            <td><input class="laboratorium-terpilih-confirm" value="{{$v->id}}" type="checkbox"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a id="simpan-laboratorium" type="button" class="btn btn-success text-white" data-dismiss="modal">Simpan</a>
            </div>
        </div>
    </div>
</div>

<script>
    new DataTable('#list-diagnosis');
    const laboratorium_all = @json($list_laboratorium)

    $("#simpan-laboratorium").click(e => {
        let i = 1
        $("#laboratorium-body").empty()
        for (let c of document.getElementsByClassName("laboratorium-terpilih-confirm")) {
            if (!c.checked) continue
            let d = laboratorium_all[c.value]
            $("#laboratorium-body").append(`
                <tr id="laboratorium-${i}">
                    <td>${i}</td>
                    <td>${d.id}</td>
                    <td>${d.nama}</td>
                    <td><button type="button" class="btn btn-danger" onclick="hapusLaboratorium('${i}')">hapus</button></td>
                    <input type='hidden' name="laboratorium[]" value="${c.value}">
                </tr>
            `)
            i++
        }
    })
    function hapusLaboratorium(id) {
        document.getElementById(`laboratorium-${id}`).remove();
    }
    @if(isset($data_lab))
        i = 1
        for (d of @json($data_lab)) {
            $("#laboratorium-body").append(`
                    <tr id="laboratorium-${i}">
                        <td>${i}</td>
                        <td>${d.id}</td>
                        <td>${d.nama}</td>
                        <td><button type="button" class="btn btn-danger" onclick="hapusLaboratorium('${i}')">hapus</button></td>
                        <input type='hidden' name="laboratorium[]" value="${d.id}">
                    </tr>
                `)
            i++
        }
    @endif
</script>
