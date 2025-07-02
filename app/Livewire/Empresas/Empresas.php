<?php

namespace App\Livewire\Empresas;

use Livewire\Component;

class Empresas extends Component
{
    public $empresas = [];

    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.empresas.empresas')->layout($layout);
    }

    public function mount()
    {
        $this->empresas = \App\Models\Empresas::all();
    }
}
