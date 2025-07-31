<?php

namespace App\Livewire\Masters;

use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ReeferTechnology;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class TechnologyTable extends DataTableComponent
{
    protected $model = ReeferTechnology::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setConfigurableAreas([
            'after-wrapper' => ['masters.technologies.technology']
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->deselected(),
            Column::make('accciones')
                ->label(function ($row) {
                    return view('masters.technologies.technology-actions', ['technology' => $row]);
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

    #[On('technologyAdded')]
    public function builder(): Builder
    {
        return Reefertechnology::query();
    }

    public $technologyId;
    public $openModal = false;
    public $technology = [
        'name' => '',
        'description' => '',
        'temperature_range' => '',
        'ventilation' => '',
        'humidity' => '',
        'atmosphere' => '',
        'usage' => '',
    ];

    public function edit(Reefertechnology $reefertechnology)
    {
        $this->technologyId = $reefertechnology->id;
        $this->technology = $reefertechnology->only(['name', 'description', 'temperature_range', 'ventilation', 'humidity', 'atmosphere', 'usage']);
        $this->openModal = true;
    }


    public function save()
    {
        $this->validate([
            'technology.name' => [
                'required',
                'string',
                'min:3',
                Rule::unique('reefer_technologies', 'name')->ignore($this->technologyId)
            ],
            'technology.description' => 'string|min:3',
            'technology.usage' => 'string|min:4'
        ], [], [
            'technology.name' => 'Nombre de tecnología',
            'technology.description' => 'Descripción de tecnología',
            'technology.usage' => 'Descripción de Uso o aplicación de tecnología'
        ]);

        Reefertechnology::find($this->technologyId)->update($this->technology);

        $this->reset('technologyId', 'technology', 'openModal');

        $this->dispatch('swal', [
            'title' => 'Exito!',
            'text' => 'tecnología de Contenedor actualizada correctamente',
            'icon' => 'success'
        ]);
    }

    public function destroyTechnology(Reefertechnology $reefertechnology)
    {
        $reefertechnology->delete();

        $this->dispatch('swal', [
            'title' => 'Exito!',
            'text' => 'tecnología de Contenedor Eliminada correctamente',
            'icon' => 'success'
        ]);
    }
}
