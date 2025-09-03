<?php

namespace App\Livewire;

use App\Models\Vessel;
use Livewire\Attributes\On;
use Livewire\Component;

class DevolutionCreate extends Component
{
        public $devolution = [
        'shipping_line_id' => '',
        'vessel_id' => '',
        'client_id' => '',
        'custom_broker_id' => '',
        'bl_number' => '',
        'eta_date' => '',
        'week' => '',
        'voyage' => '',
        'manifiest_number' => ''
    ];

    public $vessels = [];
    public $openModal = false;

    public $attach = null;

    /*  public function updated($propertyName)
    {
        if ($propertyName === 'devolution.shipping_line') {
            $this->vessels = Vessel::where('shipping_line_id', $this->devolution['shipping_line'])->get()->toArray();
        }
    } */
    #[On('vesselExternAdded')]
    public function updateddevolutionShippingLineId($value)
    {
        // Resetear el vessel seleccionado
        $this->devolution['vessel'] = '';

        // Cargar las naves de la nueva línea naviera
        if (!empty($value)) {
            $this->vessels = Vessel::where('shipping_line_id', $value)
                ->get()
                ->toArray();
        } else {
            $this->vessels = [];
        }
    }

    public function render()
    {
        return view('livewire.devolution-create');
    }
}
