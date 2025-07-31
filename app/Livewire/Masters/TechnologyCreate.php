<?php

namespace App\Livewire\Masters;

use App\Models\ReeferTechnology;
use Livewire\Component;

class TechnologyCreate extends Component
{
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

    public function save()
    {
        $this->validate([
            'technology.name' => 'required|string|min:3|unique:reefer_technologies,name',
            'technology.description' => 'string|min:3',
            'technology.usage' => 'string|min:4'
        ], [], [
            'technology.name' => 'Nombre de tecnología',
            'technology.description' => 'Descripción de tecnología',
            'technology.usage' => 'Descripción de Uso o aplicación de tecnología'
        ]);

        ReeferTechnology::create($this->technology);

        $this->reset('technology', 'openModal');
        $this->dispatch('technologyAdded');
        $this->dispatch('swal', [
            'title' => 'Exito!',
            'text' => 'tecnología de Contenedor creada correctamente',
            'icon' => 'success'
        ]);
    }
    public function render()
    {
        return view('livewire.masters.technology-create');
    }
}
