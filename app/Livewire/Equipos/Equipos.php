<?php

namespace App\Livewire\Equipos;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Equipos as EquiposModel;
use App\Models\Detalle_Equipo;

class Equipos extends Component
{
    public $equipos =[];

    public function mount(){
        $this->equipos=Detalle_Equipo::all();
    }

    public function render()
    {
        return view('livewire.equipos.equipos')->layout('layouts.guest');
    }
}