<header class="navbar navbar-expand navbar-dark flex-md-row-reverse bd-navbar" style="background-color: #003d85">
    <form action="/logout" method="post">
        @csrf
        <button class="btn d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3">Keluar <i class="bi bi-box-arrow-right"></i></button>
    </form>
    <div class="text-white">
        {{strftime('%A, %e %B %Y', strtotime(date("Y-m-d")))}}
    </div>
</header>
