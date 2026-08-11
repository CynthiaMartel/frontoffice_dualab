<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $fillable = ['reto_id', 'descripcion', 'orden'];

    public function reto()
    {
        return $this->belongsTo(Reto::class);
    }
}
