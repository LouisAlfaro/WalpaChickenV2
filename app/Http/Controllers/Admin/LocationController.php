<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('order', 'asc')->get();
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'whatsapp_url' => 'nullable|url',
            'maps_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'menu_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'promotions_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'order' => 'nullable|integer|min:0',
            'active' => 'nullable|boolean',
            'description' => 'nullable|string'
        ]);

        $data = $request->only(['name', 'address', 'phone', 'whatsapp_url', 'maps_url', 'order', 'active', 'description']);
        
        // Manejar la subida de imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('locations')) {
                Storage::disk('public')->makeDirectory('locations');
            }
            
            $image->storeAs('locations', $imageName, 'public');
            $data['image'] = $imageName;
        }

        if ($request->hasFile('menu_pdf')) {
        $pdf = $request->file('menu_pdf');
        $pdfName = time() . '_menu_' . $pdf->getClientOriginalName();
        
        if (!Storage::disk('public')->exists('locations/menus')) {
            Storage::disk('public')->makeDirectory('locations/menus');
        }
        
        $pdf->storeAs('locations/menus', $pdfName, 'public');
        $data['menu_pdf'] = $pdfName;
        }

        if ($request->hasFile('promotions_pdf')) {
            $pdf = $request->file('promotions_pdf');
            $pdfName = time() . '_promotions_' . $pdf->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('locations/promotions')) {
                Storage::disk('public')->makeDirectory('locations/promotions');
            }
            
            $pdf->storeAs('locations/promotions', $pdfName, 'public');
            $data['promotions_pdf'] = $pdfName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['active'] = $data['active'] ?? true;

        Location::create($data);

        return redirect()->route('admin.locations.index')
                        ->with('success', 'Ubicación creada exitosamente.');
    }

    public function show(Location $location)
    {
        return view('admin.locations.show', compact('location'));
    }

    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'whatsapp_url' => 'nullable|url',
            'maps_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'menu_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'promotions_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'order' => 'nullable|integer|min:0',
            'active' => 'nullable|boolean',
            'description' => 'nullable|string'
        ]);

        $data = $request->only(['name', 'address', 'phone', 'whatsapp_url', 'maps_url', 'order', 'active', 'description']);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($location->image && Storage::disk('public')->exists('locations/' . $location->image)) {
                Storage::disk('public')->delete('locations/' . $location->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('locations')) {
                Storage::disk('public')->makeDirectory('locations');
            }
            
            $image->storeAs('locations', $imageName, 'public');
            $data['image'] = $imageName;
        }

        if ($request->hasFile('menu_pdf')) {
        // Eliminar PDF anterior
        if ($location->menu_pdf && Storage::disk('public')->exists('locations/menus/' . $location->menu_pdf)) {
            Storage::disk('public')->delete('locations/menus/' . $location->menu_pdf);
        }

        $pdf = $request->file('menu_pdf');
        $pdfName = time() . '_menu_' . $pdf->getClientOriginalName();
        
        if (!Storage::disk('public')->exists('locations/menus')) {
            Storage::disk('public')->makeDirectory('locations/menus');
        }
        
        $pdf->storeAs('locations/menus', $pdfName, 'public');
        $data['menu_pdf'] = $pdfName;
        }

        if ($request->hasFile('promotions_pdf')) {
            // Eliminar PDF anterior
            if ($location->promotions_pdf && Storage::disk('public')->exists('locations/promotions/' . $location->promotions_pdf)) {
                Storage::disk('public')->delete('locations/promotions/' . $location->promotions_pdf);
            }

            $pdf = $request->file('promotions_pdf');
            $pdfName = time() . '_promotions_' . $pdf->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('locations/promotions')) {
                Storage::disk('public')->makeDirectory('locations/promotions');
            }
            
            $pdf->storeAs('locations/promotions', $pdfName, 'public');
            $data['promotions_pdf'] = $pdfName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['active'] = $data['active'] ?? true;

        $location->update($data);

        return redirect()->route('admin.locations.index')
                        ->with('success', 'Ubicación actualizada exitosamente.');
    }

    public function destroy(Location $location)
    {
        if ($location->image && Storage::disk('public')->exists('locations/' . $location->image)) {
            Storage::disk('public')->delete('locations/' . $location->image);
        }

        if ($location->menu_pdf && Storage::disk('public')->exists('locations/menus/' . $location->menu_pdf)) {
        Storage::disk('public')->delete('locations/menus/' . $location->menu_pdf);
        }

        if ($location->promotions_pdf && Storage::disk('public')->exists('locations/promotions/' . $location->promotions_pdf)) {
            Storage::disk('public')->delete('locations/promotions/' . $location->promotions_pdf);
        }

        $location->delete();

        return redirect()->route('admin.locations.index')
                        ->with('success', 'Ubicación eliminada exitosamente.');
    }

    public function toggle(Location $location)
    {
        $location->update([
            'active' => !$location->active
        ]);

        $status = $location->active ? 'activada' : 'desactivada';
        
        return redirect()->route('admin.locations.index')
                        ->with('success', "Ubicación {$status} exitosamente.");
    }
}