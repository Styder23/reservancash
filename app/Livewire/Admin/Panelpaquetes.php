<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Paquetes;
use App\Models\PaqueteEquipos;
use App\Models\PaqueteServicios;
use App\Models\DisponibilidadPaquete;
use App\Models\DetallePaquetes;
use App\Models\Empresas;
use App\Models\Equipos;
use App\Models\Servicios;
use App\Models\Paradas;
use App\Models\Rutas;
use App\Models\ParadasxRutas;
use App\Models\Imagenes;
use App\Models\Itinerarios;
use App\Models\itinerarioxruta;
use App\Models\Promociones;
use App\Models\Destinos;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Panelpaquetes extends Component
{
    use WithFileUploads;

    // Datos del paquete principal
    public $nombrepaquete = '';
    public $preciopaquete = 0;
    public $cantidadpaquete = '';
    public $descripcion = '';
    public $imagen_principal;
    public $estado = 'activo';
    public $fk_idempresa;
    public $paquetes;
    public $destinos;

    // Datos del detalle del paquete
    public $descripciondetalle;
    public $fk_iddestino = '';
    public $fk_idpromociones = '';
    public $empresas_disponibles = '';
    public $precioequipo = '';
    public $precioservicio = '';
    public $preciototal = '';

    // Servicios y equipos seleccionados
    public $servicios_seleccionados = [];
    public $equipos_seleccionados = [];

    // Disponibilidad
    public $disponibilidades = [];
    public $nueva_fecha_inicio = '';
    public $nueva_fecha_fin = '';
    public $nuevo_cupo = '';

    // Imágenes adicionales
    public $imagenes_adicionales = [];

    // Colecciones para los selects
    public $servicios_disponibles = [];
    public $equipos_disponibles = [];
    public $destinos_disponibles = [];
    public $promociones_disponibles = [];

    // itinerarios
    public $itinerarios = [];
    public $nueva_ruta = '';
    public $nueva_parada = '';
    public $rutas = [];
    public $paradas = [];

    // Variables para el itinerario
    public $itinerario_dia = '';
    public $itinerario_hora_inicio = '';
    public $itinerario_hora_fin = '';
    public $itinerario_descripcion = '';
    public $buscar_ruta = '';
    public $buscar_parada = '';
    public $rutas_filtradas = [];
    public $paradas_filtradas = [];
    public $rutas_seleccionadas = [];
    public $mostrar_modal_paradas = false;
    public $ruta_editando = [
        'id' => null,
        'nombre' => '',
        'paradas' => []
    ];
    public $indice_ruta_editando = null;
    
    public $mostrar_modal_rutas = false;
    public $mostrar_modal_paradas_lista = false;
    
    public $modoEdicion = false;
    public $paquete_editando_id = null;
    public $paquete_a_eliminar = null;

    // Control de pestañas
    public $tab_activo = 'general';

    public $mostrarModal = false;
    public $search = '';

    // Validaciones
    protected $rules = [
        'nombrepaquete' => 'required|string|max:255',
        'preciopaquete' => 'required|numeric|min:0',
        'cantidadpaquete' => 'required|integer|min:1',
        'descripcion' => 'nullable|string',
        'descripciondetalle' => 'required|string|max:255',
        'fk_iddestino' => 'required|exists:destinos,id',
        'servicios_seleccionados' => 'required|array|min:1',
        'equipos_seleccionados' => 'required|array|min:1',
        'disponibilidades' => 'required|array|min:1',
        'itinerario_dia' => 'required|string',
        'itinerario_hora_inicio' => 'required|date_format:H:i',
        'itinerario_hora_fin' => 'nullable|date_format:H:i|after:itinerario_hora_inicio',
        'rutas_seleccionadas' => 'sometimes|array',
        'ruta_editando.paradas' => 'sometimes|array'
    ];

    protected $messages = [
        'nombrepaquete.required' => 'El nombre del paquete es obligatorio',
        'preciopaquete.required' => 'El precio del paquete es obligatorio',
        'cantidadpaquete.required' => 'La cantidad del paquete es obligatoria',
        'fk_iddestino.required' => 'Debe seleccionar un destino',
        'servicios_seleccionados.required' => 'Debe seleccionar al menos un servicio',
        'equipos_seleccionados.required' => 'Debe seleccionar al menos un equipo',
        'disponibilidades.required' => 'Debe agregar al menos una fecha de disponibilidad',
    ];

    public function mount()
    {
        $this->fk_idempresa = auth()->user()->empresa_id ?? 1;
        $this->servicios_seleccionados = [];
        $this->equipos_seleccionados = [];
        $this->disponibilidades = [];
        $this->rutas_seleccionadas = [];
        $this->cargarDatos();
        $this->cargarRutas();
        $this->cargarParadas();
        $this->cargarItinerarios();
    }

    public function cargarDatos()
    {
        // Cargar datos de relaciones
        $this->servicios_disponibles = Servicios::with('Det_servicio')->get();
        $this->equipos_disponibles = Equipos::with('Det_equipo')->get();
        $this->destinos_disponibles = Destinos::all();
        $this->promociones_disponibles = Promociones::all();
        $this->empresas_disponibles = Empresas::all();
        
        // Cargar paquetes de la empresa del usuario
        $this->paquetes = Paquetes::with([
            'det_paquete.destino',
            'dis_paquete',
            'ser_paquete.servicio',
            'equi_paquete.equipo',
            'empresa' // Agregué esta relación que ya tienes en el modelo
        ])
        ->where('fk_idempresa', $this->fk_idempresa)
        ->orderBy('id', 'desc')
        ->get();
    }
    
    public function abrirModalCreacion()
    {
        $this->resetearFormularioCompleto();
        $this->modoEdicion = false;
        $this->mostrarModal = true;
    }

    public function cerrarModal()
    {
        $this->mostrarModal = false;
    }

    // modals de paradas y rutas
    
    public function abrirModalRutas()
    {
        $this->mostrar_modal_rutas = true;
    }

    public function cerrarModalRutas()
    {
        $this->mostrar_modal_rutas = false;
    }

    public function abrirModalParadas()
    {
        $this->mostrar_modal_paradas_lista = true;
    }

    public function cerrarModalParadasLista()
    {
        $this->mostrar_modal_paradas_lista = false;
    }
    // fin de los modals
    
    public function cambiarTab($tab)
    {
        $this->tab_activo = $tab;
    }

    public function resetearFormulario()
    {
        $this->reset([
            'tab_activo',
            'nombrepaquete',
            'preciopaquete',
            'cantidadpaquete',
            'descripcion',
        ]);
    }

    public function agregarDisponibilidad()
    {
        $this->validate([
            'nueva_fecha_inicio' => 'required|date|after_or_equal:today',
            'nueva_fecha_fin' => 'required|date|after:nueva_fecha_inicio',
            'nuevo_cupo' => 'required|integer|min:1',
        ]);

        $this->disponibilidades[] = [
            'fecha_inicio' => $this->nueva_fecha_inicio,
            'fecha_fin' => $this->nueva_fecha_fin,
            'cupo' => $this->nuevo_cupo,
        ];

        $this->reset(['nueva_fecha_inicio', 'nueva_fecha_fin', 'nuevo_cupo']);
    }

    protected function resetearFormularioCompleto()
    {
        $this->reset([
            'nombrepaquete',
            'preciopaquete',
            'cantidadpaquete',
            'descripcion',
            'imagen_principal',
            'estado',
            'descripciondetalle',
            'fk_iddestino',
            'fk_idpromociones',
            'servicios_seleccionados',
            'equipos_seleccionados',
            'disponibilidades',
            'imagenes_adicionales',
            'itinerario_dia',
            'itinerario_hora_inicio',
            'itinerario_hora_fin',
            'itinerario_descripcion',
            'rutas_seleccionadas',
            'paquete_editando_id',
            'modoEdicion'
        ]);
        
        $this->tab_activo = 'general';
        $this->imagenes_adicionales = [];
        $this->disponibilidades = [];
        $this->servicios_seleccionados = [];
        $this->equipos_seleccionados = [];
        $this->rutas_seleccionadas = [];
    }

    public function eliminarDisponibilidad($index)
    {
        unset($this->disponibilidades[$index]);
        $this->disponibilidades = array_values($this->disponibilidades);
    }

    private function calcularPrecioServicios()
    {
        $total = 0;
        foreach ($this->servicios_seleccionados as $servicio_id) {
            $servicio = $this->servicios_disponibles->find($servicio_id);
            if ($servicio && $servicio->Det_servicio) {
                $total += $servicio->Det_servicio->precioservicio ?? 0;
            }
        }
        return $total;
    }

    private function calcularPrecioEquipos()
    {
        $total = 0;
        foreach ($this->equipos_seleccionados as $equipo_id) {
            $equipo = $this->equipos_disponibles->find($equipo_id);
            if ($equipo && $equipo->Det_equipo) {
                $total += $equipo->Det_equipo->precio_equipo ?? 0;
            }
        }
        return $total;
    }
    
    public function calcularPrecioTotal()
    {
        // Convertir a float para evitar errores
        $precio_base = (float)$this->preciopaquete;
        $precio_servicios = $this->calcularPrecioServicios();
        $precio_equipos = $this->calcularPrecioEquipos();
        
        $subtotal = $precio_base + $precio_servicios + $precio_equipos;
        
        // Aplicar descuento si existe promoción
        if ($this->fk_idpromociones && $promocion = $this->promociones_disponibles->find($this->fk_idpromociones)) {
            $descuento = $subtotal * ($promocion->descuento / 100);
            $subtotal -= $descuento;
        }
        
        return $subtotal;
    }

    // funciones para el apartado de itinerarios
    public function updated($propertyName)
    {
        if ($propertyName === 'buscar_ruta') {
            $this->filtrarRutas();
        }
        
        if ($propertyName === 'buscar_parada') {
            $this->filtrarParadas();
        }
    }

    public function crearRuta()
    {
        $this->validate([
            'nueva_ruta' => 'required|string|max:255',
        ]);

        try {
            DB::table('rutas')->insert([
                'namerutas' => $this->nueva_ruta,
            ]);
            
            $this->nueva_ruta = '';
            $this->cargarRutas();
            session()->flash('message', 'Ruta creada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al crear la ruta: ' . $e->getMessage());
        }
    }

    public function eliminarRuta($id)
    {
        try {
            DB::table('rutas')->where('id', $id)->delete();
            $this->cargarRutas();
            session()->flash('message', 'Ruta eliminada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar la ruta: ' . $e->getMessage());
        }
    }

    // Funciones para gestionar paradas
    public function crearParada()
    {
        $this->validate([
            'nueva_parada' => 'required|string|max:255',
        ]);

        try {
            DB::table('paradas')->insert([
                'nameparadas' => $this->nueva_parada,
            ]);
            
            $this->nueva_parada = '';
            $this->cargarParadas();
            session()->flash('message', 'Parada creada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al crear la parada: ' . $e->getMessage());
        }
    }

    public function eliminarParada($id)
    {
        try {
            DB::table('paradas')->where('id', $id)->delete();
            $this->cargarParadas();
            session()->flash('message', 'Parada eliminada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar la parada: ' . $e->getMessage());
        }
    }

    // Funciones para cargar datos
    private function cargarRutas()
    {
        $this->rutas = DB::table('rutas')->get();
    }

    private function cargarParadas()
    {
        $this->paradas = DB::table('paradas')->get();
    }

    private function cargarItinerarios()
    {
        // Cargar itinerarios con sus rutas relacionadas
        $this->itinerarios = DB::table('itinerarios')
            ->leftJoin('itinerarios_ruta', 'itinerarios.id', '=', 'itinerarios_ruta.fk_iditinerario')
            ->leftJoin('rutas', 'itinerarios_ruta.fk_idruta', '=', 'rutas.id')
            ->where('itinerarios.fk_idpaquete', $this->paquete_editando_id)
            ->select('itinerarios.*', 'rutas.namerutas')
            ->get()
            ->groupBy('id')
            ->map(function ($group) {
                $itinerario = $group->first();
                $itinerario->rutas = $group->filter(function ($item) {
                    return !is_null($item->namerutas);
                })->map(function ($item) {
                    return (object) ['namerutas' => $item->namerutas];
                });
                return $itinerario;
            });
    }

    // Funciones para filtrar
    private function filtrarRutas()
    {
        if (empty($this->buscar_ruta)) {
            $this->rutas_filtradas = [];
            return;
        }
        
        $this->rutas_filtradas = $this->rutas->filter(function ($ruta) {
            return stripos($ruta->namerutas, $this->buscar_ruta) !== false;
        })->take(5);
    }

    private function filtrarParadas()
    {
        if (empty($this->buscar_parada)) {
            $this->paradas_filtradas = [];
            return;
        }
        
        $this->paradas_filtradas = $this->paradas->filter(function ($parada) {
            return stripos($parada->nameparadas, $this->buscar_parada) !== false;
        })->take(5);
    }

    // Funciones para seleccionar rutas
    public function seleccionarRuta($rutaId)
    {
        $ruta = $this->rutas->firstWhere('id', $rutaId);
        
        if ($ruta) {
            // Verificar si ya está seleccionada
            $yaSeleccionada = collect($this->rutas_seleccionadas)->contains('id', $rutaId);
            
            if (!$yaSeleccionada) {
                $this->rutas_seleccionadas[] = [
                    'id' => $ruta->id,
                    'nombre' => $ruta->namerutas,
                    'paradas' => []
                ];
            }
        }
        
        $this->buscar_ruta = '';
        $this->rutas_filtradas = [];
    }

    public function removerRutaSeleccionada($index)
    {
        unset($this->rutas_seleccionadas[$index]);
        $this->rutas_seleccionadas = array_values($this->rutas_seleccionadas);
    }

    // Funciones para modal de paradas
    public function editarRutaParadas($index)
    {
        $this->indice_ruta_editando = $index;
        $this->ruta_editando = $this->rutas_seleccionadas[$index];
        $this->mostrar_modal_paradas = true;
        $this->buscar_parada = '';
    }

    public function cerrarModalParadas()
    {
        $this->mostrar_modal_paradas = false;
        $this->ruta_editando = [];
        $this->indice_ruta_editando = null;
        $this->buscar_parada = '';
        $this->paradas_filtradas = [];
    }

    public function agregarParadaARuta($paradaId)
    {
        $parada = $this->paradas->firstWhere('id', $paradaId);
        
        if ($parada) {
            // Verificar si ya está en la ruta
            $yaEnRuta = collect($this->ruta_editando['paradas'])->contains('id', $paradaId);
            
            if (!$yaEnRuta) {
                $this->ruta_editando['paradas'][] = [
                    'id' => $parada->id,
                    'nombre' => $parada->nameparadas
                ];
            }
        }
        
        $this->buscar_parada = '';
        $this->paradas_filtradas = [];
    }

    public function removerParadaDeRuta($index)
    {
        unset($this->ruta_editando['paradas'][$index]);
        $this->ruta_editando['paradas'] = array_values($this->ruta_editando['paradas']);
    }

    public function guardarParadasRuta()
    {
        if ($this->indice_ruta_editando !== null) {
            $this->rutas_seleccionadas[$this->indice_ruta_editando] = $this->ruta_editando;
        }
        
        $this->cerrarModalParadas();
    }

    public function eliminarItinerario($id)
    {
        DB::beginTransaction();
        
        try {
            // Eliminar relaciones en itinerarios_ruta
            DB::table('itinerarios_ruta')->where('fk_iditinerario', $id)->delete();
            
            // Eliminar el itinerario
            DB::table('itinerarios')->where('id', $id)->delete();
            
            DB::commit();
            
            $this->cargarItinerarios();
            session()->flash('message', 'Itinerario eliminado exitosamente.');
            
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Error al eliminar el itinerario: ' . $e->getMessage());
        }
    }

    private function limpiarFormularioItinerario()
    {
        $this->itinerario_dia = '';
        $this->itinerario_hora_inicio = '';
        $this->itinerario_hora_fin = '';
        $this->itinerario_descripcion = '';
        $this->rutas_seleccionadas = [];
        $this->buscar_ruta = '';
        $this->rutas_filtradas = [];
    }
    
    public function guardarPaquete()
    {
        $this->dispatch('disableSaveButton');
        
        $userId = auth()->id();
        $empresa = DB::table('users')
            ->join('personas', 'personas.id', '=', 'users.fk_idpersona')
            ->join('representante_legal', 'representante_legal.fk_idpersona', '=', 'personas.id')
            ->join('empresas', 'empresas.id', '=', 'representante_legal.fk_idempresa')
            ->where('users.id', $userId)
            ->select('empresas.id', 'empresas.nameempresa')
            ->first();

        if (!$empresa) {
            session()->flash('error', 'No se encontró la empresa asociada a este usuario');
            return;
        }

        $this->validate();

        try {
            DB::beginTransaction();

            $paqueteExistente = Paquetes::where('nombrepaquete', $this->nombrepaquete)
            ->where('fk_idempresa', $empresa->id)
            ->first();
            
            if ($paqueteExistente) {
                throw new \Exception('Ya existe un paquete con este nombre');
            }

            // Crear el paquete principal
            $imagen_principal_path = null;
            if ($this->imagen_principal) {
                $imagen_principal_path = $this->imagen_principal->store('paquetes', 'public');
            }

            $paquete = Paquetes::create([
                'preciopaquete' => $this->preciopaquete,
                'nombrepaquete' => $this->nombrepaquete,
                'cantidadpaquete' => $this->cantidadpaquete,
                'descripcion' => $this->descripcion,
                'imagen_principal' => $imagen_principal_path,
                'estado' => $this->estado,
                'fk_idempresa' => $empresa->id,
            ]);

            // Crear el detalle del paquete
            $precio_total = $this->calcularPrecioTotal();
            
            DetallePaquetes::create([
                'descripciondetalle' => $this->descripciondetalle,
                'precioequipo' => $this->calcularPrecioEquipos(),
                'precioservicio' => $this->calcularPrecioServicios(),
                'preciototal' => $precio_total,
                'fk_idpaquete' => $paquete->id,
                'fk_iddestino' => $this->fk_iddestino,
                'fk_idpromociones' => $this->fk_idpromociones ?: null,
            ]);

            // Asociar servicios
            foreach ($this->servicios_seleccionados as $servicio_id) {
                DB::table('paquete_servicio')->insert([
                    'fk_idpaquete' => $paquete->id,
                    'fk_idservicio' => $servicio_id,
                ]);
            }

            // Asociar equipos
            foreach ($this->equipos_seleccionados as $equipo_id) {
                DB::table('paquete_equipo')->insert([
                    'fk_idpaquete' => $paquete->id,
                    'fk_idequipo' => $equipo_id,
                ]);
            }

            // Crear disponibilidades
            foreach ($this->disponibilidades as $disponibilidad) {
                DisponibilidadPaquete::create([
                    'fecha_inicio' => $disponibilidad['fecha_inicio'],
                    'fecha_fin' => $disponibilidad['fecha_fin'],
                    'cupo' => $disponibilidad['cupo'],
                    'fk_idpaquete' => $paquete->id,
                ]);
            }

            // Guardar imágenes adicionales
            foreach ($this->imagenes_adicionales as $imagen) {
                if ($imagen) {
                    $ruta = $imagen->store('paquetes/adicionales', 'public');
                    
                    // Usando la tabla polimórfica
                    imagenes::create([
                        'url' => $ruta,
                        'tipo' => 'secundaria',
                        'imageable_id' => $paquete->id,
                        'imageable_type' => Paquetes::class,
                    ]);
                }
            }

            // Guardar itinerarios si existen datos
            if ($this->itinerario_dia && $this->itinerario_hora_inicio) {
                $this->guardarItinerario($paquete->id);
            }

            DB::commit();
            session()->flash('mensaje', 'Paquete creado exitosamente con su itinerario.');
            $this->resetearFormularioCompleto(); // Nueva función para resetear todo
            $this->mostrarModal = false;
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al crear el paquete: ' . $e->getMessage());
        } finally {
            $this->dispatch('enableSaveButton');
        }
    }

    // Función separada para manejar los itinerarios
    protected function guardarItinerario($paqueteId)
    {
        $this->validate([
            'itinerario_dia' => 'required|string',
            'itinerario_hora_inicio' => 'required|date_format:H:i',
            'itinerario_hora_fin' => 'nullable|date_format:H:i|after:itinerario_hora_inicio',
            'rutas_seleccionadas' => 'required|array|min:1' // Cambiado de 'sometimes' a 'required'
        ]);
        
        $itinerario = Itinerarios::create([
            'dia' => $this->itinerario_dia,
            'hora_inicio' => $this->itinerario_hora_inicio,
            'hora_fin' => $this->itinerario_hora_fin,
            'descripcion' => $this->itinerario_descripcion,
            'fk_idpaquete' => $paqueteId,
        ]);

        if (!empty($this->rutas_seleccionadas)) {
            foreach ($this->rutas_seleccionadas as $ruta) {
                // Verificar si la ruta existe
                if (!isset($ruta['id'])) continue;

                // Crear relación itinerario-ruta
                itinerarioxruta::create([
                    'fk_iditinerario' => $itinerario->id,
                    'fk_idruta' => $ruta['id'],
                ]);

                // Guardar paradas para la ruta si no existen
                $this->guardarParadasParaRuta($ruta);
            }
        }
    }

    protected function guardarParadasParaRuta($rutaData)
    {
        // Verificar si la ruta ya tiene paradas
        $tieneParadas = ParadasxRutas::where('fk_idruta', $rutaData['id'])->exists();
        
        if (!$tieneParadas && !empty($rutaData['paradas'])) {
            foreach ($rutaData['paradas'] as $orden => $parada) {
                ParadasxRutas::create([
                    'fk_idruta' => $rutaData['id'],
                    'fk_idparada' => $parada['id'],
                    'ordenparada' => $orden + 1,
                ]);
            }
        }
    }
    
    public function agregarRuta($rutaId)
    {
        $ruta = Rutas::find($rutaId);
        
        if ($ruta && !collect($this->rutas_seleccionadas)->contains('id', $rutaId)) {
            $this->rutas_seleccionadas[] = [
                'id' => $ruta->id,
                'nombre' => $ruta->namerutas,
                'paradas' => []
            ];
        }
    }

    public function editarParadasRuta($index)
    {
        $this->ruta_editando = $this->rutas_seleccionadas[$index];
        $this->indice_ruta_editando = $index;
        $this->dispatch('abrirModalParadas');
    }
    
    public function editarPaquete($paqueteId)
    {
        try {
            $this->resetearFormularioCompleto();
            // Cargar el paquete con TODAS las relaciones necesarias
            $paquete = Paquetes::with([
                'det_paquete',       // Relación de detalles
                'dis_paquete',       // Disponibilidades
                'ser_paquete',       // Servicios
                'equi_paquete',      // Equipos
                'imagenes',          // Imágenes polimórficas
                'itinerarios.itinixrutas.ruta'  // Itinerarios con rutas
            ])->findOrFail($paqueteId);

            // Cargar datos básicos del paquete
            $this->paquete_editando_id = $paquete->id;
            $this->nombrepaquete = $paquete->nombrepaquete;
            $this->preciopaquete = $paquete->preciopaquete;
            $this->cantidadpaquete = $paquete->cantidadpaquete;
            $this->descripcion = $paquete->descripcion;
            $this->estado = $paquete->estado;

            // Cargar detalle del paquete (con verificación segura)
            if ($paquete->det_paquete && $paquete->det_paquete->count() > 0) {
                $detalle = $paquete->det_paquete->first();
                $this->descripciondetalle = $detalle->descripciondetalle ?? '';
                $this->fk_iddestino = $detalle->fk_iddestino ?? null;
                $this->fk_idpromociones = $detalle->fk_idpromociones ?? null;
            } else {
                $this->descripciondetalle = '';
                $this->fk_iddestino = null;
                $this->fk_idpromociones = null;
            }

            // Cargar servicios seleccionados (con verificación segura)
            $this->servicios_seleccionados = $paquete->ser_paquete 
                ? $paquete->ser_paquete->pluck('fk_idservicio')->toArray() 
                : [];

            // Cargar equipos seleccionados (con verificación segura)
            $this->equipos_seleccionados = $paquete->equi_paquete 
                ? $paquete->equi_paquete->pluck('fk_idequipo')->toArray() 
                : [];

            // Cargar disponibilidades (con verificación segura)
            $this->disponibilidades = $paquete->dis_paquete 
                ? $paquete->dis_paquete->map(function($item) {
                    return [
                        'fecha_inicio' => $item->fecha_inicio,
                        'fecha_fin' => $item->fecha_fin,
                        'cupo' => $item->cupo
                    ];
                })->toArray() 
                : [];

            // Cargar itinerarios (con verificación segura)
            if ($paquete->iti_paquete && $paquete->iti_paquete->count() > 0) {
                $itinerario = $paquete->iti_paquete->first();
                $this->itinerario_dia = $itinerario->dia ?? '';
                $this->itinerario_hora_inicio = $itinerario->hora_inicio ?? '';
                $this->itinerario_hora_fin = $itinerario->hora_fin ?? '';
                $this->itinerario_descripcion = $itinerario->descripcion ?? '';
                
                // Cargar rutas seleccionadas
                $this->rutas_seleccionadas = $itinerario->itinixrutas 
                    ? $itinerario->itinixrutas->map(function($item) {
                        return [
                            'id' => $item->ruta->id ?? null,
                            'nombre' => $item->ruta->namerutas ?? '',
                            'paradas' => $item->ruta->paradas 
                                ? $item->ruta->paradas->map(function($parada) {
                                    return [
                                        'id' => $parada->id ?? null,
                                        'nombre' => $parada->nameparadas ?? ''
                                    ];
                                })->toArray() 
                                : []
                        ];
                    })->toArray() 
                    : [];
            } else {
                $this->itinerario_dia = '';
                $this->itinerario_hora_inicio = '';
                $this->itinerario_hora_fin = '';
                $this->itinerario_descripcion = '';
                $this->rutas_seleccionadas = [];
            }

            $this->mostrarModal = true;
            $this->modoEdicion = true;

        } catch (\Exception $e) {
            session()->flash('error', 'Error al cargar el paquete: ' . $e->getMessage());
            // Opcional: logs para debugging
            \Log::error('Error al editar paquete', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function actualizarPaquete()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // Actualizar paquete principal
            $paquete = Paquetes::findOrFail($this->paquete_editando_id);
            
            $dataPaquete = [
                'nombrepaquete' => $this->nombrepaquete,
                'preciopaquete' => $this->preciopaquete,
                'cantidadpaquete' => $this->cantidadpaquete,
                'descripcion' => $this->descripcion,
                'estado' => $this->estado,
            ];

            if ($this->imagen_principal) {
                // Eliminar imagen anterior si existe
                if ($paquete->imagen_principal) {
                    Storage::disk('public')->delete($paquete->imagen_principal);
                }
                $dataPaquete['imagen_principal'] = $this->imagen_principal->store('paquetes', 'public');
            }

            $paquete->update($dataPaquete);

            // Actualizar detalle del paquete
            $precio_total = $this->calcularPrecioTotal();
            DetallePaquetes::updateOrCreate(
                ['fk_idpaquete' => $paquete->id],
                [
                    'descripciondetalle' => $this->descripciondetalle,
                    'precioequipo' => $this->calcularPrecioEquipos(),
                    'precioservicio' => $this->calcularPrecioServicios(),
                    'preciototal' => $precio_total,
                    'fk_iddestino' => $this->fk_iddestino,
                    'fk_idpromociones' => $this->fk_idpromociones ?: null,
                ]
            );

            // Actualizar servicios (eliminar todos y volver a crear)
            DB::table('paquete_servicio')->where('fk_idpaquete', $paquete->id)->delete();
            foreach ($this->servicios_seleccionados as $servicio_id) {
                DB::table('paquete_servicio')->insert([
                    'fk_idpaquete' => $paquete->id,
                    'fk_idservicio' => $servicio_id,
                ]);
            }

            // Actualizar equipos (eliminar todos y volver a crear)
            DB::table('paquete_equipo')->where('fk_idpaquete', $paquete->id)->delete();
            foreach ($this->equipos_seleccionados as $equipo_id) {
                DB::table('paquete_equipo')->insert([
                    'fk_idpaquete' => $paquete->id,
                    'fk_idequipo' => $equipo_id,
                ]);
            }

            // Actualizar disponibilidades (eliminar todas y volver a crear)
            DisponibilidadPaquete::where('fk_idpaquete', $paquete->id)->delete();
            foreach ($this->disponibilidades as $disponibilidad) {
                DisponibilidadPaquete::create([
                    'fecha_inicio' => $disponibilidad['fecha_inicio'],
                    'fecha_fin' => $disponibilidad['fecha_fin'],
                    'cupo' => $disponibilidad['cupo'],
                    'fk_idpaquete' => $paquete->id,
                ]);
            }
            
            // Actualizar imágenes adicionales
            if ($this->imagenes_adicionales) {
                foreach ($this->imagenes_adicionales as $imagen) {
                    if ($imagen) {
                        $ruta = $imagen->store('paquetes/adicionales', 'public');
                        imagenes::create([
                            'url' => $ruta,
                            'tipo' => 'secundaria',
                            'imageable_id' => $paquete->id,
                            'imageable_type' => Paquetes::class,
                        ]);
                    }
                }
            }

            // Actualizar itinerarios (eliminar existentes y crear nuevos)
            if ($this->itinerario_dia && $this->itinerario_hora_inicio) {
                // Eliminar itinerarios existentes
                $itinerariosIds = $paquete->itinerarios->pluck('id');
                itinerarioxruta::whereIn('fk_iditinerario', $itinerariosIds)->delete();
                Itinerarios::where('fk_idpaquete', $paquete->id)->delete();
                
                // Crear nuevo itinerario
                $this->guardarItinerario($paquete->id);
            }

            DB::commit();
            session()->flash('mensaje', 'Paquete actualizado exitosamente.');
            $this->resetearFormularioCompleto();
            $this->mostrarModal = false;
            $this->cargarDatos(); // Recargar la lista de paquetes

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al actualizar el paquete: ' . $e->getMessage());
        }
    }
    
    public function confirmarEliminacion($paqueteId)
    {
        $this->paquete_a_eliminar = $paqueteId;
        $this->dispatch('mostrarModalConfirmacion');
    }

    public function eliminarPaquete()
    {
        if (!$this->paquete_a_eliminar) {
            return;
        }

        try {
            DB::beginTransaction();

            $paquete = Paquetes::with(['imagenes', 'itinerarios'])->findOrFail($this->paquete_a_eliminar);

            // Eliminar imágenes adicionales (polimórficas)
            foreach ($paquete->imagenes as $imagen) {
                Storage::disk('public')->delete($imagen->url);
                $imagen->delete();
            }

            // Eliminar imagen principal
            if ($paquete->imagen_principal) {
                Storage::disk('public')->delete($paquete->imagen_principal);
            }

            // Eliminar itinerarios y sus relaciones
            $itinerariosIds = $paquete->itinerarios->pluck('id');
            itinerarioxruta::whereIn('fk_iditinerario', $itinerariosIds)->delete();
            $paquete->itinerarios()->delete();

            // Eliminar relaciones muchos a muchos
            DB::table('paquete_servicio')->where('fk_idpaquete', $paquete->id)->delete();
            DB::table('paquete_equipo')->where('fk_idpaquete', $paquete->id)->delete();

            // Eliminar disponibilidades
            $paquete->dis_paquete()->delete();

            // Eliminar detalle
            $paquete->det_paquete()->delete();

            // Finalmente eliminar el paquete
            $paquete->delete();

            DB::commit();
            session()->flash('mensaje', 'Paquete eliminado exitosamente.');
            $this->cargarDatos(); // Recargar la lista de paquetes

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al eliminar el paquete: ' . $e->getMessage());
        } finally {
            $this->paquete_a_eliminar = null;
            $this->dispatch('ocultarModalConfirmacion');
        }
    }
    
    public function render()
    {
        return view('livewire.admin.panelpaquetes', [
            'destinosFiltro' => $this->destinos_disponibles // Opcional, si lo usas para filtros
        ])->layout('layouts.prueba');
    }

    
    public function getNextTab($currentTab)
    {
        $tabs = ['general', 'servicios', 'disponibilidad', 'imagenes', 'itinerario'];
        $currentIndex = array_search($currentTab, $tabs);
        
        if ($currentIndex !== false && $currentIndex < count($tabs) - 1) {
            return $tabs[$currentIndex + 1];
        }
        
        return $currentTab;
    }

    public function getPreviousTab($currentTab)
    {
        $tabs = ['general', 'servicios', 'disponibilidad', 'imagenes', 'itinerario'];
        $currentIndex = array_search($currentTab, $tabs);
        
        if ($currentIndex !== false && $currentIndex > 0) {
            return $tabs[$currentIndex - 1];
        }
        
        return $currentTab;
    }

    // Método para navegación directa con botones
    public function siguienteTab()
    {
        $this->tab_activo = $this->getNextTab($this->tab_activo);
    }

    public function anteriorTab()
    {
        $this->tab_activo = $this->getPreviousTab($this->tab_activo);
    }
}