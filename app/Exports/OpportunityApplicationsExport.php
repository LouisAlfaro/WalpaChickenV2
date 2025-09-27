<?php

namespace App\Exports;

use App\Models\OpportunityApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OpportunityApplicationsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
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
        $query = OpportunityApplication::orderBy('created_at', 'desc');

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
            'Empresa/Nombre',
            'Rubro/Especialidad',
            'Teléfono',
            'Email',
            'Región',
            'Provincia',
            'Distrito',
            'Comentario',
            'Archivo Adjunto',
            'Estado',
            'Notas Admin',
            'Fecha Solicitud',
            'Última Actualización'
        ];
    }

    public function map($application): array
    {
        return [
            $application->id,
            $application->type_label,
            $application->type === 'trabajo' ? $application->full_name : $application->company_name,
            $application->business_area,
            $application->phone,
            $application->email,
            $application->region,
            $application->province,
            $application->district,
            $application->comment,
            $application->attachment,
            $application->status_label,
            $application->admin_notes,
            $application->created_at->format('d/m/Y H:i'),
            $application->updated_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
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