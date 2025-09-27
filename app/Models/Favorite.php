<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'order',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer'
    ];

    // Scope para obtener solo los activos
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    // Scope para ordenar por campo order
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    // Obtener URL completa de la imagen
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/favorites/' . $this->image);
        }
        return asset('images/default-favorite.jpg');
    }

    // Obtener solo los favoritos activos y ordenados
    public static function getActiveFavorites()
    {
        return self::active()->ordered()->get();
    }
}