<?php

namespace App\Livewire\Empresas;

use Livewire\Component;
use App\Models\Empresas as Modelempresa;

class Empresas extends Component
{
    public $empresas;
    public function mount(){
        $this->empresas=Modelempresa::all();
    }

    public function render()
    {
        $empresas = Modelempresa::with(['replegal.persona'])->get();
        
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.empresas.empresas')->layout($layout);
    }
}