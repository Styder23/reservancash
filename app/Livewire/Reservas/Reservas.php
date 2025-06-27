<?php

namespace App\Livewire\Reservas;

use Livewire\Component;

class Reservas extends Component
{
    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.reservas.reservas')->layout($layout);
    }
}