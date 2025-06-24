<?php

namespace App\Livewire\Servicios;

use Livewire\Component;
use App\Models\Servicios as ServiciosModel;
use App\Models\Detalle_Servicio;

class Servicios extends Component
{
    public $servicios =[];

    public function mount(){
        $this->servicios=Detalle_Servicio::all();
        
    }

    public function render()
    {
        return view('livewire.servicios.servicios')->layout('layouts.guest');
    }
}