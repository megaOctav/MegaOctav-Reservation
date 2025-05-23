<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    
    {
        Schema::create('films', function (Blueprint $table) {
            $table->engine = 'InnoDB';   // pastikan engine InnoDB untuk foreign key
            $table->id();                // bigint unsigned auto-increment
            $table->string('judul');
            $table->string('genre');
            $table->integer('durasi');
            $table->string('sutradara');
            $table->string('produksi');
            $table->text('deskripsi');   // gunakan text untuk deskripsi panjang
            $table->date('tanggal_rilis');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
