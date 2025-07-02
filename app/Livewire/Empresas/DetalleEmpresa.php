<?php

namespace App\Livewire\Empresas;

use Livewire\Component;
use App\Models\Empresas;

class DetalleEmpresa extends Component
{
    public $empresa;
    public $ultimos_paquetes;
    
    public function mount($id)
    {
        $this->empresa = Empresas::findOrFail($id);
        $this->ultimos_paquetes = $this->empresa->paquete()
            ->orderByDesc('id') // o 'created_at' si tienes timestamps
            ->take(6)
            ->get();
    }

    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.empresas.detalle-empresa')->layout($layout);
    }
}