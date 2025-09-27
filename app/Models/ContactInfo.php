<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si coincide con "contact_infos")
    protected $table = 'contact_infos';

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'title',
        'schedule',
        'phone',
        'email',
        'address',
        'facebook',
        'instagram',
        'tiktok',
        'linkedin',
    ];
}
