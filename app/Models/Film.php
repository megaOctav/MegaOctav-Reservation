<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Film extends Model
{
    //
    protected $table = 'films';
    protected $primaryKey = 'id_film';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'judul',
        'genre',
        'durasi',
        'sutradara',
        'produksi',
        'deskripsi',
        'tanggal_rilis'
    ];
}
