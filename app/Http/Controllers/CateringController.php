<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CateringInfo;
use App\Models\CateringPackage;
use App\Models\CateringRequest;
use App\Exports\CateringRequestsExport;
use App\Models\CateringClient;
use Maatwebsite\Excel\Facades\Excel;

class CateringController extends Controller
{
    // Vista pública del catering
    public function index(Request $request)
    {
        // Si es una ruta de administración, redirigir al dashboard de admin catering
        if ($request->is('admin/catering')) {
            return $this->adminIndex();
        }
        
        $cateringInfo = CateringInfo::active()->first();
        $packages = CateringPackage::active()->ordered()->get();
        $clients = CateringClient::where('is_active', true)
                ->orderBy('order', 'asc')
                ->get();
        return view('catering', compact('cateringInfo', 'packages','clients'));
    }

    // Dashboard de administración de catering
    public function adminIndex()
    {
        $totalRequests = CateringRequest::count();
        $pendingRequests = CateringRequest::where('status', 'pending')->count();
        $completedRequests = CateringRequest::where('status', 'completed')->count();
        $cateringRequests = CateringRequest::where('type', 'catering')->count();
        $reservationRequests = CateringRequest::where('type', 'reservation')->count();
        $totalPackages = CateringPackage::count();
        $activePackages = CateringPackage::active()->count();
        
        $recentRequests = CateringRequest::orderBy('created_at', 'desc')->take(5)->get();
        $cateringInfo = CateringInfo::first();
        
        return view('admin.catering.index', compact(
            'totalRequests', 'pendingRequests', 'completedRequests', 
            'cateringRequests', 'reservationRequests',
            'totalPackages', 'activePackages', 'recentRequests', 'cateringInfo'
        ));
    }

    public function storeCateringRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'region' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:1000'
        ]);

        CateringRequest::create([
            'type' => 'catering',
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'email' => $request->email,
            'region' => $request->region,
            'province' => $request->province,
            'district' => $request->district,
            'message' => $request->message,
            'status' => 'pending'
        ]);

        return redirect()->route('catering')
                        ->with('success', 'Tu solicitud de catering ha sido enviada exitosamente. Nos contactaremos contigo pronto.');
    }

    public function storeReservation(Request $request)
    {
        $request->validate([
            'event_date' => 'required|date|after:today',
            'event_time' => 'required',
            'number_of_people' => 'required|integer|min:1',
            'contact_type' => 'required|string',
            'contact_value' => 'required|string|max:255',
            'reason' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
            'catering_package_id' => 'nullable|exists:catering_packages,id'
        ]);

        CateringRequest::create([
            'type' => 'reservation',
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'number_of_people' => $request->number_of_people,
            'contact_type' => $request->contact_type,
            'contact_value' => $request->contact_value,
            'reason' => $request->reason,
            'message' => $request->message,
            'catering_package_id' => $request->catering_package_id,
            'status' => 'pending'
        ]);

        return redirect()->route('catering')
                        ->with('success', 'Tu reserva ha sido solicitada exitosamente. Nos contactaremos contigo pronto.');
    }

    // Métodos de administración

    // Gestión de información de catering
    public function editInfo()
    {
        $cateringInfo = CateringInfo::first();
        if (!$cateringInfo) {
            $cateringInfo = new CateringInfo();
        }
        
        return view('admin.catering.edit-info', compact('cateringInfo'));
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $cateringInfo = CateringInfo::first();
        if (!$cateringInfo) {
            $cateringInfo = new CateringInfo();
        }

        $cateringInfo->fill($request->except('image'));
        $cateringInfo->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($cateringInfo->main_image && file_exists(public_path('storage/' . $cateringInfo->main_image))) {
                unlink(public_path('storage/' . $cateringInfo->main_image));
            }
            
            $imagePath = $request->file('image')->store('catering', 'public');
            $cateringInfo->main_image = $imagePath;
        }

        $cateringInfo->save();

        return redirect()->route('admin.catering.edit-info')
                        ->with('success', 'Información de catering actualizada exitosamente.');
    }

    // Gestión de paquetes
    public function packages()
    {
        $packages = CateringPackage::ordered()->get();
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
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $package = new CateringPackage();
        $package->fill($request->except('image', 'features'));
        $package->is_active = $request->has('is_active');
        $package->features = $request->features ? json_encode($request->features) : null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('catering/packages', 'public');
            $package->image = $imagePath;
        }

        $package->save();

        return redirect()->route('admin.catering.packages')
                        ->with('success', 'Paquete de catering creado exitosamente.');
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
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $package->fill($request->except('image', 'features'));
        $package->is_active = $request->has('is_active');
        $package->features = $request->features ? json_encode($request->features) : null;

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($package->image && file_exists(public_path('storage/' . $package->image))) {
                unlink(public_path('storage/' . $package->image));
            }
            
            $imagePath = $request->file('image')->store('catering/packages', 'public');
            $package->image = $imagePath;
        }

        $package->save();

        return redirect()->route('admin.catering.packages')
                        ->with('success', 'Paquete de catering actualizado exitosamente.');
    }

    public function destroyPackage(CateringPackage $package)
    {
        // Eliminar imagen si existe
        if ($package->image && file_exists(public_path('storage/' . $package->image))) {
            unlink(public_path('storage/' . $package->image));
        }

        $package->delete();

        return redirect()->route('admin.catering.packages')
                        ->with('success', 'Paquete de catering eliminado exitosamente.');
    }

    public function togglePackage(CateringPackage $package)
    {
        $package->is_active = !$package->is_active;
        $package->save();

        $status = $package->is_active ? 'activado' : 'desactivado';
        
        return redirect()->route('admin.catering.packages')
                        ->with('success', "Paquete {$status} exitosamente.");
    }

    // Gestión de solicitudes
    public function requests()
    {
        $requests = CateringRequest::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.catering.requests.index', compact('requests'));
    }

    public function showRequest(CateringRequest $request)
    {
        return view('admin.catering.requests.show', compact('request'));
    }

    public function updateRequestStatus(Request $request, CateringRequest $cateringRequest)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled'
        ]);

        $cateringRequest->status = $request->status;
        $cateringRequest->save();

        return redirect()->route('admin.catering.requests')
                        ->with('success', 'Estado de solicitud actualizado exitosamente.');
    }

    public function destroyRequest(CateringRequest $request)
    {
        $request->delete();

        return redirect()->route('admin.catering.requests')
                        ->with('success', 'Solicitud eliminada exitosamente.');
    }

    public function exportRequests()
    {
        return Excel::download(new CateringRequestsExport, 'solicitudes-catering-' . date('Y-m-d') . '.xlsx');
    }
}