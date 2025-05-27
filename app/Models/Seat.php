<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    //
     protected $primaryKey = 'id_seats';

    protected $fillable = [
        'schedule_id',
        'number',
        'status_seats'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'schedule_id');
    }
}
