<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\TipoServicios;
use App\Models\Servicios;
use App\Models\Detalle_Servicio;
use Livewire\WithFileUploads;
use App\Models\imagenes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Panelservicios extends Component
{
    use WithFileUploads;

    public $servicios;
    public $modal = false;
    public $modoEditar = false;
    public $modalConfirmacion = false;
    public $servicioAEliminar = null;
    public $empresaId;
    
    public $searchQuery1 = '';
    
    public $form = [
        'id' => null,
        'nombreservicio' => '',
        'descripcionservicio' => '',
        'imageneservicio' => null,
        'precioservicio' => '',
        'fk_idtiposervicio' => '',
        'cantidadservicio' => 1
    ];

    public $tipos;

    // Apartado para agregar múltiples imágenes
    public $imagenesAdicionales = [];
    public $imagenesExistentes = [];
    public $imagenPrincipalExistente = null;

    public function mount()
    {
        $this->obtenerEmpresaUsuario();
        $this->cargarServicios();
        $this->tipos = TipoServicios::all();
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
    
    public function cargarServicios()
    {
        // Si no hay empresa asociada, no cargar servicios
        if (!$this->empresaId) {
            $this->servicios = collect();
            return;
        }

        $this->servicios = Servicios::with('Det_servicio.tiposervicio')
            ->where('fk_idempresa', $this->empresaId) // Filtrar por empresa
            ->when($this->searchQuery1, function($query) {
                $query->whereHas('Det_servicio', function($q) {
                    $q->where('nombreservicio', 'like', '%'.$this->searchQuery1.'%')
                    ->orWhere('descripcionservicio', 'like', '%'.$this->searchQuery1.'%')
                    ->orWhereHas('tiposervicio', function($subQ) {
                        $subQ->where('nametipo_servicios', 'like', '%'.$this->searchQuery1.'%');
                    });
                });
            })
            ->orderBy('id', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.panelservicios')->layout('layouts.prueba');
    }

    public function abrirModalCrear()
    {
        $this->resetForm();
        $this->modoEditar = false;
        $this->modal = true;
    }

    public function resetForm()
    {
        $this->form = [
            'id' => null,
            'nombreservicio' => '',
            'descripcionservicio' => '',
            'imageneservicio' => null,
            'precioservicio' => '',
            'fk_idtiposervicio' => '',
            'cantidadservicio' => 1
        ];
        
        // Limpiar arrays de imágenes
        $this->imagenesAdicionales = [];
        $this->imagenesExistentes = collect();
        $this->imagenPrincipalExistente = null;
    }

    public function removeImage($index)
    {
        // Crear nuevo array sin el elemento en el índice especificado
        $nuevasImagenes = [];
        foreach ($this->imagenesAdicionales as $i => $imagen) {
            if ($i != $index) {
                $nuevasImagenes[] = $imagen;
            }
        }
        $this->imagenesAdicionales = $nuevasImagenes;
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
            'form.nombreservicio' => 'required|string|max:255',
            'form.descripcionservicio' => 'nullable|string',
            'form.precioservicio' => 'required|numeric|min:0',
            'form.fk_idtiposervicio' => 'required|exists:tipo_servicios,id',
            'form.cantidadservicio' => 'required|integer|min:1',
            'form.imageneservicio' => 'required|image|max:2048', // Cambiado a required
            'imagenesAdicionales.*' => 'nullable|image|max:2048'
        ]);

        // Primero guardar la imagen principal
        $pathPrincipal = $this->form['imageneservicio']->store('servicios', 'public');

        // Ahora guardar el detalle del servicio CON la ruta de la imagen
        $detalleServicio = Detalle_Servicio::create([
            'nombreservicio' => $this->form['nombreservicio'],
            'descripcionservicio' => $this->form['descripcionservicio'],
            'precioservicio' => $this->form['precioservicio'],
            'fk_idtiposervicio' => $this->form['fk_idtiposervicio'],
            'imageneservicio' => $pathPrincipal // Guardamos la ruta aquí
        ]);

        // Guardar la misma imagen en la tabla polimórfica como tipo 'principal'
        $detalleServicio->imagenes()->create([
            'url' => $pathPrincipal,
            'tipo' => 'principal'
        ]);

        // Guardar imágenes adicionales (opcional)
        if ($this->imagenesAdicionales && count($this->imagenesAdicionales) > 0) {
            foreach ($this->imagenesAdicionales as $imagen) {
                if ($imagen) {
                    $path = $imagen->store('servicios', 'public');
                    $detalleServicio->imagenes()->create([
                        'url' => $path,
                        'tipo' => 'secundaria'
                    ]);
                }
            }
        }

        // Guardar el servicio (cantidad)
        Servicios::create([
            'cantidadservicio' => $this->form['cantidadservicio'],
            'fk_iddetalle_servicios' => $detalleServicio->id,
            'fk_idempresa' => $empresa->id,
        ]);

        $this->cerrarModal();
        $this->cargarServicios();
        session()->flash('message', 'Servicio creado exitosamente');
    }

    public function editar($id)
    {
        $servicio = Servicios::with('Det_servicio.imagenes')->findOrFail($id);
        
        $this->form = [
            'id' => $servicio->id,
            'nombreservicio' => $servicio->Det_servicio->nombreservicio,
            'descripcionservicio' => $servicio->Det_servicio->descripcionservicio,
            'precioservicio' => $servicio->Det_servicio->precioservicio,
            'fk_idtiposervicio' => $servicio->Det_servicio->fk_idtiposervicio,
            'cantidadservicio' => $servicio->cantidadservicio,
            'imageneservicio' => null // Para nuevas imágenes
        ];

        // Cargar imagen principal existente
        $this->imagenPrincipalExistente = $servicio->Det_servicio->imagenes()
            ->where('tipo', 'principal')
            ->first();

        // Cargar imágenes adicionales existentes
        $this->imagenesExistentes = $servicio->Det_servicio->imagenes()
            ->where('tipo', 'secundaria')
            ->get();

        // Limpiar imágenes nuevas
        $this->imagenesAdicionales = [];

        $this->modoEditar = true;
        $this->modal = true;
    }
    
    //Método para eliminar imagenes
    public function eliminarImagen($id)
    {
        try {
            $imagen = imagenes::findOrFail($id);
            
            // Eliminar archivo físico
            if (Storage::disk('public')->exists($imagen->url)) {
                Storage::disk('public')->delete($imagen->url);
            }
            
            // Eliminar registro de la base de datos
            $imagen->delete();
            
            // Actualizar colección de imágenes existentes
            $this->imagenesExistentes = $this->imagenesExistentes->reject(function($img) use ($id) {
                return $img->id == $id;
            });
            
            session()->flash('message', 'Imagen eliminada exitosamente');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar la imagen');
        }
    }

    public function actualizar()
    {
        $this->validate([
            'form.nombreservicio' => 'required|string|max:255',
            'form.descripcionservicio' => 'nullable|string',
            'form.precioservicio' => 'required|numeric|min:0',
            'form.fk_idtiposervicio' => 'required|exists:tipo_servicios,id',
            'form.cantidadservicio' => 'required|integer|min:1',
            'form.imageneservicio' => 'nullable|image|max:2048',
            'imagenesAdicionales.*' => 'nullable|image|max:2048'
        ]);

        $servicio = Servicios::with('Det_servicio.imagenes')->findOrFail($this->form['id']);

        // Preparar datos para actualizar
        $detalleData = [
            'nombreservicio' => $this->form['nombreservicio'],
            'descripcionservicio' => $this->form['descripcionservicio'],
            'precioservicio' => $this->form['precioservicio'],
            'fk_idtiposervicio' => $this->form['fk_idtiposervicio']
        ];

        // Manejar imagen principal nueva
        if ($this->form['imageneservicio']) {
            $pathPrincipal = $this->form['imageneservicio']->store('servicios', 'public');
            
            // Actualizar ruta en detalle_servicios
            $detalleData['imageneservicio'] = $pathPrincipal;

            // Eliminar imagen principal anterior si existe
            $imagenPrincipalAnterior = $servicio->Det_servicio->imagenes()
                ->where('tipo', 'principal')
                ->first();
                
            if ($imagenPrincipalAnterior) {
                Storage::disk('public')->delete($imagenPrincipalAnterior->url);
                $imagenPrincipalAnterior->delete();
            }
            
            // Guardar nueva imagen principal en tabla polimórfica
            $servicio->Det_servicio->imagenes()->create([
                'url' => $pathPrincipal,
                'tipo' => 'principal'
            ]);
        }

        // Actualizar detalle del servicio
        $servicio->Det_servicio->update($detalleData);

        // Guardar nuevas imágenes adicionales
        if ($this->imagenesAdicionales && count($this->imagenesAdicionales) > 0) {
            foreach ($this->imagenesAdicionales as $imagen) {
                if ($imagen) {
                    $path = $imagen->store('servicios', 'public');
                    $servicio->Det_servicio->imagenes()->create([
                        'url' => $path,
                        'tipo' => 'secundaria'
                    ]);
                }
            }
        }

        // Actualizar cantidad del servicio
        $servicio->update([
            'cantidadservicio' => $this->form['cantidadservicio']
        ]);

        $this->cerrarModal();
        $this->cargarServicios();
        session()->flash('message', 'Servicio actualizado exitosamente');
    }

    public function eliminar($id)
    {
        $this->servicioAEliminar = $id;
        $this->modalConfirmacion = true;
    }

    public function confirmarEliminar()
    {
        $servicio = Servicios::with('Det_servicio')->findOrFail($this->servicioAEliminar);
        
        // Eliminar imagen si existe
        if ($servicio->Det_servicio->imageneservicio) {
            Storage::disk('public')->delete($servicio->Det_servicio->imageneservicio);
        }
        
        // Eliminar el detalle del servicio
        $servicio->Det_servicio->delete();
        
        // Eliminar el servicio
        $servicio->delete();

        $this->modalConfirmacion = false;
        $this->servicioAEliminar = null;
        $this->cargarServicios();
        session()->flash('message', 'Servicio eliminado exitosamente');
    }

    public function cancelarEliminar()
    {
        $this->servicioAEliminar = null;
        $this->modalConfirmacion = false;
    }

    public function cerrarModal()
    {
        $this->modal = false;
        $this->resetForm();
    }

    public function updatedSearchQuery1()
    {
        $this->cargarServicios();
    }
}