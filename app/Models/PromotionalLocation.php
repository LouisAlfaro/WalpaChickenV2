<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromotionalLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'schedule',
        'description',
        'image',
        'promotion_pdf',
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
            return asset('storage/promotional-locations/' . $this->image);
        }
        return asset('images/default-location.jpg');
    }

    public function getPromotionPdfUrlAttribute()
    {
        if ($this->promotion_pdf) {
            return asset('storage/promotional-locations/pdfs/' . $this->promotion_pdf);
        }
        return null;
    }
}
