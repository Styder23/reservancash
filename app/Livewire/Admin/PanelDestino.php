<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\paneldestinos as PanelDestinosModel;
use App\Models\Destinos;
use App\Models\Distritos;
use App\Models\TipoDestinos;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class PanelDestino extends Component
{
    use WithFileUploads;

    // Propiedades del formulario
    #[Validate('required|string|max:255')]
    public $namedestino = '';
    
    #[Validate('required|string')]
    public $descripciondestino = '';
    
    #[Validate('nullable|image|max:2048')]
    public $imagenes;
    
    #[Validate('required|string')]
    public $ubicaciondestino = '';
    
    #[Validate('required|exists:distritos,id')]
    public $fk_iddistrito = '';
    
    #[Validate('required|exists:tipo_destinos,id')]
    public $fk_idtipodestino = '';
    
    // 2. Cambiar las propiedades de control:
    public $distritos = [];
    public $tiposDestino = [];
    

    // Propiedades de control
    public $showModal = false;
    public $editingId = null;
    public $searchQuery = '';
    public $destinoToDelete = null;

    public function mount()
    {
        $this->distritos = Distritos::all();
        $this->tiposDestino = TipoDestinos::all();
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
        ])->layout('layouts.layout');
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
        $this->imagenes = null;
        $this->ubicaciondestino = '';
        $this->fk_iddistrito = '';
        $this->fk_idtipodestino = '';
    }

    public function editDestino($destinoId)
    {
        $destino = Destinos::findOrFail($destinoId);
        
        $this->editingId = $destino->id;
        $this->namedestino = $destino->namedestino;
        $this->descripciondestino = $destino->descripciondestino;
        $this->ubicaciondestino = $destino->ubicaciondestino;
        $this->fk_iddistrito = $destino->fk_iddistrito;
        $this->fk_idtipodestino = $destino->fk_idtipodestino;
        
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
    
        // Manejar la imagen si se subió una nueva
        if ($this->imagenes) {
            $imagePath = $this->imagenes->store('destinos', 'public');
            $data['imagenes'] = $imagePath;
        }
    
        if ($this->editingId) {
            // Actualizar destino existente
            $destino = Destinos::findOrFail($this->editingId);
            
            // Si hay nueva imagen y existía una anterior, eliminar la anterior
            if ($this->imagenes && $destino->imagenes) {
                \Storage::disk('public')->delete($destino->imagenes);
            }
            
            $destino->update($data);
            
            session()->flash('message', 'Destino actualizado exitosamente.');
        } else {
            // Crear nuevo destino
            Destinos::create($data);
            
            session()->flash('message', 'Destino creado exitosamente.');
        }
    
        $this->closeModal();
    }

    public function confirmDelete($destinoId)
    {
        $this->destinoToDelete = $destinoId;
        $this->dispatch('show-delete-modal');
    }

    public function deleteDestino()
    {
        if ($this->destinoToDelete) {
            $destino = Destinos::findOrFail($this->destinoToDelete);
            
            // Eliminar imagen si existe
            if ($destino->imagenes) {
                \Storage::disk('public')->delete($destino->imagenes);
            }
            
            $destino->delete();
            
            session()->flash('message', 'Destino eliminado exitosamente.');
            $this->destinoToDelete = null;
        }
    }

    public function cancelDelete()
    {
        $this->destinoToDelete = null;
    }

    // Método para obtener la URL completa de la imagen
    public function getImageUrl($imagePath)
    {
        if (!$imagePath) return null;
        
        return \Storage::disk('public')->url($imagePath);
    }
}