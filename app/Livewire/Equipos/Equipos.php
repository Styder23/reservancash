<?php

namespace App\Livewire\Equipos;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Equipos as EquiposModel;

class Equipos extends Component
{
    public $equipos =[];

    public function render()
    {
        return view('livewire.equipos.equipos',[
            'equipos' => EquiposModel::latest()->paginate(9),
        ])->layout('layouts.layout');
    }
}