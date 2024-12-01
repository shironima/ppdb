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
        <h2 class="text-center mb-5">Tentang SMAK Santo Bonaventura</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Visi dan Misi</h3>
                <p>
                    Visi SMAK Santo Bonaventura adalah "Menjadi lembaga pendidikan yang unggul dalam pembentukan karakter dan intelektualitas siswa, dengan berlandaskan pada nilai-nilai Kristiani."
                </p>
                <p>
                    Misi kami adalah menyediakan pendidikan yang berkualitas, membangun karakter moral, dan mengembangkan potensi siswa secara maksimal.
                </p>
            </div>
            <div class="col-md-6">
                <h3>Fasilitas Kami</h3>
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
        <h2 class="text-center mb-4">Proses Pendaftaran</h2>
        <p class="text-center">
            Pendaftaran peserta didik baru SMAK Santo Bonaventura dapat dilakukan secara online melalui situs ini. Pastikan Anda memenuhi semua persyaratan yang telah ditentukan untuk mengikuti seleksi.
        </p>
    </div>
</section>

<!-- Contact Information -->
<section class="contact py-5">
    <div class="container">
        <h2 class="text-center mb-4">Kontak Kami</h2>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <p>Untuk pertanyaan lebih lanjut, Anda bisa menghubungi kami melalui:</p>
                <ul class="list-unstyled">
                    <li><strong>Email:</strong> <a href="mailto:info@smabona.sch.id">info@smabona.sch.id</a></li>
                    <li><strong>WhatsApp:</strong> <a href="https://wa.me/6285159932501">+62 851-5993-2501</a></li>
                    <li><strong>Alamat:</strong> Jl. Diponegoro No. 45, Kota Madiun</li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
