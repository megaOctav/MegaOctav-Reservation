<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    //
    protected $fillable = [
        'username_adm',
        'email_adm',
        'phone_adm'
    ];
}
