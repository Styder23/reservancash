<?php

namespace App\Livewire\Clientes;

use Livewire\Component;
use App\Models\Paquetes;

class Pantalladividida extends Component
{
    public $paqueteAId;
    public $paqueteBId;
    
    public $comparisonAttributes = [
        'destino' => 'Destino',
        'duracion' => 'Duración',
        'precio' => 'Precio',
        'empresa' => 'Empresa',
        'servicios' => 'Servicios incluidos'
    ];

    public function render()
    {
        $paquetes = Paquetes::with([
            'det_paquete.destino',
            'itinerarios',
            'ser_paquete.servicio.Det_servicio',
            'empresa',
            'det_paquete.promos'
        ])->get();

        $paqueteA = $this->paqueteAId ? Paquetes::with([
            'det_paquete.destino',
            'itinerarios',
            'ser_paquete.servicio.Det_servicio',
            'empresa',
            'det_paquete.promos'
        ])->find($this->paqueteAId) : null;

        $paqueteB = $this->paqueteBId ? Paquete::with([
            'det_paquete.destino',
            'itinerarios',
            'ser_paquete.servicio.Det_servicio',
            'empresa',
            'det_paquete.promos'
        ])->find($this->paqueteBId) : null;
        
        // Verificar si el usuario está autenticado
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.clientes.pantalladividida',[
            'paquetes' => $paquetes,
            'paqueteA' => $paqueteA,
            'paqueteB' => $paqueteB,
            'comparisonAttributes' => $this->comparisonAttributes
        ])->layout($layout);
    }
}