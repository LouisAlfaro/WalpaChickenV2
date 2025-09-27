<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySection extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'content',
        'image',
        'list_items',
        'order',
        'is_active'
    ];

    protected $casts = [
        'list_items' => 'array',
        'is_active' => 'boolean'
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/company/' . $this->image) : null;
    }

    // Tipos disponibles
    public static function getTypes()
    {
        return [
            'mission' => 'Misión',
            'vision' => 'Visión', 
            'values' => 'Valores',
            'history' => 'Historia',
            'team' => 'Nuestro Equipo',
            'objectives' => 'Objetivos'
        ];
    }
}