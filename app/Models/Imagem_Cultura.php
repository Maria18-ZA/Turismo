<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagem_Cultura extends Model
{
    protected $fillable = [
        'cultura_id',
        'imagem'
    ];

    public function cultura() {
        return $this->belongsTo(Cultura::class);
    }
}
