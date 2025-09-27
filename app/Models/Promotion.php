<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description', 
        'image',
        'link',
        'order',
        'is_active',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
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

    public function scopeCurrent($query)
    {
        $today = Carbon::today();
        return $query->where(function($q) use ($today) {
            $q->whereNull('start_date')
              ->orWhere('start_date', '<=', $today);
        })->where(function($q) use ($today) {
            $q->whereNull('end_date')
              ->orWhere('end_date', '>=', $today);
        });
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/promotions/' . $this->image) : null;
    }

    public function getIsCurrentAttribute()
    {
        $today = Carbon::today();
        
        $startValid = !$this->start_date || $this->start_date <= $today;
        $endValid = !$this->end_date || $this->end_date >= $today;
        
        return $startValid && $endValid;
    }
}