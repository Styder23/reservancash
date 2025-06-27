<?php

namespace App\Livewire\Promociones;

use Livewire\Component;

use App\Models\Promociones as ModelPromociones;

class Promociones extends Component
{
    public $promociones=[];
    
    public function mount(){
        $this->promociones=ModelPromociones::all();
    }

    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.promociones.promociones')->layout($layout);
    }
}