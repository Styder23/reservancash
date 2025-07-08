<?php

namespace App\Livewire\Reservas;

use Livewire\Component;
use App\Models\Paquetes;
use App\Models\premios;
use App\Models\canjeos;
use App\Models\Reservas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetalleReservaempre extends Component
{
    public $paquetesReclamables = [];
    public $mensaje = '';
    public $tipoMensaje = '';
    public $showModal = false;
    public $paqueteSeleccionado = null;
    public $fechaViaje = '';
    public $cantidadPersonas = 1;
    public $notas = '';

    public function mount()
    {
        $this->cargarPaquetesReclamables();
    }

    public function cargarPaquetesReclamables()
    {
        // Obtener paquetes con precio menor o igual a 25 soles
        $this->paquetesReclamables = Paquetes::where('preciopaquete', '<=', 25)
            ->where('estado', 1) // Solo paquetes activos
            ->with(['empresa', 'detalles.destino'])
            ->get();
    }

    public function iniciarReclamo($paqueteId)
    {
        if (!Auth::check()) {
            $this->mensaje = 'Debes iniciar sesión para reclamar paquetes';
            $this->tipoMensaje = 'error';
            return;
        }

        // Verificar si el usuario tiene premios disponibles
        $premio = premios::where('fk_iduser', Auth::id())->first();
        
        if (!$premio || $premio->cantidad_reservas < 5) {
            $this->mensaje = 'No tienes premios disponibles. Necesitas 5 reservas confirmadas para reclamar un paquete gratis.';
            $this->tipoMensaje = 'warning';
            return;
        }

        $this->paqueteSeleccionado = Paquetes::find($paqueteId);
        
        if (!$this->paqueteSeleccionado) {
            $this->mensaje = 'Paquete no encontrado';
            $this->tipoMensaje = 'error';
            return;
        }

        // Limpiar campos del modal
        $this->fechaViaje = '';
        $this->cantidadPersonas = 1;
        $this->notas = '';
        
        // Mostrar modal para completar datos de la reserva
        $this->showModal = true;
    }

    public function confirmarReclamo()
    {
        // Validar datos
        $this->validate([
            'fechaViaje' => 'required|date|after:today',
            'cantidadPersonas' => 'required|integer|min:1',
        ], [
            'fechaViaje.required' => 'La fecha de viaje es obligatoria',
            'fechaViaje.date' => 'La fecha debe ser válida',
            'fechaViaje.after' => 'La fecha de viaje debe ser posterior a hoy',
            'cantidadPersonas.required' => 'La cantidad de personas es obligatoria',
            'cantidadPersonas.integer' => 'La cantidad debe ser un número entero',
            'cantidadPersonas.min' => 'Debe ser al menos 1 persona',
        ]);

        try {
            DB::beginTransaction();

            // Crear la reserva con precio 0 (gratis)
            $reserva = Reservas::create([
                'fechareserva' => now(),
                'fecha_viaje' => $this->fechaViaje,
                'fk_idpaquete' => $this->paqueteSeleccionado->id,
                'fk_idusers' => Auth::id(),
                'cantidad_personas' => $this->cantidadPersonas,
                'estado' => 'confirmada', // Estado confirmado porque es un premio
                'metodo_pago' => 'premio', // Indicar que es un premio
                'total_pago' => 0.00, // Precio 0 porque es gratis
                'notas' => $this->notas ? $this->notas : 'Reserva canjeada por premio de fidelidad'
            ]);

            // Crear el registro de canjeo
            canjeos::create([
                'fk_iduser' => Auth::id(),
                'fk_idreserva' => $reserva->id,
                'fk_idclientereserva' => null, // Usar el ID de la reserva
                'fecha_canjeo' => now()
            ]);

            // Obtener el premio del usuario
            $premio = premios::where('fk_iduser', Auth::id())->first();
            
            // Usar el método del modelo para canjear el premio
            $premio->canjearPremio();
            
            // Resetear el contador de reservas
            $premio->update(['cantidad_reservas' => 0]);

            DB::commit();

            $this->mensaje = '¡Paquete reclamado exitosamente! Tu reserva ha sido confirmada y tu contador de reservas se ha reiniciado.';
            $this->tipoMensaje = 'success';
            
            // Cerrar modal y recargar datos
            $this->showModal = false;
            $this->paqueteSeleccionado = null;
            $this->cargarPaquetesReclamables();
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Registrar el error en el log para debugging
            \Log::error('Error al reclamar paquete: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'paquete_id' => $this->paqueteSeleccionado->id,
                'trace' => $e->getTraceAsString()
            ]);
            
            $this->mensaje = 'Error al reclamar el paquete: ' . $e->getMessage();
            $this->tipoMensaje = 'error';
        }
    }

    public function cerrarModal()
    {
        $this->showModal = false;
        $this->paqueteSeleccionado = null;
        $this->fechaViaje = '';
        $this->cantidadPersonas = 1;
        $this->notas = '';
    }

    public function cerrarMensaje()
    {
        $this->mensaje = '';
        $this->tipoMensaje = '';
    }

    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.reservas.detalle-reservaempre')->layout($layout);
    }
}