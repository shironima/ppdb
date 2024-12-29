<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3">Admin PPDB</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Kelola Pendaftaran
    </div>

    <!-- Pendaftaran Siswa Baru -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePendaftar"
            aria-expanded="true" aria-controls="collapsePendaftar">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Pendaftaran Siswa Baru</span>
        </a>
        <div id="collapsePendaftar" class="collapse" aria-labelledby="headingPendaftar" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.verifikasi-pendaftaran.index') }}">Semua Pendaftaran</a>
                <a class="collapse-item" href="#">Verifikasi Pendaftaran</a>
            </div>
        </div>
    </li>

    <!-- Kelola Berkas Pendaftaran -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBerkas"
            aria-expanded="true" aria-controls="collapseBerkas">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Berkas Pendidikan</span>
        </a>
        <div id="collapseBerkas" class="collapse" aria-labelledby="headingBerkas" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Semua Berkas Pendidikan</a>
                <a class="collapse-item" href="#">Verifikasi Berkas</a>
            </div>
        </div>
    </li>

    <!-- Kelola Pembayaran -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBayar"
            aria-expanded="true" aria-controls="collapseBayar">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Pembayaran</span>
        </a>
        <div id="collapseBayar" class="collapse" aria-labelledby="headingBayar" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Transaksi Pembayaran</a>
                <a class="collapse-item" href="#">Verifikasi Pembayaran</a>
                <a class="collapse-item" href="#">Riwayat Pembayaran</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Kelola Akun
    </div>

    <!-- Kelola Akun -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAkun"
            aria-expanded="true" aria-controls="collapseAkun">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>Kelola Akun</span>
        </a>
        <div id="collapseAkun" class="collapse" aria-labelledby="headingAkun" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.kelola-akun.admin') }}">Admin</a>
                <a class="collapse-item" href="{{ route('admin.kelola-akun.siswa') }}">Calon Siswa</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Hubungi Admin
    </div>

    <!-- Menu Pertanyaan -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePertanyaan"
            aria-expanded="true" aria-controls="collapsePertanyaan">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Pertanyaan</span>
        </a>
        <div id="collapsePertanyaan" class="collapse" aria-labelledby="headingPertanyaan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.hubungi-admin.menunggu') }}">Belum Dijawab</a>
                <a class="collapse-item" href="{{ route('admin.hubungi-admin.index') }}">Semua Pertanyaan</a>
            </div>
        </div>
    </li>
</ul>
