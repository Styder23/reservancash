<?php

namespace App\Livewire\Paquetes;

use Livewire\Component;
use App\Models\favoritos;
use App\Models\Paquetes as ModelPaquetes;
// use App\Models\DetallePaquetes;

use Illuminate\Support\Facades\Auth;

class Paquetes extends Component
{
    public $paquetes = [];
    public $paquetesContactados = [];


    public function mount()
    {

        $this->paquetes = ModelPaquetes::all();
        $this->paquetesContactados = session()->get('paquetesContactados', []);
    }

    public function render()
    {
        // Verificar si el usuario está autenticado
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.paquetes.paquetes')->layout($layout);
    }


    public function empresa()
    {
        return $this->belongsTo(\App\Models\Empresas::class, 'fk_idempresa');
    }

}