<?php

namespace App\Livewire\Equipos;

use Livewire\Component;
use App\Models\Equipos;
use App\Models\EquipoDetalle;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Serie;
use App\Models\TipoEquipo;
use App\Models\Detalle_Equipo;
use Livewire\WithFileUploads;

class DetalleEquipos extends Component
{
    public $equipo;
    public $equipoId;
    public $imagenPrincipal;
    public $equiposRelacionados;

    public function mount($id)
    {
        $this->equipoId = $id;
        $this->equipo = Equipos::with([
            'Det_equipo', 
            'empresa', 
            'Det_equipo.imagenes',
            'Det_equipo.marca',
            'Det_equipo.modelo',
            'Det_equipo.serie',
            'Det_equipo.categoria',
            'Det_equipo.tipoequipo'
        ])->findOrFail($id);

        // Establecer imagen principal inicial
        $this->imagenPrincipal = $this->equipo->Det_equipo->imagenes->first()->url ?? null;

        // Cargar equipos relacionados (misma empresa y misma categoría, excluyendo el actual)
        $this->equiposRelacionados = Equipos::with([
            'Det_equipo', 
            'Det_equipo.imagenes'
        ])
        ->where('fk_idempresa', $this->equipo->fk_idempresa)
        ->whereHas('Det_equipo', function($query) {
            $query->where('fk_idcategoria', $this->equipo->Det_equipo->fk_idcategoria);
        })
        ->where('id', '!=', $this->equipo->id)
        ->limit(3)
        ->get();
    }

    public function cambiarImagen($urlImagen)
    {
        $this->imagenPrincipal = $urlImagen;
    }
    public function render()
    {
        return view('livewire.equipos.detalle-equipos')->layout('layouts.guest');
    }
}