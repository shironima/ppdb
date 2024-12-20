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
        Schema::create('data_rinci', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('calon_siswa_id')->constrained('calon_siswa')->onDelete('cascade');
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->integer('anak_ke');
            $table->integer('jumlah_saudara');
            $table->string('asal_sekolah');
            $table->year('tahun_lulus');
            $table->text('alamat_sekolah_asal');
            $table->string('status')->default('Submitted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_rinci');
    }
};
