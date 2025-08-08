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

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->deselected(),
            Column::make("Contenedor", "code")
                ->sortable(),
            Column::make("ISO", "iso_code")
                ->sortable(),
            Column::make("Tecnologia", "reefer_technology.name")
                ->format(function ($row) {
                    return $row ?? '-';
                })
                ->sortable(),
            Column::make("Tipo", "container_type.code"),
            Column::make("T. Descripcion", "container_type.description")
                ->sortable(),
            Column::make("Puerto Origen", "port.code")
                ->sortable(),
            Column::make("Condition", "condition_status")
                ->sortable(),
            Column::make("Estado", "status")
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
            );
        }

        return $query;
    }
}
