<div>
    <!-- Header del Paquete -->
    <div class="relative h-48 bg-gradient-to-r from-blue-900 to-blue-700">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative z-10 container mx-auto px-4 h-full flex items-center">
            <div class="text-white max-w-3xl">
                @if ($paquete->det_paquete->first()->promos)
                    <span class="bg-yellow-400 text-black text-sm font-bold px-3 py-1 rounded-full mr-3">
                        Promoción Activa
                    </span>
                @endif
                <h1 class="text-4xl font-bold mb-4">{{ $paquete->nombrepaquete }}</h1>
                <p class="text-xl text-gray-200">{{ $paquete->descripcion }}</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Contenido Principal -->
            <div class="lg:col-span-2">
                <!-- Galería de Imágenes -->
                <div class="mb-8" x-data="lightbox()">
                    <!-- Grid de miniaturas -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 h-96">
                        <!-- Imagen principal -->
                        @if ($paquete->imagen_principal)
                            <div class="col-span-2 row-span-2 relative group">
                                <img src="{{ asset('storage/' . $paquete->imagen_principal) }}"
                                    alt="Imagen principal del paquete"
                                    class="w-full h-full object-cover rounded-lg cursor-pointer transition-opacity duration-300 group-hover:opacity-90"
                                    @click="openLightbox(0)">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300">
                                </div>
                            </div>
                        @endif

                        <!-- Imágenes secundarias -->
                        @foreach ($paquete->imagenes as $key => $imagen)
                            @php
                                $realIndex = $paquete->imagen_principal ? $key + 1 : $key;
                                $maxVisibleImages = $paquete->imagen_principal ? 3 : 4;
                            @endphp

                            @if ($key < $maxVisibleImages)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $imagen->url) }}" alt="Imagen del paquete"
                                        class="w-full h-full object-cover rounded-lg cursor-pointer transition-opacity duration-300 group-hover:opacity-90"
                                        @click="openLightbox({{ $realIndex }})">

                                    <!-- Overlay para mostrar cantidad de imágenes restantes -->
                                    @if ($key === $maxVisibleImages - 1 && $paquete->imagenes->count() > $maxVisibleImages)
                                        <div class="absolute inset-0 bg-black bg-opacity-60 rounded-lg flex items-center justify-center cursor-pointer transition-all duration-300 group-hover:bg-opacity-70"
                                            @click="openLightbox({{ $realIndex }})">
                                            <span class="text-white font-semibold text-lg">
                                                +{{ $paquete->imagenes->count() - $maxVisibleImages }} fotos
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Lightbox mejorado -->
                    <div x-show="lightboxOpen" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 bg-black bg-opacity-95 z-50 flex items-center justify-center p-4" x-cloak
                        @click.away="lightboxOpen = false" @keydown.escape.window="lightboxOpen = false">

                        <div class="relative w-full max-w-6xl h-full max-h-screen flex flex-col">
                            <!-- Controles superiores -->
                            <div class="flex justify-between items-center mb-4">
                                <!-- Contador de imágenes -->
                                <div class="text-white text-lg">
                                    <span x-text="lightboxIndex + 1"></span> / <span
                                        x-text="lightboxImages.length"></span>
                                </div>

                                <!-- Botón cerrar -->
                                <button @click="lightboxOpen = false"
                                    class="text-white hover:text-gray-300 p-2 rounded-full bg-black bg-opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Contenedor principal de imagen -->
                            <div class="relative flex-1 flex items-center">
                                <!-- Imagen actual con transición -->
                                <div class="w-full h-full flex items-center justify-center">
                                    <img :src="lightboxImages[lightboxIndex]"
                                        class="max-w-full max-h-full object-contain transition-opacity duration-300"
                                        :class="{ 'opacity-100': currentImageLoaded, 'opacity-0': !currentImageLoaded }"
                                        @load="currentImageLoaded = true">
                                </div>

                                <!-- Navegación anterior -->
                                <button x-show="lightboxIndex > 0" @click="prevImage()"
                                    class="absolute left-0 md:-left-12 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full hover:bg-opacity-70 transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>

                                <!-- Navegación siguiente -->
                                <button x-show="lightboxIndex < lightboxImages.length - 1" @click="nextImage()"
                                    class="absolute right-0 md:-right-12 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full hover:bg-opacity-70 transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Miniaturas de navegación -->
                            <div class="mt-4 flex overflow-x-auto py-2 space-x-2" x-show="lightboxImages.length > 1">
                                <template x-for="(image, index) in lightboxImages" :key="index">
                                    <button @click="lightboxIndex = index"
                                        class="flex-shrink-0 w-16 h-16 rounded-md overflow-hidden border-2 transition-all duration-200"
                                        :class="{
                                            'border-purple-500': lightboxIndex ===
                                                index,
                                            'border-transparent': lightboxIndex !== index
                                        }">
                                        <img :src="image" class="w-full h-full object-cover"
                                            :alt="'Miniatura ' + (index + 1)">
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información del Paquete -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Información sobre el paquete</h2>

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Destino principal</p>
                                <p class="text-sm text-gray-600">
                                    {{ $paquete->det_paquete->first()->destino->namedestino }}</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Duración</p>
                                <p class="text-sm text-gray-600">{{ $paquete->itinerarios->count() }} días</p>
                            </div>
                        </div>

                        @if ($paquete->det_paquete->first()->promos)
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Promoción activa</p>
                                    <p class="text-sm text-gray-600">
                                        {{ $paquete->det_paquete->first()->promos->namepromocion }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Empresa</p>
                                <p class="text-sm text-gray-600">{{ $paquete->empresa->nameempresa }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t pt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Servicios incluidos</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach ($paquete->ser_paquete as $servicio)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span
                                        class="text-gray-700">{{ $servicio->servicio->Det_servicio->nombreservicio }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-t pt-6 mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Equipamiento incluido</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach ($paquete->equi_paquete as $equipo)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $equipo->equipo->Det_equipo->name_equipo }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Descripción del Paquete -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Descripción detallada</h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $paquete->descripcion }}
                    </p>
                </div>

                <!-- Itinerario -->

                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Itinerario del paquete</h2>

                    <div class="space-y-8">
                        @foreach ($paquete->itinerarios->sortBy('dia') as $itinerario)
                            <div class="border-l-2 border-blue-500 pl-4 py-2">
                                <div class="flex items-start">
                                    <div
                                        class="bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                                        <span class="font-bold">Día {{ $itinerario->dia }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800">
                                                    {{ $itinerario->titulo ?? 'Actividades del día' }}</h3>
                                                @if ($itinerario->hora_inicio && $itinerario->hora_fin)
                                                    <p class="text-sm text-gray-500 mt-1">
                                                        <i class="far fa-clock mr-1"></i>
                                                        {{ \Carbon\Carbon::parse($itinerario->hora_inicio)->format('h:i A') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($itinerario->hora_fin)->format('h:i A') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                        <p class="text-gray-600 mt-2">{{ $itinerario->descripcion }}</p>

                                        <!-- Rutas asociadas a este itinerario -->
                                        @if ($itinerario->itinixrutas->count() > 0)
                                            <div class="mt-4">
                                                <h4 class="font-medium text-gray-800 mb-2">Rutas del día:</h4>
                                                <div class="space-y-4">
                                                    @foreach ($itinerario->itinixrutas as $itinixruta)
                                                        <div class="bg-gray-50 p-3 rounded-lg">
                                                            <div class="flex items-center mb-2">
                                                                <i class="fas fa-route text-blue-500 mr-2"></i>
                                                                <h5 class="font-medium text-gray-800">
                                                                    {{ $itinixruta->ruta->namerutas }}</h5>
                                                            </div>

                                                            <!-- Paradas de la ruta -->
                                                            @if ($itinixruta->ruta->paradas->count() > 0)
                                                                <div class="ml-6 mt-2">
                                                                    <div class="relative">
                                                                        <!-- Línea vertical -->
                                                                        <div
                                                                            class="absolute left-3 top-0 h-full w-0.5 bg-gray-300">
                                                                        </div>

                                                                        @foreach ($itinixruta->ruta->paradas->sortBy('ordenparada') as $parada)
                                                                            <div class="relative pb-4 pl-6">
                                                                                <!-- Punto -->
                                                                                <div
                                                                                    class="absolute left-0 top-1 w-3 h-3 rounded-full bg-blue-500 z-10">
                                                                                </div>
                                                                                <div>
                                                                                    <span
                                                                                        class="font-medium text-gray-700">{{ $parada->paradas->nameparadas }}</span>
                                                                                    @if ($parada->ordenparada)
                                                                                        <span
                                                                                            class="text-xs text-gray-500 ml-2">(Parada
                                                                                            {{ $parada->ordenparada }})</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Información de la Empresa -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Sobre la empresa</h2>

                    <div class="flex items-start">
                        <img src="{{ $paquete->empresa->logo }}" alt="Logo {{ $paquete->empresa->nameempresa }}"
                            class="w-20 h-20 object-cover rounded-lg mr-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">{{ $paquete->empresa->nameempresa }}
                            </h3>
                            <p class="text-gray-600 mt-1">{{ $paquete->empresa->descripcion }}</p>
                            <div class="mt-3">
                                <span
                                    class="inline-block bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-full mr-2">
                                    <i class="fas fa-phone-alt mr-1"></i> {{ $paquete->empresa->telefonoempresa }}
                                </span>
                                <span class="inline-block bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-full">
                                    <i class="fas fa-envelope mr-1"></i> {{ $paquete->empresa->direccionempresa }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel de Reserva -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
                    @if ($paquete->cantidadpaquete - $paquete->reservas->count() < 5)
                        <div class="text-center mb-6">
                            <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full">
                                Solo quedan {{ $paquete->cantidadpaquete - $paquete->reservas->count() }} cupos
                            </span>
                        </div>
                    @endif

                    <div class="text-center mb-6">
                        @if ($paquete->det_paquete->first()->promos)
                            <div class="flex justify-center items-center">
                                <span
                                    class="text-xl line-through text-gray-500 mr-2">S/.{{ number_format($paquete->preciopaquete, 2) }}</span>
                                <span
                                    class="text-3xl font-bold text-blue-600">S/.{{ number_format($paquete->preciopaquete * (1 - $paquete->det_paquete->first()->promos->descuento / 100), 2) }}</span>
                            </div>
                            <span class="text-sm text-gray-600">Ahorras
                                {{ $paquete->det_paquete->first()->promos->descuento }}%</span>
                        @else
                            <div class="text-3xl font-bold text-blue-600 mb-1">
                                ${{ number_format($paquete->preciopaquete, 2) }}</div>
                            <div class="text-gray-600">por persona</div>
                        @endif
                    </div>

                    <div class="space-y-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de inicio</label>
                            <select
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @foreach ($paquete->dis_paquete as $disponibilidad)
                                    <option value="{{ $disponibilidad->fecha_inicio }}">
                                        {{ \Carbon\Carbon::parse($disponibilidad->fecha_inicio)->format('d M Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($disponibilidad->fecha_fin)->format('d M Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Número de personas</label>
                            <select
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @for ($i = 1; $i <= min(5, $paquete->cantidadpaquete - $paquete->reservas->count()); $i++)
                                    <option>{{ $i }} persona{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <button wire:click="reservar"
                        class="w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 mb-4">
                        Reservar ahora
                    </button>

                    <button wire:click="contactarWhatsApp"
                        class="w-full bg-green-500 text-white font-semibold py-3 px-4 rounded-lg hover:bg-green-600 transition duration-200 mb-4 flex items-center justify-center">
                        <i class="fab fa-whatsapp mr-2 text-xl"></i> Contactar por WhatsApp
                    </button>

                    <button wire:click="personalizarPaquete"
                        class="w-full bg-yellow-500 text-white font-semibold py-3 px-4 rounded-lg hover:bg-yellow-600 transition duration-200 mb-4">
                        Personalizar paquete
                    </button>

                    <div class="border-t pt-4">
                        <div class="flex items-center text-sm text-gray-600 mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Cancelación gratuita hasta 24h antes</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            <span>Pago seguro y protegido</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($mostrarFormularioPersonalizacion)
        <div class="fixed inset-0 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-gray-800">Personalizar Paquete</h3>
                        <button wire:click="$set('mostrarFormularioPersonalizacion', false)"
                            class="text-gray-500 hover:text-gray-700">
                            &times;
                        </button>
                    </div>

                    <!-- Servicios adicionales -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold mb-3">Servicios Adicionales</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($paquete->ser_paquete as $servicio)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" wire:model="serviciosSeleccionados"
                                        value="{{ $servicio->servicio->id }}" class="rounded text-blue-600">
                                    <span>{{ $servicio->servicio->Det_servicio->nombreservicio }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Equipos adicionales -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold mb-3">Equipos Adicionales</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($paquete->equi_paquete as $equipo)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" wire:model="equiposSeleccionados"
                                        value="{{ $equipo->equipo->id }}" class="rounded text-blue-600">
                                    <span>{{ $equipo->equipo->Det_equipo->name_equipo }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Destinos adicionales -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold mb-3">Destinos Adicionales</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($paquete->det_paquete as $detalle)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" wire:model="destinosSeleccionados"
                                        value="{{ $detalle->destino->id }}" class="rounded text-blue-600">
                                    <span>{{ $detalle->destino->namedestino }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button wire:click="$set('mostrarFormularioPersonalizacion', false)"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Cancelar
                        </button>
                        <button wire:click="guardarPaquetePersonalizado"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Guardar Personalización
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        function lightbox() {
            return {
                lightboxOpen: false,
                lightboxIndex: 0,
                currentImageLoaded: false,
                lightboxImages: [
                    @if ($paquete->imagen_principal)
                        "{{ asset('storage/' . $paquete->imagen_principal) }}",
                    @endif
                    @foreach ($paquete->imagenes as $imagen)
                        "{{ asset('storage/' . $imagen->url) }}",
                    @endforeach
                ],

                openLightbox(index) {
                    this.lightboxIndex = index;
                    this.lightboxOpen = true;
                    this.currentImageLoaded = false;
                    // Deshabilitar scroll del body
                    document.body.style.overflow = 'hidden';
                },

                nextImage() {
                    if (this.lightboxIndex < this.lightboxImages.length - 1) {
                        this.currentImageLoaded = false;
                        this.lightboxIndex++;
                    }
                },

                prevImage() {
                    if (this.lightboxIndex > 0) {
                        this.currentImageLoaded = false;
                        this.lightboxIndex--;
                    }
                },

                // Restaurar scroll al cerrar
                closeLightbox() {
                    this.lightboxOpen = false;
                    document.body.style.overflow = '';
                }
            }
        }
    </script>
</div>
