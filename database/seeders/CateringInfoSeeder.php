<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CateringInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\CateringInfo::create([
            'title' => 'Servicio de Catering Walpa',
            'description' => 'Tus invitados son los nuestros, por eso te aseguramos que nuestra Experiencia Walpa los cautivará. Nuestra familia y su cálido servicio se trasladan, con lo mejor de nuestros insumos e indumentaria, a donde tú nos indiques para hacerlos sentir como en casa.',
            'phone' => '+51 123 456 789',
            'email' => 'catering@walpa.com',
            'address' => 'Lima, Perú',
            'is_active' => true
        ]);
    }
}
