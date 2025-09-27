<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::orderBy('order', 'asc')->get();
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->only(['title', 'description', 'link', 'order', 'start_date', 'end_date', 'is_active']);
        
        // Subir imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('promotions')) {
                Storage::disk('public')->makeDirectory('promotions');
            }
            
            $image->storeAs('promotions', $imageName, 'public');
            $data['image'] = $imageName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? true;

        Promotion::create($data);

        return redirect()->route('admin.promotions.index')
                        ->with('success', 'Promoción creada exitosamente.');
    }

    public function show(Promotion $promotion)
    {
        return view('admin.promotions.show', compact('promotion'));
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->only(['title', 'description', 'link', 'order', 'start_date', 'end_date', 'is_active']);

        // Subir nueva imagen si existe
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior
            if ($promotion->image && Storage::disk('public')->exists('promotions/' . $promotion->image)) {
                Storage::disk('public')->delete('promotions/' . $promotion->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('promotions')) {
                Storage::disk('public')->makeDirectory('promotions');
            }
            
            $image->storeAs('promotions', $imageName, 'public');
            $data['image'] = $imageName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? true;

        $promotion->update($data);

        return redirect()->route('admin.promotions.index')
                        ->with('success', 'Promoción actualizada exitosamente.');
    }

    public function destroy(Promotion $promotion)
    {
        // Eliminar imagen
        if ($promotion->image && Storage::disk('public')->exists('promotions/' . $promotion->image)) {
            Storage::disk('public')->delete('promotions/' . $promotion->image);
        }

        $promotion->delete();

        return redirect()->route('admin.promotions.index')
                        ->with('success', 'Promoción eliminada exitosamente.');
    }

    public function toggle(Promotion $promotion)
    {
        $promotion->update(['is_active' => !$promotion->is_active]);
        $status = $promotion->is_active ? 'activada' : 'desactivada';
        
        return redirect()->route('admin.promotions.index')
                        ->with('success', "Promoción {$status} exitosamente.");
    }
}