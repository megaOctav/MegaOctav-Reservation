<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hasfactory;

class Schedule extends Model
{
    //
    protected $primaryKey = 'id_schedule';

    protected $fillable = [
        'id_film',
        'location_id',
        'playing_data',
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
