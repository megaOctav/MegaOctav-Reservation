<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id('id_film');
            $table->string('film_title');
            $table->text('synopsis');
            $table->string('genre');
            $table->integer('duration');
            $table->integer('rating_film');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
