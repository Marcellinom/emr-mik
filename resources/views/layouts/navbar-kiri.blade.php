<style>
    .nav-link{
        color: rgba(0, 0, 0, .65);
    }
</style>

{{--ini ikon user nya--}}
<nav class="collapse bd-links col flex-column" id="bd-docs-nav" style="color: dimgrey; justify-self: center; margin-right: 5px;">
    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="img" style="border-radius: 50%; height: 2rem">
    <span>Admin</span>
</nav>

{{--ini menu-menu nya--}}
<nav class="collapse bd-links" id="bd-docs-nav" style="padding-left: 5px; font-size: 1.1rem; font-weight: 550; color: dimgrey">
    <div class="bd-toc-item">
        <a href="/" class="nav-link">
            <i class="bi bi-house-door"></i>
            <span>Dashboard</span>
        </a>
    </div>

    <div class="bd-toc-item"> {{--ini collapsible--}}
        <a href="#" data-toggle="collapse" class="nav-link" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="bi bi-database"></i>
            <span>Master Data</span>
            <i class="bi bi-caret-down-fill"></i>
        </a>
    </div>
    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#bd-docs-nav"> {{--ini isi collapsible nya--}}
        <a href="/pasien" class="nav-link">
            &emsp;
            <span>Data Pasien</span>
        </a>
        <a href="/obat" class="nav-link">
            &emsp;
            <span>Data Obat</span>
        </a>
    </div>


    <div class="bd-toc-item">
        <a href="/pendaftaran" class="nav-link">
            <i class="bi bi-ui-checks"></i>
            <span>Antrian</span>
        </a>
    </div>

    <div class="bd-toc-item">
        <a href="/antrian_asesmen" class="nav-link">
            <i class="bi bi-input-cursor-text"></i>
            <span>Asesmen Awal</span>
        </a>
    </div>

    <div class="bd-toc-item">
        <a href="/antrian_pemeriksaan" class="nav-link">
            <i class="bi bi-bandaid-fill"></i>
            <span>Pemeriksaan</span>
        </a>
    </div>

    <div class="bd-toc-item">
        <a href="/konseling" class="nav-link">
            <i class="bi bi-bandaid"></i>
            <span>Konseling</span>
        </a>
    </div>
</nav>
