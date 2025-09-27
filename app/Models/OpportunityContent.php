<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpportunityContent extends Model
{
    use HasFactory;
    protected $table = 'opportunity_content';
    protected $fillable = [
        'type',
        'title',
        'description',
        'image',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/opportunities/' . $this->image) : null;
    }

    public static function getTypes()
    {
        return [
            'comercial' => 'Comercial',
            'proveedores' => 'Proveedores',
            'trabajo' => 'Trabajo'
        ];
    }
}