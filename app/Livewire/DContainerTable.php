<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ContainerOperationalTrace;
use App\Models\GateInDetail;
use Illuminate\Database\Eloquent\Builder;

class DContainerTable extends DataTableComponent
{
    protected $model = GateInDetail::class;
    public $originType; // Ej: App\Models\Dischargue o App\Models\Devolution
    public $originId;
    public array $bulkActions = [
        'bulkAnulateConsult' => 'Anular Seleccionados'
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
            Column::make("Contenedor", "container.code")
                ->searchable()
                ->sortable(),
            Column::make("ISO", "container.iso_code")
                ->searchable()
                ->sortable(),
            Column::make("Tecnologia", "container.reefer_technology.name")
                ->format(function ($row) {
                    return $row ?? '-';
                })
                ->searchable()
                ->sortable(),
            Column::make("Tipo", "container.container_type.code"),
            Column::make("T. Descripcion", "container.container_type.description")
                ->sortable(),
            Column::make("Puerto Origen", "port.code")
                ->sortable(),
            Column::make("Condition", "container_condition")
                ->sortable(),
            Column::make("Estado", "containerOperationalTrace.status")
                ->format(function ($value, $row) {
                    //dd($row->containerOperationalTrace->currentStatus);
                    return view('components.badge', [
                        'icon' => $row->containerOperationalTrace->currentStatus['icon'] ?? '',
                        'styleBg' => $row->containerOperationalTrace->currentStatus['styleBg'] ?? '',
                        'slot' => $row->containerOperationalTrace->currentStatus['description'] ?? '',
                    ]);
                })
        ];
    }

    public function builder(): Builder
    {
        $query = GateInDetail::query()->with(['originable', 'container', 'port', 'containerOperationalTrace']);

        if ($this->originType && $this->originId) {
            $query->whereHasMorph(
                'originable',
                $this->originType,
                function (Builder $q) {
                    $q->where('id', $this->originId);
                }
            )
                ->where('status', '>=', 0);;
        }

        return $query;
    }
    public function bulkAnulateConsult()
    {
        $this->dispatch('bulkAnulateConsult', [
            'title' => '¿Estas seguro de anular?',
            'msg' => 'No podrás trabajar los contenedores anulados'
        ]);
    }

    #[On('bulkAnulate')]
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
        $validContainers = ContainerOperationalTrace::whereIn('id', $selected)
            ->where('status', 1)
            ->where('gate_in_detail_id', $this->originId)
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
        ContainerOperationalTrace::whereIn('id', $validContainers)->update([
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
