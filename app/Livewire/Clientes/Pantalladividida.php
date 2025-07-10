<?php

namespace App\Livewire\Clientes;

use App\Models\Distritos;
use App\Models\Paquetes;
use App\Models\TipoDestinos; // Importar TipoDestinos
use Livewire\Attributes\Layout; // Asegúrate de que esta importación es correcta si usas Livewire 3
use Livewire\Component;

class Pantalladividida extends Component
{
    public $tiposDestino = [];
    public $paquetes = []; // Esta propiedad no es usada directamente para la lista de paquetes mostrados, considera si es necesaria.
    public $distritos = [];

    public $paquete; // Esta propiedad contendrá el paquete cargado (para detalles, no la lista)

    // Propiedades para la búsqueda y filtros IZQUIERDA (directas, sin _Temp)
    public $busquedaIzquierda = ''; 
    public $filtroPrecioIzquierda = '';
    public $filtroDestinoIzquierda = '';
    public $filtroDistritoIzquierda = '';
    public $paqueteIzquierdaId = null;

    // Propiedades para la búsqueda y filtros DERECHA (directas, sin _Temp)
    public $busquedaDerecha = '';
    public $filtroPrecioDerecha = '';
    public $filtroDestinoDerecha = '';
    public $filtroDistritoDerecha = '';
    public $paqueteDerechaId = null;

    public $mostrarModalPago = false;
    public $mostrarRespuesta = null;
    public $valoracionHover;
    public $valoracion;
    public $nuevoComentario;

    // --- Métodos `updated*` para reiniciar la selección de paquete ---
    // Se ejecutan automáticamente cuando la propiedad correspondiente cambia
    public function updatedBusquedaIzquierda() { $this->paqueteIzquierdaId = null; }
    public function updatedFiltroPrecioIzquierda() { $this->paqueteIzquierdaId = null; }
    public function updatedFiltroDestinoIzquierda() { $this->paqueteIzquierdaId = null; }
    public function updatedFiltroDistritoIzquierda() { $this->paqueteIzquierdaId = null; }

    public function updatedBusquedaDerecha() { $this->paqueteDerechaId = null; }
    public function updatedFiltroPrecioDerecha() { $this->paqueteDerechaId = null; }
    public function updatedFiltroDestinoDerecha() { $this->paqueteDerechaId = null; }
    public function updatedFiltroDistritoDerecha() { $this->paqueteDerechaId = null; }

    // --- Métodos de Selección de Paquete (quedan igual) ---
    public function seleccionarIzquierda($id)
    {
        $this->paqueteIzquierdaId = (int) $id;
    }

    public function seleccionarDerecha($id)
    {
        $this->paqueteDerechaId = (int) $id;
    }

    // --- Métodos para Limpiar Filtros (ajustados para las propiedades directas) ---
    public function limpiarFiltrosDerecha()
    {
        $this->reset([
            'busquedaDerecha',
            'filtroPrecioDerecha',
            'filtroDestinoDerecha',
            'filtroDistritoDerecha',
            'paqueteDerechaId' // Reinicia también el paquete seleccionado
        ]);
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

    // --- Método `mount` (igual, solo para los distritos ordenados) ---
    public function mount($paqueteId = null)
    {
        // Esta línea es opcional si $this->paquetes no se usa para la lista general
        // $this->paquetes = Paquetes::all(); 

        // Cargar y ordenar los distritos alfabéticamente
        $this->distritos = Distritos::orderBy('namedistrito')->get(); 
        
        // Cargar los tipos de destino
        $this->tiposDestino = TipoDestinos::pluck('nametipo_destinos')->toArray();

        if ($paqueteId) {
            $this->cargarPaquete($paqueteId);
            $this->paqueteIzquierdaId = $paqueteId; 
        }
    }

    // --- Método `render` (llama a filtrarPaquetes con las propiedades directas) ---
    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';

        $paquetesIzquierda = $this->filtrarPaquetes(
            $this->busquedaIzquierda,
            $this->filtroPrecioIzquierda,
            $this->filtroDestinoIzquierda,
            $this->filtroDistritoIzquierda
        );

        $paquetesDerecha = $this->filtrarPaquetes(
            $this->busquedaDerecha,
            $this->filtroPrecioDerecha,
            $this->filtroDestinoDerecha,
            $this->filtroDistritoDerecha
        );

        $paqueteIzquierda = null;
        if ($this->paqueteIzquierdaId) {
            $paqueteIzquierda = Paquetes::with([
                'empresa', 'imagenes', 'det_paquete.destino', 'det_paquete.promos',
                'ser_paquete.servicio.Det_servicio', 'equi_paquete.equipo.Det_equipo',
                'dis_paquete', 'reservas', 'comentarios.users',
                'comentarios.respuestas.usuario', 'itinerarios.itinerariosRutas.ruta.rutasParadas.parada'
            ])->find($this->paqueteIzquierdaId);
        }

        $paqueteDerecha = null;
        if ($this->paqueteDerechaId) {
            $paqueteDerecha = Paquetes::with([
                'empresa', 'imagenes', 'det_paquete.destino', 'det_paquete.promos',
                'ser_paquete.servicio.Det_servicio', 'equi_paquete.equipo.Det_equipo',
                'dis_paquete', 'reservas', 'comentarios.users',
                'comentarios.respuestas.usuario', 'itinerarios.itinerariosRutas.ruta.rutasParadas.parada'
            ])->find($this->paqueteDerechaId);
        }

        return view('livewire.clientes.pantalladividida', [
            'paquetesIzquierda' => $paquetesIzquierda,
            'paqueteIzquierda' => $paqueteIzquierda,
            'paquetesDerecha' => $paquetesDerecha,
            'paqueteDerecha' => $paqueteDerecha,
            'distritos' => $this->distritos, // Pasar los distritos ordenados a la vista
            'tiposDestino' => $this->tiposDestino, // Pasar los tipos de destino a la vista
        ])->layout($layout);
    }

    // --- Método `filtrarPaquetes` (igual, trabaja con las propiedades directas) ---
    private function filtrarPaquetes($busqueda, $filtroPrecio, $filtroDestino, $filtroDistrito)
    {
        return Paquetes::query()
            ->when($busqueda, function ($query) use ($busqueda) {
                $query->where('nombrepaquete', 'like', '%' . $busqueda . '%')
                    ->orWhere('descripcion', 'like', '%' . $busqueda . '%');
            })
            ->when($filtroPrecio, function ($query) use ($filtroPrecio) {
                $query->orderBy('preciopaquete', $filtroPrecio);
            })
            ->when($filtroDestino, function ($query) use ($filtroDestino) {
                $query->whereHas('det_paquete.destino.tipoDestino', function ($q) use ($filtroDestino) {
                    $q->where('nametipo_destinos', $filtroDestino);
                });
            })
            ->when($filtroDistrito, function ($query) use ($filtroDistrito) {
                $query->whereHas('det_paquete.destino', function ($q) use ($filtroDistrito) {
                    $q->whereHas('distrito', function ($qq) use ($filtroDistrito) {
                        $qq->where('namedistrito', $filtroDistrito);
                    });
                });
            })
            ->with([
                'det_paquete.promos', 
                'det_paquete', 
                'imagenes' 
            ])
            ->get();
    }

    public function getTotalValoraciones()
    {
        return 0; // Valor de retorno temporal
    }

    public function cargarPaquete($id)
    {
        $this->paquete = Paquetes::with([
            'empresa', 'imagenes', 'det_paquete.destino', 'det_paquete.promos',
            'ser_paquete.servicio.Det_servicio', 'equi_paquete.equipo.Det_equipo',
            'dis_paquete', 'reservas', 'comentarios.users',
            'comentarios.respuestas.usuario', 'itinerarios.itinerariosRutas.ruta.rutasParadas.parada'
        ])->findOrFail($id);

        if ($this->paquete->dis_paquete->isNotEmpty()) {
            // Lógica si es necesario
        }
    }
}
    /*public function getPaquetesIzquierdaProperty()
    {
        $query = \App\Models\Paquetes::query();

        // Filtro de precio
        if ($this->filtroPrecioIzquierda) {
            $query->orderBy('preciopaquete', $this->filtroPrecioIzquierda);
        }

        // Filtro de tipo de destino
        if ($this->filtroDestinoIzquierda) {
            $query->whereHas('detalles.destino.tipoDestino', function ($q) {
                $q->where('nametipo_destinos', $this->filtroDestinoIzquierda);
            });
        }

        return $query->get();
    }*/