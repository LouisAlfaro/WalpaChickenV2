<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CateringInfo;
use App\Models\CateringPackage;
use App\Models\CateringRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CateringRequestsExport;

class CateringController extends Controller
{
    // Dashboard del catering
    public function index()
    {
        $totalRequests = CateringRequest::count();
        $pendingRequests = CateringRequest::pending()->count();
        $cateringRequests = CateringRequest::byType('catering')->count();
        $reservationRequests = CateringRequest::byType('reservation')->count();
        
        $recentRequests = CateringRequest::recent()->limit(10)->get();
        $packages = CateringPackage::active()->ordered()->get();
        $cateringInfo = CateringInfo::active()->first();
        
        return view('admin.catering.index', compact(
            'totalRequests',
            'pendingRequests', 
            'cateringRequests',
            'reservationRequests',
            'recentRequests',
            'packages',
            'cateringInfo'
        ));
    }

    // Gestión de información de catering
    public function editInfo()
    {
        $cateringInfo = CateringInfo::active()->first();
        return view('admin.catering.edit-info', compact('cateringInfo'));
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $cateringInfo = CateringInfo::active()->first();
        
        if (!$cateringInfo) {
            $cateringInfo = new CateringInfo();
        }

        $data = $request->only(['title', 'description']);

        // Subir imagen principal
        if ($request->hasFile('main_image')) {
            if ($cateringInfo->main_image && Storage::disk('public')->exists('catering/' . $cateringInfo->main_image)) {
                Storage::disk('public')->delete('catering/' . $cateringInfo->main_image);
            }

            $mainImage = $request->file('main_image');
            $mainImageName = time() . '_main_' . $mainImage->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('catering')) {
                Storage::disk('public')->makeDirectory('catering');
            }
            
            $mainImage->storeAs('catering', $mainImageName, 'public');
            $data['main_image'] = $mainImageName;
        }

        // Subir imágenes adicionales
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $image->storeAs('catering', $imageName, 'public');
                $images[] = $imageName;
            }
            $data['images'] = $images;
        }

        $cateringInfo->fill($data);
        $cateringInfo->is_active = true;
        $cateringInfo->save();

        return redirect()->route('admin.catering.index')
                        ->with('success', 'Información de catering actualizada exitosamente.');
    }

    // Gestión de paquetes
    public function packages()
    {
        $packages = CateringPackage::orderBy('order', 'asc')->get();
        return view('admin.catering.packages.index', compact('packages'));
    }

    public function createPackage()
    {
        return view('admin.catering.packages.create');
    }

    public function storePackage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'min_people' => 'required|integer|min:1',
            'max_people' => 'required|integer|min:1|gte:min_people',
            'price_per_person' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->only(['name', 'description', 'min_people', 'max_people', 'price_per_person', 'order', 'is_active']);
        
        // Filtrar features vacías
        if ($request->has('features')) {
            $features = array_filter($request->features, function($item) {
                return !empty(trim($item));
            });
            $data['features'] = array_values($features);
        }

        // Subir imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('catering/packages')) {
                Storage::disk('public')->makeDirectory('catering/packages');
            }
            
            $image->storeAs('catering/packages', $imageName, 'public');
            $data['image'] = $imageName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? true;

        CateringPackage::create($data);

        return redirect()->route('admin.catering.packages')
                        ->with('success', 'Paquete creado exitosamente.');
    }

    public function editPackage(CateringPackage $package)
    {
        return view('admin.catering.packages.edit', compact('package'));
    }

    public function updatePackage(Request $request, CateringPackage $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'min_people' => 'required|integer|min:1',
            'max_people' => 'required|integer|min:1|gte:min_people',
            'price_per_person' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->only(['name', 'description', 'min_people', 'max_people', 'price_per_person', 'order', 'is_active']);
        
        // Filtrar features vacías
        if ($request->has('features')) {
            $features = array_filter($request->features, function($item) {
                return !empty(trim($item));
            });
            $data['features'] = array_values($features);
        }

        // Subir nueva imagen si existe
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior
            if ($package->image && Storage::disk('public')->exists('catering/packages/' . $package->image)) {
                Storage::disk('public')->delete('catering/packages/' . $package->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('catering/packages')) {
                Storage::disk('public')->makeDirectory('catering/packages');
            }
            
            $image->storeAs('catering/packages', $imageName, 'public');
            $data['image'] = $imageName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? true;

        $package->update($data);

        return redirect()->route('admin.catering.packages')
                        ->with('success', 'Paquete actualizado exitosamente.');
    }

    public function destroyPackage(CateringPackage $package)
    {
        // Eliminar imagen
        if ($package->image && Storage::disk('public')->exists('catering/packages/' . $package->image)) {
            Storage::disk('public')->delete('catering/packages/' . $package->image);
        }

        $package->delete();

        return redirect()->route('admin.catering.packages')
                        ->with('success', 'Paquete eliminado exitosamente.');
    }

    public function togglePackage(CateringPackage $package)
    {
        $package->update(['is_active' => !$package->is_active]);
        $status = $package->is_active ? 'activado' : 'desactivado';
        
        return redirect()->route('admin.catering.packages')
                        ->with('success', "Paquete {$status} exitosamente.");
    }

    // Gestión de solicitudes
    public function requests()
    {
        $requests = CateringRequest::with('cateringPackage')
                                  ->recent()
                                  ->paginate(20);
        
        return view('admin.catering.requests.index', compact('requests'));
    }

    public function showRequest(CateringRequest $request)
    {
        $request->load('cateringPackage');
        return view('admin.catering.requests.show', compact('request'));
    }

    public function updateRequestStatus(Request $request, CateringRequest $cateringRequest)
    {
        $request->validate([
            'status' => 'required|in:pending,contacted,confirmed,cancelled',
            'admin_notes' => 'nullable|string'
        ]);

        $cateringRequest->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->route('admin.catering.requests')
                        ->with('success', 'Estado actualizado exitosamente.');
    }

    public function destroyRequest(CateringRequest $request)
    {
        $request->delete();
        
        return redirect()->route('admin.catering.requests')
                        ->with('success', 'Solicitud eliminada exitosamente.');
    }

    // Exportar a Excel
    public function exportRequests(Request $request)
    {
        $type = $request->get('type', 'all'); // all, catering, reservation
        $status = $request->get('status', 'all');
        
        return Excel::download(new CateringRequestsExport($type, $status), 
                              'solicitudes_catering_' . date('Y-m-d') . '.xlsx');
    }
}