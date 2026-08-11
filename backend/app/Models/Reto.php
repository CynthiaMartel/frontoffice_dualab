<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reto extends Model
{
    use HasFactory;

    protected $fillable = [
        'familia_id',
        'titulo',
        'descripcion',
        'nivel',
        'duracion',
    ];

    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }

    public function objetivos()
    {
        return $this->hasMany(Objetivo::class)->orderBy('orden');
    }

    public function recursos()
    {
        return $this->hasMany(Recurso::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
