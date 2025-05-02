<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    //
    protected $fillable = [
        'id_customer',
        'id_product',
        'total',
        'status'
    ];
}
