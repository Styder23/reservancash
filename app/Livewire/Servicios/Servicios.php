<?php

namespace App\Livewire\Servicios;

use Livewire\Component;
use App\Models\Servicios as ServiciosModel;
use App\Models\Detalle_Servicio;
use App\Models\favoritos;
use Illuminate\Support\Facades\Auth;

class Servicios extends Component
{
    public $servicios = [];
    public $servicioId;
    public $esFavorito = false;
    public $favoritos = [];
    
    public function mount(){
        $this->servicios=Detalle_Servicio::all();
        // Cargar favoritos del usuario autenticado
        if (Auth::check()) {
            $this->cargarFavoritos();
        }
    }

    public function cargarFavoritos()
    {
        $favoritosUsuario = favoritos::where('fk_iduser', Auth::id())
            ->where('favoritable_type', Detalle_Servicio::class)
            ->pluck('favoritable_id')
            ->toArray();
        
        $this->favoritos = $favoritosUsuario;
    }

    public function toggleFavorito($servicioId)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para agregar favoritos');
            return;
        }

        $userId = Auth::id();
        
        // Buscar si ya existe el favorito
        $favoritoExistente = favoritos::where('fk_iduser', $userId)
            ->where('favoritable_id', $servicioId)
            ->where('favoritable_type', Detalle_Servicio::class)
            ->first();

        if ($favoritoExistente) {
            // Si existe, lo eliminamos (quitar de favoritos)
            $favoritoExistente->delete();
            
            // Remover del array local
            $this->favoritos = array_filter($this->favoritos, function($id) use ($servicioId) {
                return $id != $servicioId;
            });
            
            session()->flash('success', 'Servicio removido de favoritos');
        } else {
            // Si no existe, lo creamos (agregar a favoritos)
            favoritos::create([
                'fk_iduser' => $userId,
                'favoritable_id' => $servicioId,
                'favoritable_type' => Detalle_Servicio::class
            ]);
            
            // Agregar al array local
            $this->favoritos[] = $servicioId;
            
            session()->flash('success', 'Servicio agregado a favoritos');
        }
    }

    public function esFavoritoDelUsuario($servicioId)
    {
        return in_array($servicioId, $this->favoritos);
    }
    
    public function render()
    {
        // Verificar si el usuario está autenticado
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.servicios.servicios')->layout($layout);
    }
}