<h5 class="text-primary">Diagnosa</h5>
<div class="container" style="flex-wrap: nowrap">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode-ICD-10</th>
                <th>Nama Diagnosa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="diagnosa-body">
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
                <h6 class="modal-title text-primary">Tambah Diagnosa</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="list-diagnosis" style="width:100%" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Kode ICD-10</th>
                        <th>Nama Diagnosa</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_diagnosa as $v)
                        <tr>
                            <td>{{$v->id}}</td>
                            <td>{{$v->nama}}</td>
                            <td><input class="diagnosa-terpilih-confirm" value="{{$v->id}}" type="checkbox"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a id="simpan-diagnosa" type="button" class="btn btn-success text-white" data-dismiss="modal">Simpan</a>
            </div>
        </div>
    </div>
</div>

<script>
    new DataTable('#list-diagnosis');
    const diagnosa_all = @json($list_diagnosa)

    $("#simpan-diagnosa").click(e => {
        let i = 1
        $("#diagnosa-body").empty()
        for (let c of document.getElementsByClassName("diagnosa-terpilih-confirm")) {
            if (!c.checked) continue
            let d = diagnosa_all[c.value]
            $("#diagnosa-body").append(`
                <tr id="diagnosa-${i}">
                    <td>${i}</td>
                    <td>${d.id}</td>
                    <td>${d.nama}</td>
                    <td><button type="button" class="btn btn-danger" onclick="hapusDiagnosa('${i}')">hapus</button></td>
                    <input type='hidden' name="diagnosa[]" value="${c.value}">
                </tr>
            `)
            i++
        }
    })
    function hapusDiagnosa(id) {
        document.getElementById(`diagnosa-${id}`).remove();
    }
    @if(isset($data_diagnosa))
        i = 0
        const data_diagnosa = @json($data_diagnosa)

        for (let d of data_diagnosa) {
             $("#diagnosa-body").append(`
                    <tr id="diagnosa-${i}">
                        <td>${i+1}</td>
                        <td>${d.id}</td>
                        <td>${d.nama}</td>
                        <td><button type="button" class="btn btn-danger" onclick="hapusDiagnosa('${i}')">hapus</button></td>
                        <input type='hidden' name="diagnosa[]" value="${d.id}">
                    </tr>
                `)
             i++
        }
    @endif
</script>
