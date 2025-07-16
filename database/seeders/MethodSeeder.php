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
            ['code' => 'CC', 'description' => 'LAVADO QUIMICO'],
            ['code' => 'FR', 'description' => 'DESTRABAR'],
            ['code' => 'FT', 'description' => 'REINSTALAR UN COMPONENTE REMOVIDO'],
            ['code' => 'GS', 'description' => 'DESABOLLAR / ENDEREZAR'],
            ['code' => 'GT', 'description' => 'REMOVER GOMA CINTA ENGOMADA Y SUS RESUDUOS'],
            ['code' => 'GW', 'description' => 'ENDEREZAR Y SOLDAR'],
            ['code' => 'IT', 'description' => 'INSERTAR'],
            ['code' => 'MD', 'description' => 'MODIFICACIONES VARIOS'],
            ['code' => 'MV', 'description' => 'REMOVER ETIQUETAS, MARCAS, LOGOS, GRAFFITIS'],
            ['code' => 'PA', 'description' => 'PINTAR'],
            ['code' => 'PL', 'description' => 'PULIDO DEL PISO'],
            ['code' => 'PR', 'description' => 'REMOVER CORROSION LOCALIZADA Y REPINTAR'],
            ['code' => 'PT', 'description' => 'PARCHAR'],
            ['code' => 'PV', 'description' => 'MASILLADO DEL PISO CON MASILLA DURA'],
            ['code' => 'PX', 'description' => 'PARCHAR, REMOVER Y REEMPLAZAR AISLAMIENTO(FOAM)'],
            ['code' => 'RA', 'description' => 'REALINEAR'],
            ['code' => 'RD', 'description' => 'REMOVER Y RETIRAR MATERIAL DE TRINCA'],
            ['code' => 'RE', 'description' => 'REASEGURAR PERNOS O COMPONENTES SUELTOS'],
            ['code' => 'RG', 'description' => 'REPARA PANELES DE GRP'],
            ['code' => 'RM', 'description' => 'REMOVER Y NO REEMPLAZAR LOS COMPONENTES'],
            ['code' => 'RP', 'description' => 'REEMPLAZAR'],
            ['code' => 'RR', 'description' => 'REMOVER Y REINSTALAR'],
            ['code' => 'RX', 'description' => 'REEMPLAZAR PANEL Y AISLAMIENTO (FOAM)'],
            ['code' => 'SE', 'description' => 'APLICAR SELLADO ALREDEDOR DE UN COMPONENTE'],
            ['code' => 'SI', 'description' => 'REPARAR USANDO PLATINA REMACHADA'],
            ['code' => 'SN', 'description' => 'SECCIONAR'],
            ['code' => 'WD', 'description' => 'SOLDAR'],
            ['code' => 'SW', 'description' => 'BARRIDO'],
            ['code' => 'WW', 'description' => 'LAVADO NORMAL USANDO AGUA'],
            ['code' => 'XW', 'description' => 'ESMERILAR Y SOLDAR'],
            ['code' => 'PS', 'description' => 'PULIR Y PINTAR'],
        ];

        foreach ($methods as $method) {
            Method::create($method);
        }
    }
}
