<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'whatsapp_url',
        'maps_url',
        'image',
        'menu_pdf',
        'order',
        'active',
        'description'
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

    // Scope para ordenar
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    // Obtener URL completa de la imagen
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/locations/' . $this->image);
        }
        return asset('images/default-location.jpg');
    }

    public function getMenuPdfUrlAttribute()
    {
        if ($this->menu_pdf) {
            return asset('storage/locations/menus/' . $this->menu_pdf);
        }
        return null;
    }

    // Obtener ubicaciones activas ordenadas
    public static function getActiveLocations()
    {
        return self::active()->ordered()->get();
    }
    
    public function menuProducts()
    {
        return $this->hasMany(MenuProduct::class);
    }

    // Productos activos del menú
    public function activeMenuProducts()
    {
        return $this->hasMany(MenuProduct::class)->where('active', true);
    }

}