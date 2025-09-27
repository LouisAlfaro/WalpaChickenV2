<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites = Favorite::orderBy('order', 'asc')->get();
        return view('admin.favorites.index', compact('favorites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.favorites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'active' => 'nullable|boolean'
        ]);

        $data = $request->only(['title', 'description', 'order', 'active']);
        
        // Manejar la subida de imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Crear el directorio si no existe
            if (!Storage::disk('public')->exists('favorites')) {
                Storage::disk('public')->makeDirectory('favorites');
            }
            
            // Guardar la imagen
            $image->storeAs('favorites', $imageName, 'public');
            $data['image'] = $imageName;
        }

        // Asignar valores por defecto si vienen vacíos
        $data['order'] = $data['order'] ?? 0;
        $data['active'] = $data['active'] ?? true;

        Favorite::create($data);

        return redirect()->route('admin.favorites.index')
                        ->with('success', 'Favorito creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        return view('admin.favorites.show', compact('favorite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        return view('admin.favorites.edit', compact('favorite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favorite $favorite)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'active' => 'nullable|boolean'
        ]);

        $data = $request->only(['title', 'description', 'order', 'active']);

        // Manejar la subida de imagen
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($favorite->image && Storage::disk('public')->exists('favorites/' . $favorite->image)) {
                Storage::disk('public')->delete('favorites/' . $favorite->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Crear el directorio si no existe
            if (!Storage::disk('public')->exists('favorites')) {
                Storage::disk('public')->makeDirectory('favorites');
            }
            
            // Guardar la nueva imagen
            $image->storeAs('favorites', $imageName, 'public');
            $data['image'] = $imageName;
        }

        // Asignar valores por defecto si vienen vacíos
        $data['order'] = $data['order'] ?? 0;
        $data['active'] = $data['active'] ?? true;

        $favorite->update($data);

        return redirect()->route('admin.favorites.index')
                        ->with('success', 'Favorito actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        // Eliminar imagen si existe
        if ($favorite->image && Storage::disk('public')->exists('favorites/' . $favorite->image)) {
            Storage::disk('public')->delete('favorites/' . $favorite->image);
        }

        $favorite->delete();

        return redirect()->route('admin.favorites.index')
                        ->with('success', 'Favorito eliminado exitosamente.');
    }

    /**
     * Toggle active status
     */
    public function toggle(Favorite $favorite)
    {
        $favorite->update([
            'active' => !$favorite->active
        ]);

        $status = $favorite->active ? 'activado' : 'desactivado';
        
        return redirect()->route('admin.favorites.index')
                        ->with('success', "Favorito {$status} exitosamente.");
    }
}