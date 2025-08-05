<?php

namespace App\Livewire;

use App\Models\Vessel;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class DischargueCreate extends Component
{
    use WithFileUploads;

    public $dischargue = [
        'shipping_line' => '',
        'vessel' => '',
        'eta' => '',
        'week' => ''
    ];

    public $vessels = [];
    public $openModal = false;

    public $attach = null;

    /*  public function updated($propertyName)
    {
        if ($propertyName === 'dischargue.shipping_line') {
            $this->vessels = Vessel::where('shipping_line_id', $this->dischargue['shipping_line'])->get()->toArray();
        }
    } */
    #[On('vesselExternAdded')]
    public function updatedDischargueShippingLine($value)
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
        dd($this->attach);
    }
    public function render()
    {
        return view('livewire.dischargue-create');
    }
}
