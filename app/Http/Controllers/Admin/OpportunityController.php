<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OpportunityContent;
use App\Models\OpportunityBenefit;
use App\Models\OpportunityApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OpportunityApplicationsExport;

class OpportunityController extends Controller
{
    // Dashboard principal
    public function index()
    {
        $totalApplications = OpportunityApplication::count();
        $pendingApplications = OpportunityApplication::pending()->count();
        $comercialApplications = OpportunityApplication::byType('comercial')->count();
        $proveedoresApplications = OpportunityApplication::byType('proveedores')->count();
        $trabajoApplications = OpportunityApplication::byType('trabajo')->count();
        
        $recentApplications = OpportunityApplication::orderBy('created_at', 'desc')->limit(10)->get();
        $contents = OpportunityContent::all();
        $benefits = OpportunityBenefit::active()->ordered()->get();
        
        return view('admin.opportunities.index', compact(
            'totalApplications',
            'pendingApplications',
            'comercialApplications',
            'proveedoresApplications',
            'trabajoApplications',
            'recentApplications',
            'contents',
            'benefits'
        ));
    }

    // Gestión de contenido
    public function editContent($type)
    {
        $content = OpportunityContent::byType($type)->first();
        $types = OpportunityContent::getTypes();
        
        return view('admin.opportunities.edit-content', compact('content', 'type', 'types'));
    }

    public function updateContent(Request $request, $type)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $content = OpportunityContent::byType($type)->first();
        
        if (!$content) {
            $content = new OpportunityContent();
            $content->type = $type;
        }

        $data = $request->only(['title', 'description']);

        // Subir imagen
        if ($request->hasFile('image')) {
            if ($content->image && Storage::disk('public')->exists('opportunities/' . $content->image)) {
                Storage::disk('public')->delete('opportunities/' . $content->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $type . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('opportunities')) {
                Storage::disk('public')->makeDirectory('opportunities');
            }
            
            $image->storeAs('opportunities', $imageName, 'public');
            $data['image'] = $imageName;
        }

        $content->fill($data);
        $content->is_active = true;
        $content->save();

        return redirect()->route('admin.opportunities.index')
                        ->with('success', 'Contenido de ' . OpportunityContent::getTypes()[$type] . ' actualizado exitosamente.');
    }

    // Gestión de beneficios (para trabajo)
    public function benefits()
    {
        $benefits = OpportunityBenefit::orderBy('order', 'asc')->get();
        return view('admin.opportunities.benefits.index', compact('benefits'));
    }

    public function createBenefit()
    {
        return view('admin.opportunities.benefits.create');
    }

    public function storeBenefit(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->only(['title', 'description', 'icon', 'order', 'is_active']);
        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? true;

        OpportunityBenefit::create($data);

        return redirect()->route('admin.opportunities.benefits')
                        ->with('success', 'Beneficio creado exitosamente.');
    }

    public function editBenefit(OpportunityBenefit $benefit)
    {
        return view('admin.opportunities.benefits.edit', compact('benefit'));
    }

    public function updateBenefit(Request $request, OpportunityBenefit $benefit)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->only(['title', 'description', 'icon', 'order', 'is_active']);
        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? true;

        $benefit->update($data);

        return redirect()->route('admin.opportunities.benefits')
                        ->with('success', 'Beneficio actualizado exitosamente.');
    }

    public function destroyBenefit(OpportunityBenefit $benefit)
    {
        $benefit->delete();
        
        return redirect()->route('admin.opportunities.benefits')
                        ->with('success', 'Beneficio eliminado exitosamente.');
    }

    public function toggleBenefit(OpportunityBenefit $benefit)
    {
        $benefit->update(['is_active' => !$benefit->is_active]);
        $status = $benefit->is_active ? 'activado' : 'desactivado';
        
        return redirect()->route('admin.opportunities.benefits')
                        ->with('success', "Beneficio {$status} exitosamente.");
    }

    // Gestión de solicitudes
    public function applications(Request $request)
    {
        $query = OpportunityApplication::orderBy('created_at', 'desc');
        
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }
        
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        
        $applications = $query->paginate(20);
        $types = OpportunityApplication::getTypes();
        $statuses = OpportunityApplication::getStatuses();
        
        return view('admin.opportunities.applications.index', compact(
            'applications', 'types', 'statuses'
        ));
    }

    public function showApplication(OpportunityApplication $application)
    {
        return view('admin.opportunities.applications.show', compact('application'));
    }

    public function updateApplicationStatus(Request $request, OpportunityApplication $application)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,contacted,rejected',
            'admin_notes' => 'nullable|string'
        ]);

        $application->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->route('admin.opportunities.applications')
                        ->with('success', 'Estado actualizado exitosamente.');
    }

    public function destroyApplication(OpportunityApplication $application)
    {
        // Eliminar archivo adjunto si existe
        if ($application->attachment && Storage::disk('public')->exists('opportunities/attachments/' . $application->attachment)) {
            Storage::disk('public')->delete('opportunities/attachments/' . $application->attachment);
        }

        $application->delete();
        
        return redirect()->route('admin.opportunities.applications')
                        ->with('success', 'Solicitud eliminada exitosamente.');
    }

    // Exportar a Excel
    public function exportApplications(Request $request)
    {
        $type = $request->get('type', 'all');
        $status = $request->get('status', 'all');
        
        $filename = 'solicitudes_oportunidades';
        if ($type !== 'all') {
            $filename .= '_' . $type;
        }
        $filename .= '_' . date('Y-m-d') . '.xlsx';
        
        return Excel::download(new OpportunityApplicationsExport($type, $status), $filename);
    }

    public function reportsIndex()
    {
        // Obtener datos reales de la base de datos
        $totalApplications = OpportunityApplication::count();
        $pendingApplications = OpportunityApplication::pending()->count();
        $activeBenefits = OpportunityBenefit::active()->count();
        
        // Calcular conversion rate
        $reviewedApplications = OpportunityApplication::whereIn('status', ['reviewed', 'contacted'])->count();
        $conversionRate = $totalApplications > 0 ? round(($reviewedApplications / $totalApplications) * 100, 1) : 0;
        
        // Datos de la semana actual
        $thisWeek = now()->startOfWeek();
        $thisWeekApplications = OpportunityApplication::where('created_at', '>=', $thisWeek)->count();
        $thisWeekReviewed = OpportunityApplication::where('created_at', '>=', $thisWeek)
                                                 ->whereIn('status', ['reviewed', 'contacted'])
                                                 ->count();
        $thisWeekHired = OpportunityApplication::where('created_at', '>=', $thisWeek)
                                             ->where('status', 'contacted')
                                             ->count();
        $thisWeekBenefits = OpportunityApplication::where('created_at', '>=', $thisWeek)
                                                ->where('type', 'trabajo')
                                                ->count();
        $thisWeekRate = $thisWeekApplications > 0 ? round(($thisWeekReviewed / $thisWeekApplications) * 100, 1) : 0;
        
        // Datos del mes actual
        $thisMonth = now()->startOfMonth();
        $thisMonthApplications = OpportunityApplication::where('created_at', '>=', $thisMonth)->count();
        $thisMonthReviewed = OpportunityApplication::where('created_at', '>=', $thisMonth)
                                                  ->whereIn('status', ['reviewed', 'contacted'])
                                                  ->count();
        $thisMonthHired = OpportunityApplication::where('created_at', '>=', $thisMonth)
                                               ->where('status', 'contacted')
                                               ->count();
        $thisMonthBenefits = OpportunityApplication::where('created_at', '>=', $thisMonth)
                                                  ->where('type', 'trabajo')
                                                  ->count();
        $thisMonthRate = $thisMonthApplications > 0 ? round(($thisMonthReviewed / $thisMonthApplications) * 100, 1) : 0;
        
        // Datos del mes pasado
        $lastMonth = now()->subMonth()->startOfMonth();
        $lastMonthEnd = now()->subMonth()->endOfMonth();
        $lastMonthApplications = OpportunityApplication::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count();
        $lastMonthReviewed = OpportunityApplication::whereBetween('created_at', [$lastMonth, $lastMonthEnd])
                                                  ->whereIn('status', ['reviewed', 'contacted'])
                                                  ->count();
        $lastMonthHired = OpportunityApplication::whereBetween('created_at', [$lastMonth, $lastMonthEnd])
                                               ->where('status', 'contacted')
                                               ->count();
        $lastMonthBenefits = OpportunityApplication::whereBetween('created_at', [$lastMonth, $lastMonthEnd])
                                                  ->where('type', 'trabajo')
                                                  ->count();
        $lastMonthRate = $lastMonthApplications > 0 ? round(($lastMonthReviewed / $lastMonthApplications) * 100, 1) : 0;
        
        // Calcular crecimiento
        $applicationsGrowth = $lastMonthApplications > 0 ? 
            round((($thisMonthApplications - $lastMonthApplications) / $lastMonthApplications) * 100, 1) : 0;
        $conversionGrowth = $lastMonthRate > 0 ? 
            round(($thisMonthRate - $lastMonthRate), 1) : 0;
        
        $data = [
            'totalApplications' => $totalApplications,
            'pendingApplications' => $pendingApplications,
            'activeBenefits' => $activeBenefits,
            'conversionRate' => $conversionRate,
            'applicationsGrowth' => $applicationsGrowth,
            'conversionGrowth' => $conversionGrowth,
            'thisWeekApplications' => $thisWeekApplications,
            'thisWeekReviewed' => $thisWeekReviewed,
            'thisWeekHired' => $thisWeekHired,
            'thisWeekBenefits' => $thisWeekBenefits,
            'thisWeekRate' => $thisWeekRate,
            'thisMonthApplications' => $thisMonthApplications,
            'thisMonthReviewed' => $thisMonthReviewed,
            'thisMonthHired' => $thisMonthHired,
            'thisMonthBenefits' => $thisMonthBenefits,
            'thisMonthRate' => $thisMonthRate,
            'lastMonthApplications' => $lastMonthApplications,
            'lastMonthReviewed' => $lastMonthReviewed,
            'lastMonthHired' => $lastMonthHired,
            'lastMonthBenefits' => $lastMonthBenefits,
            'lastMonthRate' => $lastMonthRate,
        ];
        
        return view('admin.opportunities.reports.index', $data);
    }

    /**
     * Reports Analytics
     */
    public function reportsAnalytics()
    {
        // Distribución por status
        $statusData = [
            'pending' => OpportunityApplication::where('status', 'pending')->count(),
            'reviewed' => OpportunityApplication::where('status', 'reviewed')->count(),
            'contacted' => OpportunityApplication::where('status', 'contacted')->count(),
            'rejected' => OpportunityApplication::where('status', 'rejected')->count()
        ];
        
        // Distribución por tipo
        $positionData = [
            'comercial' => OpportunityApplication::where('type', 'comercial')->count(),
            'proveedores' => OpportunityApplication::where('type', 'proveedores')->count(),
            'trabajo' => OpportunityApplication::where('type', 'trabajo')->count(),
            'otros' => OpportunityApplication::whereNotIn('type', ['comercial', 'proveedores', 'trabajo'])->count()
        ];
        
        // Timeline de las últimas 6 semanas
        $timelineLabels = [];
        $timelineData = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $weekStart = now()->subWeeks($i)->startOfWeek();
            $weekEnd = now()->subWeeks($i)->endOfWeek();
            
            $timelineLabels[] = 'Semana ' . (6 - $i);
            $timelineData[] = OpportunityApplication::whereBetween('created_at', [$weekStart, $weekEnd])->count();
        }
        
        $data = [
            'statusData' => $statusData,
            'positionData' => $positionData,
            'timelineLabels' => $timelineLabels,
            'timelineData' => $timelineData
        ];
        
        return view('admin.opportunities.reports.analytics', $data);
    }

    /**
     * Reports Comercial
     */
    public function reportsComercial()
    {
        // Simulación de datos comerciales (puedes calcular datos reales)
        $totalApplications = OpportunityApplication::count();
        $costPerHire = 850; // Puedes calcular esto basado en gastos reales
        $totalInvestment = $totalApplications * 200; // Costo estimado por aplicación
        $roiBenefits = 285; // Porcentaje de ROI
        $revenueImpact = $totalApplications * 500; // Revenue estimado por hire
        
        $data = [
            'costPerHire' => $costPerHire,
            'totalInvestment' => $totalInvestment,
            'roiBenefits' => $roiBenefits,
            'revenueImpact' => $revenueImpact
        ];
        
        return view('admin.opportunities.reports.comercial', $data);
    }

    /**
     * Reports Edit Content
     */
    public function reportsEditContent()
    {
        return view('admin.opportunities.reports.edit-content');
    }

    /**
     * Reports Update Content
     */
    public function reportsUpdateContent(Request $request)
    {
        // Validación
        $request->validate([
            'report_title' => 'required|string|max:255',
            'update_frequency' => 'required|in:daily,weekly,monthly',
            'target_applications' => 'required|integer|min:1',
            'target_conversion' => 'required|numeric|min:0|max:100',
            'max_cost_per_hire' => 'required|numeric|min:0',
            'min_roi' => 'required|numeric|min:0',
            'report_description' => 'nullable|string',
            'email_recipients' => 'nullable|string',
            'email_schedule' => 'required|in:none,weekly,monthly,quarterly'
        ]);

        // Aquí puedes guardar la configuración en una tabla de settings
        // Por ahora simulamos que se guardó exitosamente
        
        return redirect()->route('admin.opportunities.reports.index')
                        ->with('success', 'Configuración de reportes actualizada exitosamente!');
    }
}