<?php

namespace App\Livewire\Masters;

use App\Models\ReeferTechnology;
use Livewire\Component;

class TechnologyCreate extends Component
{
    public $openModal = false;
     public $technology = [
        'code' => '',
        'name' => ''
    ];

     public function save()
    {
        $this->validate([
            'technology.code' => [
                'required',
                'string',
                'min:2',
                 'unique:reefer_technologies,code'
            ],
            'technology.name' => 'required|string|min:4'
        ], [], [
            'technology.code' => 'Código de Tecnologia Reefer',
            'technology.name' => 'Nombre de Tecnologia Reefer'
        ]);

        ReeferTechnology::create($this->technology);

        $this->reset('openModal', 'technology');
        $this->dispatch('technologyAdded');
        $this->dispatch('swal', [
            'title' => 'Exito!',
            'text' => 'Tecnología Reefer creada correctamente',
            'icon' => 'success'
        ]);
    }
    public function render()
    {
        return view('livewire.masters.technology-create');
    }
}
