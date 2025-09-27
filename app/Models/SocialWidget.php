<?php
// app/Models/SocialWidget.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialWidget extends Model
{
    protected $fillable = [
        'is_active', 'position', 'social_links', 'background_color'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'social_links' => 'array'
    ];

    public static function getActive()
    {
        return self::where('is_active', true)->first();
    }
}