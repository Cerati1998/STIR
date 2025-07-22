<?php

namespace App\Livewire\Masters;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Vessel;
use Illuminate\Database\Eloquent\Builder;

class VesselTable extends DataTableComponent
{
    protected $model = Vessel::class;

    public $shippingLineId;

    public function mount($shipping_line = null)
    {
        if ($shipping_line) {
            $this->shippingLineId = $shipping_line->id;
        }
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setConfigurableAreas([
            'after-wrapper' => ['masters.lines.vessel']
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->deselected(),
            Column::make('Acciones')
                ->label(function ($row) {
                    return view('masters.lines.vessel-actions', ['vessel' => $row]);
                }),
            Column::make("IMO", "imo_number")
                ->searchable()
                ->sortable(),
            Column::make("Nombre", "name")
                ->searchable()
                ->sortable(),
            Column::make("Linea", "shippingLine.name")
                ->sortable(),
            Column::make('Capacidad', "pallets")
                ->sortable(),
            Column::make("Categoria", "type")
                ->sortable(),
            Column::make("Creado", "created_at")
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        $query = Vessel::query()->with(['shippingLine']);

        // Solo aplicar el filtro si shippingLineId está establecido
        if ($this->shippingLineId) {
            $query->where('shipping_line_id', $this->shippingLineId);
        }

        return $query;
    }
}
