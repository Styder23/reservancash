<?php

namespace App\Livewire\Paquetes;

use Livewire\Component;
use App\Models\ClientePaquete;
use App\Models\ClienteServicio;
use App\Models\ClienteEquipo;
use App\Models\ClienteDestino;
use App\Models\ClienteReserva;
use App\Models\Paquetes;
use App\Models\Reservas;
use App\Models\Pagos;
use App\Models\premios;
use App\Models\UserItinerario;
use App\Models\RespuestasComentarios;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DetallePaquete extends Component
{
    use WithFileUploads;
    
    public $paquete;
    public $fechaSeleccionada;
    public $personas = 1;
    public $mostrarFormularioPersonalizacion = false;
    public $mostrarModalPago = false;
    public $metodoPago = 'transferencia';
    public $comprobantePago;
    public $notasReserva;
    public $serviciosSeleccionados = [];
    public $equiposSeleccionados = [];
    public $destinosSeleccionados = [];

    //para los comentarios
    public $nuevoComentario = '';
    public $nuevaRespuesta = '';
    public $mostrarRespuesta = null;
    public $valoracion = 0; // Nueva propiedad para la valoración
    public $valoracionHover = 0;
    
    protected $rules = [
        'fechaSeleccionada' => 'required|date',
        'personas' => 'required|numeric|min:1|max:10',
        'serviciosSeleccionados' => 'array',
        'equiposSeleccionados' => 'array',
        'destinosSeleccionados' => 'array',
        'metodoPago' => 'required|in:transferencia,yape,plin',
        'comprobantePago' => 'required_if:metodoPago,yape,plin|image|max:2048',
        'notasReserva' => 'nullable|string|max:500',
        'nuevoComentario' => 'required|min:5|max:500',
        'nuevaRespuesta' => 'required|min:3|max:300',
        'valoracion' => 'required|numeric|min:1|max:5',
    ];

    protected $messages = [
        'fechaSeleccionada.required' => 'Debes seleccionar una fecha de viaje.',
        'personas.required' => 'Debes indicar el número de personas.',
        'personas.min' => 'El mínimo de personas es 1.',
        'personas.max' => 'El máximo de personas es 10.',
        'comprobantePago.required_if' => 'Debes subir el comprobante de pago para Yape o Plin.',
        'comprobantePago.image' => 'El comprobante debe ser una imagen.',
        'comprobantePago.max' => 'El comprobante no debe superar los 2MB.',
        'nuevoComentario.required' => 'El comentario es obligatorio.',
        'nuevoComentario.min' => 'El comentario debe tener al menos 5 caracteres.',
        'nuevoComentario.max' => 'El comentario no puede superar los 500 caracteres.',
        'nuevaRespuesta.required' => 'La respuesta es obligatoria.',
        'nuevaRespuesta.min' => 'La respuesta debe tener al menos 3 caracteres.',
        'nuevaRespuesta.max' => 'La respuesta no puede superar los 300 caracteres.',
        'valoracion.required' => 'Debes seleccionar una valoración.',
        'valoracion.min' => 'La valoración mínima es 1 estrella.',
        'valoracion.max' => 'La valoración máxima es 5 estrellas.',
    ];

    public function mount($id)
    {
        $this->cargarPaquete($id);
    }
  
    // Función para establecer la valoración
    public function setValoracion($valor)
    {
        $this->valoracion = $valor;
    }

    // Función para el efecto hover
    public function setValoracionHover($valor)
    {
        $this->valoracionHover = $valor;
    }

    // Función para limpiar el hover
    public function clearHover()
    {
        $this->valoracionHover = 0;
    }

    //funciones para los comentarios
        public function agregarComentario()
        {
            $this->validate([
                'nuevoComentario' => 'required|min:5|max:500',
                'valoracion' => 'required|numeric|min:1|max:5'
            ]);
            
            UserItinerario::create([
                'comentario' => $this->nuevoComentario,
                'fecha' => now(),
                'fk_idusers' => auth()->id(),
                'fk_idpaquete' => $this->paquete->id,
                'estrellas' => $this->valoracion, // Guardar la valoración
            ]);
            
            $this->nuevoComentario = '';
            $this->valoracion = 0; // Resetear la valoración
            $this->cargarPaquete($this->paquete->id); // Recargar con las relaciones
            
            // Mensaje de éxito
            session()->flash('message', 'Comentario y valoración agregados exitosamente');
        }


    public function toggleRespuesta($comentarioId)
    {
        $this->mostrarRespuesta = $this->mostrarRespuesta === $comentarioId ? null : $comentarioId;
        $this->nuevaRespuesta = '';
    }

    public function cancelarRespuesta()
    {
        $this->mostrarRespuesta = null;
        $this->nuevaRespuesta = '';
    }

    public function agregarRespuesta($comentarioId)
    {
        $this->validateOnly('nuevaRespuesta');
        
        RespuestasComentarios::create([
            'fk_idcomentario' => $comentarioId,
            'fk_idusers' => auth()->id(),
            'respuesta' => $this->nuevaRespuesta,
            'fecha_respuesta' => now(),
        ]);
        
        $this->nuevaRespuesta = '';
        $this->mostrarRespuesta = null;
        $this->cargarPaquete($this->paquete->id); // Recargar con las relaciones
        
        // Mensaje de éxito
        session()->flash('message', 'Respuesta agregada exitosamente');
    }

    public function getPromedioValoracion()
    {
        $comentarios = $this->paquete->comentarios()->whereNotNull('estrellas')->get();
        if ($comentarios->count() > 0) {
            return round($comentarios->avg('estrellas'), 1);
        }
        return 0;
    }

    // Función para obtener el número total de valoraciones
    public function getTotalValoraciones()
    {
        return $this->paquete->comentarios()->whereNotNull('estrellas')->count();
    }
    
    public function updatedFechaSeleccionada($value)
    {
        $this->validate([
            'fechaSeleccionada' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    $disponibilidad = $this->paquete->dis_paquete->first();
                    if (!$disponibilidad) {
                        $fail('No hay disponibilidad para este paquete.');
                        return;
                    }
                    
                    if ($value < $disponibilidad->fecha_inicio || $value > $disponibilidad->fecha_fin) {
                        $fail('La fecha seleccionada no está dentro del rango disponible.');
                    }
                }
            ]
        ]);
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
            'reservas',
            'comentarios.users',
            'comentarios.respuestas.usuario',
        ])->findOrFail($id);

        if ($this->paquete->dis_paquete->isNotEmpty()) {
            $this->fechaSeleccionada = $this->paquete->dis_paquete->first()->fecha_inicio;
        }
    }

    public function abrirModalPago()
    {
        $this->validate([
            'fechaSeleccionada' => 'required',
            'personas' => 'required|numeric|min:1|max:10'
        ]);
        
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar disponibilidad - CORREGIDO
        $disponibilidad = $this->paquete->dis_paquete->first();
        if (!$disponibilidad) {
            $this->dispatch('mostrarAlerta', [
                'tipo' => 'error',
                'mensaje' => 'No hay disponibilidad configurada para este paquete.'
            ]);
            return;
        }
        
        $cuposDisponibles = $disponibilidad->cupo - $this->paquete->reservas->count();
        if ($cuposDisponibles < $this->personas) {
            $this->dispatch('mostrarAlerta', [
                'tipo' => 'error',
                'mensaje' => "Solo quedan {$cuposDisponibles} cupos disponibles para la cantidad de personas seleccionadas."
            ]);
            return;
        }
        
        $this->mostrarModalPago = true;
    }

    public function cerrarModal()
    {
        $this->mostrarModalPago = false;
        $this->reset(['metodoPago', 'comprobantePago', 'notasReserva']);
        $this->metodoPago = 'transferencia'; // valor por defecto
    }

    protected $listeners = [
        'abrirModalPago' => 'abrirModalPago'
    ];
    
    public function emitirAlerta($tipo, $mensaje)
    {
        $this->dispatch('mostrarAlerta', [
            'tipo' => $tipo,
            'mensaje' => $mensaje
        ]);
    }
    
    private function calcularPrecioTotal()
    {
        $personasIncluidas = $this->paquete->personas_incluidas ?? 1;
        $precioBase = $this->paquete->preciopaquete;
        
        // Si hay más personas que las incluidas, calcular el extra
        if ($this->personas > $personasIncluidas) {
            $personasExtra = $this->personas - $personasIncluidas;
            $precioBase += $personasExtra * $this->paquete->precio_extra_persona;
        } else {
            $precioBase = $this->paquete->preciopaquete;
        }
        
        // Aplicar descuento si hay promoción
        if ($this->paquete->det_paquete->first()->promos) {
            $descuento = $this->paquete->det_paquete->first()->promos->descuento;
            $precioBase = $precioBase * (1 - $descuento / 100);
        }
        
        return $precioBase;
    }
    
    public function reservar()
    {
        $this->validate([
            'fechaSeleccionada' => 'required|date|after_or_equal:today',
            'personas' => 'required|numeric|min:1|max:10',
            'metodoPago' => 'required|in:transferencia,yape,plin', // minúsculas
            // 'comprobantePago' => 'required_if:metodoPago,yape,plin|image|max:2048', // minúsculas
            'notasReserva' => 'nullable|string|max:500'
        ]);
        
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar disponibilidad - CORREGIDO
        $disponibilidad = $this->paquete->dis_paquete->first();
        if (!$disponibilidad) {
            $this->dispatch('mostrarAlerta', [
                'tipo' => 'error',
                'mensaje' => 'No hay disponibilidad configurada para este paquete.'
            ]);
            return;
        }
        
        $cuposDisponibles = $disponibilidad->cupo - $this->paquete->reservas->count();
        if ($cuposDisponibles < $this->personas) {
            $this->dispatch('mostrarAlerta', [
                'tipo' => 'error',
                'mensaje' => "Solo quedan {$cuposDisponibles} cupos disponibles para la fecha seleccionada."
            ]);
            return;
        }
        
        DB::beginTransaction();
        try {
            $precioTotal = $this->calcularPrecioTotal();
            
            $reserva = Reservas::create([
                'fechareserva' => now(),
                'fecha_viaje' => $this->fechaSeleccionada,
                'fk_idpaquete' => $this->paquete->id,
                'fk_idusers' => Auth::id(),
                'cantidad_personas' => $this->personas,
                'estado' => 'pendiente',
                'metodo_pago' => $this->metodoPago,
                'total_pago' => $precioTotal,
                'notas' => $this->notasReserva
            ]);

            // Procesar pago
            if (in_array($this->metodoPago, ['yape', 'plin', 'transferencia'])) {
                $rutaComprobante = $this->comprobantePago->store('comprobantes', 'public');
                
                Pagos::create([
                    'metodo' => $this->metodoPago,
                    'comprobante_pago' => $rutaComprobante,
                    'estado' => 'pendiente',
                    'fecha_pago' => now(),
                    'fk_idreserva' => $reserva->id
                ]);
            }
            
            // Guardar servicios/equipos adicionales si se personalizó
            if (!empty($this->serviciosSeleccionados)) {
                $reserva->servicios()->attach($this->serviciosSeleccionados);
            }
            
            if (!empty($this->equiposSeleccionados)) {
                $reserva->equipos()->attach($this->equiposSeleccionados);
            }
            

            DB::commit();
            
            // Enviar notificación por email
            // Auth::user()->notify(new ReservaCreada($reserva));
            
            $this->dispatch('mostrarAlerta', [
                'tipo' => 'success',
                'mensaje' => '¡Reserva realizada con éxito!'
            ]);
            
            return redirect()->route('reservacli');
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('mostrarAlerta', [
                'tipo' => 'error',
                'mensaje' => 'Error al procesar la reserva: ' . $e->getMessage()
            ]);
        }
    }

    public function validarCampos()
    {
        $errores = [];
        
        if (!$this->fechaSeleccionada) {
            $errores[] = 'Debes seleccionar una fecha de viaje';
        }
        
        if (!$this->personas || $this->personas < 1 || $this->personas > 10) {
            $errores[] = 'Ingresa un número válido de personas (1-10)';
        }
        
        // Verificar disponibilidad - CORREGIDO
        $disponibilidad = $this->paquete->dis_paquete->first();
        if ($disponibilidad) {
            $cuposDisponibles = $disponibilidad->cupo - $this->paquete->reservas->count();
            if ($cuposDisponibles < $this->personas) {
                $errores[] = "Solo quedan {$cuposDisponibles} cupos disponibles";
            }
        } else {
            $errores[] = "No hay disponibilidad configurada para este paquete";
        }
        
        if (!empty($errores)) {
            $this->dispatch('validationError', [
                'mensaje' => implode('. ', $errores)
            ]);
            return false;
        }
        
        return true;
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

    public function render()
    {
        return view('livewire.paquetes.detalle-paquete')
            ->layout(auth()->check() ? 'layouts.prueba' : 'layouts.guest')
            ->title($this->paquete->nombrepaquete ?? 'Detalle del Paquete');
    }

    // public $whatsappActivo = false;

    // public function contactarWhatsApp($paqueteId)
    // {
    //     $this->whatsappActivo = true;

    //     // Guardar el paquete como "contactado" en sesión
    //     $contactados = session()->get('paquetesContactados', []);
    //     if (!in_array($paqueteId, $contactados)) {
    //         $contactados[] = $paqueteId;
    //         session(['paquetesContactados' => $contactados]);
    //     }
    // }
}