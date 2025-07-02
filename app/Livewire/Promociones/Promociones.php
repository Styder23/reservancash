<?php

namespace App\Livewire\Promociones;

use Livewire\Component;

use App\Models\Promociones as ModelPromociones;

class Promociones extends Component
{
    public $promociones = [];
    public $paquetes = [];
    public $paquetesContactados = [];

    public function mount()
    {
        $this->promociones = ModelPromociones::all();
        $this->paquetes = ModelPromociones::all();
        $this->paquetesContactados = session()->get('paquetesContactados', []);

        // Solo paquetes que tengan detalles con promoción y descuento
        $this->paquetes = \App\Models\Paquetes::whereHas('detalles', function ($q) {
            $q->whereNotNull('fk_idpromociones');
        })
            ->with(['detalles.promocion'])
            ->get();
    }

    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.promociones.promociones')->layout($layout);
    }
}
