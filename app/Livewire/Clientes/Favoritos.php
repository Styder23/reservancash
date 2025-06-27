<?php

namespace App\Livewire\Clientes;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\favoritos as FavoritosModel;

class Favoritos extends Component
{
    public $search = '';
    public $showAll = [
        'paquetes' => false,
        'equipos' => false,
        'servicios' => false,
        'destinos' => false
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'showAll' => ['except' => []]
    ];

    public function toggleShowAll($type)
    {
        $this->showAll[$type] = !$this->showAll[$type];
    }

    public function removeFromFavorites($type, $id)
    {
        $modelClass = $this->getModelClass($type);
        
        FavoritosModel::where([
            'fk_iduser' => Auth::id(),
            'favoritable_id' => $id,
            'favoritable_type' => $modelClass
        ])->delete();

        $this->dispatch('favoritesUpdated');
    }

    protected function getModelClass($type)
    {
        return match($type) {
            'paquete' => 'App\Models\Paquetes',
            'equipo' => 'App\Models\Detalle_Equipo',
            'servicio' => 'App\Models\Detalle_Servicio',
            'destino' => 'App\Models\Destinos', // Mantén este si existe, si no existe, quítalo
            default => null
        };
    }

    public function getPaquetesProperty()
    {
        return Auth::user()->favoritos()
            ->where('favoritable_type', 'App\Models\Paquetes')
            ->with(['favoritable' => function($query) {
                $query->when($this->search, function($q) {
                    $q->where('nombrepaquete', 'like', '%'.$this->search.'%')
                      ->orWhere('descripcion', 'like', '%'.$this->search.'%');
                });
            }])
            ->get()
            ->pluck('favoritable')
            ->filter();
    }

    public function getEquiposProperty()
    {
        return Auth::user()->favoritos()
            ->where('favoritable_type', 'App\Models\Detalle_Equipo')
            ->with(['favoritable' => function($query) {
                $query->when($this->search, function($q) {
                    $q->where('name_equipo', 'like', '%'.$this->search.'%')
                      ->orWhere('descripcion_equipo', 'like', '%'.$this->search.'%');
                });
            }])
            ->get()
            ->pluck('favoritable')
            ->filter();
    }

    public function getServiciosProperty()
    {
        return Auth::user()->favoritos()
            ->where('favoritable_type', 'App\Models\Detalle_Servicio')
            ->with(['favoritable' => function($query) {
                $query->when($this->search, function($q) {
                    $q->where('nombreservicio', 'like', '%'.$this->search.'%')
                      ->orWhere('descripcionservicio', 'like', '%'.$this->search.'%');
                });
            }])
            ->get()
            ->pluck('favoritable')
            ->filter();
    }

    public function getDestinosProperty()
    {
        // Si no tienes modelo Destinos, puedes comentar esto o crear el modelo
        return Auth::user()->favoritos()
            ->where('favoritable_type', 'App\Models\Destinos')
            ->with(['favoritable' => function($query) {
                $query->when($this->search, function($q) {
                    $q->where('nombre', 'like', '%'.$this->search.'%')
                      ->orWhere('descripcion', 'like', '%'.$this->search.'%');
                });
            }])
            ->get()
            ->pluck('favoritable')
            ->filter();
    }
    
    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.clientes.favoritos',[
            'paquetes' => $this->paquetes,
            'equipos' => $this->equipos,
            'servicios' => $this->servicios,
            'destinos' => $this->destinos
        ])->layout($layout);
    }
}