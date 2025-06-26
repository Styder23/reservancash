<?php

namespace App\Livewire\Paquetes;

use Livewire\Component;


use App\Models\Paquetes as ModelPaquetes;

class Paquetes extends Component
{
    public $paquetes=[];
    
    public function mount(){
        
        $this->paquetes = ModelPaquetes::all();
    }

    public function render()
    {
        // Verificar si el usuario está autenticado
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.paquetes.paquetes')->layout($layout);
    }
}