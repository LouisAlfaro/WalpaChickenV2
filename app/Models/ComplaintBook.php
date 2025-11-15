<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComplaintBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_number',
        'type',
        'full_name',
        'document_type',
        'document_number',
        'phone',
        'email',
        'department',
        'province',
        'district',
        'address',
        'product_type',
        'amount',
        'description',
        'complaint_detail',
        'request',
        'status',
        'admin_notes',
        'resolved_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'resolved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Generar número de reclamo automáticamente
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($complaint) {
            if (!$complaint->complaint_number) {
                $year = date('Y');
                $lastComplaint = static::whereYear('created_at', $year)
                    ->orderBy('id', 'desc')
                    ->first();
                
                $number = $lastComplaint ? intval(substr($lastComplaint->complaint_number, -6)) + 1 : 1;
                $complaint->complaint_number = 'LR-' . $year . '-' . str_pad($number, 6, '0', STR_PAD_LEFT);
            }
        });
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pendiente');
    }

    public function scopeInProcess($query)
    {
        return $query->where('status', 'en_proceso');
    }

    public function scopeResolved($query)
    {
        return $query->where('status', 'resuelto');
    }

    // Accessors
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pendiente' => 'Pendiente',
            'en_proceso' => 'En Proceso',
            'resuelto' => 'Resuelto',
            'rechazado' => 'Rechazado'
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getTypeLabelAttribute()
    {
        return $this->type === 'reclamo' ? 'Reclamo' : 'Queja';
    }

    public function getProductTypeLabelAttribute()
    {
        return $this->product_type === 'producto' ? 'Producto' : 'Servicio';
    }
}
