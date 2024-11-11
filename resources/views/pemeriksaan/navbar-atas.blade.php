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

    .no-registrasi {
        text-align: right;
        font-size: 0.9em;
        font-weight: bold;
        color: #333;
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
            <h3 id="info-nama"></h3>
            <p id="info-rm"></p>
            <p id="info-nik"></p>
            <p id="info-kelamin-lahir"></p>
            <div class="btn-group">
                <button id="info-dr" style="border-bottom-left-radius: 16px; border-top-left-radius: 16px; border-right: 1px black" disabled></button>
                <button id="info-poli" style="border-bottom-right-radius: 16px; border-top-right-radius: 16px" disabled></button>
            </div>
        </div>
        <div class="no-registrasi">
            No Registrasi / {{sprintf("REG%08d", $id)}}
        </div>
    </div>
    <br>
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

        function pad(num, size) {
            var s = "00000000" + num;
            return s.substr(s.length-size);
        }

        function formatDateAndAge(dateString) {
            const months = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            // Parse the date
            const birthDate = new Date(dateString);
            const day = birthDate.getDate();
            const month = months[birthDate.getMonth()];
            const year = birthDate.getFullYear();

            // Calculate the age
            const today = new Date();
            let age = today.getFullYear() - year;
            if (
                today.getMonth() < birthDate.getMonth() ||
                (today.getMonth() === birthDate.getMonth() && today.getDate() < day)
            ) {
                age--;
            }

            // Format the date and age string
            return `${day} ${month} ${year} ${age} Tahun`;
        }

        $.ajax({
            url: `/api/pasien_by_id_registrasi?id_registrasi={{$id}}`,
            type: "GET",
            dataType: "json", // Expect JSON data in response
            success: function(response) {
                let d = response.data[0]
                $("#info-nama").html(d.nama)
                $("#info-rm").html(`RM${pad(d.no_rm, 8)}`)
                $("#info-nik").html(d.nik)
                $("#info-kelamin-lahir").html(`${d.jenis_kelamin == "L" ? "Laki-Laki" : "Perempuan"} ${formatDateAndAge(d.tanggal_lahir)}`)
                $("#info-dr").html(d.nama_dokter)
                $("#info-poli").html(d.poliklinik_tujuan)
            }
        })
    </script>
@endsection
