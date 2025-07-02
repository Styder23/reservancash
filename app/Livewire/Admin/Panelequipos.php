<?php

namespace App\Livewire\Admin;

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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;

class Panelequipos extends Component
{
    use WithFileUploads;

    public $equipos;
    public $categorias, $marcas, $modelos, $series, $tipos;
    public $modal = false;
    public $modoEditar = false;
    public $imagenTemporal;
    public $empresaId;
    
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

    public $searchQuery1 = '';
    public $equipoAEliminar = null;
    public $modalConfirmacion = false;

    //para las imagenes adicionales
    public $imagenesAdicionales = [];
    public $imagenesExistentes = [];

    public function mount()
    {
        // Obtener la empresa del usuario autenticado
        $this->obtenerEmpresaUsuario();
        $this->cargarEquipos();
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        $this->modelos = Modelo::all();
        $this->series = Serie::all();
        $this->tipos = TipoEquipo::all();
    }
    
    public function obtenerEmpresaUsuario()
    {
        $userId = auth()->id();
        $empresa = DB::table('users')
            ->join('personas', 'personas.id', '=', 'users.fk_idpersona')
            ->join('representante_legal', 'representante_legal.fk_idpersona', '=', 'personas.id')
            ->join('empresas', 'empresas.id', '=', 'representante_legal.fk_idempresa')
            ->where('users.id', $userId)
            ->select('empresas.id', 'empresas.nameempresa')
            ->first();

        if (!$empresa) {
            session()->flash('error', 'No se encontró la empresa asociada a este usuario');
            $this->empresaId = null;
            return;
        }

        $this->empresaId = $empresa->id;
    }

    public function cargarEquipos()
    {
        // Si no hay empresa asociada, no cargar equipos
        if (!$this->empresaId) {
            $this->equipos = collect();
            return;
        }

        $this->equipos = Equipos::with(['Det_equipo.categoria', 'Det_equipo.marca', 'Det_equipo.modelo', 'Det_equipo.serie', 'Det_equipo.tipoequipo', 'empresa'])
            ->where('fk_idempresa', $this->empresaId) // Filtrar por empresa
            ->when($this->searchQuery1, function ($query) {
                $query->whereHas('Det_equipo', function($q) {
                    $q->where('name_equipo', 'like', '%' . $this->searchQuery1 . '%')
                    ->orWhere('descripcion_equipo', 'like', '%' . $this->searchQuery1 . '%')
                    ->orWhereHas('categoria', function($subQ) {
                        $subQ->where('namecategorias', 'like', '%' . $this->searchQuery1 . '%');
                    })
                    ->orWhereHas('marca', function($subQ) {
                        $subQ->where('namemarcas', 'like', '%' . $this->searchQuery1 . '%');
                    })
                    ->orWhereHas('modelo', function($subQ) {
                        $subQ->where('namemodelos', 'like', '%' . $this->searchQuery1 . '%');
                    })
                    ->orWhereHas('serie', function($subQ) {
                        $subQ->where('nameserie', 'like', '%' . $this->searchQuery1 . '%');
                    })
                    ->orWhereHas('tipoequipo', function($subQ) {
                        $subQ->where('nametipoequipos', 'like', '%' . $this->searchQuery1 . '%');
                    });
                });
            })
            ->orderBy('id', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.panelequipos', [
            'equipos' => $this->equipos
        ])->layout('layouts.prueba');
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
        // Obtener el ID del usuario autenticado y la empresa (como ya lo tienes)
        $userId = auth()->id();
        $empresa = DB::table('users')
            ->join('personas', 'personas.id', '=', 'users.fk_idpersona')
            ->join('representante_legal', 'representante_legal.fk_idpersona', '=', 'personas.id')
            ->join('empresas', 'empresas.id', '=', 'representante_legal.fk_idempresa')
            ->where('users.id', $userId)
            ->select('empresas.id', 'empresas.nameempresa')
            ->first();

        if (!$empresa) {
            session()->flash('error', 'No se encontró la empresa asociada a este usuario');
            return;
        }
        
        $this->validate([
            'form.name_equipo' => 'required',
            'form.precio_equipo' => 'required|numeric',
            'form.fk_idcategoria' => 'required',
            'form.fk_idtipoequipo' => 'required',
            'form.cantidadequipo' => 'required|integer|min:1',
            'form.imagenes_equipo' => 'nullable|image|max:2048',
            'imagenesAdicionales.*' => 'image|max:2048',
        ]);

        // MOVER ESTE BLOQUE ANTES DE CREAR EL EQUIPO
        $ruta = null;
        if ($this->form['imagenes_equipo']) {
            $ruta = $this->form['imagenes_equipo']->store('equipos', 'public');
        }

        $equipo = Detalle_Equipo::create([
            'name_equipo' => $this->form['name_equipo'],
            'descripcion_equipo' => $this->form['descripcion_equipo'],
            'precio_equipo' => $this->form['precio_equipo'],
            'imagenes_equipo' => $ruta, // Ahora $ruta ya está definida
            'fk_idcategoria' => $this->form['fk_idcategoria'],
            'fk_idserie' => $this->form['fk_idserie'],
            'fk_idmarca' => $this->form['fk_idmarca'],
            'fk_idmodelo' => $this->form['fk_idmodelo'],
            'fk_idtipoequipo' => $this->form['fk_idtipoequipo'],
        ]);
        
        if ($ruta) {
            // Guardar también en la tabla imagenes
            $equipo->imagenes()->create([
                'url' => $ruta,
                'tipo' => 'principal'
            ]);
        }

        // Guardar imágenes adicionales
        if ($this->imagenesAdicionales) {
            foreach ($this->imagenesAdicionales as $imagen) {
                $rutaAdicional = $imagen->store('equipos/adicionales', 'public');
                $equipo->imagenes()->create([
                    'url' => $rutaAdicional,
                    'tipo' => 'adicional'
                ]);
            }
        }

        Equipos::create([
            'fk_iddetalle_equipo' => $equipo->id, 
            'cantidadequipo' => $this->form['cantidadequipo'],
            'fk_idempresa' => $empresa->id,
        ]);

        $this->cerrarModal();
        $this->equipos = Equipos::with('Det_equipo', 'Det_equipo.categoria')->get();
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
        
        $this->imagenesExistentes = $equipoDetalle->Det_equipo->imagenes->where('tipo', 'adicional');
    }

    public function actualizar()
    {
        $equipo = Detalle_Equipo::findOrFail($this->form['id']);

        if ($this->form['imagenes_equipo']) {
            $ruta = $this->form['imagenes_equipo']->store('equipos', 'public');
            $equipo->imagenes_equipo = $ruta;
            
            // Eliminar imagen principal anterior de la tabla imagenes si existe
            $equipo->imagenes()->where('tipo', 'principal')->delete();
            
            // Guardar nueva imagen principal en tabla imagenes
            $equipo->imagenes()->create([
                'url' => $ruta,
                'tipo' => 'principal'
            ]);
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

        // Guardar imágenes adicionales nuevas
        if ($this->imagenesAdicionales) {
            foreach ($this->imagenesAdicionales as $imagen) {
                $rutaAdicional = $imagen->store('equipos/adicionales', 'public');
                $equipo->imagenes()->create([
                    'url' => $rutaAdicional,
                    'tipo' => 'adicional'
                ]);
            }
        }
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
        $this->equipoAEliminar = $id;
        $this->modalConfirmacion = true;
    }

    public function confirmarEliminar()
    {
        $equipo = Equipos::findOrFail($this->equipoAEliminar);
        
        // Eliminar imágenes asociadas
        if ($equipo->Det_equipo) {
            // Eliminar archivos físicos
            foreach ($equipo->Det_equipo->imagenes as $imagen) {
                Storage::disk('public')->delete($imagen->url);
            }
            // Eliminar registros de imágenes
            $equipo->Det_equipo->imagenes()->delete();
            
            // Eliminar el detalle
            $equipo->Det_equipo()->delete();
        }
        
        $equipo->delete();

        $this->modalConfirmacion = false;
        $this->equipoAEliminar = null;
        session()->flash('message', 'Equipo eliminado correctamente.');
    }

    public function cancelarEliminar()
    {
        $this->modalConfirmacion = false;
        $this->equipoAEliminar = null;
    }
    
    // Método para eliminar imágenes adicionales
    public function removeImagenAdicional($index)
    {
        unset($this->imagenesAdicionales[$index]);
        $this->imagenesAdicionales = array_values($this->imagenesAdicionales);
    }

    // Método para eliminar imágenes existentes
    public function eliminarImagen($id)
    {
        $imagen = imagenes::find($id);
        if ($imagen) {
            // Eliminar el archivo físico
            Storage::disk('public')->delete($imagen->url);
            // Eliminar el registro
            $imagen->delete();
            // Actualizar la lista de imágenes
            $this->imagenesExistentes = $this->imagenesExistentes->filter(fn($img) => $img->id != $id);
        }
    }

}