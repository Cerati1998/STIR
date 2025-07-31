<?php

namespace Database\Seeders;

use App\Models\ReeferTechnology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReeferTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            [
                'name' => 'CONVENCIONAL',
                'description' => 'Control Básico de Temperatura',
                'temperature_range' => 'Control estándar según el rango requerido (ej. -30°C a +30°C).',
                'ventilation' => 'Ajustable (normalmente 25 m³/h o 50 m³/h).',
                'humidity' => 'No controlada activamente (depende de la carga).',
                'atmosphere' => 'Aire natural (sin modificación de gases).',
                'usage' => 'Carga general refrigerada o congelada (ej. frutas, carnes, lácteos).'
            ],
        ];

        foreach ($technologies as $technology) {
            ReeferTechnology::create($technology);
        }
    }
}
