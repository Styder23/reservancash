<?php

namespace App\Livewire\Paquetes;

use Livewire\Component;


use App\Models\Paquetes as ModelPaquetes;

class Paquetes extends Component
{
    public $paquetes=[];
    
    public function mount(){
        
        $this->paquetes=ModelPaquetes::all();
    }

    public function render()
    {
        return view('livewire.paquetes.paquetes')->layout('layouts.guest');
    }
}