<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Promociones;
use App\Models\imagenes;
use App\Models\Videos;
use App\Models\Empresas;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Panelpromociones extends Component
{
    use WithFileUploads;

    // Propiedades principales
    public $promociones = [];
    public $searchQuery = '';
    
    // Propiedades para el modal y formulario
    public $modal = false;
    public $modalConfirmacion = false;
    public $modoEditar = false;
    public $promocionId = null;
    public $promocionAEliminar = null; // Agregar esta propiedad
    
    // Propiedades del formulario
    public $form = [
        'namepromocion' => '',
        'descripcion' => '',
        'descuento' => '',
        'fechainicio' => '',
        'fechafin' => '',
        'estado' => '1',
    ];
    
    // Propiedades para archivos
    public $imagenesAdicionales = [];
    public $videosAdicionales = [];
    public $imagenesExistentes = [];
    public $videosExistentes = [];
    public $imagenesAEliminar = [];
    public $videosAEliminar = [];

    public $empresaId;
    // Inicialización
    
    public function mount()
    {
        // Obtener la empresa del usuario autenticado
        $this->obtenerEmpresaUsuario();
        $this->cargarPromociones();
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

    // Cargar promociones con búsqueda
    public function cargarPromociones()
    {
        // Si no hay empresa asociada, no cargar promociones
        if (!$this->empresaId) {
            $this->promociones = collect();
            return;
        }

        $query = Promociones::with(['imagenes', 'videos', 'empresa'])
            ->where('fk_idempresa', $this->empresaId); // Filtrar por empresa
        
        if (!empty($this->searchQuery)) {
            $query->where(function($q) {
                $q->where('namepromocion', 'like', '%'.$this->searchQuery.'%')
                ->orWhere('descripcion', 'like', '%'.$this->searchQuery.'%');
            });
        }
        
        $this->promociones = $query->orderBy('id', 'desc')->get();
    }

    // Búsqueda en tiempo real
    public function updatedSearchQuery()
    {
        $this->cargarPromociones();
    }

    // Abrir modal para crear
    public function abrirModalCrear()
    {
        $this->resetForm();
        $this->modoEditar = false;
        $this->modal = true;
    }

    // Abrir modal para editar
    public function editar($id)
    {
        $promocion = Promociones::with(['imagenes', 'videos'])->findOrFail($id);
        
        $this->form = [
            'namepromocion' => $promocion->namepromocion,
            'descripcion' => $promocion->descripcion,
            'descuento' => $promocion->descuento,
            'fechainicio' => $promocion->fechainicio,
            'fechafin' => $promocion->fechafin,
            'estado' => $promocion->estado,
        ];
        
        // Cargar imágenes y videos existentes
        $this->imagenesExistentes = $promocion->imagenes;
        $this->videosExistentes = $promocion->videos;
        
        // Limpiar arrays de nuevos archivos
        $this->imagenesAdicionales = [];
        $this->videosAdicionales = [];
        $this->imagenesAEliminar = [];
        $this->videosAEliminar = [];
        
        $this->promocionId = $id;
        $this->modoEditar = true;
        $this->modal = true;
    }

    // Guardar nueva promoción
    public function guardar()
    {
        // Obtener el ID del usuario autenticado y la empresa
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
        
        // Validación de datos
        $this->validate([
            'form.namepromocion' => 'required|string|max:255',
            'form.descripcion' => 'required|string|max:1000',
            'form.descuento' => 'required|numeric|min:1|max:100',
            'form.fechainicio' => 'required|date',
            'form.fechafin' => 'required|date|after:form.fechainicio',
            'imagenesAdicionales.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'videosAdicionales.*' => 'nullable|mimes:mp4,mov,avi|max:40960',
        ]);
        
        try {
            DB::beginTransaction();
            
            // Crear nueva promoción
            $promocion = Promociones::create(array_merge(
                $this->form,
                ['fk_idempresa' => $empresa->id]
            ));
            
            // Guardar nuevas imágenes si existen
            if (!empty($this->imagenesAdicionales)) {
                $this->guardarImagenes($promocion);
            }
            
            // Guardar nuevos videos si existen
            if (!empty($this->videosAdicionales)) {
                $this->guardarVideos($promocion);
            }
            
            DB::commit();
            
            $this->cerrarModal();
            $this->cargarPromociones();
            session()->flash('message', 'Promoción creada exitosamente');
            
        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear promoción: ' . $e->getMessage());
            session()->flash('error', 'Error al crear la promoción. Por favor, inténtelo nuevamente.');
        }
    }

    // Actualizar promoción existente
    public function actualizar()
    {
        // Validación de datos
        $this->validate([
            'form.namepromocion' => 'required|string|max:255',
            'form.descripcion' => 'required|string|max:1000',
            'form.descuento' => 'required|numeric|min:1|max:100',
            'form.fechainicio' => 'required|date',
            'form.fechafin' => 'required|date|after:form.fechainicio',
            'imagenesAdicionales.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'videosAdicionales.*' => 'nullable|mimes:mp4,mov,avi|max:40960',
        ]);
        
        try {
            DB::beginTransaction();
            
            // Actualizar promoción existente
            $promocion = Promociones::findOrFail($this->promocionId);
            $promocion->update($this->form);
            
            // Eliminar archivos marcados para eliminación
            $this->eliminarArchivosMarcados();
            
            // Guardar nuevas imágenes si existen
            if (!empty($this->imagenesAdicionales)) {
                $this->guardarImagenes($promocion);
            }
            
            // Guardar nuevos videos si existen
            if (!empty($this->videosAdicionales)) {
                $this->guardarVideos($promocion);
            }
            
            DB::commit();
            
            $this->cerrarModal();
            $this->cargarPromociones();
            session()->flash('message', 'Promoción actualizada exitosamente');
            
        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar promoción: ' . $e->getMessage());
            session()->flash('error', 'Error al actualizar la promoción. Por favor, inténtelo nuevamente.');
        }
    }

    // Guardar imágenes en storage y base de datos
    protected function guardarImagenes($promocion)
    {
        foreach ($this->imagenesAdicionales as $imagen) {
            if ($imagen) {
                $path = $imagen->store('promociones/imagenes', 'public');
                
                $promocion->imagenes()->create([
                    'url' => $path,
                    'tipo' => 'promocion'
                ]);
            }
        }
    }

    // Guardar videos en storage y base de datos
    protected function guardarVideos($promocion)
    {
        foreach ($this->videosAdicionales as $video) {
            if ($video) {
                $path = $video->store('promociones/videos', 'public');
                
                $promocion->videos()->create([
                    'url' => $path,
                    'tipo' => 'promocion'
                ]);
            }
        }
    }
    
    // Eliminar archivos marcados para eliminación
    protected function eliminarArchivosMarcados()
    {
        // Eliminar imágenes
        foreach ($this->imagenesAEliminar as $imagenId) {
            $imagen = imagenes::find($imagenId);
            if ($imagen) {
                Storage::disk('public')->delete($imagen->url);
                $imagen->delete();
            }
        }
        
        // Eliminar videos
        foreach ($this->videosAEliminar as $videoId) {
            $video = Videos::find($videoId);
            if ($video) {
                Storage::disk('public')->delete($video->url);
                $video->delete();
            }
        }
    }

    // Marcar imagen para eliminación
    public function eliminarImagen($id)
    {
        try {
            if ($this->modoEditar) {
                // En modo edición, marcar para eliminación
                $this->imagenesAEliminar[] = $id;
                $this->imagenesExistentes = $this->imagenesExistentes->filter(function ($imagen) use ($id) {
                    return $imagen->id != $id;
                });
            }
            
            session()->flash('message', 'Imagen marcada para eliminación');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar la imagen');
        }
    }

    // Marcar video para eliminación
    public function eliminarVideo($id)
    {
        try {
            if ($this->modoEditar) {
                // En modo edición, marcar para eliminación
                $this->videosAEliminar[] = $id;
                $this->videosExistentes = $this->videosExistentes->filter(function ($video) use ($id) {
                    return $video->id != $id;
                });
            }
            
            session()->flash('message', 'Video marcado para eliminación');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar el video');
        }
    }

    // Eliminar una promoción
    public function eliminar($id)
    {
        $this->promocionAEliminar = $id;
        $this->modalConfirmacion = true;
    }

    // Confirmar eliminación
    public function confirmarEliminar()
    {
        DB::beginTransaction();
        
        try {
            $promocion = Promociones::with(['imagenes', 'videos'])->findOrFail($this->promocionAEliminar);
            
            // Eliminar imágenes asociadas
            foreach ($promocion->imagenes as $imagen) {
                Storage::disk('public')->delete($imagen->url);
                $imagen->delete();
            }
            
            // Eliminar videos asociados
            foreach ($promocion->videos as $video) {
                Storage::disk('public')->delete($video->url);
                $video->delete();
            }
            
            // Eliminar la promoción
            $promocion->delete();
            
            DB::commit();
            
            session()->flash('message', 'Promoción eliminada exitosamente');
            $this->cargarPromociones();
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al eliminar la promoción: ' . $e->getMessage());
        }
        
        $this->cancelarEliminar();
    }

    // Cancelar eliminación
    public function cancelarEliminar()
    {
        $this->promocionAEliminar = null;
        $this->modalConfirmacion = false;
    }

    // Cerrar modal y resetear
    public function cerrarModal()
    {
        $this->modal = false;
        $this->resetForm();
    }

    // Resetear formulario
    public function resetForm()
    {
        $this->form = [
            'namepromocion' => '',
            'descripcion' => '',
            'descuento' => '',
            'fechainicio' => '',
            'fechafin' => '',
            'estado' => '1',
        ];
        
        $this->imagenesAdicionales = [];
        $this->videosAdicionales = [];
        $this->imagenesExistentes = collect();
        $this->videosExistentes = collect();
        $this->imagenesAEliminar = [];
        $this->videosAEliminar = [];
        $this->promocionId = null;
        $this->modoEditar = false;
        $this->resetErrorBag();
    }

    // Eliminar imagen temporal
    public function removeImage($index)
    {
        unset($this->imagenesAdicionales[$index]);
        $this->imagenesAdicionales = array_values($this->imagenesAdicionales);
    }

    // Eliminar video temporal
    public function removeVideo($index)
    {
        unset($this->videosAdicionales[$index]);
        $this->videosAdicionales = array_values($this->videosAdicionales);
    }

    // Renderizar vista
    public function render()
    {
        return view('livewire.admin.panelpromociones')->layout('layouts.prueba');
    }
}