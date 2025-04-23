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
        Schema::create('confirms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_booked')->constrained('bookings')->onDelete('cascade'); // Foreign Key ke pemesanan
            $table->string('metode'); // Metode pembayaran (misal: Transfer Bank, QRIS, dll)
            $table->date('tanggal_konfirmasi'); // Tanggal konfirmasi pembayaran
            $table->string('status_konfirmasi'); // Status (Lunas, Pending, Ditolak, dll)
            $table->integer('id_admin')->constrained('admins')->onDelete('cascade');; 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirms');
    }
};
