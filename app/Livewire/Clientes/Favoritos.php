<?php

namespace App\Livewire\Clientes;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\favoritos as FavoritosModel;
use App\Models\Paquetes; // Importa los modelos directamente
use App\Models\Detalle_Equipo;
use App\Models\Detalle_Servicio;
use App\Models\Destinos;
use Illuminate\Database\Query\Builder; // Para el tipo hint

class Favoritos extends Component
{
    public $search = '';
    public $paqueteId = null;

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
        return match ($type) {
            'paquete' => Paquetes::class, // Usa ::class para obtener el string completo
            'equipo' => Detalle_Equipo::class,
            'servicio' => Detalle_Servicio::class,
            'destino' => Destinos::class,
            default => null
        };
    }

    // --- PROPIEDADES COMPUTADAS CON JOIN EXPLÍCITO ---

    public function getPaquetesProperty()
    {
        $query = Auth::user()->favoritos()
            ->where('favoritable_type', Paquetes::class)
            ->join('paquetes', 'table_favoritos.favoritable_id', '=', 'paquetes.id') // Asegúrate que 'paquetes' sea el nombre real de tu tabla
            ->select('paquetes.*'); // Selecciona solo las columnas del paquete

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('paquetes.nombrepaquete', 'like', '%' . $this->search . '%')
                  ->orWhere('paquetes.descripcion', 'like', '%' . $this->search . '%');
            });
        }
        
        // dd($query->toSql(), $query->getBindings()); // Para depurar la consulta
        return $query->get(); // Retorna directamente la colección de Paquetes
    }

    public function getEquiposProperty()
    {
        $query = Auth::user()->favoritos()
            ->where('favoritable_type', Detalle_Equipo::class)
            ->join('detalle_equipos', 'table_favoritos.favoritable_id', '=', 'detalle_equipos.id') // Asegúrate que 'detalle_equipos' sea el nombre real de tu tabla
            ->select('detalle_equipos.*'); // Selecciona solo las columnas del equipo

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('detalle_equipos.name_equipo', 'like', '%' . $this->search . '%')
                  ->orWhere('detalle_equipos.descripcion_equipo', 'like', '%' . $this->search . '%');
            });
        }

        // dd($query->toSql(), $query->getBindings()); // Para depurar la consulta
        return $query->get(); // Retorna directamente la colección de Equipos
    }

    public function getServiciosProperty()
    {
        $query = Auth::user()->favoritos()
            ->where('favoritable_type', Detalle_Servicio::class)
            ->join('detalle_servicios', 'table_favoritos.favoritable_id', '=', 'detalle_servicios.id') // Asegúrate que 'detalle_servicios' sea el nombre real de tu tabla
            ->select('detalle_servicios.*'); // Selecciona solo las columnas del servicio

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('detalle_servicios.nombreservicio', 'like', '%' . $this->search . '%')
                  ->orWhere('detalle_servicios.descripcionservicio', 'like', '%' . $this->search . '%');
            });
        }

        return $query->get();
    }

    public function getDestinosProperty()
    {
        $query = Auth::user()->favoritos()
            ->where('favoritable_type', Destinos::class)
            ->join('destinos', 'table_favoritos.favoritable_id', '=', 'destinos.id') // Asegúrate que 'destinos' sea el nombre real de tu tabla
            ->select('destinos.*'); // Selecciona solo las columnas del destino

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('destinos.namedestino', 'like', '%' . $this->search . '%')
                  ->orWhere('destinos.descripciondestino', 'like', '%' . $this->search . '%');
            });
        }

        return $query->get();
    }

    // --- FIN PROPIEDADES COMPUTADAS CON JOIN EXPLÍCITO ---

    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';

        // Tu lógica de paqueteId si aún la usas
        $paquete = null;
        if ($this->paqueteId) {
            $paquete = Paquetes::with([
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
            ])->find($this->paqueteId);
        }

        return view('livewire.clientes.favoritos', [
            'paquetes' => $this->paquetes,
            'equipos' => $this->equipos,
            'servicios' => $this->servicios,
            'destinos' => $this->destinos
        ])->layout($layout);
    }

    public function limpiarFiltros()
    {
        $this->reset([
            'search',
            'paqueteId'
        ]);
    }
}