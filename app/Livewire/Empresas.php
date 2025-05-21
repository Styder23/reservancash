<?php

namespace App\Livewire;

use Livewire\Component;

class Empresas extends Component
{
    public function render()
    {
        return view('livewire.empresas')->layout('layouts.layout');
    }
}