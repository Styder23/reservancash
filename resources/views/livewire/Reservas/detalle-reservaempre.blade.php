<div>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-purple-900 via-purple-800 to-purple-700">

        <!-- Header -->
        <div class="bg-white/10 backdrop-blur-sm shadow-lg border-b border-white/20">
            <div class="container mx-auto px-4 py-6">
                <div class="flex items-center justify-center">
                    <div class="text-center">
                        <h1 class="text-4xl font-bold text-white mb-2">
                            <i class="fas fa-gift mr-3 text-yellow-400"></i>
                            Paquetes Reclamables
                        </h1>
                        <p class="text-white/80 text-lg">
                            Descubre increíbles paquetes turísticos gratuitos disponibles para ti
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mensajes -->
        @if ($mensaje)
            <div class="container mx-auto px-4 mt-4">
                <div
                    class="alert alert-{{ $tipoMensaje === 'success' ? 'success' : ($tipoMensaje === 'warning' ? 'warning' : 'danger') }} 
                        bg-{{ $tipoMensaje === 'success' ? 'green' : ($tipoMensaje === 'warning' ? 'yellow' : 'red') }}-100 
                        border border-{{ $tipoMensaje === 'success' ? 'green' : ($tipoMensaje === 'warning' ? 'yellow' : 'red') }}-400 
                        text-{{ $tipoMensaje === 'success' ? 'green' : ($tipoMensaje === 'warning' ? 'yellow' : 'red') }}-700 
                        px-4 py-3 rounded-lg relative flex items-center justify-between">
                    <div class="flex items-center">
                        <i
                            class="fas fa-{{ $tipoMensaje === 'success' ? 'check-circle' : ($tipoMensaje === 'warning' ? 'exclamation-triangle' : 'times-circle') }} mr-2"></i>
                        <span>{{ $mensaje }}</span>
                    </div>
                    <button wire:click="cerrarMensaje" class="ml-4 text-xl leading-none cursor-pointer">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Contenido Principal -->
        <div class="container mx-auto px-4 py-8">
            @if ($paquetesReclamables->count() > 0)
                <!-- Estadísticas -->
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 mb-8 border border-white/20">
                    <div class="flex items-center justify-center text-center">
                        <div class="bg-emerald-500/20 rounded-full p-4 mr-4">
                            <i class="fas fa-star text-3xl text-yellow-400"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-1">
                                {{ $paquetesReclamables->count() }} Paquetes Disponibles
                            </h3>
                            <p class="text-white/70">
                                Todos los paquetes con precio igual o menor a S/. 25.00
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Grid de Paquetes -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($paquetesReclamables as $paquete)
                        <div
                            class="bg-white/95 backdrop-blur-sm rounded-xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 border border-white/20">
                            <!-- Imagen del Paquete -->
                            <div
                                class="relative h-48 bg-gradient-to-br from-emerald-400 to-emerald-600 overflow-hidden">
                                @if ($paquete->imagen_principal)
                                    <img src="{{ asset('storage/' . $paquete->imagen_principal) }}"
                                        alt="{{ $paquete->nombrepaquete }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-mountain text-6xl text-white/70"></i>
                                    </div>
                                @endif

                                <!-- Badge de Precio -->
                                <div
                                    class="absolute top-4 right-4 bg-yellow-400 text-purple-900 px-3 py-1 rounded-full font-bold text-sm shadow-lg">
                                    <i class="fas fa-tag mr-1"></i>
                                    S/. {{ number_format($paquete->preciopaquete, 2) }}
                                </div>

                                <!-- Badge Gratis -->
                                <div
                                    class="absolute top-4 left-4 bg-emerald-500 text-white px-3 py-1 rounded-full font-bold text-sm shadow-lg">
                                    <i class="fas fa-gift mr-1"></i>
                                    GRATIS
                                </div>
                            </div>

                            <!-- Contenido de la Card -->
                            <div class="p-6">
                                <!-- Título -->
                                <h3 class="text-xl font-bold text-purple-900 mb-3 line-clamp-2">
                                    {{ $paquete->nombrepaquete }}
                                </h3>

                                <!-- Empresa -->
                                @if ($paquete->empresa)
                                    <div class="flex items-center mb-3 text-gray-600">
                                        <i class="fas fa-building mr-2 text-purple-600"></i>
                                        <span class="text-sm">{{ $paquete->empresa->nombre ?? 'Empresa' }}</span>
                                    </div>
                                @endif

                                <!-- Descripción -->
                                <p class="text-gray-700 text-sm mb-4 line-clamp-3">
                                    {{ $paquete->descripcion ?? 'Disfruta de una experiencia única con este increíble paquete turístico.' }}
                                </p>

                                <!-- Detalles del Paquete -->
                                <div class="space-y-2 mb-6">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-users mr-2 text-emerald-600"></i>
                                        <span>{{ $paquete->personas_incluidas ?? 1 }} persona(s) incluida(s)</span>
                                    </div>

                                    @if ($paquete->detalles->first() && $paquete->detalles->first()->destino)
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                                            <span>{{ $paquete->detalles->first()->destino->nombre ?? 'Destino increíble' }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Botón de Reclamar -->
                                <button wire:click="iniciarReclamo({{ $paquete->id }})"
                                    class="w-full bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 
                                           text-purple-900 font-bold py-3 px-6 rounded-lg transition-all duration-300 
                                           transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-gift mr-2"></i>
                                    Reclamar Paquete
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Información adicional -->
                <div class="mt-12 bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                    <div class="text-center">
                        <i class="fas fa-info-circle text-4xl text-yellow-400 mb-4"></i>
                        <h3 class="text-2xl font-bold text-white mb-3">¿Cómo funciona?</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                            <div class="text-center">
                                <div
                                    class="bg-emerald-500/20 rounded-full p-4 mx-auto mb-3 w-16 h-16 flex items-center justify-center">
                                    <i class="fas fa-mouse-pointer text-2xl text-yellow-400"></i>
                                </div>
                                <h4 class="text-lg font-semibold text-white mb-2">1. Selecciona</h4>
                                <p class="text-white/70 text-sm">Elige el paquete que más te guste</p>
                            </div>
                            <div class="text-center">
                                <div
                                    class="bg-emerald-500/20 rounded-full p-4 mx-auto mb-3 w-16 h-16 flex items-center justify-center">
                                    <i class="fas fa-gift text-2xl text-yellow-400"></i>
                                </div>
                                <h4 class="text-lg font-semibold text-white mb-2">2. Reclama</h4>
                                <p class="text-white/70 text-sm">Haz clic en "Reclamar Paquete"</p>
                            </div>
                            <div class="text-center">
                                <div
                                    class="bg-emerald-500/20 rounded-full p-4 mx-auto mb-3 w-16 h-16 flex items-center justify-center">
                                    <i class="fas fa-plane text-2xl text-yellow-400"></i>
                                </div>
                                <h4 class="text-lg font-semibold text-white mb-2">3. Disfruta</h4>
                                <p class="text-white/70 text-sm">¡Prepárate para tu aventura!</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Estado vacío -->
                <div class="text-center py-16">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-12 border border-white/20 max-w-md mx-auto">
                        <i class="fas fa-gift text-6xl text-yellow-400 mb-6"></i>
                        <h3 class="text-2xl font-bold text-white mb-4">
                            No hay paquetes reclamables disponibles
                        </h3>
                        <p class="text-white/70 mb-6">
                            Por el momento no tenemos paquetes gratuitos disponibles. ¡Vuelve pronto para descubrir
                            nuevas
                            ofertas!
                        </p>
                        <button onclick="window.location.reload()"
                            class="bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 
                                   text-purple-900 font-bold py-3 px-6 rounded-lg transition-all duration-300">
                            <i class="fas fa-sync-alt mr-2"></i>
                            Actualizar
                        </button>
                    </div>
                </div>
            @endif
        </div>

        <!-- Modal para completar datos de la reserva -->
        @if ($showModal && $paqueteSeleccionado)
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
                <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 overflow-hidden">
                    <!-- Header del Modal -->
                    <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6 text-white">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold">
                                <i class="fas fa-gift mr-2"></i>
                                Completar Reclamo
                            </h3>
                            <button wire:click="cerrarModal" class="text-white/80 hover:text-white text-2xl">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Contenido del Modal -->
                    <div class="p-6">
                        <!-- Información del Paquete -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h4 class="font-semibold text-gray-800 mb-2">{{ $paqueteSeleccionado->nombrepaquete }}</h4>
                            <p class="text-sm text-gray-600 mb-2">
                                <i class="fas fa-tag mr-1"></i>
                                Precio original: S/. {{ number_format($paqueteSeleccionado->preciopaquete, 2) }}
                            </p>
                            <p class="text-sm text-emerald-600 font-semibold">
                                <i class="fas fa-gift mr-1"></i>
                                ¡Totalmente GRATIS por tu fidelidad!
                            </p>
                        </div>

                        <!-- Formulario -->
                        <form wire:submit.prevent="confirmarReclamo">
                            <!-- Fecha de Viaje -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    Fecha de Viaje *
                                </label>
                                <input type="date" wire:model="fechaViaje"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                @error('fechaViaje')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Cantidad de Personas -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-users mr-1"></i>
                                    Cantidad de Personas *
                                </label>
                                <select wire:model="cantidadPersonas"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                    <option value="1">1 persona</option>
                                    <option value="2">2 personas</option>
                                    <option value="3">3 personas</option>
                                    <option value="4">4 personas</option>
                                    <option value="5">5 personas</option>
                                    <option value="6">6 personas</option>
                                </select>
                                @error('cantidadPersonas')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Notas Adicionales -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-comment mr-1"></i>
                                    Notas Adicionales (Opcional)
                                </label>
                                <textarea wire:model="notas" rows="3" placeholder="Alguna solicitud especial o comentario..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none"></textarea>
                            </div>

                            <!-- Botones -->
                            <div class="flex gap-3">
                                <button type="button" wire:click="cerrarModal"
                                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="flex-1 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-medium py-2 px-4 rounded-lg transition-all">
                                    <i class="fas fa-check mr-2"></i>
                                    Confirmar Reclamo
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
