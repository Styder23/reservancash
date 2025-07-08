<div class="min-h-screen bg-purple-50 py-8">
    <div class="container mx-auto px-2 md:px-4">
        <!-- Mostrar mensajes de error/éxito -->
        @if (session()->has('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-2 mb-6">

            <!-- Título -->
            <h1 class="text-2xl font-semibold text-purple-800 flex items-center gap-2">
                <i class="fas fa-calendar-check text-xl"></i> Gestión de Reservas
            </h1>

            <!-- Info de empresa -->
            @if ($this->getUserHasEmpresa())
                <span class="text-sm text-purple-600">Empresa: <strong>{{ $this->getNombreEmpresa() }}</strong></span>
            @endif

            <!-- Filtros -->
            <div class="flex flex-col lg:flex-row items-center gap-3 w-full lg:w-auto">

                <!-- Buscar -->
                <div class="relative w-full md:w-56">
                    <input type="text" wire:model.debounce.500ms="search"
                        class="w-full pl-9 pr-3 py-1.5 text-sm rounded-md border border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        placeholder="Buscar...">
                    <i class="fas fa-search absolute left-3 top-2.5 text-purple-400 text-sm"></i>
                </div>

                <!-- Estado -->
                <select wire:model="filtroEstado"
                    class="py-1.5 px-3 text-sm rounded-md border border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Todos los estados</option>
                    <option value="pendiente">Pendientes</option>
                    <option value="confirmado">Confirmadas</option>
                    <option value="cancelada">Canceladas</option>
                    <option value="completado">Completadas</option>
                </select>

                <!-- Fecha -->
                <input type="date" wire:model="fechaFiltro"
                    class="py-1.5 px-3 text-sm rounded-md border border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500">

                <!-- Botón Limpiar -->
                <button wire:click="limpiarFiltros"
                    class="flex items-center gap-1 px-3 py-1.5 text-sm bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
                    <i class="fas fa-eraser"></i> Limpiar
                </button>
            </div>
        </div>

        <!-- Verificar si el usuario tiene empresa -->
        @if (!$this->getUserHasEmpresa())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                No tienes una empresa asociada a tu cuenta. Contacta al administrador.
            </div>
        @endif

        <!-- Listado de Reservas -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            @if ($reservas && $reservas->count() > 0)
                <div class="overflow-x-autooverflow-x-auto scrollbar-thin scrollbar-thumb-purple-300">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-purple-100">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                    Cliente</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                    Paquete</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                    Fecha</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                    Estado</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                    Pago</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($reservas as $reserva)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-200 flex items-center justify-center">
                                                <i class="fas fa-user text-purple-600"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $reserva->users->name ?? 'N/A' }}
                                                </div>
                                                <div class="text-sm text-gray-500 hidden md:block">
                                                    {{ $reserva->users->email ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-medium">
                                            {{ $reserva->paquete->nombrepaquete ?? 'N/A' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $reserva->cantidad_personas ?? 0 }} personas
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            @if ($reserva->fecha_viaje)
                                                {{ \Carbon\Carbon::parse($reserva->fecha_viaje)->format('d M Y') }}
                                            @else
                                                Fecha no definida
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            @if ($reserva->created_at)
                                                {{ $reserva->created_at->format('h:i A') }}
                                            @else
                                                Hora no disponible
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span @class([
                                            'px-2 py-1 rounded-full text-xs font-semibold',
                                            'bg-yellow-100 text-yellow-800' => $reserva->estado == 'pendiente',
                                            'bg-green-100 text-green-800' => $reserva->estado == 'confirmada',
                                            'bg-red-100 text-red-800' => $reserva->estado == 'cancelada',
                                            'bg-blue-100 text-blue-800' => $reserva->estado == 'completada',
                                        ])>
                                            {{ ucfirst($reserva->estado) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($reserva->pago)
                                            <button wire:click="mostrarComprobante({{ $reserva->id }})"
                                                class="text-purple-600 hover:text-purple-900 font-medium">
                                                <i class="fas fa-receipt mr-1"></i>Ver comprobante
                                            </button>
                                        @else
                                            <span class="text-red-500">
                                                <i class="fas fa-times-circle mr-1"></i>Sin pago
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex flex-col md:flex-row space-y-1 md:space-y-0 md:space-x-2">
                                            @if ($reserva->estado == 'pendiente')
                                                <button wire:click="abrirModalConfirmar({{ $reserva->id }})"
                                                    class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                                                    <i class="fas fa-check mr-1"></i>Confirmar
                                                </button>
                                                <button wire:click="abrirModalCancelar({{ $reserva->id }})"
                                                    class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                                                    <i class="fas fa-times mr-1"></i>Cancelar
                                                </button>
                                            @endif
                                            <button wire:click="mostrarComprobante({{ $reserva->id }})"
                                                class="px-3 py-1 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors">
                                                <i class="fas fa-eye mr-1"></i>Detalles
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $reservas->links() }}
                </div>
            @else
                <!-- Mensaje cuando no hay reservas -->
                <div class="p-8 text-center">
                    <div class="mx-auto h-24 w-24 text-purple-400 mb-4">
                        <i class="fas fa-calendar-times text-6xl"></i>
                    </div>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No hay reservas encontradas</h3>
                    <p class="mt-1 text-gray-500">
                        @if ($this->getUserHasEmpresa())
                            No se encontraron reservas con los filtros aplicados.
                        @else
                            No tienes una empresa asociada para mostrar reservas.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Confirmar Reserva -->
    @if ($mostrarModalConfirmar)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between border-b pb-3">
                        <h3 class="text-lg font-medium text-purple-800">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Confirmar Reserva
                        </h3>
                        <button wire:click="cerrarModales" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="mt-4">
                        ¿Estás seguro que deseas confirmar esta reserva? Se notificará al cliente sobre la confirmación.
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-100 text-right">
                    <button wire:click="cerrarModales"
                        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button wire:click="confirmarReserva"
                        class="ml-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        <i class="fas fa-check mr-1"></i> Confirmar Reserva
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Cancelar Reserva -->
    @if ($mostrarModalCancelar)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between border-b pb-3">
                        <h3 class="text-lg font-medium text-purple-800">
                            <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                            Cancelar Reserva
                        </h3>
                        <button wire:click="cerrarModales" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="mt-4">
                        <div class="mb-4">
                            <label for="motivoCancelacion" class="block text-sm font-medium text-gray-700">
                                Motivo de cancelación
                            </label>
                            <textarea wire:model="motivoCancelacion" id="motivoCancelacion" rows="3"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm"></textarea>
                            @error('motivoCancelacion')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <p class="text-sm text-gray-600">Se notificará al cliente sobre la cancelación.</p>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-100 text-right">
                    <button wire:click="cerrarModales"
                        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Volver
                    </button>
                    <button wire:click="cancelarReserva"
                        class="ml-2 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        <i class="fas fa-times mr-1"></i> Confirmar Cancelación
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Comprobante de Pago -->
    @if ($comprobanteVisible)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-purple-800">
                            <i class="fas fa-file-invoice-dollar mr-2"></i>
                            Comprobante de Pago
                        </h3>
                        <button wire:click="ocultarComprobante" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        @php
                            $reserva = \App\Models\Reservas::find($comprobanteVisible);
                        @endphp
                        @if ($reserva && $reserva->pago)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-medium text-purple-700 mb-2">Información del Pago</h4>
                                    <div class="space-y-2">
                                        <p><span class="font-medium">Método:</span>
                                            {{ ucfirst($reserva->pago->metodo) }}</p>
                                        <p><span class="font-medium">Monto:</span> S/.
                                            {{ number_format($reserva->total_pago, 2) }}</p>
                                        <p><span class="font-medium">Fecha:</span>
                                            {{ \Carbon\Carbon::parse($reserva->pago->fecha_pago)->format('d/m/Y H:i') }}
                                        </p>
                                        <p><span class="font-medium">Estado:</span>
                                            <span @class([
                                                'px-2 py-1 rounded-full text-xs font-medium',
                                                'bg-green-100 text-green-800' => $reserva->pago->estado == 'completado',
                                                'bg-yellow-100 text-yellow-800' => $reserva->pago->estado == 'pendiente',
                                                'bg-red-100 text-red-800' => $reserva->pago->estado == 'rechazado',
                                            ])>
                                                {{ ucfirst($reserva->pago->estado) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-medium text-purple-700 mb-2">Comprobante</h4>
                                    @if ($reserva->pago->comprobante_pago)
                                        <img src="{{ asset('storage/' . $reserva->pago->comprobante_pago) }}"
                                            alt="Comprobante de pago"
                                            class="max-w-full h-auto rounded-lg border border-gray-200">
                                    @else
                                        <div class="bg-gray-100 p-4 rounded-lg text-center">
                                            <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                                            <p class="text-gray-500">No hay comprobante adjunto</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-exclamation-circle text-4xl text-yellow-500 mb-4"></i>
                                <p class="text-gray-700">No se encontró información de pago para esta reserva.</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button wire:click="ocultarComprobante"
                            class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                            <i class="fas fa-times mr-1"></i> Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif


</div>
