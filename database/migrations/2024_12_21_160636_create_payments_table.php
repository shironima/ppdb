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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();  // ID transaksi Midtrans
            $table->string('transaction_status'); // Status transaksi dari Midtrans
            $table->decimal('gross_amount', 15, 2); // Jumlah transaksi
            $table->string('payment_type'); // Jenis pembayaran
            $table->json('payment_data')->nullable(); // Data tambahan pembayaran
            $table->foreignId('calon_siswa_id')->constrained('calon_siswa')->onDelete('cascade'); // Relasi ke CalonSiswa
            $table->enum('status', ['pending', 'settlement', 'deny', 'expire', 'cancel', 'verified', 'invalid'])
                  ->default('pending'); // Status pembayaran
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
