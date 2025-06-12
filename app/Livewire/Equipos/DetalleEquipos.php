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
    use WithFileUploads;

    public $equipos;
    public $categorias, $marcas, $modelos, $series, $tipos;
    public $modal = false;
    public $modoEditar = false;
    public $imagenTemporal;

    public $form = [
        'id' => null,
        'name_equipo' => '',
        'descripcion_equipo' => '',
        'precio_equipo' => '',
        'imagenes_equipo' => null,
        'fk_idcategoria' => '',
        'fk_idserie' => '',
        'fk_idmarca' => '',
        'fk_idmodelo' => '',
        'fk_idtipoequipo' => '',
        'cantidadequipo' => 1,
    ];

    public function mount()
    {
        $this->equipos = Equipos::with('Det_equipo', 'Det_equipo.categoria')->get(); // Cambiar 'detalle' por 'Det_equipo'
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        $this->modelos = Modelo::all();
        $this->series = Serie::all();
        $this->tipos = TipoEquipo::all();
    }
    
    public function render()
    {
        return view('livewire.equipos.detalle-equipos')->layout('layouts.layout');
    }

        public function abrirModalCrear()
    {
        $this->resetForm();
        $this->modal = true;
        $this->modoEditar = false;
    }

    public function cerrarModal()
    {
        $this->modal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->form = [
            'id' => null,
            'name_equipo' => '',
            'descripcion_equipo' => '',
            'precio_equipo' => '',
            'imagenes_equipo' => null,
            'fk_idcategoria' => '',
            'fk_idserie' => '',
            'fk_idmarca' => '',
            'fk_idmodelo' => '',
            'fk_idtipoequipo' => '',
            'cantidadequipo' => 1,
        ];
        $this->imagenTemporal = null;
    }

    public function guardar()
    {
        $this->validate([
            'form.name_equipo' => 'required',
            'form.precio_equipo' => 'required|numeric',
            'form.fk_idcategoria' => 'required',
            'form.fk_idtipoequipo' => 'required',
            'form.cantidadequipo' => 'required|integer|min:1',
            'form.imagenes_equipo' => 'nullable|image|max:2048'
        ]);

        $ruta = null;
        if ($this->form['imagenes_equipo']) {
            $ruta = $this->form['imagenes_equipo']->store('equipos', 'public');
        }

        $equipo = Detalle_Equipo::create([
            'name_equipo' => $this->form['name_equipo'],
            'descripcion_equipo' => $this->form['descripcion_equipo'],
            'precio_equipo' => $this->form['precio_equipo'],
            'imagenes_equipo' => $ruta, // Cambiar 'imagen' por 'imagenes_equipo'
            'fk_idcategoria' => $this->form['fk_idcategoria'],
            'fk_idserie' => $this->form['fk_idserie'],
            'fk_idmarca' => $this->form['fk_idmarca'],
            'fk_idmodelo' => $this->form['fk_idmodelo'],
            'fk_idtipoequipo' => $this->form['fk_idtipoequipo'],
        ]);

        Equipos::create([
            'fk_iddetalle_equipo' => $equipo->id, // Cambiar 'fk_idequipo' por 'fk_iddetalle_equipo'
            'cantidadequipo' => $this->form['cantidadequipo'],
        ]);

        $this->cerrarModal();
        $this->equipos = Equipos::with('Det_equipo', 'Det_equipo.categoria')->get(); // Cambiar relaciones
        session()->flash('message', 'Equipo creado correctamente.');
    }

    public function editar($id)
    {
        $this->modoEditar = true;
        $this->modal = true;

        $equipoDetalle = Equipos::with('Det_equipo')->findOrFail($id); // Buscar en Equipos, no en Detalle_Equipo

        $this->form = [
            'id' => $equipoDetalle->Det_equipo->id, // Usar Det_equipo
            'name_equipo' => $equipoDetalle->Det_equipo->name_equipo,
            'descripcion_equipo' => $equipoDetalle->Det_equipo->descripcion_equipo,
            'precio_equipo' => $equipoDetalle->Det_equipo->precio_equipo,
            'imagenes_equipo' => null,
            'fk_idcategoria' => $equipoDetalle->Det_equipo->fk_idcategoria,
            'fk_idserie' => $equipoDetalle->Det_equipo->fk_idserie,
            'fk_idmarca' => $equipoDetalle->Det_equipo->fk_idmarca,
            'fk_idmodelo' => $equipoDetalle->Det_equipo->fk_idmodelo,
            'fk_idtipoequipo' => $equipoDetalle->Det_equipo->fk_idtipoequipo,
            'cantidadequipo' => $equipoDetalle->cantidadequipo, // Directamente desde equipoDetalle
        ];
    }

    public function actualizar()
    {
        $equipo = Detalle_Equipo::findOrFail($this->form['id']);

        if ($this->form['imagenes_equipo']) {
            $ruta = $this->form['imagenes_equipo']->store('equipos', 'public');
            $equipo->imagenes_equipo = $ruta; // Cambiar 'imagen' por 'imagenes_equipo'
        }

        $equipo->update([
            'name_equipo' => $this->form['name_equipo'],
            'descripcion_equipo' => $this->form['descripcion_equipo'],
            'precio_equipo' => $this->form['precio_equipo'],
            'fk_idcategoria' => $this->form['fk_idcategoria'],
            'fk_idserie' => $this->form['fk_idserie'],
            'fk_idmarca' => $this->form['fk_idmarca'],
            'fk_idmodelo' => $this->form['fk_idmodelo'],
            'fk_idtipoequipo' => $this->form['fk_idtipoequipo'],
        ]);

        // Actualizar o crear detalle
        Equipos::updateOrCreate(
            ['fk_iddetalle_equipo' => $equipo->id], // Cambiar 'fk_idequipo' por 'fk_iddetalle_equipo'
            ['cantidadequipo' => $this->form['cantidadequipo']]
        );

        $this->cerrarModal();
        $this->equipos = Equipos::with('Det_equipo', 'Det_equipo.categoria')->get(); // Cambiar relaciones
        session()->flash('message', 'Equipo actualizado correctamente.');
    }

    public function eliminar($id)
    {
        $equipo = Equipos::findOrFail($id);
        $equipo->Det_equipo()->delete(); // Cambiar 'detalle' por 'Det_equipo'
        $equipo->delete();

        $this->equipos = Equipos::with('Det_equipo', 'Det_equipo.categoria')->get(); // Cambiar relaciones
        session()->flash('message', 'Equipo eliminado.');
    }
}