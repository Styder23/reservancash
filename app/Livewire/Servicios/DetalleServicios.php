<?php

namespace App\Livewire\Servicios;

use Livewire\Component;
use App\Models\Servicios;

class DetalleServicios extends Component
{
    
    public $servicio;
    public $servicioId;
    public $imagenPrincipal;
    public $serviciosRelacionados;

    public function mount($id)
    {
        $this->servicioId = $id;
        $this->servicio = Servicios::with([
            'Det_servicio', 
            'empresa', 
            'Det_servicio.imagenes',
            'Det_servicio.tiposervicio',
            'Det_servicio.imagenPrincipal'
        ])->findOrFail($id);

        // Cargar servicios relacionados (misma empresa, excluyendo el actual)
        $this->serviciosRelacionados = Servicios::with([
            'Det_servicio', 
            'Det_servicio.imagenPrincipal'
        ])
        ->where('fk_idempresa', $this->servicio->fk_idempresa)
        ->where('id', '!=', $this->servicio->id)
        ->limit(3)
        ->get();
    }

    public function render()
    {
        return view('livewire.servicios.detalle-servicios')->layout('layouts.guest');
    }
}