<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Damage;

class DamageTable extends DataTableComponent
{
    protected $model = Damage::class;
    public $openModal = false;
    public $openEditModal = false;


    public $damageEdit = [
        'id' => null,
        'code' => null,
        'description' => null,
    ];

    public function openEdit()
    {
        $this->openModal = true;
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');

        $this->setConfigurableAreas([
            'after-wrapper' => ['codes.damages.edit'],
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->deselected(),
            Column::make("Codigo", "code")
                ->sortable(),
            Column::make("Descripcion", "description")
                ->sortable(),
            Column::make("Creado", "created_at")
                ->sortable(),
            Column::make('Acciones')
                ->label(function ($row) {
                    return view('codes.damages.actions', ['damage' => $row]);
                })
        ];
    }
}
