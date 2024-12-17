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
        Schema::create('alamat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calon_siswa_id');
            $table->string('alamat_lengkap');
            $table->string('rt');
            $table->string('rw');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kota_kabupaten');
            $table->string('provinsi');
            $table->string('kode_pos')->nullable();
            $table->string('tinggal_dengan');
            $table->timestamps();

            //Foreign Key dengan tabel calon_siswa
            $table->foreign('calon_siswa_id')->references('id')->on('calon_siswa')->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamat');
    }
};
