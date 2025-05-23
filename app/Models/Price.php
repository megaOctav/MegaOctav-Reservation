<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Price extends Model
{
    //

    protected $table = 'price';
    protected $primaryKey = 'id_price';
    public $timestamps = false; // karena tidak ada kolom created_at dan updated_at

    protected $fillable = [
        'film_id',
        'day_type',
        'ticket_price'
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id', 'id_film');
    }
}
