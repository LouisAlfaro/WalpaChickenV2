<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CateringPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Paquete para 10-20 personas',
                'description' => 'Perfecto para reuniones familiares y eventos íntimos. Incluye platos principales, acompañamientos y postres.',
                'min_people' => 10,
                'max_people' => 20,
                'price_per_person' => 35.00,
                'features' => json_encode([
                    'Platos principales variados',
                    'Acompañamientos incluidos',
                    'Postres de la casa',
                    'Servicio de personal',
                    'Montaje y limpieza'
                ]),
                'order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Paquete para 21-50 personas',
                'description' => 'Ideal para eventos corporativos y celebraciones medianas. Menú completo con opciones vegetarianas.',
                'min_people' => 21,
                'max_people' => 50,
                'price_per_person' => 32.00,
                'features' => json_encode([
                    'Menú completo',
                    'Opciones vegetarianas',
                    'Bebidas incluidas',
                    'Personal de servicio completo',
                    'Decoración básica',
                    'Montaje y limpieza'
                ]),
                'order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Paquete para 51+ personas',
                'description' => 'Para grandes eventos y celebraciones. Servicio premium con chef en sitio y atención personalizada.',
                'min_people' => 51,
                'max_people' => 200,
                'price_per_person' => 28.00,
                'features' => json_encode([
                    'Chef en sitio',
                    'Menú personalizable',
                    'Estación de bebidas',
                    'Personal completo',
                    'Decoración incluida',
                    'Coordinador de evento',
                    'Montaje y limpieza'
                ]),
                'order' => 3,
                'is_active' => true
            ]
        ];

        foreach ($packages as $package) {
            \App\Models\CateringPackage::create($package);
        }
    }
}
