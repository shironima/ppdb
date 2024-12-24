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
        Schema::create('registration', function (Blueprint $table) {
            // UUID untuk ID utama
            $table->uuid('id')->primary(); 
                
                // Foreign key yang merujuk ke tabel lain dengan menggunakan ID biasa
            $table->unsignedBigInteger('calon_siswa_id'); 
            $table->unsignedBigInteger('berkas_pendidikan_id'); 
            $table->unsignedBigInteger('payments_id')->nullable(); 
            $table->unsignedBigInteger('alamat_id'); 
            $table->unsignedBigInteger('data_orang_tua_id'); 
            $table->unsignedBigInteger('data_rinci_id'); 

            $table->timestamps();

            // Relasi dengan tabel lain, di sini menggunakan unsignedBigInteger
            $table->foreign('calon_siswa_id')->references('id')->on('calon_siswa')->onDelete('cascade');
            $table->foreign('berkas_pendidikan_id')->references('id')->on('berkas_pendidikan')->onDelete('cascade');
            $table->foreign('payments_id')->references('id')->on('payments')->onDelete('set null');
            $table->foreign('alamat_id')->references('id')->on('alamat')->onDelete('cascade'); 
            $table->foreign('data_orang_tua_id')->references('id')->on('data_orang_tua')->onDelete('cascade'); 
            $table->foreign('data_rinci_id')->references('id')->on('data_rinci')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration');
    }
};
