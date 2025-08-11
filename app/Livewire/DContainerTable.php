<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Container;
use Illuminate\Database\Eloquent\Builder;

class DContainerTable extends DataTableComponent
{
    protected $model = Container::class;
    public $originType; // Ej: App\Models\Dischargue o App\Models\Devolution
    public $originId;
    public array $bulkActions = [
        'bulkAnulate' => 'Anular Seleccionados'
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        // Activar checkboxes de selección múltiple
        $this->setBulkActionsEnabled();
        $this->setBulkActions($this->bulkActions);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->deselected(),
            Column::make("Contenedor", "code")
                ->searchable()
                ->sortable(),
            Column::make("ISO", "iso_code")
                ->searchable()
                ->sortable(),
            Column::make("Tecnologia", "reefer_technology.name")
                ->format(function ($row) {
                    return $row ?? '-';
                })
                ->searchable()
                ->sortable(),
            Column::make("Tipo", "container_type.code"),
            Column::make("T. Descripcion", "container_type.description")
                ->sortable(),
            Column::make("Puerto Origen", "port.code")
                ->sortable(),
            Column::make("Condition", "condition_status")
                ->sortable(),
            Column::make("Estado", "status")
                ->format(function ($value, $row) {
                    return $row->currentStatus;
                })
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        $query = Container::query()->with(['origin', 'container_type', 'port', 'reefer_technology', 'machine']);

        if ($this->originType && $this->originId) {
            $query->whereHasMorph(
                'origin',
                $this->originType,
                function (Builder $q) {
                    $q->where('id', $this->originId);
                }
            )
                ->where('status', '>', 0);;
        }

        return $query;
    }

    public function bulkAnulate()
    {
        $selected = $this->getSelected();

        if (empty($selected)) {
            $this->dispatch('swal', [
                'title' => 'Error!',
                'text' => 'Debe seleccionar mínimo un contenedor para anular.',
                'icon' => 'error'
            ]);
            return;
        }

        // Solo obtener los que tengan status = 1
        $validContainers = Container::whereIn('id', $selected)
            ->where('status', 1)
            ->pluck('id')
            ->toArray();

        if (empty($validContainers)) {
            $this->dispatch('swal', [
                'title' => 'Atención!',
                'text' => 'Ninguno de los contenedores seleccionados puede ser anulado (solo se permite anunciados).',
                'icon' => 'error'
            ]);
            return;
        }

        // Actualizar solo los válidos
        Container::whereIn('id', $validContainers)->update([
            'status' => 0
        ]);

        $this->clearSelected();

        $this->dispatch('swal', [
            'title' => 'Éxito!',
            'text' => 'Contenedores anulados con éxito.',
            'icon' => 'success'
        ]);
    }
}
