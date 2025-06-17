<?php

namespace App\Livewire;

use Livewire\Component;

class Destinos extends Component
{
    public function render()
    {
        $layout = auth()->check() ? 'layouts.app' : 'layouts.layout';

        return view('livewire.destinos.destinos')->layout($layout);
    }
}