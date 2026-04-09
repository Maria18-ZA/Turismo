<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagem_Hotel extends Model
{
    protected $fillable = [
        'hotel_id',
        'imagem'
    ];

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }
}
