<?php

namespace Database\Seeders;

use App\Models\ContainerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContainerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $containerTypes = [
            [
                'iso_code'   => "40GP",
                'description' => "40'-ST STANDAR",
                'length'     => 12.19,
                'width'      => 2.44,
                'height'     => 2.59,
            ],
            [
                'iso_code'   => "40HC",
                'description' => "40'-HQ HIGH CUBE",
                'length'     => 12.19,
                'width'      => 2.44,
                'height'     => 2.89,
            ],
            [
                'iso_code'   => "40RF",
                'description' => "40'-RF REEFER",
                'length'     => 11.56,
                'width'      => 2.29,
                'height'     => 2.59,
            ],
            [
                'iso_code'   => "40OT",
                'description' => "40'-OT OPEN TOP",
                'length'     => 12.19,
                'width'      => 2.44,
                'height'     => 2.59,
            ],
            [
                'iso_code'   => "40FR",
                'description' => "40'-FR FLAT RAK",
                'length'     => 12.06,
                'width'      => 2.44,
                'height'     => 2.28,
            ],
            [
                'iso_code'   => "20GP",
                'description' => "20'-ST STANDAR",
                'length'     => 6.06,
                'width'      => 2.44,
                'height'     => 2.59,
            ],
            [
                'iso_code'   => "20RF",
                'description' => "20'-RF REEFER",
                'length'     => 5.45,
                'width'      => 2.29,
                'height'     => 2.27,
            ],
            [
                'iso_code'   => "20OT",
                'description' => "20'-OT OPEN TOP",
                'length'     => 5.90,
                'width'      => 2.34,
                'height'     => 2.35,
            ],
            [
                'iso_code'   => "20FR",
                'description' => "20'-FR FLAT RAK",
                'length'     => 5.70,
                'width'      => 2.36,
                'height'     => 2.24,
            ],
            [
                'iso_code'   => "20HC",
                'description' => "20'-HQ HIGH CUBE",
                'length'     => 6.06,
                'width'      => 2.44,
                'height'     => 2.70,
            ],
        ];

        foreach ($containerTypes as $containerType) {
            ContainerType::create($containerType);
        }
    }
}
