<?php

namespace App\Livewire;

use Livewire\Component;

class Inicio extends Component
{
    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.inicio')->layout($layout);
    }
}