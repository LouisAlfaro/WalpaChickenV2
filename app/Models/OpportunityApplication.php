<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpportunityApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'company_name',
        'business_area',
        'phone',
        'email',
        'region',
        'province',
        'district',
        'comment',
        'attachment',
        'full_name',
        'status',
        'admin_notes'
    ];

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Pendiente',
            'reviewed' => 'Revisado',
            'contacted' => 'Contactado',
            'rejected' => 'Rechazado'
        ];

        return $labels[$this->status] ?? 'Desconocido';
    }

    public function getTypeLabelAttribute()
    {
        $labels = [
            'comercial' => 'Comercial',
            'proveedores' => 'Proveedores',
            'trabajo' => 'Trabajo'
        ];

        return $labels[$this->type] ?? 'Desconocido';
    }

    public function getAttachmentUrlAttribute()
    {
        return $this->attachment ? asset('storage/opportunities/attachments/' . $this->attachment) : null;
    }

    public static function getStatuses()
    {
        return [
            'pending' => 'Pendiente',
            'reviewed' => 'Revisado',
            'contacted' => 'Contactado',
            'rejected' => 'Rechazado'
        ];
    }

    public static function getTypes()
    {
        return [
            'comercial' => 'Comercial',
            'proveedores' => 'Proveedores',
            'trabajo' => 'Trabajo'
        ];
    }
}