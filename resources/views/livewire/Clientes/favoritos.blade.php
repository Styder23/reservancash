<!-- resources/views/livewire/favoritos.blade.php -->
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <!-- Titulo y buscador -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-purple-800 mb-4 md:mb-0">Mis Favoritos</h1>

            <div class="relative w-full md:w-64">
                <input wire:model.live="search" type="text" placeholder="Buscar en favoritos..."
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-purple-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        <!-- Sección de Paquetes -->
        @if ($paquetes->count() > 0)
            <div class="mb-12">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-purple-700">Paquetes Favoritos</h2>
                    @if ($paquetes->count() > 6)
                        <button wire:click="toggleShowAll('paquetes')"
                            class="text-jade-600 hover:text-jade-800 font-medium">
                            {{ $showAll['paquetes'] ? 'Mostrar menos' : 'Mostrar más' }}
                        </button>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($paquetes->take($showAll['paquetes'] ? $paquetes->count() : 6) as $paquete)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="{{ Storage::url($paquete->imagen_principal) }}"
                                    alt="{{ $paquete->nombrepaquete }}" class="w-full h-48 object-cover">
                                <button wire:click="removeFromFavorites('paquete', {{ $paquete->id }})"
                                    class="absolute top-3 right-3 bg-white p-2 rounded-full shadow-md hover:bg-red-100 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 fill-current"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="p-5">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $paquete->nombrepaquete }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $paquete->descripcion }}</p>
                                <div class="flex justify-between items-center">
                                    <span
                                        class="text-lg font-bold text-jade-600">S/.{{ number_format($paquete->preciopaquete, 2) }}</span>
                                    <a href="{{ route('vistapaquete', $paquete->id) }}"
                                        class="text-purple-600 hover:text-purple-800 font-medium">Ver detalles</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Sección de Equipos -->
        @if ($equipos->count() > 0)
            <div class="mb-12">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-purple-700">Equipos Favoritos</h2>
                    @if ($equipos->count() > 6)
                        <button wire:click="toggleShowAll('equipos')"
                            class="text-jade-600 hover:text-jade-800 font-medium">
                            {{ $showAll['equipos'] ? 'Mostrar menos' : 'Mostrar más' }}
                        </button>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($equipos->take($showAll['equipos'] ? $equipos->count() : 6) as $equipo)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $equipo->imagenes_equipo) }}"
                                    alt="{{ $equipo->name_equipo }}" class="w-full h-48 object-cover">
                                <button wire:click="removeFromFavorites('equipo', {{ $equipo->id }})"
                                    class="absolute top-3 right-3 bg-white p-2 rounded-full shadow-md hover:bg-red-100 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 fill-current"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="p-5">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $equipo->name_equipo }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $equipo->descripcion_equipo }}</p>
                                <div class="flex justify-between items-center">
                                    <span
                                        class="text-lg font-bold text-jade-600">S/.{{ number_format($equipo->precio_equipo, 2) }}/día</span>
                                    <a href="{{ route('vistaequipo', $equipo->id) }}"
                                        class="text-purple-600 hover:text-purple-800 font-medium">Ver detalles</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Sección de Servicios -->
        @if ($servicios->count() > 0)
            <div class="mb-12">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-purple-700">Servicios Favoritos</h2>
                    @if ($servicios->count() > 6)
                        <button wire:click="toggleShowAll('servicios')"
                            class="text-jade-600 hover:text-jade-800 font-medium">
                            {{ $showAll['servicios'] ? 'Mostrar menos' : 'Mostrar más' }}
                        </button>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($servicios->take($showAll['servicios'] ? $servicios->count() : 6) as $servicio)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $servicio->imageneservicio) }}"
                                    alt="{{ $servicio->nombreservicio }}" class="w-full h-48 object-cover">
                                <button wire:click="removeFromFavorites('servicio', {{ $servicio->id }})"
                                    class="absolute top-3 right-3 bg-white p-2 rounded-full shadow-md hover:bg-red-100 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 fill-current"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="p-5">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $servicio->nombreservicio }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $servicio->descripcionservicio }}</p>
                                <div class="flex justify-between items-center">
                                    <span
                                        class="text-lg font-bold text-jade-600">S/.{{ number_format($servicio->precioservicio, 2) }}</span>
                                    <a href="{{ route('vistaservicio', $servicio->id) }}"
                                        class="text-purple-600 hover:text-purple-800 font-medium">Ver detalles</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Sección de Destinos -->
        @if ($destinos->count() > 0)
            <div class="mb-12">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-purple-700">Destinos Favoritos</h2>
                    @if ($destinos->count() > 6)
                        <button wire:click="toggleShowAll('destinos')"
                            class="text-jade-600 hover:text-jade-800 font-medium">
                            {{ $showAll['destinos'] ? 'Mostrar menos' : 'Mostrar más' }}
                        </button>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($destinos->take($showAll['destinos'] ? $destinos->count() : 6) as $destino)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="{{ $destino->imagen_url }}" alt="{{ $destino->nombre }}"
                                    class="w-full h-48 object-cover">
                                <button wire:click="removeFromFavorites('destino', {{ $destino->id }})"
                                    class="absolute top-3 right-3 bg-white p-2 rounded-full shadow-md hover:bg-red-100 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 fill-current"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="p-5">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $destino->nombre }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $destino->descripcion }}</p>
                                <a href="{{ route('vistadestino', $destino->id) }}"
                                    class="text-purple-600 hover:text-purple-800 font-medium">Ver detalles</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Mensaje cuando no hay favoritos -->
        @if ($paquetes->count() === 0 && $equipos->count() === 0 && $servicios->count() === 0 && $destinos->count() === 0)
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-purple-400 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">No tienes favoritos aún</h2>
                <p class="text-gray-500 mb-6">Guarda tus paquetes, equipos, servicios y destinos favoritos para
                    encontrarlos fácilmente aquí.</p>
                <a href="#"
                    class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200">
                    Explorar opciones
                </a>
            </div>
        @endif
    </div>
</div>
