<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromotionalPopup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionalPopupController extends Controller
{
    public function index()
    {
        $popups = PromotionalPopup::latest()->paginate(10);
        return view('admin.promotional-popups.index', compact('popups'));
    }

    public function create()
    {
        return view('admin.promotional-popups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'is_active' => 'boolean',
            'display_frequency' => 'required|integer|min:1|max:168',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date'
        ]);

        $data = $request->all();

        // Subir imagen
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('promotional-popups', 'public');
        }

        // Si se activa este popup, desactivar los demás
        if ($data['is_active'] ?? false) {
            PromotionalPopup::where('is_active', true)->update(['is_active' => false]);
        }

        PromotionalPopup::create($data);

        return redirect()->route('admin.promotional-popups.index')
                        ->with('success', 'Popup promocional creado exitosamente.');
    }

    public function show(PromotionalPopup $promotionalPopup)
    {
        return view('admin.promotional-popups.show', compact('promotionalPopup'));
    }

    public function edit(PromotionalPopup $promotionalPopup)
    {
        return view('admin.promotional-popups.edit', compact('promotionalPopup'));
    }

    public function update(Request $request, PromotionalPopup $promotionalPopup)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'is_active' => 'boolean',
            'display_frequency' => 'required|integer|min:1|max:168',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date'
        ]);

        $data = $request->all();

        // Subir nueva imagen si se proporciona
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior
            if ($promotionalPopup->image) {
                Storage::disk('public')->delete($promotionalPopup->image);
            }
            $data['image'] = $request->file('image')->store('promotional-popups', 'public');
        }

        // Si se activa este popup, desactivar los demás
        if ($data['is_active'] ?? false) {
            PromotionalPopup::where('id', '!=', $promotionalPopup->id)
                           ->where('is_active', true)
                           ->update(['is_active' => false]);
        }

        $promotionalPopup->update($data);

        return redirect()->route('admin.promotional-popups.index')
                        ->with('success', 'Popup promocional actualizado exitosamente.');
    }

    public function destroy(PromotionalPopup $promotionalPopup)
    {
        // Eliminar imagen
        if ($promotionalPopup->image) {
            Storage::disk('public')->delete($promotionalPopup->image);
        }

        $promotionalPopup->delete();

        return redirect()->route('admin.promotional-popups.index')
                        ->with('success', 'Popup promocional eliminado exitosamente.');
    }

    public function toggle(PromotionalPopup $promotionalPopup)
    {
        if (!$promotionalPopup->is_active) {
            // Desactivar otros popups
            PromotionalPopup::where('id', '!=', $promotionalPopup->id)
                           ->update(['is_active' => false]);
        }

        $promotionalPopup->update(['is_active' => !$promotionalPopup->is_active]);

        return back()->with('success', 'Estado del popup actualizado.');
    }
}