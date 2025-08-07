<?php

namespace App\Imports;

use App\Models\Container;
use App\Models\ContainerType;
use App\Models\Port;
use App\Models\ReeferMachine;
use App\Models\ReeferTechnology;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Throwable;

class ContainerImport implements
    ToCollection,
    WithHeadingRow,
    WithChunkReading,
    WithBatchInserts
{
    protected $dischargueId;

    // Cache en memoria durante el chunk
    protected array $cachedPorts = [];
    protected array $cachedContainerTypes = [];
    protected array $cachedReefers = [];

    public function __construct($dischargueId)
    {
        $this->dischargueId = $dischargueId;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $data) {
            $row = $data->toArray();

            if (collect($row)->filter()->isEmpty()) {
                Log::info("Fila completamente vacía en línea " . ($index + 1));
                break;
            }

            try {
                $containerCode = strtoupper(trim($row['container'] ?? ''));

                if (strlen($containerCode) !== 11) {
                    Log::error("Fila $index: Contenedor inválido → '{$containerCode}'");
                    throw new \Exception("El contenedor '{$row['container']}' no tiene 11 caracteres (tiene " . strlen($row['container']) . ")");
                }

                // Port
                $portCode = strtoupper(trim($row['pol'] ?? ''));
                if (!$portCode) {
                    Log::error("Fila $index: Código de puerto vacío.");
                    continue;
                }

                $port = $this->getCachedPort($portCode);

                // Container type
                $iso = strtoupper(trim($row['iso'] ?? ''));
                if (!$iso) {
                    Log::error("Fila $index: Código ISO vacío.");
                    continue;
                }


                $containerType = $this->getCachedContainerType($iso);

                // Reefer machine y tecnología (solo si es reefer)
                $reeferMachineId = null;
                $reeferTechnologyId = null;

                if ($containerType->is_reefer) {
                    $type = strtoupper(trim($row['type'] ?? ''));

                    if (empty($type)) {
                        $type = 'CONVENCIONAL';
                        Log::info("Fila $index: Contenedor reefer sin tipo, asignado tipo por defecto: CONVENCIONAL.");
                    }

                    $reeferTechnology = $this->getCachedTechnology($type);
                    $reeferTechnologyId = $reeferTechnology->id;
                }


                // Crear el contenedor
                Container::create([
                    'code' => $containerCode,
                    'iso_code' => $iso,
                    'container_type_id' => $containerType->id,
                    'port_id' => $port->id,
                    'condition_status' => strtoupper(trim($row['condition'] ?? '')),
                    'status' => 1,
                    'reefer_machine_id' => null,
                    'reefer_technology_id' => $reeferTechnologyId,
                    'origin_id' => $this->dischargueId,
                    'origin_type' => \App\Models\Dischargue::class,
                ]);
            } catch (Throwable $e) {
                Log::error("Fila $index falló: " . $e->getMessage());
                throw new \Exception("Error en la fila $index: " . $e->getMessage(), 0, $e);
                // No lanzar excepción para evitar rollback completo
                //continue;
            }
        }
    }
    protected function getCachedTechnology(string $type): ReeferTechnology
    {
        $normalizedType = strtoupper(trim($type));

        if (isset($this->cachedReefers[$normalizedType])) {
            return $this->cachedReefers[$normalizedType];
        }

        // Buscar por coincidencia exacta (insensible a mayúsculas)
        $existing = ReeferTechnology::whereRaw('UPPER(TRIM(name)) = ?', [$normalizedType])->first();

        if (!$existing) {
            $existing = ReeferTechnology::create([
                'name' => $type,
            ]);
        }

        return $this->cachedReefers[$normalizedType] = $existing;
    }



    protected function getCachedPort(string $code): Port
    {
        if (isset($this->cachedPorts[$code])) {
            return $this->cachedPorts[$code];
        }

        return $this->cachedPorts[$code] = Port::firstOrCreate(['code' => $code], [
            'name' => $code,
        ]);
    }

    protected function getCachedContainerType(string $iso): ContainerType
    {
        if (isset($this->cachedContainerTypes[$iso])) {
            return $this->cachedContainerTypes[$iso];
        }

        return $this->cachedContainerTypes[$iso] = ContainerType::firstOrCreate(['iso_code' => $iso], [
            'description' => $iso,
        ]);
    }
}
