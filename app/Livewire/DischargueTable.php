<?php

namespace App\Livewire;

use App\Models\Container;
use App\Models\Vessel;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Dischargue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class DischargueTable extends DataTableComponent
{
    protected $model = Dischargue::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setConfigurableAreas([
            'after-wrapper' => ['dischargues.dischargue']
        ]);
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

    public function filters(): array
    {
        return [
            DateRangeFilter::make('Fecha ETA')
                ->config([
                    'altFormat' => 'F j, Y', // Date format that will be displayed once selected
                    'ariaDateFormat' => 'F j, Y', // An aria-friendly date format
                    'dateFormat' => 'Y-m-d', // Date format that will be received by the filter
                    'placeholder' => 'Introduzca el rango de fechas', // A placeholder value
                    'locale' => 'en',
                ])
                ->filter(function (Builder $builder, array $dateRange) {
                    $builder
                        ->whereDate('eta_date', '>=', $dateRange['minDate'])
                        ->whereDate('eta_date', '<=', $dateRange['maxDate']);
                })
        ];
    }

    public $dischargueId;

    public $vessels = [];


    public $openModal = false;
    public $dischargue = [
        'shipping_line_id' => '',
        'vessel_id' => '',
        'bl_number' => '',
        'eta_date' => '',
        'week' => ''
    ];

    public function edit(Dischargue $dischargue)
    {
        $this->dischargueId = $dischargue->id;
        $this->dischargue = $dischargue->only([
            'shipping_line_id',
            'vessel_id',
            'bl_number',
            'eta_date',
            'week',
        ]);

        $this->dischargue['eta_date'] = Carbon::createFromFormat('d/m/Y', $this->dischargue['eta_date'])->format('Y-m-d');
        $this->vessels = Vessel::where('shipping_line_id', $this->dischargue['shipping_line_id'])
            ->get()
            ->toArray();

        $this->openModal = true;
    }

    #[On('vesselExternAdded')]
    public function updatedDischargueShippingLineId($value)
    {
        // Resetear el vessel seleccionado
        $this->dischargue['vessel'] = '';

        // Cargar las naves de la nueva línea naviera
        if (!empty($value)) {
            $this->vessels = Vessel::where('shipping_line_id', $value)
                ->get()
                ->toArray();
        } else {
            $this->vessels = [];
        }
    }

    public function save()
    {

        $this->validate([
            'dischargue.shipping_line_id' => 'required|numeric|exists:shipping_lines,id',
            'dischargue.vessel_id' => 'required|numeric|exists:vessels,id',
            'dischargue.eta_date' => 'required|date',
            'dischargue.bl_number' => 'nullable|string|min:5'
        ], [], [
            'dischargue.shipping_line_id' => 'Linea Naviera',
            'dischargue.vessel_id' => 'Nave',
            'dischargue.eta_date' => 'Fecha ETA',
            'dischargue.bl_number' => 'Número de BL'
        ]);

        $dischargue = Dischargue::find($this->dischargueId);
        $dischargue->update($this->dischargue);


        $this->reset('dischargueId', 'dischargue', 'openModal');
        $this->dispatch('swal', [
            'title' => 'Exito!',
            'text' => 'Descarga actualizada con Exito!',
            'icon' => 'success'
        ]);
    }

    public function destroy(Dischargue $dischargue)
    {
        //actualizo a estado 0 todos los contenedores
        $containers = Container::where('origin_id', $dischargue->id)
            ->where('origin_type', "App\Models\Dischargue");
        $containers->update([
            'status' => 0
        ]);

        $dischargue->delete();

        $this->dispatch('swal', [
            'title' => 'Exito!',
            'text' => 'Anuncio de Descarga anulado',
            'icon' => 'success'
        ]);
    }
}
