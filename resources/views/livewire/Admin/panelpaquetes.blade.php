<div>
    <div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow-lg">

        <!-- Encabezado con botón y buscador -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Paquetes Turísticos</h1>

            <div class="flex space-x-4">
                <!-- Buscador -->
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar paquetes..."
                        class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Botón para abrir modal -->
                <button wire:click="abrirModalCreacion"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Crear Paquete
                </button>
            </div>
        </div>

        <!-- Mensajes de sesión -->
        @if (session()->has('mensaje'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('mensaje') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="mt-4">
        <!-- Contenido principal de la vista (lista de paquetes, etc.) -->
        @if ($paquetes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($paquetes as $paquete)
                    <div
                        class="bg-white rounded-xl card-shadow hover-lift overflow-hidden animate-fade-in transition-transform duration-300 hover:scale-[1.02]">
                        <!-- Imagen principal -->
                        <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-500 relative overflow-hidden">
                            @if ($paquete->imagen_principal)
                                <img src="{{ Storage::url($paquete->imagen_principal) }}"
                                    alt="{{ $paquete->nombrepaquete }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full">
                                    <div class="text-center text-white">
                                        <svg class="w-16 h-16 mx-auto mb-2 opacity-75" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="font-medium">Sin imagen</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Badge estado -->
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium
                              {{ $paquete->estado == 'activo' ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }}">
                                    {{ ucfirst($paquete->estado) }}
                                </span>
                            </div>

                            <!-- Badge precio -->
                            <div class="absolute bottom-4 right-4">
                                <span
                                    class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-1 rounded-full text-sm font-bold">
                                    S/. {{ number_format($paquete->preciopaquete, 2) }}
                                </span>
                            </div>
                        </div>

                        <!-- Contenido -->
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-900">{{ $paquete->nombrepaquete }}</h3>
                                <div class="flex space-x-1">
                                    <button wire:click="editarPaquete({{ $paquete->id }})"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmarEliminacion({{ $paquete->id }})"
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Información básica -->
                            <div class="space-y-2 text-sm text-gray-600 mb-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                    <span>Cupos: {{ $paquete->cantidadpaquete }}</span>
                                </div>

                                @if ($paquete->destino)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span>Destino: {{ $paquete->destino->namedestino }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Descripción -->
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($paquete->descripcion, 120) }}
                            </p>

                            <!-- Servicios incluidos (mini badges) -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach ($paquete->ser_paquete->take(3) as $servicioPaquete)
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                        {{ $servicioPaquete->servicio->Det_servicio->nombreservicio ?? 'Servicio' }}
                                    </span>
                                @endforeach
                                @if ($paquete->ser_paquete->count() > 3)
                                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                                        +{{ $paquete->ser_paquete->count() - 3 }} más
                                    </span>
                                @endif
                            </div>

                            <!-- Fechas disponibles -->
                            <div class="text-xs text-gray-500">
                                @if ($paquete->dis_paquete->count() > 0)
                                    @php
                                        $disponibilidad = $paquete->dis_paquete->first();
                                        $fecha_inicio = \Carbon\Carbon::parse($disponibilidad->fecha_inicio);
                                        $fecha_fin = \Carbon\Carbon::parse($disponibilidad->fecha_fin);
                                    @endphp
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span>Disponible:
                                            {{ $fecha_inicio->format('d M') }} -
                                            {{ $fecha_fin->format('d M Y') }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg p-8 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No hay paquetes creados</h3>
                <p class="mt-1 text-sm text-gray-500">Comienza creando tu primer paquete turístico</p>
                <div class="mt-6">
                    <button wire:click="abrirModalCreacion"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        <svg class="w-5 h-5 inline mr-1 -mt-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear Paquete
                    </button>
                </div>
            </div>
        @endif

        <!-- Modal de creación -->
        @if ($mostrarModal)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                    <!-- Encabezado del modal -->
                    <div class="border-b px-6 py-4 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-800">
                            {{ $modoEdicion ? 'Editar Paquete Turístico' : 'Crear Nuevo Paquete Turístico' }}
                        </h2>
                        <button wire:click="cerrarModal" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    @if (session()->has('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Contenido del modal -->
                    <div class="p-6">
                        <form wire:submit.prevent="{{ $modoEdicion ? 'actualizarPaquete' : 'guardarPaquete' }}">
                            <!-- Navegación por pestañas -->
                            <div class="mb-6">
                                <nav class="flex space-x-8" aria-label="Tabs">
                                    <button type="button" wire:click="cambiarTab('general')"
                                        class="py-2 px-1 border-b-2 font-medium text-sm {{ $tab_activo === 'general' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                        Información General
                                    </button>
                                    <button type="button" wire:click="cambiarTab('servicios')"
                                        class="py-2 px-1 border-b-2 font-medium text-sm {{ $tab_activo === 'servicios' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                        Servicios y Equipos
                                    </button>
                                    <button type="button" wire:click="cambiarTab('disponibilidad')"
                                        class="py-2 px-1 border-b-2 font-medium text-sm {{ $tab_activo === 'disponibilidad' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                        Disponibilidad
                                    </button>
                                    <button type="button" wire:click="cambiarTab('imagenes')"
                                        class="py-2 px-1 border-b-2 font-medium text-sm {{ $tab_activo === 'imagenes' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                        Imágenes
                                    </button>
                                    <button type="button" wire:click="cambiarTab('itinerario')"
                                        class="py-2 px-1 border-b-2 font-medium text-sm {{ $tab_activo === 'itinerario' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                        Itinerario
                                    </button>
                                </nav>
                            </div>

                            <!-- Contenido de las pestañas -->
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <!-- Pestaña: Información General -->
                                @if ($tab_activo === 'general')
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <!-- Datos del Paquete -->
                                        <div class="space-y-4">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Datos del Paquete</h3>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del
                                                    Paquete *</label>
                                                <input type="text" wire:model="nombrepaquete"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    placeholder="Ej: Tour Machu Picchu 3 días">
                                                @error('nombrepaquete')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Precio Base
                                                    *</label>
                                                <input type="number" step="0.01" wire:model="preciopaquete"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    placeholder="0.00">
                                                @error('preciopaquete')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Cantidad
                                                    Disponible *</label>
                                                <input type="number" wire:model="cantidadpaquete"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    placeholder="1">
                                                @error('cantidadpaquete')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                                                <textarea wire:model="descripcion" rows="4"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    placeholder="Descripción general del paquete turístico..."></textarea>
                                                @error('descripcion')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                                                <select wire:model="estado"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    <option value="activo">Activo</option>
                                                    <option value="inactivo">Inactivo</option>
                                                </select>
                                            </div>

                                            {{-- <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Empresa</label>
                                            <input type="text" value="{{}}">
                                            @error('fk_idempresa')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div> --}}
                                        </div>

                                        <!-- Detalles del Paquete -->
                                        <div class="space-y-4">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Detalles del Paquete
                                            </h3>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción
                                                    del
                                                    Detalle *</label>
                                                <textarea wire:model="descripciondetalle" rows="3"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    placeholder="Detalles específicos del paquete..."></textarea>
                                                @error('descripciondetalle')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Destino
                                                    *</label>
                                                <select wire:model="fk_iddestino"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    <option value="">Seleccionar destino...</option>
                                                    @foreach ($destinos_disponibles as $destino)
                                                        <option value="{{ $destino->id }}">
                                                            {{ $destino->namedestino }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('fk_iddestino')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Promoción
                                                    (Opcional)</label>
                                                <select wire:model="fk_idpromociones"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    <option value="">Sin promoción</option>
                                                    @foreach ($promociones_disponibles as $promocion)
                                                        <option value="{{ $promocion->id }}">{{ $promocion->nombre }}
                                                            -
                                                            {{ $promocion->descuento }}%</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Imagen
                                                    Principal</label>
                                                <input type="file" wire:model="imagen_principal" accept="image/*"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                @if ($imagen_principal)
                                                    <div class="mt-2">
                                                        @if (is_string($imagen_principal))
                                                            <img src="{{ asset('storage/' . $imagen_principal) }}"
                                                                class="h-32 w-32 object-cover rounded-lg">
                                                        @else
                                                            <img src="{{ $imagen_principal->temporaryUrl() }}"
                                                                class="h-32 w-32 object-cover rounded-lg">
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Pestaña: Servicios y Equipos -->
                                @if ($tab_activo === 'servicios')
                                    <!-- Resumen de Precios (Ahora al inicio) -->
                                    <div
                                        class="mb-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg shadow-sm">
                                        <h4 class="font-semibold text-blue-800 mb-3 flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            Resumen de Precios
                                        </h4>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                            <div class="bg-white p-3 rounded-lg border">
                                                <div class="text-gray-600 font-medium">Precio Base</div>
                                                <div class="text-lg font-bold text-gray-800">S/.
                                                    {{ number_format($preciopaquete ?: 0, 2) }}</div>
                                            </div>
                                            <div class="bg-white p-3 rounded-lg border">
                                                <div class="text-gray-600 font-medium">Precio Servicios</div>
                                                <div class="text-lg font-bold text-blue-600">S/.
                                                    {{ number_format($this->calcularPrecioServicios(), 2) }}</div>
                                            </div>
                                            <div class="bg-white p-3 rounded-lg border">
                                                <div class="text-gray-600 font-medium">Precio Equipos</div>
                                                <div class="text-lg font-bold text-green-600">S/.
                                                    {{ number_format($this->calcularPrecioEquipos(), 2) }}</div>
                                            </div>

                                            <div class="bg-white p-3 rounded-lg border border-indigo-200">
                                                <div class="text-gray-600 font-medium">
                                                    Precio Total
                                                    @if ($fk_idpromociones)
                                                        <span class="text-xs text-green-600">(con descuento)</span>
                                                    @endif
                                                </div>
                                                <div class="text-xl font-bold text-indigo-700">
                                                    S/. {{ number_format($this->calcularPrecioTotal(), 2) }}
                                                </div>

                                                @if ($fk_idpromociones)
                                                    @php
                                                        $promocion = $promociones_disponibles->find($fk_idpromociones);
                                                        $subtotal_sin_descuento =
                                                            (float) $preciopaquete +
                                                            $this->calcularPrecioServicios() +
                                                            $this->calcularPrecioEquipos();
                                                        $descuento_monto =
                                                            $subtotal_sin_descuento * ($promocion->descuento / 100);
                                                    @endphp

                                                    <div class="text-xs text-gray-500 mt-1">
                                                        <div>Descuento aplicado: {{ $promocion->descuento }}%</div>
                                                        <div class="text-green-600">
                                                            Ahorras: S/. {{ number_format($descuento_monto, 2) }}
                                                        </div>
                                                        <div class="text-gray-400 line-through">
                                                            Precio sin descuento: S/.
                                                            {{ number_format($subtotal_sin_descuento, 2) }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                        <!-- Servicios -->
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                    </path>
                                                </svg>
                                                Servicios Incluidos *
                                            </h3>

                                            <!-- Buscador de Servicios -->
                                            <div class="mb-4">
                                                <div class="relative">
                                                    <input type="text" wire:model.live="buscar_servicio"
                                                        class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                        placeholder="Buscar servicios...">
                                                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>

                                            <div
                                                class="space-y-3 max-h-80 overflow-y-auto border border-gray-200 rounded-lg p-4">
                                                @php
                                                    $servicios_filtrados = $servicios_disponibles;
                                                    if (!empty($buscar_servicio)) {
                                                        $servicios_filtrados = $servicios_disponibles->filter(function (
                                                            $servicio,
                                                        ) {
                                                            return stripos(
                                                                $servicio->Det_servicio->nombreservicio ?? '',
                                                                $this->buscar_servicio,
                                                            ) !== false;
                                                        });
                                                    }
                                                    $servicios_mostrar = $servicios_filtrados->take(5);
                                                @endphp

                                                @forelse ($servicios_mostrar as $servicio)
                                                    <label
                                                        class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200 {{ in_array($servicio->id, $servicios_seleccionados) ? 'bg-blue-50 border-blue-300' : '' }}">
                                                        <input type="checkbox"
                                                            wire:model.live="servicios_seleccionados"
                                                            value="{{ $servicio->id }}"
                                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                        <div class="flex-1">
                                                            <div class="font-medium text-gray-800">
                                                                {{ $servicio->Det_servicio->nombreservicio ?? 'Servicio sin nombre' }}
                                                            </div>
                                                            <div class="text-sm text-gray-600">
                                                                Cantidad: {{ $servicio->cantidadservicio }}
                                                                @if ($servicio->Det_servicio && $servicio->Det_servicio->precioservicio)
                                                                    - Precio: S/.
                                                                    {{ number_format($servicio->Det_servicio->precioservicio, 2) }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </label>
                                                @empty
                                                    <div class="text-center py-4 text-gray-500">
                                                        @if (!empty($buscar_servicio))
                                                            No se encontraron servicios que coincidan con
                                                            "{{ $buscar_servicio }}"
                                                        @else
                                                            No hay servicios disponibles
                                                        @endif
                                                    </div>
                                                @endforelse

                                                @if ($servicios_filtrados->count() > 5)
                                                    <div class="text-center py-2 text-sm text-gray-500 border-t">
                                                        Mostrando 5 de {{ $servicios_filtrados->count() }} servicios.
                                                        Usa
                                                        el buscador para encontrar más.
                                                    </div>
                                                @endif
                                            </div>
                                            @error('servicios_seleccionados')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Equipos -->
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                                    </path>
                                                </svg>
                                                Equipos Incluidos *
                                            </h3>

                                            <!-- Buscador de Equipos -->
                                            <div class="mb-4">
                                                <div class="relative">
                                                    <input type="text" wire:model.live="buscar_equipo"
                                                        class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                        placeholder="Buscar equipos...">
                                                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>

                                            <div
                                                class="space-y-3 max-h-80 overflow-y-auto border border-gray-200 rounded-lg p-4">
                                                @php
                                                    $equipos_filtrados = $equipos_disponibles;
                                                    if (!empty($buscar_equipo)) {
                                                        $equipos_filtrados = $equipos_disponibles->filter(function (
                                                            $equipo,
                                                        ) {
                                                            return stripos(
                                                                $equipo->Det_equipo->name_equipo ?? '',
                                                                $this->buscar_equipo,
                                                            ) !== false;
                                                        });
                                                    }
                                                    $equipos_mostrar = $equipos_filtrados->take(5);
                                                @endphp

                                                @forelse ($equipos_mostrar as $equipo)
                                                    <label
                                                        class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200 {{ in_array($equipo->id, $equipos_seleccionados) ? 'bg-green-50 border-green-300' : '' }}">
                                                        <input type="checkbox" wire:model.live="equipos_seleccionados"
                                                            value="{{ $equipo->id }}"
                                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                        <div class="flex-1">
                                                            <div class="font-medium text-gray-800">
                                                                {{ $equipo->Det_equipo->name_equipo ?? 'Equipo sin nombre' }}
                                                            </div>
                                                            <div class="text-sm text-gray-600">
                                                                Cantidad: {{ $equipo->cantidadequipo }}
                                                                @if ($equipo->Det_equipo && $equipo->Det_equipo->precio_equipo)
                                                                    - Precio: S/.
                                                                    {{ number_format($equipo->Det_equipo->precio_equipo, 2) }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </label>
                                                @empty
                                                    <div class="text-center py-4 text-gray-500">
                                                        @if (!empty($buscar_equipo))
                                                            No se encontraron equipos que coincidan con
                                                            "{{ $buscar_equipo }}"
                                                        @else
                                                            No hay equipos disponibles
                                                        @endif
                                                    </div>
                                                @endforelse

                                                @if ($equipos_filtrados->count() > 5)
                                                    <div class="text-center py-2 text-sm text-gray-500 border-t">
                                                        Mostrando 5 de {{ $equipos_filtrados->count() }} equipos. Usa
                                                        el
                                                        buscador para encontrar más.
                                                    </div>
                                                @endif
                                            </div>
                                            @error('equipos_seleccionados')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <!-- Pestaña: Disponibilidad -->
                                @if ($tab_activo === 'disponibilidad')
                                    <div class="space-y-6">
                                        <h3 class="text-lg font-semibold text-gray-800">Gestión de Disponibilidad</h3>

                                        <!-- Formulario para agregar disponibilidad -->
                                        <div
                                            class="grid grid-cols-1 md:grid-cols-4 gap-4 p-4 bg-white border border-gray-200 rounded-lg">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha
                                                    Inicio</label>
                                                <input type="date" wire:model="nueva_fecha_inicio"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha
                                                    Fin</label>
                                                <input type="date" wire:model="nueva_fecha_fin"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-2">Cupo</label>
                                                <input type="number" wire:model="nuevo_cupo" min="1"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>
                                            <div class="flex items-end">
                                                <button type="button" wire:click="agregarDisponibilidad"
                                                    class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    Agregar
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Lista de disponibilidades -->
                                        @if (count($disponibilidades) > 0)
                                            <div class="space-y-3">
                                                <h4 class="font-medium text-gray-800">Disponibilidades Agregadas:</h4>
                                                @foreach ($disponibilidades as $index => $disponibilidad)
                                                    <div
                                                        class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                                                        <div class="flex-1">
                                                            <span
                                                                class="font-medium">{{ \Carbon\Carbon::parse($disponibilidad['fecha_inicio'])->format('d/m/Y') }}</span>
                                                            al
                                                            <span
                                                                class="font-medium">{{ \Carbon\Carbon::parse($disponibilidad['fecha_fin'])->format('d/m/Y') }}</span>
                                                            -
                                                            <span
                                                                class="text-green-700 font-semibold">{{ $disponibilidad['cupo'] }}
                                                                cupos</span>
                                                        </div>
                                                        <button type="button"
                                                            wire:click="eliminarDisponibilidad({{ $index }})"
                                                            class="text-red-600 hover:text-red-800 font-medium">
                                                            Eliminar
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center py-8 text-gray-500">
                                                <p>No hay disponibilidades agregadas</p>
                                                <p class="text-sm">Agregue al menos una fecha de disponibilidad para
                                                    continuar</p>
                                            </div>
                                        @endif

                                        @error('disponibilidades')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <!-- Pestaña: Imágenes -->
                                @if ($tab_activo === 'imagenes')
                                    <div class="space-y-6">
                                        <h3 class="text-lg font-semibold text-gray-800">Imágenes Adicionales</h3>

                                        <!-- Subida de imágenes múltiples -->
                                        <div class="p-4 bg-white border border-gray-200 rounded-lg">
                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    Seleccionar Imágenes (múltiples)
                                                </label>
                                                <input type="file" wire:model="imagenes_adicionales" multiple
                                                    accept="image/*"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <p class="text-sm text-gray-500 mt-1">
                                                    Puede seleccionar múltiples imágenes. Formatos permitidos: JPG, PNG,
                                                    GIF
                                                </p>
                                                @error('imagenes_adicionales.*')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Vista previa de imágenes seleccionadas -->
                                            @if ($imagenes_adicionales)
                                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                                    @foreach ($imagenes_adicionales as $index => $imagen)
                                                        <div class="relative">
                                                            <img src="{{ $imagen->temporaryUrl() }}"
                                                                class="h-32 w-full object-cover rounded-lg border border-gray-200">
                                                            <button type="button"
                                                                wire:click="eliminarImagenTemporal({{ $index }})"
                                                                class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                                                ×
                                                            </button>
                                                            <div class="mt-2">
                                                                <select
                                                                    wire:model="tipos_imagenes.{{ $index }}"
                                                                    class="w-full text-xs px-2 py-1 border border-gray-300 rounded">
                                                                    <option value="secundaria">Secundaria</option>
                                                                    <option value="principal">Principal</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Imágenes ya agregadas (para edición) -->
                                        @if (isset($imagenes_guardadas) && count($imagenes_guardadas) > 0)
                                            <div class="space-y-4">
                                                <h4 class="font-medium text-gray-800">Imágenes Guardadas:</h4>
                                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                                    @foreach ($imagenes_guardadas as $index => $imagen)
                                                        <div
                                                            class="relative bg-white border border-gray-200 rounded-lg p-2">
                                                            <img src="{{ Storage::url($imagen['url']) }}"
                                                                class="h-32 w-full object-cover rounded-lg">
                                                            <div class="mt-2 space-y-2">
                                                                <select
                                                                    wire:model="imagenes_guardadas.{{ $index }}.tipo"
                                                                    class="w-full text-xs px-2 py-1 border border-gray-300 rounded">
                                                                    <option value="secundaria">Secundaria</option>
                                                                    <option value="principal">Principal</option>
                                                                </select>
                                                                <input type="text"
                                                                    wire:model="imagenes_guardadas.{{ $index }}.descripcion"
                                                                    placeholder="Descripción..."
                                                                    class="w-full text-xs px-2 py-1 border border-gray-300 rounded">
                                                            </div>
                                                            <button type="button"
                                                                wire:click="eliminarImagenGuardada({{ $index }})"
                                                                class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                                                ×
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Gestión con tabla polimórfica -->
                                        <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                            <h4 class="font-semibold text-blue-800 mb-2">Gestión Avanzada de Imágenes
                                            </h4>
                                            <p class="text-sm text-blue-700 mb-3">
                                                Las imágenes se guardarán usando el sistema polimórfico, permitiendo
                                                mejor
                                                organización y gestión.
                                            </p>

                                            @if (count($imagenes_polimorficas ?? []) > 0)
                                                <div class="space-y-2">
                                                    <h5 class="font-medium text-blue-800">Imágenes en Sistema
                                                        Polimórfico:
                                                    </h5>
                                                    @foreach ($imagenes_polimorficas as $imagen)
                                                        <div
                                                            class="flex items-center justify-between bg-white p-2 rounded">
                                                            <div class="flex items-center space-x-3">
                                                                <img src="{{ Storage::url($imagen['url']) }}"
                                                                    class="h-12 w-12 object-cover rounded">
                                                                <div>
                                                                    <div class="text-sm font-medium">
                                                                        {{ $imagen['tipo'] ?? 'No definido' }}</div>
                                                                    <div class="text-xs text-gray-500">
                                                                        {{ $imagen['descripcion'] ?? 'Sin descripción' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button"
                                                                wire:click="eliminarImagenPolimorfica({{ $imagen['id'] }})"
                                                                class="text-red-600 hover:text-red-800 text-sm">
                                                                Eliminar
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Información adicional sobre imágenes -->
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <h5 class="font-medium text-gray-800 mb-2">Información Importante:</h5>
                                            <ul class="text-sm text-gray-600 space-y-1">
                                                <li>• La imagen principal se mostrará como portada del paquete</li>
                                                <li>• Las imágenes secundarias aparecerán en la galería del paquete</li>
                                                <li>• Se admiten formatos: JPG, PNG, GIF (máximo 2MB por imagen)</li>
                                                <li>• Puede agregar descripciones opcionales para cada imagen</li>
                                                <li>• Las imágenes se organizan automáticamente usando el sistema
                                                    polimórfico</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                <!-- Pestaña: Itinerario -->
                                @if ($tab_activo === 'itinerario')
                                    <div class="space-y-6">
                                        <!-- Gestión de Rutas y Paradas -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Panel de Rutas -->
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <h3 class="text-sm font-medium text-gray-900 mb-3">Gestionar Rutas</h3>
                                                <div class="space-y-3">
                                                    <div class="flex gap-2">
                                                        <input type="text" wire:model="nueva_ruta"
                                                            placeholder="Nombre de la ruta"
                                                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                                                        <button wire:click="crearRuta"
                                                            class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                                                            Crear
                                                        </button>
                                                    </div>
                                                    <button wire:click="abrirModalRutas"
                                                        class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Ver todas las rutas
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Panel de Paradas -->
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <h3 class="text-sm font-medium text-gray-900 mb-3">Gestionar Paradas
                                                </h3>
                                                <div class="space-y-3">
                                                    <div class="flex gap-2">
                                                        <input type="text" wire:model="nueva_parada"
                                                            placeholder="Nombre de la parada"
                                                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                                                        <button wire:click="crearParada"
                                                            class="px-4 py-2 bg-green-600 text-white text-sm rounded-md hover:bg-green-700">
                                                            Crear
                                                        </button>
                                                    </div>
                                                    <button wire:click="abrirModalParadas"
                                                        class="text-sm text-green-600 hover:text-green-800 flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Ver todas las paradas
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- modal para la lista de rutas --}}
                                            @if ($mostrar_modal_rutas)
                                                <div
                                                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                                    <div
                                                        class="bg-white rounded-lg p-6 w-full max-w-md max-h-[80vh] flex flex-col">
                                                        <h3 class="text-lg font-semibold mb-4">Todas las Rutas</h3>
                                                        <div class="flex-1 overflow-y-auto space-y-2">
                                                            @foreach ($rutas as $ruta)
                                                                <div
                                                                    class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                                                    <span>{{ $ruta->namerutas }}</span>
                                                                    <div class="flex space-x-2">
                                                                        <button
                                                                            wire:click="seleccionarRuta({{ $ruta->id }})"
                                                                            class="text-blue-600 text-sm hover:underline">
                                                                            Seleccionar
                                                                        </button>
                                                                        <button
                                                                            wire:click="eliminarRuta({{ $ruta->id }})"
                                                                            class="text-red-500 hover:text-red-700">
                                                                            ×
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="mt-4 flex justify-end">
                                                            <button wire:click="cerrarModalRutas"
                                                                class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">
                                                                Cerrar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- modal para la lista de paradas --}}
                                            @if ($mostrar_modal_paradas_lista)
                                                <div
                                                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                                    <div
                                                        class="bg-white rounded-lg p-6 w-full max-w-md max-h-[80vh] flex flex-col">
                                                        <h3 class="text-lg font-semibold mb-4">Todas las Rutas</h3>
                                                        <div class="flex-1 overflow-y-auto space-y-2">
                                                            @foreach ($paradas as $parada)
                                                                <div
                                                                    class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                                                    <span>{{ $parada->nameparadas }}</span>
                                                                    <div class="flex space-x-2">
                                                                        <button
                                                                            wire:click="seleccionarRuta({{ $parada->id }})"
                                                                            class="text-blue-600 text-sm hover:underline">
                                                                            Seleccionar
                                                                        </button>
                                                                        <button
                                                                            wire:click="eliminarRuta({{ $parada->id }})"
                                                                            class="text-red-500 hover:text-red-700">
                                                                            ×
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="mt-4 flex justify-end">
                                                            <button wire:click="cerrarModalRutas"
                                                                class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">
                                                                Cerrar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                        <!-- Crear Itinerario -->
                                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Crear Día de
                                                Itinerario
                                            </h3>

                                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Día</label>
                                                    <input type="number" wire:model="itinerario_dia" min="1"
                                                        placeholder="1"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Hora
                                                        Inicio</label>
                                                    <input type="time" wire:model="itinerario_hora_inicio"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Hora
                                                        Fin</label>
                                                    <input type="time" wire:model="itinerario_hora_fin"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                                                <textarea wire:model="itinerario_descripcion" rows="3" placeholder="Descripción de las actividades del día"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                            </div>

                                            <!-- Selección de Rutas con Búsqueda -->
                                            <div class="mb-6">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Rutas del
                                                    Itinerario</label>

                                                <!-- Buscador de rutas -->
                                                <div class="relative mb-3">
                                                    <input type="text" wire:model.live="buscar_ruta"
                                                        placeholder="Buscar y seleccionar rutas..."
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                                                    <!-- Dropdown de resultados -->
                                                    @if ($buscar_ruta && count($rutas_filtradas) > 0)
                                                        <div
                                                            class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-40 overflow-y-auto">
                                                            @foreach ($rutas_filtradas as $ruta)
                                                                <button type="button"
                                                                    wire:click="seleccionarRuta({{ $ruta->id }})"
                                                                    class="w-full text-left px-3 py-2 hover:bg-gray-50 focus:bg-gray-50 border-b last:border-b-0">
                                                                    {{ $ruta->namerutas }}
                                                                </button>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Rutas seleccionadas -->
                                                <div class="space-y-2">
                                                    @foreach ($rutas_seleccionadas as $index => $ruta_sel)
                                                        <div
                                                            class="flex items-center justify-between p-3 bg-blue-50 border border-blue-200 rounded-md">
                                                            <div class="flex items-center space-x-3">
                                                                <span
                                                                    class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">{{ $index + 1 }}</span>
                                                                <span
                                                                    class="font-medium">{{ $ruta_sel['nombre'] }}</span>

                                                                <!-- Paradas de la ruta -->
                                                                <div class="flex flex-wrap gap-1">
                                                                    @foreach ($ruta_sel['paradas'] as $parada)
                                                                        <span
                                                                            class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">
                                                                            {{ $parada['nombre'] }}
                                                                        </span>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <div class="flex items-center space-x-2">
                                                                <button
                                                                    wire:click="editarRutaParadas({{ $index }})"
                                                                    class="text-blue-600 hover:text-blue-800 text-sm">
                                                                    Editar paradas
                                                                </button>
                                                                <button
                                                                    wire:click="removerRutaSeleccionada({{ $index }})"
                                                                    class="text-red-500 hover:text-red-700">
                                                                    ×
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            {{-- <!-- Botón para guardar itinerario -->
                                        <div class="flex justify-end">
                                            <button wire:click="guardarItinerario"
                                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                Guardar Itinerario
                                            </button>
                                        </div> --}}
                                            <div class="text-sm text-gray-500 italic">
                                                El itinerario se guardará automáticamente al guardar el paquete.
                                            </div>
                                        </div>

                                        <!-- Lista de Itinerarios Existentes -->
                                        @if (count($itinerarios) > 0)
                                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Itinerarios
                                                    Creados
                                                </h3>
                                                <div class="space-y-4">
                                                    @foreach ($itinerarios as $itinerario)
                                                        <div class="border border-gray-200 rounded-lg p-4">
                                                            <div class="flex items-center justify-between mb-2">
                                                                <h4 class="font-medium">Día {{ $itinerario->dia }}
                                                                </h4>
                                                                <div class="flex items-center space-x-2">
                                                                    <span class="text-sm text-gray-500">
                                                                        {{ $itinerario->hora_inicio }} -
                                                                        {{ $itinerario->hora_fin }}
                                                                    </span>
                                                                    <button
                                                                        wire:click="eliminarItinerario({{ $itinerario->id }})"
                                                                        class="text-red-500 hover:text-red-700">
                                                                        ×
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <p class="text-gray-600 text-sm mb-2">
                                                                {{ $itinerario->descripcion }}</p>

                                                            <!-- Mostrar rutas del itinerario -->
                                                            <div class="flex flex-wrap gap-2">
                                                                @foreach ($itinerario->rutas as $ruta)
                                                                    <span
                                                                        class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                                                        {{ $ruta->namerutas }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Modal para editar paradas de ruta -->
                                    @if ($mostrar_modal_paradas)
                                        <div
                                            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                                                <h3 class="text-lg font-semibold mb-4">Paradas para:
                                                    {{ $ruta_editando['nombre'] ?? '' }}</h3>

                                                <!-- Buscador de paradas -->
                                                <div class="relative mb-4">
                                                    <input type="text" wire:model.live="buscar_parada"
                                                        placeholder="Buscar parada..."
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                                                    @if ($buscar_parada && count($paradas_filtradas) > 0)
                                                        <div
                                                            class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-32 overflow-y-auto">
                                                            @foreach ($paradas_filtradas as $parada)
                                                                <button type="button"
                                                                    wire:click="agregarParadaARuta({{ $parada->id }})"
                                                                    class="w-full text-left px-3 py-2 hover:bg-gray-50">
                                                                    {{ $parada->nameparadas }}
                                                                </button>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Paradas seleccionadas con orden -->
                                                <div class="space-y-2 mb-4 max-h-40 overflow-y-auto">
                                                    @if (isset($ruta_editando['paradas']))
                                                        @foreach ($ruta_editando['paradas'] as $index => $parada)
                                                            <div
                                                                class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                                                <div class="flex items-center space-x-2">
                                                                    <span
                                                                        class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded">{{ $index + 1 }}</span>
                                                                    <span
                                                                        class="text-sm">{{ $parada['nombre'] }}</span>
                                                                </div>
                                                                <button
                                                                    wire:click="removerParadaDeRuta({{ $index }})"
                                                                    class="text-red-500 hover:text-red-700">
                                                                    ×
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <div class="flex justify-end space-x-2">
                                                    <button wire:click="cerrarModalParadas"
                                                        class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50">
                                                        Cancelar
                                                    </button>
                                                    <button wire:click="guardarParadasRuta"
                                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                                        Guardar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                <!-- Botones de acción -->
                                <div class="mt-8 flex justify-between items-center">
                                    @if ($tab_activo !== 'general')
                                        <button type="button" wire:click="anteriorTab"
                                            class="px-6 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                            Anterior
                                        </button>
                                    @else
                                        <div></div>
                                    @endif

                                    <div class="flex space-x-3">
                                        @if ($tab_activo !== 'itinerario')
                                            <button type="button" wire:click="siguienteTab"
                                                class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                                Siguiente
                                            </button>
                                        @else
                                            <button type="submit"
                                                class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                                {{ $modoEdicion ? 'Actualizar Paquete' : 'Guardar Paquete' }}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <!-- Modal de Confirmación para Eliminar -->
        @if ($paquete_a_eliminar)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                    <div class="border-b px-6 py-4">
                        <h2 class="text-xl font-bold text-gray-800">Confirmar Eliminación</h2>
                    </div>

                    <div class="p-6">
                        <p class="text-gray-700 mb-4">¿Estás seguro que deseas eliminar este paquete? Esta acción no se
                            puede deshacer.</p>

                        <div class="flex justify-end space-x-3">
                            <button wire:click="$set('paquete_a_eliminar', null)"
                                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                Cancelar
                            </button>
                            <button wire:click="eliminarPaquete"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                Eliminar Paquete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            // Confirmación antes de eliminar
            Livewire.on('mostrarModalConfirmacion', () => {
                // Puedes personalizar con SweetAlert o similar si lo prefieres
                console.log('Modal de confirmación activado');
            });

            // Deshabilitar botón durante guardado
            Livewire.on('disableSaveButton', () => {
                document.querySelectorAll('button[type="submit"]').forEach(btn => {
                    btn.disabled = true;
                    btn.innerHTML = '<span class="animate-pulse">Procesando...</span>';
                });
            });

            Livewire.on('enableSaveButton', () => {
                document.querySelectorAll('button[type="submit"]').forEach(btn => {
                    btn.disabled = false;
                    btn.innerHTML =
                        '{{ $modoEdicion ? 'Actualizar Paquete' : 'Guardar Paquete' }}';
                });
            });
        });
    </script>
</div>
