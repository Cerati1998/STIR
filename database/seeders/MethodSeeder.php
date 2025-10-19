<?php

namespace Database\Seeders;

use App\Models\Method;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['code' => 'CC', 'description' => 'Chemical clean'],
            ['code' => 'FR', 'description' => 'Free-up / includ. lubricate'],
            ['code' => 'FT', 'description' => 'Refit'],
            ['code' => 'GS', 'description' => 'Dent Removal / Straightening'],
            ['code' => 'GT', 'description' => 'Remove glue and tape'],
            ['code' => 'GW', 'description' => 'Straighten and weld'],
            ['code' => 'IT', 'description' => 'Insert'],
            ['code' => 'MV', 'description' => 'Remove labels, brands, logos, graffiti'],
            ['code' => 'PA', 'description' => 'Paint'],
            ['code' => 'PL', 'description' => 'FLOOR POLISHING'],
            ['code' => 'PR', 'description' => 'REMOVE LOCALIZED CORROSION AND REPAINT'],
            ['code' => 'PS', 'description' => 'Surface preparation and paint'],
            ['code' => 'PT', 'description' => 'Patch'],
            ['code' => 'PX', 'description' => 'Patch and foam'],
            ['code' => 'RA', 'description' => 'Realign'],
            ['code' => 'RD', 'description' => 'Remove and dispose'],
            ['code' => 'RE', 'description' => 'REASEGURAR PERNOS O COMPONENTES SUELTOS'],
            ['code' => 'RM', 'description' => 'Remove (without re-placement)'],
            ['code' => 'RP', 'description' => 'Replace'],
            ['code' => 'RR', 'description' => 'Remove and refit after repair'],
            ['code' => 'SE', 'description' => 'Seal/reseal'],
            ['code' => 'SI', 'description' => 'Splice'],
            ['code' => 'SN', 'description' => 'Section'],
            ['code' => 'SW', 'description' => 'SCANNING'],
            ['code' => 'XW', 'description' => 'GRINDING AND WELDING'],
            ['code' => 'WD', 'description' => 'Weld'],
            ['code' => 'WP', 'description' => 'Sweep'],
            ['code' => 'WW', 'description' => 'Water Wash'],
            ];

        foreach ($methods as $method) {
            Method::create($method);
        }
    }
}
