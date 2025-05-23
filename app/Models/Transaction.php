<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Kalau field timestamps kamu default (`created_at` dan `updated_at`), ini gak perlu diubah
    protected $fillable = [
        'id_user',
        'schedule_id',
        'payment_method',
        'total_price',
        'payment_date',
    ];
}
