<?php

namespace Database\Seeders;

use App\Models\Damage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DamageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $damages = [
            ['code' => 'BR', 'description' => 'Roto/Dividido'],
            ['code' => 'BT', 'description' => 'Doblado'],
            ['code' => 'BW', 'description' => 'ARQUEADO (DAÑO GADUAL SOBRE LA LONGITUD DEL COMPONENTE)'],
            ['code' => 'CL', 'description' => 'Línea de Comprensión'],
            ['code' => 'CO', 'description' => 'Corroído/Oxidado'],
            ['code' => 'CT', 'description' => 'Contaminado'],
            ['code' => 'CU', 'description' => 'Corte'],
            ['code' => 'DB', 'description' => 'Escombros/Material de estiba'],
            ['code' => 'DL', 'description' => 'Delaminado'],
            ['code' => 'DT', 'description' => 'Abolladura/dobladura'],
            ['code' => 'DY', 'description' => 'Sucio'],
            ['code' => 'FZ', 'description' => 'Trabado'],
            ['code' => 'GD', 'description' => 'Rasguño'],
            ['code' => 'SO', 'description' => 'GRP RAJADO, AGRIETADO (SOLO LA FIBRA DE VIDRIO)'],
            ['code' => 'GP', 'description' => 'GRP RAJADO LA FIBRA DE VIDRIO Y PLYWOOD'],
            ['code' => 'HO', 'description' => 'Agujero'],
            ['code' => 'IR', 'description' => 'Reparación Impropia'],
            ['code' => 'LK', 'description' => 'Pase de luz/fuga'],
            ['code' => 'LO', 'description' => 'Perdido / Suelto'],
            ['code' => 'ML', 'description' => 'Marcas/Etiquetas'],
            ['code' => 'MS', 'description' => 'Perdido/Faltante'],
            ['code' => 'NI', 'description' => 'Equipo no cumple con las dimensiones ISO'],
            ['code' => 'NL', 'description' => 'CLAVOS USUALMENTE EN EL PISO'],
            ['code' => 'OL', 'description' => 'ALTA CONTAMINACION DE ACEITE'],
            ['code' => 'OR', 'description' => 'Olor'],
            ['code' => 'OS', 'description' => 'PISO SUCIO'],
            ['code' => 'WN', 'description' => 'Reparación realizada con material inadecuado.'],
            ['code' => 'WT', 'description' => 'Desgaste: Inevitable deterioro de un componente debido al uso bajo condiciones'],
            ['code' => 'BK', 'description' => 'Obstruido'],
            ['code' => 'BN', 'description' => 'Quemado'],
            ['code' => 'CD', 'description' => 'Daño Consecuencial'],
            ['code' => 'CK', 'description' => 'Agrietado'],
            ['code' => 'NO', 'description' => 'No, según lo requerido por el propietario'],
            ['code' => 'PF', 'description' => 'Falla de Pintura'],
            ['code' => 'PS', 'description' => 'Corrosión por picadura'],
            ['code' => 'RA', 'description' => 'Retirar para acceder'],
        ];

        foreach ($damages as $damage) {
            Damage::create($damage);
        }
    }
}
