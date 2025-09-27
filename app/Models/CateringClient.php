<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CateringClient extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'description',
        'website',
        'industry',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('storage/' . $this->logo);
        }
        return asset('images/default-client-logo.png');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
