<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hasfactory;

class Schedule extends Model
{
    //
    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'id_film',
        'location_id',
        'playing_data',
        'playing_time'
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'id_film', 'id_film');
    }
}
