<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CateringRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'birth_date',
        'phone',
        'email',
        'region',
        'province',
        'district',
        'event_date',
        'event_time',
        'number_of_people',
        'contact_type',
        'contact_value',
        'reason',
        'message',
        'catering_package_id',
        'event_type',
        'special_requirements',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'event_date' => 'date',
        'event_time' => 'datetime:H:i'
    ];

    // Scopes
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

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Relationships
    public function cateringPackage()
    {
        return $this->belongsTo(CateringPackage::class);
    }

    // Accessors
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Pendiente',
            'contacted' => 'Contactado',
            'confirmed' => 'Confirmado',
            'cancelled' => 'Cancelado'
        ];

        return $labels[$this->status] ?? 'Desconocido';
    }

    public function getTypeLabelAttribute()
    {
        $labels = [
            'catering' => 'Catering',
            'reservation' => 'Reserva'
        ];

        return $labels[$this->type] ?? 'Desconocido';
    }

    public function getFullAddressAttribute()
    {
        $parts = array_filter([$this->district, $this->province, $this->region]);
        return implode(', ', $parts);
    }

    // Métodos estáticos
    public static function getStatuses()
    {
        return [
            'pending' => 'Pendiente',
            'contacted' => 'Contactado',
            'confirmed' => 'Confirmado',
            'cancelled' => 'Cancelado'
        ];
    }

    public static function getTypes()
    {
        return [
            'catering' => 'Catering',
            'reservation' => 'Reserva'
        ];
    }

    public static function getContactTypes()
    {
        return [
            'phone' => 'Teléfono',
            'email' => 'Email',
            'whatsapp' => 'WhatsApp'
        ];
    }
}