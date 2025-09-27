<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'video_url',
        'video_file',
        'media_type',
        'overlay_text',
        'overlay_position',
        'social_platform',
        'social_url',
        'button_text',
        'button_color',
        'order',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Social media platforms configuration
     */
    public static function getSocialPlatforms()
    {
        return [
            'facebook' => [
                'name' => 'Facebook',
                'color' => '#1877F2',
                'icon' => 'fab fa-facebook-f'
            ],
            'instagram' => [
                'name' => 'Instagram', 
                'color' => '#E4405F',
                'icon' => 'fab fa-instagram'
            ],
            'tiktok' => [
                'name' => 'TikTok',
                'color' => '#000000', 
                'icon' => 'fab fa-tiktok'
            ],
            'youtube' => [
                'name' => 'YouTube',
                'color' => '#FF0000',
                'icon' => 'fab fa-youtube'
            ],
            'twitter' => [
                'name' => 'Twitter/X',
                'color' => '#1DA1F2',
                'icon' => 'fab fa-twitter'
            ]
        ];
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at');
    }

    /**
     * Accessors
     */
    public function getMediaUrlAttribute()
    {
        if ($this->media_type === 'video' && $this->video_url) {
            return $this->video_url;
        }
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getSocialPlatformInfoAttribute()
    {
        $platforms = self::getSocialPlatforms();
        return $platforms[$this->social_platform] ?? null;
    }

    public function getPlatformIconAttribute()
    {
        $info = $this->social_platform_info;
        return $info ? $info['icon'] : 'fas fa-link';
    }

    public function getPlatformColorAttribute()
    {
        $info = $this->social_platform_info;
        return $info ? $info['color'] : $this->button_color;
    }

    /**
     * Static methods
     */
    public static function getActivePosts()
    {
        return self::active()->ordered()->get();
    }
}