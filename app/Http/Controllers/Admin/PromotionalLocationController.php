<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromotionalLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionalLocationController extends Controller
{
    public function index()
    {
        $promotionalLocations = PromotionalLocation::orderBy('order', 'asc')->get();
        return view('admin.promotional-locations.index', compact('promotionalLocations'));
    }

    public function create()
    {
        return view('admin.promotional-locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:50',
            'schedule' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'promotion_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'whatsapp_url' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
            'active' => 'nullable|boolean'
        ]);

        $data = $request->only(['name', 'address', 'phone', 'schedule', 'description', 'whatsapp_url', 'order', 'active']);
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('promotional-locations')) {
                Storage::disk('public')->makeDirectory('promotional-locations');
            }
            
            $image->storeAs('promotional-locations', $imageName, 'public');
            $data['image'] = $imageName;
        }

        if ($request->hasFile('promotion_pdf')) {
            $pdf = $request->file('promotion_pdf');
            $pdfName = time() . '_promotion_' . $pdf->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('promotional-locations/pdfs')) {
                Storage::disk('public')->makeDirectory('promotional-locations/pdfs');
            }
            
            $pdf->storeAs('promotional-locations/pdfs', $pdfName, 'public');
            $data['promotion_pdf'] = $pdfName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['active'] = $data['active'] ?? true;

        PromotionalLocation::create($data);

        return redirect()->route('admin.promotional-locations.index')
                        ->with('success', 'Promoción creada exitosamente.');
    }

    public function show(PromotionalLocation $promotionalLocation)
    {
        return view('admin.promotional-locations.show', compact('promotionalLocation'));
    }

    public function edit(PromotionalLocation $promotionalLocation)
    {
        return view('admin.promotional-locations.edit', compact('promotionalLocation'));
    }

    public function update(Request $request, PromotionalLocation $promotionalLocation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:50',
            'schedule' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'promotion_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'whatsapp_url' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
            'active' => 'nullable|boolean'
        ]);

        $data = $request->only(['name', 'address', 'phone', 'schedule', 'description', 'whatsapp_url', 'order', 'active']);

        if ($request->hasFile('image')) {
            if ($promotionalLocation->image && Storage::disk('public')->exists('promotional-locations/' . $promotionalLocation->image)) {
                Storage::disk('public')->delete('promotional-locations/' . $promotionalLocation->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('promotional-locations')) {
                Storage::disk('public')->makeDirectory('promotional-locations');
            }
            
            $image->storeAs('promotional-locations', $imageName, 'public');
            $data['image'] = $imageName;
        }

        if ($request->hasFile('promotion_pdf')) {
            if ($promotionalLocation->promotion_pdf && Storage::disk('public')->exists('promotional-locations/pdfs/' . $promotionalLocation->promotion_pdf)) {
                Storage::disk('public')->delete('promotional-locations/pdfs/' . $promotionalLocation->promotion_pdf);
            }

            $pdf = $request->file('promotion_pdf');
            $pdfName = time() . '_promotion_' . $pdf->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('promotional-locations/pdfs')) {
                Storage::disk('public')->makeDirectory('promotional-locations/pdfs');
            }
            
            $pdf->storeAs('promotional-locations/pdfs', $pdfName, 'public');
            $data['promotion_pdf'] = $pdfName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['active'] = $data['active'] ?? true;

        $promotionalLocation->update($data);

        return redirect()->route('admin.promotional-locations.index')
                        ->with('success', 'Promoción actualizada exitosamente.');
    }

    public function destroy(PromotionalLocation $promotionalLocation)
    {
        if ($promotionalLocation->image && Storage::disk('public')->exists('promotional-locations/' . $promotionalLocation->image)) {
            Storage::disk('public')->delete('promotional-locations/' . $promotionalLocation->image);
        }

        if ($promotionalLocation->promotion_pdf && Storage::disk('public')->exists('promotional-locations/pdfs/' . $promotionalLocation->promotion_pdf)) {
            Storage::disk('public')->delete('promotional-locations/pdfs/' . $promotionalLocation->promotion_pdf);
        }

        $promotionalLocation->delete();

        return redirect()->route('admin.promotional-locations.index')
                        ->with('success', 'Promoción eliminada exitosamente.');
    }

    public function toggle(PromotionalLocation $promotionalLocation)
    {
        $promotionalLocation->update([
            'active' => !$promotionalLocation->active
        ]);

        $status = $promotionalLocation->active ? 'activada' : 'desactivada';
        
        return redirect()->route('admin.promotional-locations.index')
                        ->with('success', "Promoción {$status} exitosamente.");
    }
}
