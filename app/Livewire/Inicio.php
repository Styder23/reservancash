<?php

namespace App\Livewire;

use Livewire\Component;

class Inicio extends Component
{
    public function render()
    {
        return view('livewire.inicio')->layout('layouts.guest');
    }

    public $destinos = [];
    public $servicios = [];
    public $detalle_paquetes = [];



    // Funcion para mostrar los destinos
    public function mount()
    {
        $this->destinos = \App\Models\Destinos::all(); 
        $this->servicios = \App\Models\Servicios::all();
        $this->detalle_paquetes = \App\Models\DetallePaquetes::all(); 

    }
}
