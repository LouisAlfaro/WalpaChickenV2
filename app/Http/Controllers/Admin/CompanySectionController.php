<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanySectionController extends Controller
{
    public function index()
    {
        $sections = CompanySection::orderBy('order', 'asc')->get();
        return view('admin.company-sections.index', compact('sections'));
    }

    public function create()
    {
        $types = CompanySection::getTypes();
        return view('admin.company-sections.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:' . implode(',', array_keys(CompanySection::getTypes())),
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'list_items' => 'nullable|array',
            'list_items.*' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->only(['type', 'title', 'content', 'order', 'is_active']);
        
        // Filtrar list_items vacíos
        if ($request->has('list_items')) {
            $listItems = array_filter($request->list_items, function($item) {
                return !empty(trim($item));
            });
            $data['list_items'] = array_values($listItems);
        }

        // Subir imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('company')) {
                Storage::disk('public')->makeDirectory('company');
            }
            
            $image->storeAs('company', $imageName, 'public');
            $data['image'] = $imageName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? true;

        CompanySection::create($data);

        return redirect()->route('admin.company-sections.index')
                        ->with('success', 'Sección creada exitosamente.');
    }

    public function show(CompanySection $companySection)
    {
        return view('admin.company-sections.show', compact('companySection'));
    }

    public function edit(CompanySection $companySection)
    {
        $types = CompanySection::getTypes();
        return view('admin.company-sections.edit', compact('companySection', 'types'));
    }

    public function update(Request $request, CompanySection $companySection)
    {
        $request->validate([
            'type' => 'required|string|in:' . implode(',', array_keys(CompanySection::getTypes())),
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'list_items' => 'nullable|array',
            'list_items.*' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->only(['type', 'title', 'content', 'order', 'is_active']);
        
        // Filtrar list_items vacíos
        if ($request->has('list_items')) {
            $listItems = array_filter($request->list_items, function($item) {
                return !empty(trim($item));
            });
            $data['list_items'] = array_values($listItems);
        }

        // Subir nueva imagen si existe
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior
            if ($companySection->image && Storage::disk('public')->exists('company/' . $companySection->image)) {
                Storage::disk('public')->delete('company/' . $companySection->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('company')) {
                Storage::disk('public')->makeDirectory('company');
            }
            
            $image->storeAs('company', $imageName, 'public');
            $data['image'] = $imageName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? true;

        $companySection->update($data);

        return redirect()->route('admin.company-sections.index')
                        ->with('success', 'Sección actualizada exitosamente.');
    }

    public function destroy(CompanySection $companySection)
    {
        // Eliminar imagen
        if ($companySection->image && Storage::disk('public')->exists('company/' . $companySection->image)) {
            Storage::disk('public')->delete('company/' . $companySection->image);
        }

        $companySection->delete();

        return redirect()->route('admin.company-sections.index')
                        ->with('success', 'Sección eliminada exitosamente.');
    }

    public function toggle(CompanySection $companySection)
    {
        $companySection->update(['is_active' => !$companySection->is_active]);
        $status = $companySection->is_active ? 'activada' : 'desactivada';
        
        return redirect()->route('admin.company-sections.index')
                        ->with('success', "Sección {$status} exitosamente.");
    }
}