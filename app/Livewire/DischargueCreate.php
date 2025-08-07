<?php

namespace App\Livewire;

use App\Imports\ContainerImport;
use App\Models\Dischargue;
use App\Models\Vessel;
use Illuminate\Support\Facades\DB as FacadesDB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class DischargueCreate extends Component
{
    use WithFileUploads;

    public $dischargue = [
        'shipping_line_id' => '',
        'vessel_id' => '',
        'eta_date' => '',
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

        FacadesDB::beginTransaction();
        try {
            $this->validate([
                'attach' => 'required|max:10240|mimes:xls,xlsx,csv',
                'dischargue.shipping_line_id' => 'required|numeric|exists:shipping_lines,id',
                'dischargue.vessel_id' => 'required|numeric|exists:vessels,id',
                'dischargue.eta_date' => 'required|date'
            ], [], [
                'attach' => 'Archivo excel de Descarga',
                'dischargue.shipping_line_id' => 'Linea Naviera',
                'dischargue.vessel_id' => 'Nave',
                'dischargue.eta_date' => 'Fecha ETA'
            ]);

            $newDischargue = Dischargue::create($this->dischargue);

            //Guardar archivo en disco
            $filePath = $this->attach->store('imports');

            //importo los contenedores
            Excel::import(new ContainerImport($newDischargue->id), $filePath);
            FacadesDB::commit();

            $this->reset('attach', 'dischargue', 'openModal');
            $this->dispatch('dischargueAdded');
            $this->dispatch('swal', [
                'title' => 'Exito!',
                'text' => 'Descarga subida con Exito!',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            FacadesDB::rollBack();
            $this->dispatch('swal', [
                'title' => 'Error!',
                'text' => 'Error durante la importación: ' . $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.dischargue-create');
    }
}
