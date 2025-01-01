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
        <a class="nav-link" href="{{ route('admin.verifikasi-pendaftaran.index') }}">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Pendaftaran Siswa Baru</span>
        </a>
    </li>

    <!-- Kelola Berkas Pendidikan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.verifikasi-berkas-pendidikan.index') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Berkas Pendidikan</span>
        </a>
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

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Notifikasi
    </div>

    <!-- Menu Pertanyaan -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNotifikasi"
            aria-expanded="true" aria-controls="collapseNotifikasi">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Atur Notifikasi</span>
        </a>
        <div id="collapseNotifikasi" class="collapse" aria-labelledby="headingNotifikasi" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.admin-contact.email') }}">Email</a>
                <a class="collapse-item" href="{{ route('admin.admin-contact.whatsapp') }}">Whatsapp</a>
            </div>
        </div>
    </li>
</ul>
