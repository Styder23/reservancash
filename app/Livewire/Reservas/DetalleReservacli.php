<?php

namespace App\Livewire\Reservas;

use Livewire\Component;

class DetalleReservacli extends Component
{
    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.reservas.detalle-reservacli')->layout($layout);
    }
}