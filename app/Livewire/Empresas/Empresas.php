<?php

namespace App\Livewire\Empresas;

use Livewire\Component;

class Empresas extends Component
{
    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.empresas.empresas')->layout($layout);
    }
}