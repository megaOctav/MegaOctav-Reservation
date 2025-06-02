<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_schedule';

    protected $fillable = [
        'film_id',
        'location_id',
        'playing_date',
        'playing_time'
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id', 'id_film');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id_location');
    }
}
