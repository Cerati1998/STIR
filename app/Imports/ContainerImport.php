<?php

namespace App\Imports;

use App\Models\Container;
use App\Models\ContainerType;
use App\Models\Port;
use App\Models\ReeferMachine;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\{
    ToCollection,
    WithHeadingRow
};
use Throwable;


class ContainerImport implements
    ToCollection,
    WithHeadingRow,
    WithChunkReading,     // 👈 Necesaria para chunkSize()
    WithBatchInserts     // 👈 Necesaria para batchSize()
{
    use SkipsFailures;

    protected $dischargueId;
    public function __construct($dischargueId)
    {
        $this->dischargueId = $dischargueId;
    }

    public function chunkSize(): int
    {
        return 100; // o el número que prefieras
    }

    public function batchSize(): int
    {
        return 100;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $data) {
            try {
                $row = $data->toArray();
                // Validar y preparar cada contenedor

                $reeferMachine = ReeferMachine::firstOrCreate(['name' => trim($row['type'])], [
                    'code' => trim($row['type']),
                    'name' => trim($row['type'])
                ]);
                $port = Port::firstOrCreate(['code' => trim($row['pol'])], [
                    'code' => trim($row['pol']),
                    'name' => trim($row['pol'])
                ]);
                $containerType = ContainerType::firstOrCreate(['iso_code' => trim($row['iso'])], [
                    'iso_code' => trim($row['iso']),
                    'description' => trim($row['iso'])
                ]);
                Container::create([
                    'code' => $row['container'],
                    'iso_code'        => $row['iso'],
                    'container_type_id'    => $containerType->id,
                    'port_id' => $port->id,
                    'condition_status'        => $row['condition'],
                    'status' => 1,
                    'reefer_technology_id' => $reeferMachine->id,
                    'reefer_machine_id' => $reeferMachine->id,
                    // RELACIÓN polIMÓRFICA
                    'origin_id' => $this->dischargueId,
                    'origin_type' => \App\Models\Dischargue::class,

                ]);
            } catch (Throwable $e) {
                // Log o manejo personalizado (no detiene la importación completa)
                Log::error("Fila $index falló: " . $e->getMessage());
                continue;
            }
        }
    }
    /* public function model(array $row)
    {
        $reeferMachine = ReeferMachine::firstOrCreate(['name' => trim($row['type'])], [
            'name' => trim($row['type'])
        ]);
        $port = Port::firstOrCreate(['code' => trim($row['pol'])], [
            'code' => trim($row['pol']),
            'name' => trim($row['pol'])
        ]);
        $containerType = ContainerType::firstOrCreate(['iso_code' => trim($row['iso'])], [
            'iso_code' => trim($row['iso']),
            'description' => trim($row['iso'])
        ]);
        return new Container([
            'code' => $row['container'],
            'iso_code'        => $row['iso'],
            'container_type_id'    => $containerType->id,
            'port_id' => $port->id,
            'condition_status'        => $row['condition'],
            'status' => 1,
            'reefer_technology_id' => $reeferMachine->id,
            'reefer_machine_id' => $reeferMachine->id,
            // RELACIÓN polIMÓRFICA
            'origin_id' => $this->dischargueId,
            'origin_type' => \App\Models\Dischargue::class,

        ]);
    } */
}
