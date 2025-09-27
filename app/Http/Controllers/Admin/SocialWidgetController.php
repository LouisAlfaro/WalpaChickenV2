<?php
// app/Http/Controllers/Admin/SocialWidgetController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialWidget;
use Illuminate\Http\Request;

class SocialWidgetController extends Controller
{
    public function edit()
    {
        $widget = SocialWidget::first() ?? new SocialWidget([
            'social_links' => [
                'facebook' => '',
                'instagram' => '',
                'tiktok' => '',
                'linkedin' => '',
                'twitter' => ''
            ],
            'position' => 'right',
            'background_color' => '#FEC601',
            'is_active' => true
        ]);

        return view('admin.social-widget.edit', compact('widget'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'social_links.facebook' => 'nullable|url',
            'social_links.instagram' => 'nullable|url', 
            'social_links.tiktok' => 'nullable|url',
            'social_links.linkedin' => 'nullable|url',
            'social_links.twitter' => 'nullable|url',
            'position' => 'required|in:left,right',
            'background_color' => 'required|string',
            'is_active' => 'boolean'
        ]);

        $widget = SocialWidget::first();
        
        if (!$widget) {
            $widget = new SocialWidget();
        }

        $widget->fill([
            'social_links' => $request->social_links,
            'position' => $request->position,
            'background_color' => $request->background_color,
            'is_active' => $request->boolean('is_active')
        ]);

        $widget->save();

        return redirect()->back()->with('success', 'Widget de redes sociales actualizado exitosamente.');
    }
}