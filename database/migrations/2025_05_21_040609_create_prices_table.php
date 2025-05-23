<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('price', function (Blueprint $table) {
            $table->id('id_price');
            $table->unsignedBigInteger('film_id');
            $table->string('day_type', 20);
            $table->decimal('ticket_price', 8, 2);

            $table->foreign('film_id')->references('id_film')->on('films')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('price');
    }
};
