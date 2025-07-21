<?php

namespace App\Livewire\Masters;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ShippingLine;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;

class LineTable extends DataTableComponent
{
    protected $model = ShippingLine::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setConfigurableAreas([
            'after-wrapper' => ['masters.lines.modal']
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->deselected(),
            Column::make('Acciones')
                ->label(function ($row) {
                    return view('masters.lines.actions', ['line' => $row]);
                }),
            Column::make("Código", "code")
                ->searchable()
                ->sortable(),
            Column::make("Nombre", "name")
                ->searchable()
                ->sortable(),
            Column::make("Creado", "created_at")
                ->sortable(),
            Column::make("Actualizado", "updated_at")
                ->sortable(),
        ];
    }

    #[On('lineAdded')]
    public function builder(): Builder
    {
        return ShippingLine::query();
    }

    public $line_id;
    public $openModal = false;
    public $line = [
        'code' => '',
        'name' => '',
    ];

    public function closeModal()
    {
        $this->openModal = false;
        $this->line = [
            'code' => '',
            'name' => '',
        ];
    }

    public function edit(ShippingLine $line)
    {
        $this->line_id = $line->id;
        $this->line = $line->only(['code', 'name']);
        $this->openModal = true;
    }


    public function destroy(ShippingLine $line)
    {
        $line->delete();
        $this->dispatch('swal', [
            'title' => 'Eliminado',
            'text' => 'La línea de envío ha sido eliminada correctamente.',
            'icon' => 'success',
        ]);
    }
}
