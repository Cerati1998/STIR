<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            [
                'id' => '01',
                'description' => 'Factura',
            ],
            [
                'id' => '03',
                'description' => 'Boleta de Venta',
            ],
            /* [
                'id' => '04',
                'description' => 'Liquidación de compra',
            ], */
            [
                'id' => '07',
                'description' => 'Nota de Crédito',
            ],
            [
                'id' => '08',
                'description' => 'Nota de Débito',
            ],
            [
                'id' => '09',
                'description' => 'Guía de Remisión',
            ],
            [
                'id' => '10',
                'description' => 'Inspeccion GATE IN',
            ],
            [
                'id' => '11',
                'description' => 'Reporte de Reparación',
            ],
            [
                'id' => '12',
                'description' => 'Inspeccion GATE OUT',
            ],
            [
                'id' => '13',
                'description' => 'Orden de Compra',
            ],
            [
                'id' => '14',
                'description' => 'Orden de Servicio',
            ],
            [
                'id' => '15',
                'description' => 'Reporte de Leak Test',
            ],
        ];

        foreach ($documents as $document) {
            Document::create($document);
        }

    }
}
