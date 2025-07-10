<!-- resources/views/livewire/mis-reservas.blade.php -->
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-purple-800 mb-4 md:mb-0">Mi Historial</h1>

            <!-- Filtros -->
            <div class="flex space-x-4">
                <select wire:model.live="filtroEstado"
                    class="px-4 py-2 rounded-lg border border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Todos los estados</option>
                    <option value="pendiente">Pendientes</option>
                    <option value="confirmada">Confirmadas</option>
                    <option value="cancelada">Canceladas</option>
                </select>
            </div>
        </div>

        <!-- Listado de Reservas -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            @if ($reservas->count() > 0)
                @foreach ($reservas as $reserva)
                    <div
                        class="border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition-colors duration-150">
                        <div class="p-6">
                            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4">
                                <!-- Sección de imagen y datos principales -->
                                <div class="flex flex-col sm:flex-row gap-4 flex-grow">
                                    <!-- Imagen del paquete -->
                                    <div class="w-full sm:w-24 h-48 sm:h-24 rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="{{ asset('storage/' . $reserva->paquete->imagen_principal) }}"
                                            alt="{{ $reserva->paquete->nombrepaquete }}"
                                            class="w-full h-full object-cover">
                                    </div>

                                    <!-- Información principal -->
                                    <div class="flex-grow">
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3">
                                            <h2 class="text-xl font-semibold text-gray-800 mb-2 sm:mb-0">
                                                {{ $reserva->paquete->nombrepaquete ?? 'Paquete no disponible' }}
                                            </h2>
                                            <span @class([
                                                'px-3 py-1 rounded-full text-sm font-medium w-fit',
                                                'bg-yellow-100 text-yellow-800' => $reserva->estado === 'pendiente',
                                                'bg-green-100 text-green-800' => $reserva->estado === 'confirmada',
                                                'bg-red-100 text-red-800' => $reserva->estado === 'cancelada',
                                                'bg-orange-100 text-orange-800' =>
                                                    $reserva->estado === 'cancelacion_solicitada',
                                            ])>
                                                @if ($reserva->estado === 'cancelacion_solicitada')
                                                    Cancelación Solicitada
                                                @else
                                                    {{ ucfirst($reserva->estado) }}
                                                @endif
                                            </span>
                                        </div>

                                        <!-- Grid de información -->
                                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 text-sm">
                                            <div class="flex items-center text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-purple-500 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <span>{{ \Carbon\Carbon::parse($reserva->fechareserva)->format('d M Y') }}</span>
                                            </div>
                                            <div class="flex items-center text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-purple-500 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>{{ \Carbon\Carbon::parse($reserva->created_at)->format('h:i A') }}</span>
                                            </div>
                                            <div class="flex items-center text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-purple-500 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                    </path>
                                                </svg>
                                                <span>{{ $reserva->cantidad_personas ?? 'N/A' }} personas</span>
                                            </div>
                                            <div class="flex items-center text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-purple-500 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                                <span class="font-semibold text-gray-800">S/.
                                                    {{ number_format($reserva->total_pago ?? 0, 2) }}</span>
                                            </div>
                                        </div>

                                        <!-- Notas -->
                                        @if ($reserva->notas || $reserva->motivo_cliente)
                                            <div class="mt-4 space-y-3">
                                                <!-- Notas generales -->
                                                @if ($reserva->notas)
                                                    <div class="p-3 bg-blue-50 rounded-lg border-l-4 border-blue-400">
                                                        <h4 class="font-medium text-blue-800 mb-1 flex items-center">
                                                            <svg class="w-4 h-4 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                                </path>
                                                            </svg>
                                                            Notas:
                                                        </h4>
                                                        <p class="text-blue-700 text-sm">{{ $reserva->notas }}</p>
                                                    </div>
                                                @endif

                                                <!-- Motivo de cancelación del cliente -->
                                                @if ($reserva->motivo_cliente)
                                                    <div class="p-3 bg-red-50 rounded-lg border-l-4 border-red-400">
                                                        <h4 class="font-medium text-red-800 mb-1 flex items-center">
                                                            <svg class="w-4 h-4 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                                                                </path>
                                                            </svg>
                                                            Motivo de Cancelación:
                                                        </h4>
                                                        <p class="text-red-700 text-sm">{{ $reserva->motivo_cliente }}
                                                        </p>
                                                        @if ($reserva->fecha_solicitud_cancelacion)
                                                            <p class="text-red-600 text-xs mt-1">
                                                                Solicitada el
                                                                {{ \Carbon\Carbon::parse($reserva->fecha_solicitud_cancelacion)->format('d M Y - h:i A') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Acciones -->
                                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 flex-shrink-0">
                                    <!-- Solo mostrar botón cancelar si está pendiente o confirmado -->
                                    {{-- @if (in_array($reserva->estado, ['pendiente', 'confirmado']))
                                        <button wire:click="mostrarModalCancelar({{ $reserva->id }})"
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Solicitar Cancelación
                                        </button>
                                    @endif --}}

                                    <!-- Botón ver detalles -->
                                    <button wire:click="mostrarModalDetalles({{ $reserva->id }})"
                                        class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200 text-center flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Ver Detalles
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Paginación -->
                @if ($reservas->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $reservas->links() }}
                    </div>
                @endif
            @else
                <!-- Mensaje cuando no hay reservas -->
                <div class="p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No tienes reservas</h3>
                        <p class="text-gray-500 mb-6">Empieza a explorar nuestros increíbles paquetes turísticos y haz
                            tu primera reserva.</p>
                        <div class="space-y-3">
                            <a href="{{ route('paquetes') }}"
                                class="inline-flex items-center px-6 py-3 bg-purple-600 border border-transparent rounded-lg font-semibold text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Explorar Paquetes
                            </a>
                            <div class="text-sm text-gray-400">
                                <p>Descubre destinos únicos y experiencias inolvidables</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de Cancelación -->
    @if ($modalCancelarVisible)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <svg class="h-10 w-10 text-yellow-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-gray-900">Solicitar Cancelación</h3>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mb-4">
                        <div class="flex">
                            <svg class="flex-shrink-0 h-5 w-5 text-yellow-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                                </path>
                            </svg>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-yellow-800">Solicitud de Cancelación</h4>
                                <p class="text-sm text-yellow-700 mt-1">
                                    Tu solicitud será revisada por nuestro equipo. Te contactaremos para proceder con el
                                    reembolso según nuestras políticas.
                                </p>
                            </div>
                        </div>
                    </div>

                    <p class="text-gray-600 mb-4">
                        Para procesar tu solicitud de cancelación, por favor explica el motivo:
                    </p>

                    <!-- Campo obligatorio para motivo del cliente -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Motivo de la solicitud *
                        </label>
                        <textarea wire:model="motivoCliente"
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500 @error('motivoCliente') border-red-500 @enderror"
                            rows="4" placeholder="Describe detalladamente el motivo de tu solicitud de cancelación..." required></textarea>
                        @error('motivoCliente')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Información de contacto -->
                    <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-4">
                        <h4 class="text-sm font-medium text-blue-800 mb-2">Información de Contacto</h4>
                        <div class="text-sm text-blue-700 space-y-1">
                            <p><strong>WhatsApp:</strong> +51 943 654 321</p>
                            <p><strong>Email:</strong> reservas@tuempresa.com</p>
                            <p><strong>Horario:</strong> Lun-Vie 9:00 AM - 6:00 PM</p>
                        </div>
                    </div>

                    <!-- Política de cancelación -->
                    <div class="bg-gray-50 border border-gray-200 rounded-md p-3 mb-4">
                        <h4 class="text-sm font-medium text-gray-800 mb-1">Política de Cancelación</h4>
                        <p class="text-xs text-gray-600">
                            Las cancelaciones están sujetas a nuestras políticas. El reembolso dependerá del tiempo de
                            anticipación y las condiciones del paquete.
                        </p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button wire:click="cerrarModal"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancelar
                        </button>
                        <button wire:click="solicitarCancelacion"
                            class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors disabled:opacity-50"
                            :disabled="!$wire.motivoCliente || $wire.motivoCliente.length < 10"> Enviar Solicitud
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Mensajes de éxito/error -->
    @if (session()->has('message'))
        <div
            class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg z-50">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('message') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div
            class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg z-50">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Modal de Detalles Reserva-->
    @if ($modalDetallesVisible && $reservaSeleccionada)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <!-- Header del modal -->
                <div class="sticky top-0 bg-white border-b border-gray-200 p-6 rounded-t-lg">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-gray-900">Detalles de la Reserva</h3>
                        <button wire:click="cerrarModalDetalles" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Contenido del modal -->
                <div class="p-6">
                    <!-- Información del paquete -->
                    <div class="mb-6">
                        <div class="flex flex-col lg:flex-row gap-6">
                            <!-- Imagen del paquete -->
                            <div class="lg:w-1/3">
                                <img src="{{ asset('storage/' . $reservaSeleccionada->paquete->imagen_principal) }}"
                                    alt="{{ $reservaSeleccionada->paquete->nombrepaquete }}"
                                    class="w-full h-64 object-cover rounded-lg shadow-md">
                            </div>

                            <!-- Información básica -->
                            <div class="lg:w-2/3">
                                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                                    {{ $reservaSeleccionada->paquete->nombrepaquete }}
                                </h2>

                                <!-- Estado de la reserva -->
                                <div class="mb-4">
                                    <span @class([
                                        'px-4 py-2 rounded-full text-sm font-medium',
                                        'bg-yellow-100 text-yellow-800' =>
                                            $reservaSeleccionada->estado === 'pendiente',
                                        'bg-green-100 text-green-800' =>
                                            $reservaSeleccionada->estado === 'confirmada',
                                        'bg-red-100 text-red-800' => $reservaSeleccionada->estado === 'cancelada',
                                        'bg-orange-100 text-orange-800' =>
                                            $reservaSeleccionada->estado === 'cancelacion_solicitada',
                                    ])>
                                        @if ($reservaSeleccionada->estado === 'cancelacion_solicitada')
                                            Cancelación Solicitada
                                        @else
                                            {{ ucfirst($reservaSeleccionada->estado) }}
                                        @endif
                                    </span>
                                </div>

                                <!-- Descripción del paquete -->
                                @if ($reservaSeleccionada->paquete->descripcion)
                                    <div class="mb-4">
                                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Descripción</h4>
                                        <p class="text-gray-600 leading-relaxed">
                                            {{ $reservaSeleccionada->paquete->descripcion }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Información de la reserva -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Información de la Reserva</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Código de reserva -->
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-purple-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                    </svg>
                                    <span class="font-medium text-gray-700">Código</span>
                                </div>
                                <p class="text-gray-900 font-semibold">#{{ $reservaSeleccionada->id }}</p>
                            </div>

                            <!-- Fecha de reserva -->
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-purple-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="font-medium text-gray-700">Fecha de Viaje</span>
                                </div>
                                <p class="text-gray-900 font-semibold">
                                    {{ \Carbon\Carbon::parse($reservaSeleccionada->fechareserva)->format('d M Y') }}
                                </p>
                            </div>

                            <!-- Hora de reserva -->
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-purple-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium text-gray-700">Hora</span>
                                </div>
                                <p class="text-gray-900 font-semibold">
                                    {{ \Carbon\Carbon::parse($reservaSeleccionada->created_at)->format('h:i A') }}</p>
                            </div>

                            <!-- Cantidad de personas -->
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-purple-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    <span class="font-medium text-gray-700">Personas</span>
                                </div>
                                <p class="text-gray-900 font-semibold">
                                    {{ $reservaSeleccionada->cantidad_personas ?? 'N/A' }}</p>
                            </div>

                            <!-- Total -->
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-purple-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    <span class="font-medium text-gray-700">Total</span>
                                </div>
                                <p class="text-gray-900 font-bold text-lg">S/.
                                    {{ number_format($reservaSeleccionada->total_pago ?? 0, 2) }}</p>
                            </div>

                            <!-- Fecha de creación -->
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-purple-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                    <span class="font-medium text-gray-700">Reservado el</span>
                                </div>
                                <p class="text-gray-900 font-semibold">
                                    {{ \Carbon\Carbon::parse($reservaSeleccionada->created_at)->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notas -->
                    @if ($reservaSeleccionada->notas || $reservaSeleccionada->motivo_cliente)
                        <div class="mb-6 space-y-4">
                            <!-- Notas generales -->
                            @if ($reservaSeleccionada->notas)
                                <div class="bg-blue-50 rounded-lg p-6 border-l-4 border-blue-400">
                                    <h4 class="text-lg font-semibold text-blue-800 mb-2 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Notas Adicionales
                                    </h4>
                                    <p class="text-blue-700">{{ $reservaSeleccionada->notas }}</p>
                                </div>
                            @endif

                            <!-- Motivo de cancelación del cliente -->
                            @if ($reservaSeleccionada->motivo_cliente)
                                <div class="bg-red-50 rounded-lg p-6 border-l-4 border-red-400">
                                    <h4 class="text-lg font-semibold text-red-800 mb-2 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                                            </path>
                                        </svg>
                                        Motivo de Cancelación
                                    </h4>
                                    <p class="text-red-700 mb-2">{{ $reservaSeleccionada->motivo_cliente }}</p>
                                    @if ($reservaSeleccionada->fecha_solicitud_cancelacion)
                                        <div class="flex items-center text-red-600 text-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            Solicitada el
                                            {{ \Carbon\Carbon::parse($reservaSeleccionada->fecha_solicitud_cancelacion)->format('d M Y - h:i A') }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Información del paquete adicional -->
                    @if ($reservaSeleccionada->paquete->duracion || $reservaSeleccionada->paquete->precio_por_persona)
                        <div class="bg-gray-50 rounded-lg p-6 mb-6">
                            <h4 class="text-xl font-semibold text-gray-800 mb-4">Detalles del Paquete</h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if ($reservaSeleccionada->paquete->duracion)
                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-purple-500 mr-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="font-medium text-gray-700">Duración</span>
                                        </div>
                                        <p class="text-gray-900 font-semibold">
                                            {{ $reservaSeleccionada->paquete->duracion }}</p>
                                    </div>
                                @endif

                                @if ($reservaSeleccionada->paquete->precio_por_persona)
                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-purple-500 mr-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                            <span class="font-medium text-gray-700">Precio por persona</span>
                                        </div>
                                        <p class="text-gray-900 font-semibold">S/.
                                            {{ number_format($reservaSeleccionada->paquete->precio_por_persona, 2) }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Footer del modal -->
                <div class="sticky bottom-0 bg-white border-t border-gray-200 p-6 rounded-b-lg">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            Reserva #{{ $reservaSeleccionada->id }}
                        </div>
                        <div class="flex space-x-3">
                            @if (in_array($reservaSeleccionada->estado, ['pendiente', 'confirmado']))
                                <button
                                    wire:click="mostrarModalCancelar({{ $reservaSeleccionada->id }}); cerrarModalDetalles()"
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                                    Solicitar Cancelación
                                </button>
                            @endif
                            <button wire:click="cerrarModalDetalles"
                                class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
