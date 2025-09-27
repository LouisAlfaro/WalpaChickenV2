<?php
// app/Models/MenuProduct.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description', 
        'price',
        'image',
        'location_id',
        'order',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
        'price' => 'decimal:2'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/menu-products/' . $this->image);
        }
        return asset('images/default-product.jpg');
    }

    public function getFormattedPriceAttribute()
    {
        if ($this->price) {
            return 'S/ ' . number_format($this->price, 2);
        }
        return null;
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}