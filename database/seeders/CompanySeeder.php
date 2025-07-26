<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::create([
            'ruc' => '20474360955',
            'razonSocial' => 'Macromar Logistics S.A.C.',
            'nombreComercial' => 'Macromar Logistics',
            'direccion' => 'Av. Elmer Faucett Cdra 30 Nro. S/n Int. 406b Otr. Centro aéreo Comercial (Mod B Sector B 4to Piso Bco de la Nacion)',
            'ubigeo' => '150113',
        ]);

        $company->users()->attach(1);

        $branch = $company->branches()->create([
            'name' => 'Depot Paita - Norte',
            'code' => '0000',
            'ubigeo' => '150113',
            'address' => '1-D Z.I. ZONA INDUSTRIAL II COMPLEMENTARIA PIURA – PAITA',
        ]);

        $branch->documents()->attach("01", [
            'serie' => 'F001',
            'correlativo' => '0001',
            'company_id' => $company->id,
        ]);
        $branch->documents()->attach("03", [
            'serie' => 'B001',
            'correlativo' => '0001',
            'company_id' => $company->id,
        ]);
        $branch->documents()->attach("07", [
            'serie' => 'FC01',
            'correlativo' => '0001',
            'company_id' => $company->id,
        ]);
        $branch->documents()->attach("07", [
            'serie' => 'BC01',
            'correlativo' => '0001',
            'company_id' => $company->id,
        ]);
        $branch->documents()->attach("08", [
            'serie' => 'FD01',
            'correlativo' => '0001',
            'company_id' => $company->id,
        ]);
        $branch->documents()->attach("08", [
            'serie' => 'BD01',
            'correlativo' => '0001',
            'company_id' => $company->id,
        ]);
        $branch->documents()->attach("09", [
            'serie' => 'T001',
            'correlativo' => '0001',
            'company_id' => $company->id,
        ]);

        $branch->users()->attach(1, [
            'company_id' => $company->id,
        ]);

        //creo cliente y ya no en el observer
        // Crear cliente "Cliente Varios" con branch y company
        Client::create([
            'tipoDoc' => '-',
            'rznSocial' => 'Cliente Varios',
            'branch_id' => $branch->id,
            'company_id' => $company->id,
        ]);
    }
}
