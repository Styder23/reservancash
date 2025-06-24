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
        return view('livewire.promociones.promociones')->layout('layouts.guest');
    }
}