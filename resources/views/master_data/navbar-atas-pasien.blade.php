<style>
    #info-pasien-atas {
        display: flex;
        align-items: center;
    }
    .profile-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
    }

    .info {
        flex-grow: 1;
    }

    .info h3 {
        margin: 0;
        font-size: 1.2em;
        font-weight: bold;
    }

    .info p {
        margin: 4px 0;
        color: #666;
    }

    .btn-group button {
        background-color: #5ba8e2; /* Green background */
        color: black; /* White text */
        padding: 1px 15px; /* Some padding */
        float: left; /* Float the buttons side by side */
    }

</style>
@section('content-body-upper')
    <div id="info-pasien-atas">
        <object class="profile-img" data="{{asset('person-sick.jpg')}}" type="image/png">
            {{--        di masa depan kalau mau implemen foto user, img tag dibawah adalah icon default jika foto diatas gaada--}}
            <img class="profile-img" src="{{asset('person-sick.jpg')}}" alt="Stack Overflow logo and icons and such">
        </object>
        <div class="info">
            <h3 id="info-nama">Nama: {{$pasien->nama}}</h3>
            <p id="info-rm">No: {{sprintf("RM%08d", $pasien->no_rm)}}</p>
            <p id="info-nik">Nik: {{$pasien->nik}}</p>
            <p id="info-kelamin-lahir">{{$pasien->jenis_kelamin == "L" ? "Laki-Laki" : "Perempuan"}}, {{$pasien->tanggal_lahir}}</p>
        </div>
    </div>
@endsection
