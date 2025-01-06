@extends('layouts.app')

@section('title', 'Alur Pendaftaran')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 fw-bold">Alur Pendaftaran</h1>
    <p class="text-center text-muted fs-5 mb-5">
        Ikuti 5 langkah mudah untuk mendaftar di SMAK Santo Bonaventura.
    </p>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            @php
                $steps = [
                    [
                        'number' => '1',
                        'title' => 'Kunjungi Halaman Pendaftaran Online',
                        'description' => 'Kunjungi halaman pendaftaran online di <a href="' . route('/') . '" class="text-decoration-none text-primary fw-bold">Pendaftaran Online</a>. Baca <a href="' . route('nav-page.informasippdb') . '" class="text-decoration-none text-secondary fw-bold">Informasi PPDB</a> sebelum memulai registrasi.'
                    ],
                    [
                        'number' => '2',
                        'title' => 'Buat Akun',
                        'description' => 'Buat akun untuk dapat login ke dalam sistem.'
                    ],
                    [
                        'number' => '3',
                        'title' => 'Isi Formulir dan Upload Berkas',
                        'description' => 'Isi semua formulir dan upload berkas yang dibutuhkan, seperti: Keterangan Lulus/Ijazah, Raport Semester 1-5, dan Kartu Keluarga.'
                    ],
                    [
                        'number' => '4',
                        'title' => 'Kirim Pendaftaran',
                        'description' => 'Isi semua formulir dan upload berkas yang dibutuhkan, lalu kirim pendaftaran.'
                    ],
                    [
                        'number' => '5',
                        'title' => 'Tunggu Konfirmasi Sistem dan Admin',
                        'description' => 'Tunggu konfirmasi formulir dan berkas dari sistem. Admin akan memverifikasi berkas pendaftaran dan mengirimkan hasilnya melalui Email dan WhatsApp.'
                    ]
                ];
            @endphp

            @foreach ($steps as $step)
            <div class="mb-4">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 1.25rem;">
                            {{ $step['number'] }}
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1 fw-bold">{{ $step['title'] }}</h5>
                        <p class="mb-0">{!! $step['description'] !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
