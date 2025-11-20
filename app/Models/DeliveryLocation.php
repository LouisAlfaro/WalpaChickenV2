<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'schedule',
        'description',
        'image',
        'pedidosya_url',
        'didifood_url',
        'rappi_url',
        'whatsapp_url',
        'order',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/delivery-locations/' . $this->image);
        }
        return asset('images/default-location.jpg');
    }
}
