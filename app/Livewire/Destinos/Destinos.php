<?php

namespace App\Livewire\Destinos;

use Livewire\Component;

class Destinos extends Component
{
    public function render()
    {
        // Verificar si el usuario está autenticado
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        
        return view('livewire.destinos.destinos')->layout($layout);
    }
}