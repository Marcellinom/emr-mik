@section('navbar-kanan')
    <div style="box-shadow:0 .6rem 1rem rgba(0,0,0,.15); background-color: white; padding: 10px; border: 1px solid black; border-radius: 10px">
        <i class="bi bi-info-circle"></i> <span style="font-weight: bold">Resume Medis</span>
        <br><br>
        <span class="text-danger">*</span> Wajib ditandatangani oleh Dokter setidaknya 2x24 jam
        <br>
        <button id="ttd-resume" class="btn btn-primary text-white" data-toggle="modal" data-target="#modal-resume">Tanda tangan</button>
    </div>
    <br>
    <div style="box-shadow:0 .6rem 1rem rgba(0,0,0,.15); background-color: white; padding: 10px; border: 1px solid black; border-radius: 10px">
        <i class="bi bi-info-circle"></i> <span style="font-weight: bold">Informed Consent</span>
        <br><br>
        <span class="text-danger">*</span> Wajib ditandatangani oleh Pasien/Penanggung Jawab Pasien apabila menolak tindakan medis
        <br>
        <button id="ttd-consent" class="btn btn-primary text-white" data-toggle="modal" data-target="#modal-consent">Tanda tangan</button>
    </div>
@endsection

<div class="modal fade" id="modal-resume" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-primary">Tanda Tangan Informed Consent</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="wrapper">
                    <canvas id="ttd-resume" class="signature-pad" width=400 height=200></canvas>
                </div>
                <div>
                    <button class="clear" id="ttd_resume_medis">Clear</button>
                </div>
            </div>
            <div class="modal-footer">
                <a id="simpan-resume" type="button" class="btn btn-success text-white" data-dismiss="modal">Simpan</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-consent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-primary">Tanda Tangan Resume Medis</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="wrapper">
                    <canvas id="ttd-consent" class="signature-pad" width=400 height=200></canvas>
                </div>
                <div>
                    <button class="clear" id="ttd_informed_consent">Clear</button>
                </div>
            </div>
            <div class="modal-footer">
                <a id="simpan-consent" type="button" class="btn btn-success text-white" data-dismiss="modal">Simpan</a>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        const ttd_pad = {
            ttd_resume_medis: new SignaturePad(document.getElementById('ttd-resume'), {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 0)'
            }),
            ttd_informed_consent: new SignaturePad(document.getElementById('ttd-consent'), {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 0)'
            })
        }
        let cancelButton = document.getElementsByClassName('clear');
        for (let e of cancelButton) {
            e.addEventListener('click', function (ev) {
                ev.preventDefault()
                ttd_pad[e.id].clear();
            });
        }
        const data_resume = @json($row_resume)

        for (let i in ttd_pad) {
            ttd_pad[i].fromDataURL(data_resume[i])
            if (data_resume[i] != null) {
                ttd_pad[i].off()
                $(`#${i}`).prop('hidden', true)
            }
        }
    </script>
    @parent
@endsection

<style>
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
