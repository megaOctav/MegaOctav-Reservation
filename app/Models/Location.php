<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $primaryKey = 'id_location';
    protected $fillable = [
        'city',
        'theater_name',
        'theater_address'
    ];
}
