<?php

namespace App\Livewire\Paquetes;

use Livewire\Component;
use App\Models\favoritos;
use App\Models\Paquetes as ModelPaquetes;
// use App\Models\DetallePaquetes;

use Illuminate\Support\Facades\Auth;

class Paquetes extends Component
{
    public $paquetes = [];
    public $paquetesContactados = [];
    public $paqueteId;
    public $esFavorito = false;
    public $favoritos = [];

    public function mount()
    {
        $this->paquetes = ModelPaquetes::all();
        $this->paquetesContactados = session()->get('paquetesContactados', []);
        if (Auth::check()) {
            $this->cargarFavoritos();
        }
    }

        public function cargarFavoritos()
    {
        $favoritosUsuario = favoritos::where('fk_iduser', Auth::id())
            ->where('favoritable_type', ModelPaquetes::class)
            ->pluck('favoritable_id')
            ->toArray();
        
        $this->favoritos = $favoritosUsuario;
    }
    
    public function toggleFavorito($paqueteId)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para agregar favoritos');
            return;
        }

        $userId = Auth::id();
        
        // Buscar si ya existe el favorito
        $favoritoExistente = favoritos::where('fk_iduser', $userId)
            ->where('favoritable_id', $paqueteId)
            ->where('favoritable_type', ModelPaquetes::class)
            ->first();

        if ($favoritoExistente) {
            // Si existe, lo eliminamos (quitar de favoritos)
            $favoritoExistente->delete();
            
            // Remover del array local
            $this->favoritos = array_filter($this->favoritos, function($id) use ($paqueteId) {
                return $id != $paqueteId;
            });
            
            session()->flash('success', 'Paquete removido de favoritos');
        } else {
            // Si no existe, lo creamos (agregar a favoritos)
            favoritos::create([
                'fk_iduser' => $userId,
                'favoritable_id' => $paqueteId,
                'favoritable_type' => ModelPaquetes::class
            ]);
            
            // Agregar al array local
            $this->favoritos[] = $paqueteId;
            
            session()->flash('success', 'Paquete agregado a favoritos');
        }
    }

    public function esFavoritoDelUsuario($paqueteId)
    {
        return in_array($paqueteId, $this->favoritos);
    }

    public function render()
    {
        // Verificar si el usuario está autenticado
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.paquetes.paquetes')->layout($layout);
    }


    // public function empresa()
    // {
    //     return $this->belongsTo(\App\Models\Empresas::class, 'fk_idempresa');
    // }

}