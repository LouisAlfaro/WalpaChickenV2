<?php

namespace App\Exports;

use App\Models\CateringRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CateringRequestsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $type;
    protected $status;

    public function __construct($type = 'all', $status = 'all')
    {
        $this->type = $type;
        $this->status = $status;
    }

    public function collection()
    {
        $query = CateringRequest::with('cateringPackage')->orderBy('created_at', 'desc');

        if ($this->type !== 'all') {
            $query->where('type', $this->type);
        }

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tipo',
            'Nombre',
            'Fecha Nacimiento',
            'Teléfono',
            'Email',
            'Región',
            'Provincia',
            'Distrito',
            'Fecha Evento',
            'Hora Evento',
            'Número Personas',
            'Tipo Contacto',
            'Contacto',
            'Motivo',
            'Paquete',
            'Tipo Evento',
            'Requerimientos Especiales',
            'Mensaje',
            'Estado',
            'Notas Admin',
            'Fecha Solicitud',
            'Última Actualización'
        ];
    }

    public function map($request): array
    {
        return [
            $request->id,
            $request->type_label,
            $request->name,
            $request->birth_date ? $request->birth_date->format('d/m/Y') : '',
            $request->phone,
            $request->email,
            $request->region,
            $request->province,
            $request->district,
            $request->event_date ? $request->event_date->format('d/m/Y') : '',
            $request->event_time ? $request->event_time->format('H:i') : '',
            $request->number_of_people,
            $request->contact_type,
            $request->contact_value,
            $request->reason,
            $request->cateringPackage ? $request->cateringPackage->name : '',
            $request->event_type,
            $request->special_requirements,
            $request->message,
            $request->status_label,
            $request->admin_notes,
            $request->created_at->format('d/m/Y H:i'),
            $request->updated_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Estilo para el encabezado
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['rgb' => 'D4AF37']
                ]
            ],
        ];
    }
}