<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $fillable = ['reto_id', 'nombre'];

    public function reto()
    {
        return $this->belongsTo(Reto::class);
    }
}
