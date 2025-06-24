<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\paneldestinos as PanelDestinosModel;
use App\Models\Destinos;
use App\Models\Distritos;
use App\Models\TipoDestinos;
use App\Models\imagenes;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;

class PanelDestino extends Component
{
    use WithFileUploads;
    
    #[Validate('required|string|max:255')]
    public $namedestino = '';
    
    #[Validate('required|string')]
    public $descripciondestino = '';
    
    #[Validate('nullable|image|max:2048')]
    public $imagenPrincipal;

    #[Validate('nullable|array')]
    public $imagenesAdicionales = [];

    public $imagenPrincipalActual = null;
    public $imagenesAdicionalesActuales = [];
    
    #[Validate('required|string')]
    public $ubicaciondestino = '';
    
    #[Validate('required|exists:distritos,id')]
    public $fk_iddistrito = '';
    
    #[Validate('required|exists:tipo_destinos,id')]
    public $fk_idtipodestino = '';
    
    // Propiedades de control
    public $distritos = [];
    public $tiposDestino = [];
    public $showModal = false;
    public $editingId = null;
    public $searchQuery = '';
    public $destinoToDelete = null;

    public function mount()
    {
        $this->distritos = Distritos::all();
        $this->tiposDestino = TipoDestinos::all();
    }

    public function rules()
    {
        return [
            'namedestino' => 'required|string|max:255',
            'descripciondestino' => 'required|string',
            'imagenPrincipal' => 'nullable|image|max:2048',
            'imagenesAdicionales' => 'nullable|array|max:10', // Máximo 10 imágenes
            'imagenesAdicionales.*' => 'image|max:2048|mimes:jpeg,png,jpg,gif,webp',
            'ubicaciondestino' => 'required|string',
            'fk_iddistrito' => 'required|exists:distritos,id',
            'fk_idtipodestino' => 'required|exists:tipo_destinos,id',
        ];
    }

    public function render()
    {
        $destinos = Destinos::with(['distrito', 'tipoDestino'])
            ->when($this->searchQuery, function ($query) {
                $query->where('namedestino', 'like', '%' . $this->searchQuery . '%')
                      ->orWhereHas('distrito', function($q) {
                          $q->where('namedistrito', 'like', '%' . $this->searchQuery . '%');
                      })
                      ->orWhereHas('tipoDestino', function($q) {
                          $q->where('nametipo_destinos', 'like', '%' . $this->searchQuery . '%');
                      });
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('livewire.admin.panel-destino', [
            'destinos' => $destinos
        ])->layout('layouts.prueba');
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->namedestino = '';
        $this->descripciondestino = '';
        $this->imagenPrincipal = null;
        $this->imagenesAdicionales = [];
        $this->imagenPrincipalActual = null;
        $this->imagenesAdicionalesActuales = [];
        $this->ubicaciondestino = '';
        $this->fk_iddistrito = '';
        $this->fk_idtipodestino = '';
    }

    public function editDestino($destinoId)
    {
        $destino = Destinos::with('imagenes')->findOrFail($destinoId);
        
        $this->editingId = $destino->id;
        $this->namedestino = $destino->namedestino;
        $this->descripciondestino = $destino->descripciondestino;
        $this->ubicaciondestino = $destino->ubicaciondestino;
        $this->fk_iddistrito = $destino->fk_iddistrito;
        $this->fk_idtipodestino = $destino->fk_idtipodestino;
        
        // Cargar imagen principal desde el campo 'imagenes'
        $this->imagenPrincipalActual = $destino->imagenes;
        
        // Cargar imágenes adicionales desde la relación polimórfica
        $this->imagenesAdicionalesActuales = $destino->imagenes()
            ->where('tipo', 'adicional')
            ->get()
            ->map(function($img) {
                return ['id' => $img->id, 'url' => $img->url];
            })->toArray();
        
        $this->showModal = true;
    }

    public function saveDestino()
    {
        $this->validate();

        $data = [
            'namedestino' => $this->namedestino,
            'descripciondestino' => $this->descripciondestino,
            'ubicaciondestino' => $this->ubicaciondestino,
            'fk_iddistrito' => $this->fk_iddistrito,
            'fk_idtipodestino' => $this->fk_idtipodestino
        ];

        // Manejar imagen principal - guardar en el campo 'imagenes' de la tabla destinos
        if ($this->imagenPrincipal) {
            $imagePath = $this->imagenPrincipal->store('destinos', 'public');
            $data['imagenes'] = $imagePath;
        }

        if ($this->editingId) {
            $destino = Destinos::findOrFail($this->editingId);
            
            // Si hay nueva imagen principal, eliminar la anterior
            if ($this->imagenPrincipal && $destino->imagenes) {
                Storage::disk('public')->delete($destino->imagenes);
            }
            
            $destino->update($data);
        } else {
            $destino = Destinos::create($data);
        }

        // Manejar imágenes adicionales - guardar en relación polimórfica
        if ($this->imagenesAdicionales && count($this->imagenesAdicionales) > 0) {
            foreach ($this->imagenesAdicionales as $imagen) {
                if ($imagen && is_object($imagen) && method_exists($imagen, 'store')) {
                    $imagePath = $imagen->store('destinos', 'public');
                    $destino->imagenes()->create([
                        'url' => $imagePath,
                        'tipo' => 'adicional'
                    ]);
                }
            }
        }

        session()->flash('message', $this->editingId ? 'Destino actualizado exitosamente.' : 'Destino creado exitosamente.');
        $this->closeModal();
    }

    public function eliminarImagenAdicional($index)
    {
        if (isset($this->imagenesAdicionalesActuales[$index])) {
            $imagen = $this->imagenesAdicionalesActuales[$index];
            
            // Eliminar del storage
            Storage::disk('public')->delete($imagen['url']);
            
            // Eliminar de la base de datos
            imagenes::find($imagen['id'])->delete();
            
            // Eliminar del array
            unset($this->imagenesAdicionalesActuales[$index]);
            $this->imagenesAdicionalesActuales = array_values($this->imagenesAdicionalesActuales);
            
            session()->flash('message', 'Imagen eliminada correctamente.');
        }
    }
    
    public function confirmDelete($destinoId)
    {
        $this->destinoToDelete = $destinoId;
        $this->dispatch('show-delete-modal');
    }

    public function cancelDelete()
    {
        $this->destinoToDelete = null;
    }

    public function deleteDestino()
    {
        if ($this->destinoToDelete) {
            $destino = Destinos::findOrFail($this->destinoToDelete);
            
            // Eliminar imagen principal del campo 'imagenes'
            if ($destino->imagenes) {
                Storage::disk('public')->delete($destino->imagenes);
            }
            
            // Eliminar imágenes adicionales de la relación polimórfica
            foreach ($destino->imagenes()->get() as $imagen) {
                Storage::disk('public')->delete($imagen->url);
                $imagen->delete();
            }
            
            $destino->delete();
            
            session()->flash('message', 'Destino eliminado exitosamente.');
            $this->destinoToDelete = null;
        }
    }

    public function getImageUrl($imagePath)
    {
        if (!$imagePath) return null;
        
        return Storage::disk('public')->url($imagePath);
    }
}