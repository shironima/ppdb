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
        Schema::create('notification_contact', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calon_siswa_id');
            $table->unsignedBigInteger('user_id');
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->timestamps();

            // Indexes
            $table->foreign('calon_siswa_id')->references('id')->on('calon_siswa')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_contact');
    }
};
