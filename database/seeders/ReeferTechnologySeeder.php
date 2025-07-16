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
        $reeferTechnologies = [
            // Main Brands
            [
                'code' => 'THERMOKING',
                'name' => 'Thermo King'
            ],
            [
                'code' => 'CARRIER',
                'name' => 'Carrier Transicold'
            ],
            [
                'code' => 'DAIKIN',
                'name' => 'Daikin Reefer'
            ],
            [
                'code' => 'STARCOOL',
                'name' => 'Star Cool (Mitsubishi)'
            ],

            // Other Important Manufacturers
            [
                'code' => 'MHI',
                'name' => 'Mitsubishi Heavy Industries'
            ],
            [
                'code' => 'WEST',
                'name' => 'West Transport Refrigeration'
            ],
            [
                'code' => 'ZYTRAX',
                'name' => 'ZyTrax'
            ],
            [
                'code' => 'KOMATSU',
                'name' => 'Komatsu Reefer'
            ],

            // Specialized Systems
            [
                'code' => 'CRYO',
                'name' => 'Cryo-Trans'
            ],
            [
                'code' => 'AMER',
                'name' => 'AmeriCold Logistics'
            ],
            [
                'code' => 'SEA',
                'name' => 'Seacold'
            ]
        ];

        foreach ($reeferTechnologies as $technology) {
            ReeferTechnology::create($technology);
        }
    }
}
