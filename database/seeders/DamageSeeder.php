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
            ['code' => 'BK', 'description' => 'Blocked'],
            ['code' => 'BN', 'description' => 'Burned'],
            ['code' => 'BR', 'description' => 'Broken  /Split'],
            ['code' => 'BT', 'description' => 'Bent'],
            ['code' => 'BW', 'description' => 'Bowed'],
            ['code' => 'CL', 'description' => 'Compresion line'],
            ['code' => 'CD', 'description' => 'Consequential damage'],
            ['code' => 'CK', 'description' => 'Cracked'],
            ['code' => 'CO', 'description' => 'Corroded/ Rusty'],
            ['code' => 'CT', 'description' => 'Contaminated'],
            ['code' => 'CU', 'description' => 'Cut'],
            ['code' => 'DB', 'description' => 'Debris/dunnage'],
            ['code' => 'DI', 'description' => 'Disconnected'],
            ['code' => 'DL', 'description' => 'Delaminated'],
            ['code' => 'DT', 'description' => 'Dent/ Bent'],
            ['code' => 'DY', 'description' => 'Dirty'],
            ['code' => 'FZ', 'description' => 'Frozen/seized'],
            ['code' => 'GD', 'description' => 'Gouged'],
            ['code' => 'GP', 'description' => 'GRP RAJADO LA FIBRA DE VIDRIO Y PLYWOOD'],
            ['code' => 'HO', 'description' => 'Holed'],
            ['code' => 'IR', 'description' => 'Improper repair'],
            ['code' => 'LB', 'description' => 'Low Battery '],
            ['code' => 'LF', 'description' => 'Low fluid level'],
            ['code' => 'LK', 'description' => 'Leak'],
            ['code' => 'LO', 'description' => 'Loose'],
            ['code' => 'ME', 'description' => 'Manufacturing defect ( deleted"Existing")'],
            ['code' => 'ML', 'description' => 'Markings/labels'],
            ['code' => 'MS', 'description' => 'Missing/lost'],
            ['code' => 'MX', 'description' => 'Equipment Misuse'],
            ['code' => 'NI', 'description' => 'Not within ISO dimensions'],
            ['code' => 'NL', 'description' => 'Nails in flooring'],
            ['code' => 'NO', 'description' => 'Not as required by owner'],
            ['code' => 'OD', 'description' => 'Out-of-date'],
            ['code' => 'OL', 'description' => 'Oil saturated'],
            ['code' => 'OR', 'description' => 'Odour'],
            ['code' => 'OS', 'description' => 'Oil Stains'],
            ['code' => 'PF', 'description' => 'Paint failure'],
            ['code' => 'PS', 'description' => 'Pitted Surface'],
            ['code' => 'RA', 'description' => 'Remove for access'],
            ['code' => 'RC', 'description' => 'Conversion required'],
            ['code' => 'SH', 'description' => 'Short/open circuit'],
            ['code' => 'SO', 'description' => 'GRP RAJADO, AGRIETADO (SOLO LA FIBRA DE VIDRIO)'],
            ['code' => 'TR', 'description' => 'Test required'],
            ['code' => 'WN', 'description' => 'Reparación realizada con material inadecuado.'],
            ['code' => 'WT', 'description' => 'Desgaste: Inevitable deterioro de un componente debido al uso bajo condiciones'],
            ];

        foreach ($damages as $damage) {
            Damage::create($damage);
        }
    }
}
