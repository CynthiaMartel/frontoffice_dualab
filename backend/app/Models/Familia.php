<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Familia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug', 'descripcion', 'icono', 'color_hex'];

    protected static function booted(): void
    {
        static::creating(function (self $familia) {
            if (empty($familia->slug)) {
                $familia->slug = Str::slug($familia->nombre);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function retos()
    {
        return $this->hasMany(Reto::class);
    }
}
