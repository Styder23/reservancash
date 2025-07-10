<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Paquetes;
use App\Models\Itinerarios;
use App\Models\UserItinerario;

class Inicio extends Component
{
    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.inicio')->layout($layout);
    }

    public $destinos = [];
    public $servicios = [];
    public $detalle_paquetes = [];
    public $paquetes = [];
    public $empresas = [];
    public $paquetesConPromocion = [];
    public $itinerarios = [];
    public $rangosPrecio = [];
    public $rangosDuracion = [];
    public $distritos = [];

    public $userItinierario = [];
    public $resenas;


    // Funcion para mostrar los destinos
    public function mount()
    {
        $this->destinos = \App\Models\Destinos::all();
        $this->servicios = \App\Models\Servicios::all();
        $this->detalle_paquetes = \App\Models\DetallePaquetes::all();
        $this->paquetes = \App\Models\Paquetes::all();
        $this->empresas = \App\Models\Empresas::all();
        $this->itinerarios = \App\Models\Itinerarios::all();
        $this->distritos = \App\Models\Distritos::all();

        $this->paquetes = Paquetes::whereHas('detalles', function ($q) {
            $q->whereNotNull('fk_idpromociones');
        })
            ->with('detalles')
            ->get();


        // Todos los paquetes
        $this->paquetes = Paquetes::with('detalles')->get();



        $this->cargarResenas();



        // Solo paquetes con promoción y descuento
        $this->paquetesConPromocion = Paquetes::whereHas('detalles', function ($q) {
            $q->whereNotNull('fk_idpromociones');
        })
            ->whereHas('detalles.promocion', function ($q) {
                $q->where('descuento', '>', 0);
            })
            ->with('detalles.promocion')
            ->get();



        // Carga los 3 primeros itinerarios con su paquete y rutas relacionadas
        $this->itinerarios = Itinerarios::with([
            'paquete',
            'itinerariosRutas.ruta',
            'itinerariosRutas.ruta.rutasParadas.parada'
        ])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();




        // Calcular rangos de precio dinámicos
        $precioMin = \App\Models\Paquetes::min('preciopaquete');
        $precioMax = \App\Models\Paquetes::max('preciopaquete');

        $precioMin = floor($precioMin);
        $precioMax = ceil($precioMax);

        $rangosPrecio = [];
        $inicio = $precioMin;
        while ($inicio < $precioMax) {
            $fin = $inicio + 20;
            $rangosPrecio[] = [
                'min' => $inicio,
                'max' => $fin,
                'label' => "S/ {$inicio} - S/ {$fin}",
            ];
            $inicio = $fin;
        }
        $this->rangosPrecio = $rangosPrecio;




        // Cargar duraciones de la tabla paquete_disponibilidad
        $duraciones = \DB::table('paquete_disponibilidad')
            ->selectRaw('DATEDIFF(fecha_fin, fecha_inicio) as dias')
            ->whereNotNull('fecha_inicio')
            ->whereNotNull('fecha_fin')
            ->get()
            ->pluck('dias')
            ->filter(function ($dias) {
                return $dias > 0;
            });

        // Calcula el mínimo y máximo de días
        $minDuracion = $duraciones->min();
        $maxDuracion = $duraciones->max();

        // Genera rangos de 2 en 2 días (puedes ajustar el rango)
        $rangosDuracion = [];
        $inicio = $minDuracion;
        $salto = 3; // Cambia a 1, 3, 5, etc. según prefieras
        while ($inicio <= $maxDuracion) {
            $fin = $inicio + $salto - 1;
            $label = $fin > $maxDuracion
                ? "{$inicio} días o más"
                : "{$inicio} - {$fin} días";
            $rangosDuracion[] = [
                'min' => $inicio,
                'max' => $fin > $maxDuracion ? $maxDuracion : $fin,
                'label' => $label,
            ];
            $inicio += $salto;
        }
        $this->rangosDuracion = $rangosDuracion;
    }


    // Función para obtener el número total de valoraciones
    public function getTotalValoraciones()
    {
        return $this->paquete->comentarios()->whereNotNull('estrellas')->count();
    }




    // Carga las reseñas
    public function cargarResenas()
    {
        $paquetes = Paquetes::with(['empresa', 'userItinerarios.users'])
            ->where('estado', 1)
            ->take(3)
            ->get();

        $comentarios = UserItinerario::with(['users', 'paquete.empresa'])
            ->whereNotNull('comentario')
            ->latest('fecha')
            ->take(3)
            ->get();

        $this->resenas = $comentarios->map(function ($comentario, $index) use ($paquetes) {
            return [
                'paquete' => $paquetes->get($index),
                'comentario' => $comentario
            ];
        });
    }
}
