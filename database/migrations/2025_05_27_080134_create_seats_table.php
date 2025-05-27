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
        Schema::create('seats', function (Blueprint $table) {
            $table->id('id_seats');
            $table->unsignedBigInteger('schedule_id');
            $table->string('number');
            $table->enum('status_seats', ['available', 'booked']);
            $table->timestamps();

            // Foreign key ke tabel schedules
            $table->foreign('schedule_id')->references('id_schedule')->on('schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
