<?php

namespace App\Http\Controllers;

use App\Models\PromotionalPopup;
use Illuminate\Http\Request;

class PopupController extends Controller
{
    public function getActivePopup()
    {
        // Usar consulta simple sin el scope por ahora
        $popup = PromotionalPopup::where('is_active', true)->first();
        
         if (!$popup) {
             return response()->json(['popup' => null]);
         }


         $lastShown = session('popup_last_shown_' . $popup->id);
         $shouldShow = true;

         if ($lastShown) {
              $hoursSinceLastShown = now()->diffInHours($lastShown);
             $shouldShow = $hoursSinceLastShown >= $popup->display_frequency;
          }

          if (!$shouldShow) {
             return response()->json(['popup' => null]);
         }
  
         session(['popup_last_shown_' . $popup->id => now()]);

        return response()->json([
            'popup' => [
                'id' => $popup->id,
                'title' => $popup->title,
                'image' => $popup->image_url,
                'link' => $popup->link
            ]
        ]);
    }
}