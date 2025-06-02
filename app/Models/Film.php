<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Film extends Model
{
    //
    protected $table = 'films';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'film_title',
        'synopsis',
        'genre',
        'duration',
        'rating_film'
    ];
}
