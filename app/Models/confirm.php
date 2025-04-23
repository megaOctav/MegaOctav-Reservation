<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class confirm extends Model
{
    //
    protected $fillable = [
        'id_booked', 
        'metode', 
        'tanggal_konfirmasi', 
        'status_konfirmasi',
        'id_admin'];
}
