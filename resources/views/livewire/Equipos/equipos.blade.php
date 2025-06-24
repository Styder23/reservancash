<div>
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            <span class="text-purple-600">Nuestros Equipos</span> para tu Aventura
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($equipos as $equipo)
                <div
                    class="bg-white rounded-xl shadow-lg hover:shadow-xl overflow-hidden transform hover:-translate-y-1 transition-all duration-300 animate-fade-in">
                    <!-- Image Container -->
                    <div class="h-48 bg-gradient-to-br from-purple-400 to-blue-500 relative overflow-hidden">
                        @if ($equipo->imagenes_equipo)
                            <img src="{{ asset('storage/' . $equipo->imagenes_equipo) }}" alt="{{ $equipo->name_equipo }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                        @else
                            <div class="flex items-center justify-center h-full">
                                <div class="text-center text-white">
                                    <svg class="w-16 h-16 mx-auto mb-2 opacity-75" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                        </path>
                                    </svg>
                                    <p class="font-medium">Sin imagen</p>
                                </div>
                            </div>
                        @endif

                        <!-- Overlay gradient for better text readability -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>

                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span
                                class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-1.5 rounded-full text-sm font-medium shadow-sm">
                                {{ $equipo->categoria->namecategorias ?? 'Sin categoría' }}
                            </span>
                        </div>

                        <!-- Stock Badge -->
                        <div class="absolute top-4 right-4">
                            <span
                                class="bg-blue-500/90 backdrop-blur-sm text-white px-3 py-1.5 rounded-full text-sm font-medium shadow-sm">
                                {{ $equipo->equipos->sum('cantidadequipo') }} unidades
                            </span>
                        </div>

                        <!-- Availability Badge -->
                        <div class="absolute bottom-4 right-4">
                            <span
                                class="bg-green-500/90 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs font-medium">
                                @if ($equipo->equipos->sum('cantidadequipo') > 0)
                                    Disponible
                                @else
                                    Sin stock
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Title and Rating -->
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-xl font-bold text-gray-900 leading-tight">
                                {{ $equipo->name_equipo }}
                            </h3>
                            <!-- Quality Rating (opcional) -->
                            <div class="flex items-center space-x-1 ml-2">
                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                </svg>
                                <span class="text-sm text-gray-600 font-medium">4.7</span>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="flex items-center mb-4">
                            <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                </path>
                            </svg>
                            <span class="text-2xl font-bold text-emerald-600">S/
                                {{ $equipo->precio_equipo }}</span>
                            <span class="text-gray-500 text-sm ml-2">por día</span>
                        </div>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                            {{ Str::limit($equipo->descripcion_equipo ?? 'Sin descripción disponible', 120) }}
                        </p>

                        <!-- Equipment Details -->
                        <div class="space-y-2 mb-6">
                            @if ($equipo->marca)
                                <div class="flex items-center text-sm text-gray-600">
                                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="font-medium">{{ $equipo->marca->namemarcas }}</span>
                                </div>
                            @endif

                            @if ($equipo->modelo)
                                <div class="flex items-center text-sm text-gray-600">
                                    <div
                                        class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-3 h-3 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="font-medium">{{ $equipo->modelo->namemodelos }}</span>
                                </div>
                            @endif

                            @if ($equipo->serie)
                                <div class="flex items-center text-sm text-gray-600">
                                    <div class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Serie: {{ $equipo->serie->nameserie }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-3">
                            <button
                                class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z">
                                    </path>
                                </svg>
                                Rentar
                            </button>
                            <a href="{{ route('vistaequipo', $equipo->id) }}"
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

                    {{-- <!-- Additional info bar -->
                    <div class="px-6 pb-4">
                        <div class="flex items-center justify-between text-xs text-gray-500 bg-gray-50 rounded-lg p-3">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Estado: Excelente</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Entrega inmediata</span>
                            </div>
                        </div>
                    </div> --}}
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    No hay equipos disponibles por ahora.
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        {{-- <div class="mt-8">
            {{ $equipos->links() }}
        </div> --}}
    </div>
</div>
