<?php

namespace App\Livewire\Root;

use Livewire\Component;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\TipoEquipo;
use App\Models\TipoServicios;

class DatosGenerales extends Component
{
    public $activeTab = 'Categorías';
    
    // Modal properties
    public $showModal = false;
    public $modalTitle = '';
    public $currentItem = [];
    public $currentModel = '';
    
    // Delete modal
    public $showDeleteModal = false;
    public $itemToDelete;
    public $modelToDelete;
    
    // Data
    public $categorias = [];
    public $marcas = [];
    public $modelos = [];
    public $tipoEquipos = [];
    public $tipoServicios = [];
    
    protected $listeners = ['refresh' => '$refresh'];
    
    public function mount()
    {
        $this->loadData();
    }
    
    public function loadData()
    {
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        $this->modelos = Modelo::all();
        $this->tipoEquipos = TipoEquipo::all();
        $this->tipoServicios = TipoServicios::all();
    }
    
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function openCreateModal($model)
    {
        $this->currentModel = $model;
        $this->modalTitle = 'Crear ' . $this->getModelName($model);
        $this->currentItem = ['name' => ''];
        $this->showModal = true;
    }
    
    public function edit($model, $id)
    {
        $this->currentModel = $model;
        $this->modalTitle = 'Editar ' . $this->getModelName($model);
        
        $modelClass = 'App\Models\\' . $model;
        $item = $modelClass::find($id);
        
        $nameField = $this->getNameField($model);
        $this->currentItem = [
            'id' => $item->id,
            'name' => $item->$nameField
        ];
        
        $this->showModal = true;
    }
    
    public function save()
    {
        $rules = [
            'currentItem.name' => 'required|string|max:255'
        ];
        
        $this->validate($rules);
        
        $modelClass = 'App\Models\\' . $this->currentModel;
        $nameField = $this->getNameField($this->currentModel);
        
        if (isset($this->currentItem['id'])) {
            $item = $modelClass::find($this->currentItem['id']);
            $item->$nameField = $this->currentItem['name'];
            $item->save();
            session()->flash('message', 'Registro actualizado correctamente.');
        } else {
            $modelClass::create([$nameField => $this->currentItem['name']]);
            session()->flash('message', 'Registro creado correctamente.');
        }
        
        $this->closeModal();
        $this->loadData();
    }
    
    public function confirmDelete($model, $id)
    {
        $this->modelToDelete = $model;
        $this->itemToDelete = $id;
        $this->showDeleteModal = true;
    }
    
    public function deleteItem()
    {
        $modelClass = 'App\Models\\' . $this->modelToDelete;
        $item = $modelClass::find($this->itemToDelete);
        
        if ($item) {
            $item->delete();
            session()->flash('message', 'Registro eliminado correctamente.');
        }
        
        $this->closeDeleteModal();
        $this->loadData();
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->currentItem = [];
        $this->currentModel = '';
    }
    
    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->itemToDelete = null;
        $this->modelToDelete = '';
    }
    
    private function getModelName($model)
    {
        $names = [
            'Categoria' => 'Categoría',
            'Marca' => 'Marca',
            'Modelo' => 'Modelo',
            'TipoEquipo' => 'Tipo de Equipo',
            'TipoServicios' => 'Tipo de Servicio'
        ];
        
        return $names[$model] ?? $model;
    }
    
    private function getNameField($model)
    {
        $fields = [
            'Categoria' => 'namecategorias',
            'Marca' => 'namemarcas',
            'Modelo' => 'namemodelos',
            'TipoEquipo' => 'nametipoequipos',
            'TipoServicios' => 'nametipo_servicios'
        ];
        
        return $fields[$model] ?? 'name';
    }

    public function render()
    {
        
        return view('livewire.root.datos-generales')->layout('layouts.prueba');
    }
}