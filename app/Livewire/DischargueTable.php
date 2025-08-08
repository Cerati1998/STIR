<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Dischargue;
use Illuminate\Database\Eloquent\Builder;

class DischargueTable extends DataTableComponent
{
    protected $model = Dischargue::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    #[On('dischargueAdded')]
    public function builder(): Builder
    {
        return Dischargue::with(['vessel', 'shippingLine', 'containers', 'user', 'branch'])
            ->where('branch_id', session('branch')->id);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->deselected(),
            Column::make('Acciones')
                ->label(function ($row) {
                    return view('dischargues.actions', ['dischargue' => $row]);
                }),
            Column::make("Nave", "vessel.name")
                ->searchable()
                ->sortable(),
            Column::make("Linea", "shippingLine.name")
                ->searchable()
                ->sortable(),
            //->format(fn($value, $row) => $row->shippingLine ? "{$row->shippingLine->name} ({$row->shippingLine->code})" : '-'),
            Column::make("Bl", "bl_number")
                ->searchable()
                ->sortable(),
            Column::make("ETA", "eta_date")
                ->sortable(),
            Column::make("Week", "week")
                ->searchable()
                ->sortable(),
            Column::make("Inicio", "started_at")
                ->sortable(),
            Column::make("Termino", "completed_at")
                ->sortable(),
            Column::make("Usuario", "user.name")
                ->sortable(),
            Column::make("Sucursal", "branch.name")
                ->searchable()
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
        ];
    }
}
