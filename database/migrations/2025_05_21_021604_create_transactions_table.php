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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id('id_transaction'); // ID utama
        $table->unsignedBigInteger('id_user');
        $table->unsignedBigInteger('schedule_id');
        $table->string('payment_method');
        $table->decimal('total_price', 10, 2);
        $table->date('payment_date');
        $table->timestamps(); // created_at & updated_at

        // Optional: Foreign key constraints (hapus kalau gak pakai relasi)
        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
