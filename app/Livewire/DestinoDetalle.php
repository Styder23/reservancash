<?php

namespace App\Livewire;

use Livewire\Component;

class DestinoDetalle extends Component
{
    public function render()
    {
        return view('livewire.destinos.destino-detalle')->layout('layouts.layout');
    }
}