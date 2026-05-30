<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagem_Hotel extends Model
{
    protected $table = 'imagem_hoteis';
    
    protected $fillable = [
        'hotel_id',
        'imagem',
        'is_principal'
    ];

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }

    public function imagemPrincipal()
{
    return $this->hasOne(Imagem_Hotel::class)->where('is_principal', true);
}
}
