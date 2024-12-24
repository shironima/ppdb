<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- Welcome / Landing Page -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('/') }}">
                <i class="bi bi-house"></i>
                <span>Home</span>
            </a>
        </li>

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Info PPDB -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#info-ppdb-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-info-circle"></i>
                <span>Informasi PPDB</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="info-ppdb-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('siswa.informasi-ppdb.info-pendaftaran') }}">
                        <i class="bi bi-circle"></i>
                        <span>Info Pendaftaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswa.informasi-ppdb.alur-pendaftaran') }}">
                        <i class="bi bi-circle"></i>
                        <span>Alur Pendaftaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswa.informasi-ppdb.biaya-pendidikan')}} ">
                        <i class="bi bi-circle"></i>
                        <span>Biaya Pendidikan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswa.informasi-ppdb.tanya-admin-ppdb') }}">
                        <i class="bi bi-circle"></i>
                        <span>Tanya pada Admin PPDB</span>
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <li class="nav-heading">
            Formulir Pendaftaran
        </li>

        <!-- Data Diri -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('calon-siswa.index') }}">
                <i class="bi bi-person"></i>
                <span>Data Diri</span>
            </a>
        </li>

        <!-- Alamat -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('alamat.index') }}">
                <i class="bi bi-geo-alt"></i>
                <span>Alamat</span>
            </a>
        </li>

        <!-- Data Orang Tua -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('data-orang-tua.index') }}">
                <i class="bi bi-people"></i>
                <span>Data Orang Tua</span>
            </a>
        </li>

        <!-- Data Rinci -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('data-rinci.index') }}">
                <i class="bi bi-list-ul"></i>
                <span>Data Rinci</span>
            </a>
        </li>

        <!-- Berkas Pendidikan -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('berkas-pendidikan.index') }}">
                <i class="bi bi-folder"></i>
                <span>Berkas Pendidikan</span>
            </a>
        </li>

        <!-- Pembayaran -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('payments.index') }}">
                <i class="bi bi-cash-coin"></i>
                <span>Pembayaran</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <li class="nav-heading">
            Pendaftaran Saya
        </li>

        <!-- Status Pendaftaran -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('status-pendaftaran.index') }}">
                <i class="bi bi-check-circle"></i>
                <span>Status</span>
            </a>
        </li>

        <!-- Kontak Notifikasi -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('notification.index') }}">
                <i class="bi bi-bell"></i>
                <span>Notifikasi</span>
            </a>
        </li>
    </ul>
</aside>
