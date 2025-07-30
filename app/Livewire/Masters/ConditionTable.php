<?php

namespace App\Livewire\Masters;

use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ReeferCondition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class ConditionTable extends DataTableComponent
{
    protected $model = ReeferCondition::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setConfigurableAreas([
            'after-wrapper' => ['masters.technologies.condition']
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->deselected(),
            Column::make('accciones')
                ->label(function ($row) {
                    return view('masters.technologies.condition-actions', ['condition' => $row]);
                }),
            Column::make("Nombre", "name")
                ->searchable()
                ->sortable(),
            Column::make("Descripción", "description")
                ->searchable(),
            Column::make("Temperatura", "temperature_range"),
            Column::make("Ventilación", "ventilation"),
            Column::make("Humedad", "humidity"),
            Column::make("Atmosfera", "atmosphere"),
            Column::make("Uso", "usage"),
            Column::make("Actualizado", "updated_at")
                ->sortable(),
        ];
    }

    #[On('conditionAdded')]
    public function builder(): Builder
    {
        return ReeferCondition::query();
    }

    public $conditionId;
    public $openModal = false;
    public $condition = [
        'name' => '',
        'description' => '',
        'temperature_range' => '',
        'ventilation' => '',
        'humidity' => '',
        'atmosphere' => '',
        'usage' => '',
    ];

    public function edit(ReeferCondition $reeferCondition)
    {
        $this->conditionId = $reeferCondition->id;
        $this->condition = $reeferCondition->only(['name', 'description', 'temperature_range', 'ventilation', 'humidity', 'atmosphere', 'usage']);
        $this->openModal = true;
    }


    public function save()
    {
        $this->validate([
            'condition.name' => [
                'required',
                'string',
                'min:3',
                Rule::unique('reefer_conditions', 'name')->ignore($this->conditionId)
            ],
            'condition.description' => 'string|min:3',
            'condition.usage' => 'string|min:4'
        ], [], [
            'condition.name' => 'Nombre de Condición',
            'condition.description' => 'Descripción de Condición',
            'condition.usage' => 'Descripción de Uso o aplicación de Condición'
        ]);

        ReeferCondition::find($this->conditionId)->update($this->condition);

        $this->reset('conditionId', 'condition', 'openModal');

        $this->dispatch('swal', [
            'title' => 'Exito!',
            'text' => 'Condición de Contenedor actualizada correctamente',
            'icon' => 'success'
        ]);
    }

    public function destroyCondition(ReeferCondition $reeferCondition)
    {
        $reeferCondition->delete();

        $this->dispatch('swal', [
            'title' => 'Exito!',
            'text' => 'Condición de Contenedor Eliminada correctamente',
            'icon' => 'success'
        ]);
    }
}
