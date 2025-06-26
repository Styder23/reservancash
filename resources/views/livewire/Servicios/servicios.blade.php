<div>
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            <span class="text-purple-600">Nuestros Servicios</span> para tu Aventura
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($servicios as $servicio)
                <div
                    class="bg-white rounded-xl shadow-lg hover:shadow-xl overflow-hidden transform hover:-translate-y-1 transition-all duration-300 animate-fade-in">
                    <!-- Image Container -->
                    <div class="h-48 bg-gradient-to-br from-purple-400 to-blue-500 relative overflow-hidden">
                        <img src="{{ asset('storage/' . $servicio->imageneservicio) }}"
                            alt="{{ $servicio->nombreservicio }}"
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">

                        <!-- Overlay gradient for better text readability -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>

                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span
                                class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-1.5 rounded-full text-sm font-medium shadow-sm">
                                {{ $servicio->categoria ?? 'Servicio' }}
                            </span>
                        </div>

                        <!-- Favorite/Heart Icon (opcional) -->
                        <div class="absolute top-4 right-4">
                            <button wire:click="toggleFavorito({{ $servicio->id }})"
                                class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-sm hover:bg-white transition-colors">
                                <svg class="w-4 h-4 {{ in_array($servicio->id, $favoritos) ? 'text-red-500 fill-current' : 'text-gray-600' }}"
                                    fill="{{ in_array($servicio->id, $favoritos) ? 'currentColor' : 'none' }}"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    {{-- Mensajes de notificación --}}
                    @if (session()->has('success'))
                        <div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg z-50">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-md shadow-lg z-50">
                            {{ session('error') }}
                        </div>
                    @endif
                    <!-- Content -->
                    <div class="p-6">
                        <!-- Title and Rating -->
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-xl font-bold text-gray-900 leading-tight">
                                {{ $servicio->nombreservicio }}
                            </h3>
                            <!-- Rating (opcional) -->
                            <div class="flex items-center space-x-1 ml-2">
                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                </svg>
                                <span class="text-sm text-gray-600 font-medium">4.8</span>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="flex items-center mb-4">
                            <span class="text-2xl font-bold text-emerald-600">S/{{ $servicio->precioservicio }}</span>
                            <span class="text-gray-500 text-sm ml-1">por persona</span>
                        </div>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">
                            {{ Str::limit($servicio->descripcionservicio ?? 'Sin descripción disponible', 120) }}
                        </p>

                        <!-- Action Buttons -->
                        <div class="flex space-x-3">
                            <button
                                class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg">
                                Reservar
                            </button>
                            <a href="{{ route('vistaservicio', $servicio->id) }}"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-200 flex items-center justify-center group">
                                <span class="mr-1">Ver más</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Optional: Additional info bar -->
                    {{-- <div class="px-6 pb-4">
                        <div class="flex items-center justify-between text-xs text-gray-500 bg-gray-50 rounded-lg p-3">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>2-3 horas</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Disponible</span>
                            </div>
                        </div>
                    </div> --}}
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    No hay servicios disponibles por ahora.
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        {{-- <div class="mt-8">
            {{ $equipos->links() }}
        </div> --}}

    </div>
    <script>
        // Script para ocultar las notificaciones después de 3 segundos
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const notifications = document.querySelectorAll('.fixed.top-4.right-4');
                notifications.forEach(function(notification) {
                    notification.style.display = 'none';
                });
            }, 3000);
        });
    </script>
</div>
