<?php

namespace App\Livewire\Empresas;

use Livewire\Component;
use App\Models\Empresas as Modelempresa;

class Empresas extends Component
{
    public $empresas = [];

    public function render()
    {
        $empresas = Modelempresa::with(['replegal.persona'])->get();
        
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.empresas.empresas')->layout($layout);
    }

    public function mount()
    {
        $this->empresas = \App\Models\Empresas::all();
    }
}