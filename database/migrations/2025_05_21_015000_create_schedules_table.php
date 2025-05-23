<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('film_id');
            // $table->unsignedBigInteger('location_id')->nullable(); // Komentar dulu sampai tabel locations dibuat
            $table->date('playing_date');
            $table->time('playing_time');
            $table->timestamps();

            // Foreign key ke films.id
            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');

            // Foreign key location_id dikomen dulu karena tabel locations belum ada
            // $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
