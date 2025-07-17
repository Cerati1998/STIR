<?php

namespace App\Livewire;

use Livewire\Component;

class DamageCreate extends Component
{

       public $openModal = false;

    public $damageCreate = [
        'code' => '-',
        'description' => null,
    ];
    public function render()
    {
        return view('livewire.damage-create');
    }
}
