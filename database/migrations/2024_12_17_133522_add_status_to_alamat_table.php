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
        Schema::table('alamat', function (Blueprint $table) {
            $table->enum('status', ['Belum Diverifikasi', 'Diverifikasi', 'Perlu Perbaikan'])->default('Belum Diverifikasi'); // Menambahkan kolom status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alamat', function (Blueprint $table) {
            //
        });
    }
};
