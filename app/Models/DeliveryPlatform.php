<?php
// app/Models/DeliveryPlatform.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DeliveryPlatform extends Model
{
    protected $fillable = ['name', 'image', 'link', 'is_active', 'order'];
    
    protected $casts = ['is_active' => 'boolean'];

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}