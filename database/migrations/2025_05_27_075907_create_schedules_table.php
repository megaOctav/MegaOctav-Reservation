<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('id_schedule');
            $table->unsignedBigInteger('film_id');
            $table->unsignedBigInteger('location_id');
            $table->date('playing_date');
            $table->time('playing_time');
            $table->timestamps();

            // Foreign key ke films.id
            $table->foreign('film_id')->references('id_film')->on('films')->onDelete('cascade');
            // Foreign key ke location id
            $table->foreign('location_id')->references('id_location')->on('locations')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
