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
            $table->id('id_pembayaran'); // Primary Key

            // Foreign Key
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_produk');

            // Kolom tambahan
            $table->decimal('total', 15, 2);
            $table->string('status_pembayaran');
            $table->date('tanggal');
            $table->time('waktu');

            $table->timestamps();

            // Foreign key constraints (opsional, bisa kamu aktifkan jika FK tersedia)
            // $table->foreign('id_pelanggan')->references('id')->on('pelanggans')->onDelete('cascade');
            // $table->foreign('id_produk')->references('id')->on('produks')->onDelete('cascade');
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
