<?php

namespace App\Livewire\Clientes;

use App\Livewire\Promociones\Promociones;
use App\Models\Paquetes;

use Livewire\Component;
// use App\Models\Paquetes;
// use App\Models\Paquetes;

class Pantalladividida extends Component
{
    public $paquetes = [];
    public $promociones = [];
    public $paqueteIzquierdaId;
    public $paqueteDerechaId;
    public $busquedaIzquierda = '';
    public $busquedaDerecha = '';
    public function filtrarIzquierda() {}
    public function filtrarDerecha() {}


    public $filtroDuracionIzquierda = '';
    public $filtroPrecioIzquierda = '';
    public $filtroFechaInicioIzquierda = '';
    public $filtroFechaFinIzquierda = '';

    public $filtroPrecioDerecha = '';
    public $filtroFechaInicioDerecha = '';
    public $filtroFechaFinDerecha = '';
    public $filtroDestinoDerecha = '';

    // Variables temporales para los selects
    public $filtroPrecioDerechaTemp = '';
    public $filtroFechaInicioDerechaTemp = '';
    public $filtroFechaFinDerechaTemp = '';
    public $filtroDestinoDerechaTemp = '';
    // Variables temporales para los selects
    public $filtroPrecioIzquierdaTemp = '';
    public $filtroFechaInicioIzquierdaTemp = '';
    public $filtroFechaFinIzquierdaTemp = '';
    public $filtroDestinoIzquierdaTemp = '';



    // Si tienes relación con destinos y quieres filtrar por tipo:
    public $filtroDestinoIzquierda = '';


    public $duracionesDisponibles = [];
    public $tiposDestino = [];



    public function mount()
    {
        $this->paquetes = Paquetes::all();

        $this->tiposDestino = \App\Models\TipoDestinos::pluck('nametipo_destinos')->toArray();
    }
    public function seleccionarIzquierda($id)
    {
        $this->paqueteIzquierdaId = $id;
    }

    public function seleccionarDerecha($id)
    {
        $this->paqueteDerechaId = $id;
    }

    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';

        // FILTROS IZQUIERDA
        $paquetesIzquierda = \App\Models\Paquetes::query()
            ->when($this->busquedaIzquierda, function ($query) {
                $query->where('nombrepaquete', 'like', '%' . $this->busquedaIzquierda . '%');
            })
            ->when($this->filtroPrecioIzquierda, function ($query) {
                $query->orderBy('preciopaquete', $this->filtroPrecioIzquierda);
            })
            ->when($this->filtroDestinoIzquierda, function ($query) {
                $query->whereHas('detalles.destino.tipoDestino', function ($q) {
                    $q->where('nametipo_destinos', $this->filtroDestinoIzquierda);
                });
            })
            ->get();

        // FILTROS DERECHA (ajusta los nombres de variables según tus filtros)
        $paquetesDerecha = \App\Models\Paquetes::query()
            ->when($this->busquedaDerecha, function ($query) {
                $query->where('nombrepaquete', 'like', '%' . $this->busquedaDerecha . '%');
            })
            ->when($this->filtroPrecioDerecha, function ($query) {
                $query->orderBy('preciopaquete', $this->filtroPrecioDerecha);
            })
            ->when($this->filtroDestinoDerecha, function ($query) {
                $query->whereHas('detalles.destino.tipoDestino', function ($q) {
                    $q->where('nametipo_destinos', $this->filtroDestinoDerecha);
                });
            })
            ->get();

        $paqueteIzquierda = $paquetesIzquierda->firstWhere('id', $this->paqueteIzquierdaId);
        $paqueteDerecha = $paquetesDerecha->firstWhere('id', $this->paqueteDerechaId);

        return view('livewire.clientes.pantalladividida', [
            'paqueteIzquierda' => $paqueteIzquierda,
            'paqueteDerecha' => $paqueteDerecha,
            'paquetesIzquierda' => $paquetesIzquierda,
            'paquetesDerecha' => $paquetesDerecha,
        ])->layout($layout);
    }

    public function getPaquetesIzquierdaProperty()
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
    }

    public function aplicarFiltrosDerecha()
    {
        $this->filtroPrecioDerecha = $this->filtroPrecioDerechaTemp;
        $this->filtroFechaInicioDerecha = $this->filtroFechaInicioDerechaTemp;
        $this->filtroFechaFinDerecha = $this->filtroFechaFinDerechaTemp;
        $this->filtroDestinoDerecha = $this->filtroDestinoDerechaTemp;
    }
    public function aplicarFiltrosIzquierda()
    {
        $this->filtroPrecioIzquierda = $this->filtroPrecioIzquierdaTemp;
        $this->filtroFechaInicioIzquierda = $this->filtroFechaInicioIzquierdaTemp;
        $this->filtroFechaFinIzquierda = $this->filtroFechaFinIzquierdaTemp;
        $this->filtroDestinoIzquierda = $this->filtroDestinoIzquierdaTemp;
    }


}