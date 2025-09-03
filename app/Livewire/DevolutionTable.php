<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\CustomBroker;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Devolution;
use App\Models\ShippingLine;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class DevolutionTable extends DataTableComponent
{
    protected $model = Devolution::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setConfigurableAreas([
            'after-wrapper' => ['devolutions.devolution']
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->deselected(),
            Column::make('Acciones')
                ->label(function ($row) {
                    return view('devolutions.actions', ['devolution' => $row]);
                }),
            Column::make("Fecha Retorno", "returnedDate")
                ->sortable(),
            Column::make("Cliente", "client.rznSocial")
                ->sortable(),
            Column::make("Agente", "broker.rznSocial")
                ->sortable(),
            Column::make("BL", "bl_number")
                ->sortable(),
            Column::make("Memo", "memo_number")
                ->sortable(),
            Column::make("Linea", "shippingLine.name")
                ->sortable(),
            Column::make("Nave", "vessel.name")
                ->sortable(),
            Column::make("Viaje", "voyage")
                ->sortable(),
            Column::make("Sucursal", "branch.name")
                ->sortable(),
            Column::make("Creado Por", "created_by")
                ->sortable(),
            Column::make("Anulado Por", "anulated_by")
                ->sortable()
        ];
    }

    public function builder(): Builder
    {
        return Devolution::with(['client', 'shippingLine', 'vessel', 'creator', 'branch','broker'])
            ->where('devolutions.branch_id', session('branch')->id);
    }

    public function filters(): array
    {
        return [
            DateRangeFilter::make('Fecha Return')
                ->config([
                    'altFormat' => 'F j, Y', // Date format that will be displayed once selected
                    'ariaDateFormat' => 'F j, Y', // An aria-friendly date format
                    'dateFormat' => 'Y-m-d', // Date format that will be received by the filter
                    'placeholder' => 'Introduzca el rango de fechas', // A placeholder value
                    'locale' => 'en',
                ])
                ->filter(function (Builder $builder, array $dateRange) {
                    $builder
                        ->whereDate('returned_at', '>=', $dateRange['minDate'])
                        ->whereDate('returned_at', '<=', $dateRange['maxDate']);
                }),
            SelectFilter::make('Cliente')
                ->options(
                    ['' => 'Todos'] + Client::query()
                        ->whereHas('devolutions', function ($query) {
                            $query->where('devolutions.branch_id', session('branch')->id);
                        })
                        ->pluck('rznSocial', 'id')
                        ->toArray()
                )
                ->filter(function ($query, $value) {
                    if ($value) {
                        $query->whereHas('client', function ($q) use ($value) {
                            $q->where('id', $value);
                        });
                    }
                }),
            SelectFilter::make('Agente')
                ->options(
                    ['' => 'Todos'] + CustomBroker::query()
                        ->whereHas('devolutions', function ($query) {
                            $query->where('devolutions.branch_id', session('branch')->id);
                        })
                        ->pluck('rznSocial', 'id')
                        ->toArray()
                )
                ->filter(function ($query, $value) {
                    if ($value) {
                        $query->whereHas('broker', function ($q) use ($value) {
                            $q->where('id', $value);
                        });
                    }
                }),
            SelectFilter::make('Linea')
                ->options(
                    ['' => 'Todas'] + ShippingLine::query()
                        ->whereHas('devolutions', function ($query) {
                            $query->where('devolutions.branch_id', session('branch')->id);
                        })
                        ->pluck('name', 'id')
                        ->toArray()
                )
                ->filter(function ($query, $value) {
                    if ($value) {
                        $query->whereHas('shippingLine', function ($q) use ($value) {
                            $q->where('id', $value);
                        });
                    }
                })
        ];
    }
}
