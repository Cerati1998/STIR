<?php

namespace App\Livewire\Masters;

use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Port;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class PortTable extends DataTableComponent
{
    protected $model = Port::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('name', 'desc');
        $this->setConfigurableAreas([
            'after-wrapper' => ['masters.ports.modal']
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->deselected(),
            Column::make('Acciones')
                ->label(function ($row) {
                    return view('masters.ports.actions', ['port' => $row]);
                }),
            Column::make("Código", "code")
                ->searchable()
                ->sortable(),
            Column::make("Nombre", "name")
                ->searchable()
                ->sortable(),
            Column::make("Pais", "country_code")
                ->sortable(),
            Column::make("Coordenadas", "location")
                ->sortable(),
            Column::make("Creado", "created_at")
                ->sortable(),
        ];
    }

    #[On('portAdded')]
    public function builder(): Builder
    {
        return Port::query();
    }

    public $countryOptions = [
        ['code' => 'PER', 'name' => 'PERÚ', 'estado' => 1],
        ['code' => 'USA', 'name' => 'ESTADOS UNIDOS', 'estado' => 1],
        ['code' => 'CHN', 'name' => 'CHINA', 'estado' => 1],
        ['code' => 'BRA', 'name' => 'BRASIL', 'estado' => 1],
        ['code' => 'CHL', 'name' => 'CHILE', 'estado' => 1],
        ['code' => 'ECU', 'name' => 'ECUADOR', 'estado' => 1],
        ['code' => 'COL', 'name' => 'COLOMBIA', 'estado' => 1],
        ['code' => 'MEX', 'name' => 'MÉXICO', 'estado' => 1],
        ['code' => 'JPN', 'name' => 'JAPÓN', 'estado' => 1],
        ['code' => 'KOR', 'name' => 'COREA DEL SUR', 'estado' => 1],
        ['code' => 'CAN', 'name' => 'CANADÁ', 'estado' => 1],
        ['code' => 'AUS', 'name' => 'AUSTRALIA', 'estado' => 1],
        ['code' => 'SGP', 'name' => 'SINGAPUR', 'estado' => 1],
        ['code' => 'VNM', 'name' => 'VIETNAM', 'estado' => 1],
        ['code' => 'THA', 'name' => 'TAILANDIA', 'estado' => 1],
        ['code' => 'PAN', 'name' => 'PANAMÁ', 'estado' => 1],
        ['code' => 'ARG', 'name' => 'ARGENTINA', 'estado' => 1],
        ['code' => 'BOL', 'name' => 'BOLIVIA', 'estado' => 1],
        ['code' => 'DEU', 'name' => 'ALEMANIA', 'estado' => 1],
        ['code' => 'FRA', 'name' => 'FRANCIA', 'estado' => 1],
        ['code' => 'ITA', 'name' => 'ITALIA', 'estado' => 1],
        ['code' => 'ESP', 'name' => 'ESPAÑA', 'estado' => 1],
        ['code' => 'NLD', 'name' => 'PAÍSES BAJOS', 'estado' => 1],
        ['code' => 'BEL', 'name' => 'BÉLGICA', 'estado' => 1],
        ['code' => 'IND', 'name' => 'INDIA', 'estado' => 1],
        ['code' => 'ZAF', 'name' => 'SUDÁFRICA', 'estado' => 1],
        ['code' => 'MYS', 'name' => 'MALASIA', 'estado' => 1],
        ['code' => 'NZL', 'name' => 'NUEVA ZELANDA', 'estado' => 1],
        ['code' => 'RUS', 'name' => 'RUSIA', 'estado' => 1],
        ['code' => 'TUR', 'name' => 'TURQUÍA', 'estado' => 1],
        ['code' => 'ISR', 'name' => 'ISRAEL', 'estado' => 1],
        ['code' => 'PRT', 'name' => 'PORTUGAL', 'estado' => 1],
        ['code' => 'SWE', 'name' => 'SUECIA', 'estado' => 1],
        ['code' => 'FIN', 'name' => 'FINLANDIA', 'estado' => 1],
        ['code' => 'NOR', 'name' => 'NORUEGA', 'estado' => 1],
        ['code' => 'DNK', 'name' => 'DINAMARCA', 'estado' => 1],
        ['code' => 'AUT', 'name' => 'AUSTRIA', 'estado' => 1],
        ['code' => 'POL', 'name' => 'POLONIA', 'estado' => 1],
        ['code' => 'CZE', 'name' => 'REPUBLICA CHECA', 'estado' => 1],
        ['code' => 'EGY', 'name' => 'EGIPTO', 'estado' => 1],
        ['code' => 'DZA', 'name' => 'ARGELIA', 'estado' => 1],
        ['code' => 'MAR', 'name' => 'MARRUECOS', 'estado' => 1],
        ['code' => 'NGA', 'name' => 'NIGERIA', 'estado' => 1],
        ['code' => 'KEN', 'name' => 'KENIA', 'estado' => 1],
        ['code' => 'TUN', 'name' => 'TÚNEZ', 'estado' => 1],
        ['code' => 'GHA', 'name' => 'GHANA', 'estado' => 1],
        ['code' => 'CMR', 'name' => 'CAMERÚN', 'estado' => 1],
        ['code' => 'CIV', 'name' => 'COSTA DE MARFIL', 'estado' => 1],
        ['code' => 'SEN', 'name' => 'SENEGAL', 'estado' => 1]
    ];

    public $portId;
    public $openModal = false;
    public $port = [
        'code' => '',
        'name' => '',
        'country_code' => '',
        'location' => ''
    ];

    public function edit(Port $port)
    {
        $this->portId = $port->id;
        $this->port = $port->only(['code', 'name', 'country_code', 'location']);
        $this->openModal = true;
    }

    public function closeModal()
    {
        $this->reset('openModal', 'portId', 'port');
    }

    public function save()
    {
        $this->validate([
            'port.code' => [
                'required',
                'string',
                'min:3',
                'max:6',
                Rule::unique('ports', 'code')->ignore($this->portId)
            ],
            'port.name' => 'required|string|min:3',
            'port.country_code' => 'required|string|min:2|max:4'
        ], [], [
            'port.code' => 'Código de Puerto',
            'port.name' => 'Nombre de Puerto',
            'port.country_code' => 'Código de País'
        ]);

        Port::find($this->portId)->update($this->port);

        $this->reset('openModal', 'port', 'portId');
        $this->dispatch('swal', [
            'title' => 'Exito!',
            'text' => 'Puerto actualizado correctamente',
            'icon' => 'success'
        ]);
    }

    public function destroy(Port $port)
    {
        $port->delete();

        $this->dispatch('swal', [
            'title' => 'Exito!',
            'text' => 'Puerto eliminado correctamente',
            'icon' => 'success'
        ]);
    }
}
