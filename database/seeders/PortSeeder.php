<?php

namespace Database\Seeders;

use App\Models\Port;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ports = [
                // Dutch Ports
                ['code' => 'NLRTM', 'name' => 'Rotterdam', 'country_code' => 'NLD'],
                ['code' => 'NLAMS', 'name' => 'Amsterdam', 'country_code' => 'NLD'],
                ['code' => 'NLVLI', 'name' => 'Vlissingen', 'country_code' => 'NLD'],

                // Chilean Ports  
                ['code' => 'CLVAP', 'name' => 'Valparaíso', 'country_code' => 'CHL'],
                ['code' => 'CLSAI', 'name' => 'San Antonio', 'country_code' => 'CHL'],

                // Mexican Ports
                ['code' => 'MXVER', 'name' => 'Veracruz', 'country_code' => 'MEX'],
                ['code' => 'MXMAN', 'name' => 'Manzanillo', 'country_code' => 'MEX'],

                // Chinese Ports
                ['code' => 'CNSHA', 'name' => 'Shanghai', 'country_code' => 'CHN'],
                ['code' => 'CNNGB', 'name' => 'Ningbo', 'country_code' => 'CHN'],

                // European Ports
                ['code' => 'GBDVR', 'name' => 'Dover', 'country_code' => 'GBR'],
                ['code' => 'BEANR', 'name' => 'Antwerp', 'country_code' => 'BEL'],

                // US Ports
                ['code' => 'USILG', 'name' => 'Wilmington', 'country_code' => 'USA'],
                ['code' => 'USILM', 'name' => 'Wilmington NC', 'country_code' => 'USA'],

                ['code' => 'PEPAI', 'name' => 'Paita', 'country_code' => 'PER'],
                ['code' => 'PECLL', 'name' => 'Callao', 'country_code' => 'PER'],

                ['code' => 'ECGYE', 'name' => 'Guayaquil', 'country_code' => 'ECU'],    
        ];

        foreach ($ports as $port) {
            Port::create($port);
        }
    }
}
