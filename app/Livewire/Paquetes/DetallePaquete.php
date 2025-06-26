<?php

namespace App\Livewire\Paquetes;

use Livewire\Component;
use App\Models\Paquetes;
use App\Models\ClientePaquete;
use App\Models\ClienteServicio;
use App\Models\ClienteEquipo;
use App\Models\ClienteDestino;
use App\Models\ClienteReserva;
use App\Models\Reservas;
use Illuminate\Support\Facades\Auth;

class DetallePaquete extends Component
{
    public $paquete;
    public $fechaSeleccionada;
    public $personas = 1;
    public $mostrarFormularioPersonalizacion = false;
    public $serviciosSeleccionados = [];
    public $equiposSeleccionados = [];
    public $destinosSeleccionados = [];

    protected $rules = [
        'fechaSeleccionada' => 'required',
        'personas' => 'required|numeric|min:1',
        'serviciosSeleccionados' => 'array',
        'equiposSeleccionados' => 'array',
        'destinosSeleccionados' => 'array'
    ];

    public function mount($id)
    {
        $this->cargarPaquete($id);
    }

    public function cargarPaquete($id)
    {
        $this->paquete = Paquetes::with([
            'empresa',
            'imagenes',
            'det_paquete.destino',
            'det_paquete.promos',
            'ser_paquete.servicio.Det_servicio',
            'equi_paquete.equipo.Det_equipo',
            'dis_paquete',
            'reservas'
        ])->findOrFail($id);

        if ($this->paquete->dis_paquete->isNotEmpty()) {
            $this->fechaSeleccionada = $this->paquete->dis_paquete->first()->fecha_inicio;
        }
    }

    public function reservar()
    {
        $this->validate([
            'fechaSeleccionada' => 'required',
            'personas' => 'required|numeric|min:1'
        ]);

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Crear reserva directa
        Reservas::create([
            'fechareserva' => now(),
            'fk_idpaquete' => $this->paquete->id,
            'fk_idusers' => Auth::id(),
        ]);

        session()->flash('success', 'Reserva realizada con éxito');
        return redirect()->route('reservacli');
    }

    public function personalizarPaquete()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->mostrarFormularioPersonalizacion = true;
    }

    public function guardarPaquetePersonalizado()
    {
        $this->validate();

        // Crear paquete personalizado
        $clientePaquete = ClientePaquete::create([
            'preciototal' => $this->calcularPrecioTotal(),
            'fechacreacion' => now(),
            'estado' => 'borrador',
            'fk_iduser' => Auth::id(),
            'fk_idpaquete' => $this->paquete->id
        ]);

        // Guardar elementos personalizados
        $this->guardarElementosPersonalizados($clientePaquete);

        $this->mostrarFormularioPersonalizacion = false;
        session()->flash('success', 'Paquete personalizado guardado');
        return redirect()->route('paquetecliente');
    }

    protected function guardarElementosPersonalizados($clientePaquete)
    {
        foreach ($this->serviciosSeleccionados as $servicioId) {
            ClienteServicio::create([
                'fk_idclientepaquete' => $clientePaquete->id,
                'fk_idservicio' => $servicioId
            ]);
        }

        foreach ($this->equiposSeleccionados as $equipoId) {
            ClienteEquipo::create([
                'fk_idclientepaquete' => $clientePaquete->id,
                'fk_idequipo' => $equipoId
            ]);
        }

        foreach ($this->destinosSeleccionados as $destinoId) {
            ClienteDestino::create([
                'fk_idclientepaquete' => $clientePaquete->id,
                'fk_iddestino' => $destinoId
            ]);
        }
    }

    public function confirmarReservaPersonalizada($clientePaqueteId)
    {
        $clientePaquete = ClientePaquete::findOrFail($clientePaqueteId);

        ClienteReserva::create([
            'fechareserva' => now(),
            'estado' => 'pendiente',
            'confirmado_por_empresa' => false,
            'fk_idpaquetecliente' => $clientePaquete->id,
            'fk_idusers' => Auth::id()
        ]);

        $clientePaquete->update(['estado' => 'confirmado']);

        session()->flash('success', 'Reserva personalizada confirmada');
        return redirect()->route('mis-reservas');
    }

    private function calcularPrecioTotal()
    {
        $precioBase = $this->paquete->preciopaquete * $this->personas;

        // Añadir servicios adicionales
        $servicios = $this->paquete->ser_paquete
            ->whereIn('servicio.id', $this->serviciosSeleccionados)
            ->pluck('servicio');
        
        foreach ($servicios as $servicio) {
            $precioBase += $servicio->Det_servicio->precio_servicio ?? 0;
        }

        // Añadir equipos adicionales
        $equipos = $this->paquete->equi_paquete
            ->whereIn('equipo.id', $this->equiposSeleccionados)
            ->pluck('equipo');
        
        foreach ($equipos as $equipo) {
            $precioBase += $equipo->Det_equipo->precio_equipo ?? 0;
        }

        return $precioBase;
    }

    public function render()
    {
        return view('livewire.paquetes.detalle-paquete')
            ->layout(auth()->check() ? 'layouts.prueba' : 'layouts.guest')
            ->title($this->paquete->nombrepaquete ?? 'Detalle del Paquete');
    }
}