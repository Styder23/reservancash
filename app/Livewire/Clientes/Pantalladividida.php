<?php

namespace App\Livewire\Clientes;

use Livewire\Component;

class Pantalladividida extends Component
{
    public function render()
    {
        // Verificar si el usuario está autenticado
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.clientes.pantalladividida')->layout($layout);
    }
}