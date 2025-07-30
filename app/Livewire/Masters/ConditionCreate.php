<?php

namespace App\Livewire\Masters;

use App\Models\ReeferCondition;
use Livewire\Component;

class ConditionCreate extends Component
{
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

    public function save()
    {
        $this->validate([
            'condition.name' => 'required|string|min:3|unique:reefer_conditions,name',
            'condition.description' => 'string|min:3',
            'condition.usage' => 'string|min:4'
        ], [], [
            'condition.name' => 'Nombre de Condición',
            'condition.description' => 'Descripción de Condición',
            'condition.usage' => 'Descripción de Uso o aplicación de Condición'
        ]);

        ReeferCondition::create($this->condition);

        $this->reset('condition', 'openModal');
        $this->dispatch('conditionAdded');
        $this->dispatch('swal', [
            'title' => 'Exito!',
            'text' => 'Condición de Contenedor creada correctamente',
            'icon' => 'success'
        ]);
    }
    public function render()
    {
        return view('livewire.masters.condition-create');
    }
}
