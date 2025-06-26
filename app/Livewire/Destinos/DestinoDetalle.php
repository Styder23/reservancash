<?php

namespace App\Livewire\Destinos;

use Livewire\Component;

class DestinoDetalle extends Component
{
    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.destinos.destino-detalle')->layout($layout);
    }
}