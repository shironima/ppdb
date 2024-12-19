<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_orang_tua', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('calon_siswa_id');
            $table->string('nama_ayah', 255);
            $table->string('nik_ayah', 16);
            $table->integer('tahun_lahir_ayah');
            $table->enum('pendidikan_ayah', ['SD', 'SMP', 'SMA', 'Diploma', 'S-1', 'S-2', 'Lainnya']);
            $table->enum('pekerjaan_ayah', ['ASN/TNI/POLRI', 'Guru/Dosen/Pengajar', 'Pengusaha', 'Pedagang', 'Wiraswasta', 'Wirausaha', 'Petani/Peternak', 'Lainnya']);
            $table->enum('penghasilan_ayah', ['Dibawah 1jt', '1jt - 2jt', '2jt - 4jt', 'Diatas 5jt']);
            $table->string('nomor_hp_ayah', 15);
            $table->string('nama_ibu', 255);
            $table->string('nik_ibu', 16);
            $table->integer('tahun_lahir_ibu');
            $table->enum('pendidikan_ibu', ['SD', 'SMP', 'SMA', 'Diploma', 'S-1', 'S-2', 'Lainnya']);
            $table->enum('pekerjaan_ibu', ['ASN/TNI/POLRI', 'Guru/Dosen/Pengajar', 'Pengusaha', 'Pedagang', 'Wiraswasta', 'Wirausaha', 'Petani/Peternak', 'Lainnya']);
            $table->enum('penghasilan_ibu', ['Dibawah 1jt', '1jt - 2jt', '2jt - 4jt', 'Diatas 5jt']);
            $table->string('nomor_hp_ibu', 15);
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('calon_siswa_id')->references('id')->on('calon_siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_orang_tua');
    }
};
