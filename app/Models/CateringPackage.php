<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateringPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'min_people',
        'max_people',
        'price_per_person',
        'image',
        'features',
        'order',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'price_per_person' => 'decimal:2'
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

    // Accessors
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/catering/packages/' . $this->image) : null;
    }

    public function getPeopleRangeAttribute()
    {
        return $this->min_people . ' a ' . $this->max_people . ' personas';
    }

    // Relationships
    public function requests()
    {
        return $this->hasMany(CateringRequest::class);
    }
}