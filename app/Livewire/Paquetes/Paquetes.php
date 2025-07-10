<?php

namespace App\Livewire\Paquetes;

use Livewire\Component;
use App\Models\favoritos;
use App\Models\Paquetes as ModelPaquetes;
use App\Models\Distritos;
use App\Models\TipoDestinos;

use Illuminate\Support\Facades\Auth;

class Paquetes extends Component
{
    public $paquetesContactados = [];
    public $paqueteId;
    public $esFavorito = false;
    public $favoritos = [];

    public $tiposDestino;
    public $distritos;

    // Estos serán los que se actualicen en tiempo real desde el input
    public $busquedaIzquierda = ''; 
    public $paqueteIzquierdaId = null;

    // Estos serán los que se actualicen en tiempo real desde los select
    public $filtroPrecioIzquierda = '';
    public $filtroDestinoIzquierda = '';
    public $filtroDistritoIzquierda = '';

    // Los *_Temp ya no son estrictamente necesarios si usas .live en todos
    // Pero si los mantienes para alguna lógica específica, asegúrate de que se sincronicen
    // Por simplicidad, los eliminaré para que busquedaIzquierda, filtroPrecioIzquierda, etc.
    // sean las propiedades directas que Livewire actualiza.

    public function mount()
    {
        $this->paquetesContactados = session()->get('paquetesContactados', []);
        $this->distritos = Distritos::orderBy('namedistrito')->get(); 
        $this->tiposDestino = TipoDestinos::pluck('nametipo_destinos')->toArray();
        

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
        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para agregar favoritos');
            return;
        }

        $userId = Auth::id();
        
        $favoritoExistente = favoritos::where('fk_iduser', $userId)
            ->where('favoritable_id', $paqueteId)
            ->where('favoritable_type', ModelPaquetes::class)
            ->first();

        if ($favoritoExistente) {
            $favoritoExistente->delete();
            $this->favoritos = array_filter($this->favoritos, function($id) use ($paqueteId) {
                return $id != $paqueteId;
            });
            session()->flash('success', 'Paquete removido de favoritos');
        } else {
            favoritos::create([
                'fk_iduser' => $userId,
                'favoritable_id' => $paqueteId,
                'favoritable_type' => ModelPaquetes::class
            ]);
            $this->favoritos[] = $paqueteId;
            session()->flash('success', 'Paquete agregado a favoritos');
        }
    }

    public function esFavoritoDelUsuario($paqueteId)
    {
        return in_array($paqueteId, $this->favoritos);
    }

    // El método 'render' se encargará de recalcular la lista filtrada cada vez que una propiedad con wire:model.live cambie.
    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';

        $paquetesFiltrados = $this->filtrarPaquetes(
            $this->busquedaIzquierda, // Ahora se usa directamente esta propiedad
            $this->filtroPrecioIzquierda, // Ahora se usa directamente esta propiedad
            $this->filtroDestinoIzquierda, // Ahora se usa directamente esta propiedad
            $this->filtroDistritoIzquierda // Ahora se usa directamente esta propiedad
        );
        
        $paqueteIzquierda = null;
        if ($this->paqueteIzquierdaId) {
            $paqueteIzquierda = ModelPaquetes::with([
                'empresa',
                'imagenes',
                'det_paquete.destino',
                'det_paquete.promos',
                'ser_paquete.servicio.Det_servicio',
                'equi_paquete.equipo.Det_equipo',
                'dis_paquete',
                'reservas',
                'comentarios.users',
                'comentarios.respuestas.usuario',
                'itinerarios.itinerariosRutas.ruta.rutasParadas.parada'
            ])->find($this->paqueteIzquierdaId);
        }

        return view('livewire.paquetes.paquetes', [
            'paquetes' => $paquetesFiltrados, 
            'paqueteIzquierda' => $paqueteIzquierda,
            'distritos' => $this->distritos,
            'tiposDestino' => $this->tiposDestino,
        ])->layout($layout);
    }

    private function filtrarPaquetes($busqueda, $filtroPrecio, $filtroDestino, $filtroDistrito)
    {
        $query = ModelPaquetes::query();

        $query->when($busqueda, function ($q) use ($busqueda) {
            $q->where('nombrepaquete', 'like', '%' . $busqueda . '%')
                ->orWhere('descripcion', 'like', '%' . $busqueda . '%');
        });

        $query->when($filtroPrecio, function ($q) use ($filtroPrecio) {
            $q->orderBy('preciopaquete', $filtroPrecio);
        });

        $query->when($filtroDestino, function ($q) use ($filtroDestino) {
            $q->whereHas('det_paquete.destino.tipoDestino', function ($qq) use ($filtroDestino) {
                $qq->where('nametipo_destinos', $filtroDestino);
            });
        });

        $query->when($filtroDistrito, function ($q) use ($filtroDistrito) {
            $q->whereHas('det_paquete.destino', function ($qq) use ($filtroDistrito) {
                $qq->whereHas('distrito', function ($qqq) use ($filtroDistrito) {
                    $qqq->where('namedistrito', $filtroDistrito);
                });
            });
        });
        
        $query->with([
            'det_paquete.promos', 
            'det_paquete', 
            'imagenes' 
        ]);

        return $query->get();
    }
    
    // Ejemplo de un "updated" hook si necesitaras lógica adicional:
    public function updatedBusquedaIzquierda($value)
    {
        $this->paqueteIzquierdaId = null; // Reiniciar paquete seleccionado al cambiar la búsqueda
    }
    public function updatedFiltroPrecioIzquierda($value)
    {
        $this->paqueteIzquierdaId = null; // Reiniciar paquete seleccionado al cambiar el filtro
    }
    public function updatedFiltroDestinoIzquierda($value)
    {
        $this->paqueteIzquierdaId = null;
    }
    public function updatedFiltroDistritoIzquierda($value)
    {
        $this->paqueteIzquierdaId = null;
    }


    public function limpiarFiltrosIzquierda()
    {
        $this->reset([
            'busquedaIzquierda',
            'filtroPrecioIzquierda',
            'filtroDestinoIzquierda',
            'filtroDistritoIzquierda',
            'paqueteIzquierdaId' // Reinicia también el paquete seleccionado
        ]);
    }
}