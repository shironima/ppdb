@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<header class="bg-dark text-white text-center" style="
    background-image: url('/images/banner-2.png'); 
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat; 
    height: 50vh; 
    display: flex; 
    align-items: center; 
    justify-content: center;">
    <div class="container py-5">
        <h1 class="display-4 mb-3">Selamat Datang di PPDB SMAK Santo Bonaventura</h1>
        <p class="lead mb-4">Menyediakan pendidikan berkualitas dan fasilitas yang lengkap</p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg">Daftar Sekarang</a>
    </div>
</header>

<!-- Tentang Kami -->
<section id="tentang-kami" class="about py-5">
    <div class="container">
        <div class="row text-center">
            <!-- Visi dan Misi Sekolah -->
            <div class="col-md-4">
                <h3 class="mb-4"><strong>Visi dan Misi Sekolah</strong></h3>
                <p>
                    <b>Visi SMAK Santo Bonaventura</b> adalah "Menjadi lembaga pendidikan yang unggul dalam pembentukan karakter dan intelektualitas siswa, dengan berlandaskan pada nilai-nilai Kristiani."
                </p>
                <p>
                    <b>Misi SMAK Santo Bonaventura</b> adalah menyediakan pendidikan yang berkualitas, membangun karakter moral, dan mengembangkan potensi siswa secara maksimal.
                </p>
            </div>

            <!-- Galeri Sekolah -->
            <div class="col-md-4">
                <h3 class="mb-4"><strong>Galeri Sekolah</strong></h3>
                <div id="schoolGalleryCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/images/galery-web/1.png" class="d-block w-100" alt="Galeri Sekolah 1">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/galery-web/2.png" class="d-block w-100" alt="Galeri Sekolah 2">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/galery-web/3.png" class="d-block w-100" alt="Galeri Sekolah 3">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/galery-web/4.png" class="d-block w-100" alt="Galeri Sekolah 4">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/galery-web/5.png" class="d-block w-100" alt="Galeri Sekolah 5">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/galery-web/6.png" class="d-block w-100" alt="Galeri Sekolah 6">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/galery-web/7.png" class="d-block w-100" alt="Galeri Sekolah 7">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#schoolGalleryCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#schoolGalleryCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Fasilitas yang Tersedia -->
            <div class="col-md-4">
                <h3 class="mb-4"><strong>Fasilitas yang Tersedia</strong></h3>
                <p>
                    Kami memiliki berbagai fasilitas yang mendukung proses belajar mengajar, seperti ruang kelas yang nyaman, laboratorium, dan fasilitas olahraga yang memadai.
                </p>
                <p>
                    Selain itu, kami juga menawarkan kegiatan ekstrakurikuler untuk mengembangkan bakat dan minat siswa di luar akademik.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Proses Pendaftaran -->
<section class="registration-process bg-light py-5">
    <div class="container">
        <div class="row">
            <!-- Bagian Kiri -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                <h2 class="text-center mb-4"><strong>Proses Pendaftaran</strong></h2>
                <p class="text-center">
                    Pendaftaran peserta didik baru SMAK Santo Bonaventura dapat dilakukan secara online melalui situs ini. 
                    Pastikan Anda mempersiapkan semua persyaratan yang telah ditentukan untuk mengikuti pendaftaran.
                </p>
                <a href="{{ route('nav-page.alurpendaftaran') }}" class="btn btn-primary mt-3">Lihat Syarat & Alur Pendaftaran</a>
            </div>
            <!-- Bagian Kanan -->
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img src="/images/smabona1-removebg.png" class="img-fluid" alt="Ilustrasi Pendaftaran">
            </div>
        </div>
    </div>
</section>

@endsection
