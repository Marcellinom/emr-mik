@section('content-body-upper')
    <button class="redirect-btn btn btn-href" value="asesmen_awal" style="border-radius: 25px">Asesmen Awal</button>
    <button class="redirect-btn btn btn-href" value="soape" style="border-radius: 25px">SOAPE</button>
    <button class="redirect-btn btn btn-href" value="penunjang" style="border-radius: 25px">Penunjang</button>
    <button class="redirect-btn btn btn-href" value="resume_medis" style="border-radius: 25px">Resume Medis</button>

    <script>
        for (let e of document.getElementsByClassName('redirect-btn')) {
            e.addEventListener('click', function () {
                window.location = `/pemeriksaan/${this.value}/{{$id}}`
            }, false)
        }
    </script>
@endsection
