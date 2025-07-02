<?php

namespace App\Livewire\Equipos;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Equipos as EquiposModel;
use App\Models\Detalle_Equipo;
use App\Models\favoritos;

use Illuminate\Support\Facades\Auth;

class Equipos extends Component
{
    public $equipos =[];
    public $equipoId;
    public $esFavorito = false;
    public $favoritos = [];
    
    public function mount(){
        $this->equipos=Detalle_Equipo::all();
        if (Auth::check()) {
            $this->cargarFavoritos();
        }
    }

    public function cargarFavoritos()
    {
        $favoritosUsuario = favoritos::where('fk_iduser', Auth::id())
            ->where('favoritable_type', Detalle_Equipo::class)
            ->pluck('favoritable_id')
            ->toArray();
        
        $this->favoritos = $favoritosUsuario;
    }
    
    public function toggleFavorito($equipoId)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para agregar favoritos');
            return;
        }

        $userId = Auth::id();
        
        // Buscar si ya existe el favorito
        $favoritoExistente = favoritos::where('fk_iduser', $userId)
            ->where('favoritable_id', $equipoId)
            ->where('favoritable_type', Detalle_Equipo::class)
            ->first();

        if ($favoritoExistente) {
            // Si existe, lo eliminamos (quitar de favoritos)
            $favoritoExistente->delete();
            
            // Remover del array local
            $this->favoritos = array_filter($this->favoritos, function($id) use ($equipoId) {
                return $id != $equipoId;
            });
            
            session()->flash('success', 'Equipo removido de favoritos');
        } else {
            // Si no existe, lo creamos (agregar a favoritos)
            favoritos::create([
                'fk_iduser' => $userId,
                'favoritable_id' => $equipoId,
                'favoritable_type' => Detalle_Equipo::class
            ]);
            
            // Agregar al array local
            $this->favoritos[] = $equipoId;
            
            session()->flash('success', 'Equipo agregado a favoritos');
        }
    }

    public function esFavoritoDelUsuario($equipoId)
    {
        return in_array($equipoId, $this->favoritos);
    }

    public function render()
    {
        // Verificar si el usuario está autenticado
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';

        return view('livewire.equipos.equipos')->layout($layout);
    }
}