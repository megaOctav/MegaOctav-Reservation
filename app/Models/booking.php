<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    //
    protected $fillable = [
        'id_customer',
        'booking_date',
        'status'
    ];
}
