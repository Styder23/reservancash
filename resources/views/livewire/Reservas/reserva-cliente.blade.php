<!-- resources/views/livewire/mis-reservas.blade.php -->
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-purple-800 mb-4 md:mb-0">Mis Reservas</h1>

            <!-- Filtros -->
            <div class="flex space-x-4">
                <select wire:model="filtroEstado"
                    class="px-4 py-2 rounded-lg border border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Todos los estados</option>
                    <option value="pendiente">Pendientes</option>
                    <option value="confirmado">Confirmadas</option>
                    <option value="cancelado">Canceladas</option>
                </select>

                <input type="date" wire:model="fechaFiltro"
                    class="px-4 py-2 rounded-lg border border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
        </div>

        <!-- Listado de Reservas -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            @if ($reservas->count() > 0)
                @foreach ($reservas as $reserva)
                    <div
                        class="border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition-colors duration-150">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                <!-- Información principal -->
                                <div class="mb-4 md:mb-0">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h2 class="text-xl font-semibold text-gray-800">
                                            {{ $reserva->cli_paquete->paquetes->nombrepaquete ?? 'Paquete no disponible' }}
                                        </h2>
                                        <span @class([
                                            'px-2 py-1 rounded-full text-xs font-medium',
                                            'bg-yellow-100 text-yellow-800' => $reserva->estado === 'pendiente',
                                            'bg-green-100 text-green-800' => $reserva->estado === 'confirmado',
                                            'bg-red-100 text-red-800' => $reserva->estado === 'cancelado',
                                        ])>
                                            {{ ucfirst($reserva->estado) }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            {{-- <span>{{ $reserva->fechareserva->format('d M Y') }}</span> --}}
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{-- <span>{{ $reserva->created_at->format('h:i A') }}</span> --}}
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            <span>{{ $reserva->cli_paquete->paquetes->cantidadpaquete ?? 'N/A' }}
                                                personas</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                            <span>S/.
                                                {{ number_format($reserva->cli_paquete->preciototal ?? 0, 2) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Acciones -->
                                <div class="flex flex-col sm:flex-row sm:space-x-3 space-y-2 sm:space-y-0">
                                    @if ($reserva->estado === 'pendiente')
                                        <button wire:click="confirmarReserva({{ $reserva->id }})"
                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                            Confirmar
                                        </button>
                                        <button wire:click="mostrarModalCancelar({{ $reserva->id }})"
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                            Cancelar
                                        </button>
                                    @endif

                                    <a href="{{ route('vistareservacli', $reserva->id) }}"
                                        class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-center">
                                        Ver Detalles
                                    </a>
                                </div>
                            </div>

                            <!-- Notas -->
                            @if ($reserva->notas)
                                <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                    <h4 class="font-medium text-blue-800 mb-1">Notas:</h4>
                                    <p class="text-blue-700">{{ $reserva->notas }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach


                <!-- Paginación -->
                {{-- @if ($reservas->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $reservas->links() }}
                    </div>
                @endif --}}
            @else
                <!-- Mensaje cuando no hay reservas -->
                <div class="p-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No tienes reservas</h3>
                    <p class="mt-1 text-gray-500">Empieza a explorar nuestros paquetes y haz tu primera reserva.</p>
                    <div class="mt-6">
                        <a href="{{ route('paquetes') }}"
                            class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Ver Paquetes
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de Cancelación -->
    @if ($mostrarModalCancelar)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Confirmar Cancelación</h3>
                    <p class="text-gray-600 mb-6">¿Estás seguro que deseas cancelar esta reserva?</p>

                    <div class="flex justify-end space-x-3">
                        <button wire:click="cerrarModal"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Volver
                        </button>
                        <button wire:click="cancelarReserva"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Confirmar Cancelación
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
