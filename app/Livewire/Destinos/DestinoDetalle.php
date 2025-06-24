<?php

namespace App\Livewire\Destinos;

use Livewire\Component;

class DestinoDetalle extends Component
{
    public function render()
    {
        return view('livewire.destinos.destino-detalle')->layout('layouts.guest');
    }
}