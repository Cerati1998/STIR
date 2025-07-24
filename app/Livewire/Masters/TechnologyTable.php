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
            Column::make('Acciones')
                ->label(function ($row) {
                    return view('masters.technologies.technology-actions', ['technology' => $row]);
                }),
            Column::make("Código", "code")
                ->searchable()
                ->sortable(),
            Column::make("Nombre", "name")
                ->searchable()
                ->sortable(),
            Column::make("Creado", "created_at")
                ->sortable(),
        ];
    }

    #[On('technologyAdded')]
    public function builder(): Builder
    {
        return ReeferTechnology::query();
    }

    public $openModal = false;
    public $technologyId;
    public $technology = [
        'code' => '',
        'name' => ''
    ];

    public function edit(ReeferTechnology $reeferTechnology)
    {
        $this->technology = $reeferTechnology->only('code', 'name');
        $this->technologyId = $reeferTechnology->id;
        $this->openModal = true;
    }

    public function save()
    {
        $this->validate([
            'technology.code' => [
                'required',
                'string',
                'min:2',
                Rule::unique('reefer_technologies', 'code')->ignore($this->technologyId)
            ],
            'technology.name' => 'required|string|min:4'
        ], [], [
            'technology.code' => 'Código de Tecnologia Reefer',
            'technology.name' => 'Nombre de Tecnologia Reefer'
        ]);

        ReeferTechnology::find($this->technologyId)->update($this->technology);

        $this->reset('openModal', 'technologyId', 'technology');
        $this->dispatch('swal', [
            'title' => 'Exito!',
            'text' => 'Tecnología Reefer actualizada correctamente',
            'icon' => 'success'
        ]);
    }

    public function destroy(ReeferTechnology $reeferTechnology)
    {
        $reeferTechnology->delete();

        $this->dispatch('swal', [
            'title' => 'Exito!',
            'text' => 'Tecnología Reefer eliminada correctamente',
            'icon' => 'success'
        ]);
    }
}
