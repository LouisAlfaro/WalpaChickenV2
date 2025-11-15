<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ComplaintBooksExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $complaints;

    public function __construct($complaints)
    {
        $this->complaints = $complaints;
    }

    public function collection()
    {
        return $this->complaints;
    }

    public function headings(): array
    {
        return [
            'N° Reclamo',
            'Tipo',
            'Estado',
            'Fecha Registro',
            'Nombre Completo',
            'Tipo Doc.',
            'N° Documento',
            'Teléfono',
            'Email',
            'Departamento',
            'Provincia',
            'Distrito',
            'Dirección',
            'Tipo Bien',
            'Monto',
            'Descripción Bien',
            'Detalle Reclamo',
            'Pedido',
            'Notas Admin',
            'Fecha Resolución'
        ];
    }

    public function map($complaint): array
    {
        return [
            $complaint->complaint_number,
            $complaint->type_label,
            $complaint->status_label,
            $complaint->created_at->format('d/m/Y H:i'),
            $complaint->full_name,
            $complaint->document_type,
            $complaint->document_number,
            $complaint->phone,
            $complaint->email,
            $complaint->department,
            $complaint->province,
            $complaint->district,
            $complaint->address,
            $complaint->product_type_label,
            $complaint->amount ? 'S/ ' . number_format($complaint->amount, 2) : '-',
            $complaint->description,
            $complaint->complaint_detail,
            $complaint->request,
            $complaint->admin_notes ?? '-',
            $complaint->resolved_at ? $complaint->resolved_at->format('d/m/Y H:i') : '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'FEC601']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,  // N° Reclamo
            'B' => 12,  // Tipo
            'C' => 15,  // Estado
            'D' => 18,  // Fecha
            'E' => 25,  // Nombre
            'F' => 12,  // Tipo Doc
            'G' => 15,  // N° Doc
            'H' => 15,  // Teléfono
            'I' => 30,  // Email
            'J' => 15,  // Departamento
            'K' => 15,  // Provincia
            'L' => 15,  // Distrito
            'M' => 35,  // Dirección
            'N' => 12,  // Tipo Bien
            'O' => 12,  // Monto
            'P' => 40,  // Descripción
            'Q' => 50,  // Detalle
            'R' => 40,  // Pedido
            'S' => 40,  // Notas
            'T' => 18,  // Fecha Resolución
        ];
    }
}
