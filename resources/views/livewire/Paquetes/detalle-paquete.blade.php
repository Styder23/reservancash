<div>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
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
                                <div class="relative group h-full">
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
                        @click.away="closeLightbox()" @keydown.escape.window="closeLightbox()">

                        <div class="relative w-full max-w-6xl h-full max-h-screen flex flex-col">
                            <!-- Controles superiores -->
                            <div class="flex justify-between items-center mb-4">
                                <!-- Contador de imágenes -->
                                <div class="text-white text-lg font-medium">
                                    <span x-text="lightboxIndex + 1"></span> / <span
                                        x-text="lightboxImages.length"></span>
                                </div>

                                <!-- Botón cerrar -->
                                <button @click.stop="closeLightbox()"
                                    class="text-white hover:text-gray-300 p-2 rounded-full bg-black bg-opacity-50 hover:bg-opacity-70 transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Contenedor principal de imagen -->
                            <div class="relative flex-1 flex items-center justify-center">
                                <!-- Imagen actual con transición -->
                                {{-- <div class="w-full h-full flex items-center justify-center">
                                    <img :src="lightboxImages[lightboxIndex]"
                                        class="max-w-full max-h-full object-contain transition-opacity duration-300"
                                        :class="{
                                            'opacity-100 visible': currentImageLoaded,
                                            'opacity-0 invisible': !currentImageLoaded
                                        }"
                                        @load="currentImageLoaded = true">
                                </div>
                                <!-- Loading spinner -->
                                <div x-show="!currentImageLoaded"
                                    class="absolute inset-0 flex items-center justify-center">
                                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-white"></div>
                                </div>
                                <!-- Navegación anterior -->
                                <div x-show="!currentImageLoaded"
                                    class="absolute inset-0 flex items-center justify-center">
                                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-white"></div>
                                </div> --}}

                                <!-- Navegación anterior -->
                                <button x-show="lightboxIndex > 0" @click="prevImage()"
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full hover:bg-opacity-70 transition-all duration-200 z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>

                                <!-- Navegación siguiente -->
                                <button x-show="lightboxIndex < lightboxImages.length - 1" @click="nextImage()"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full hover:bg-opacity-70 transition-all duration-200 z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Miniaturas de navegación -->
                            <div class="mt-4 flex overflow-x-auto py-2 space-x-2 scrollbar-hide"
                                x-show="lightboxImages.length > 1">
                                <template x-for="(image, index) in lightboxImages" :key="index">
                                    <button @click="lightboxIndex = index; preloadImage(image)"
                                        class="flex-shrink-0 w-16 h-16 rounded-md overflow-hidden border-2 transition-all duration-200"
                                        :class="{
                                            'border-blue-500 ring-2 ring-blue-300': lightboxIndex === index,
                                            'border-gray-600 hover:border-gray-400': lightboxIndex !== index
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
                        <img src="{{ asset('storage/' . $paquete->empresa->logoempresa) }}"
                            alt="Logo {{ $paquete->empresa->nameempresa }}"
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
                    @if ($paquete->dis_paquete->first() && $paquete->dis_paquete->first()->cupo - $paquete->reservas->count() < 5)
                        <div class="text-center mb-6">
                            <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full">
                                Solo quedan {{ $paquete->dis_paquete->first()->cupo - $paquete->reservas->count() }}
                                cupos
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
                                S/.{{ number_format($paquete->preciopaquete, 2) }}</div>
                            <div class="text-gray-600">por persona</div>
                        @endif
                    </div>

                    <div class="space-y-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de viaje</label>
                            <input type="date" wire:model="fechaSeleccionada" min="{{ now()->format('Y-m-d') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('fechaSeleccionada')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Número de personas</label>
                            <div class="flex items-center">

                                <input type="number" wire:model="personas" min="1" max="10"
                                    class="w-full px-3 py-2 border-t border-b border-gray-300 text-center focus:outline-none focus:ring-2 focus:ring-blue-500">

                            </div>
                            @error('personas')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button wire:click="abrirModalPago"
                        class="w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 mb-4">
                        Reservar ahora
                    </button>

                    @php
                        $telefono = $paquete->empresa->telefonoempresa ?? '51999999999';
                        $urlWhatsapp = "https://wa.me/{$telefono}?text=Hola, estoy interesado en el paquete: {{ $paquete->nombrepaquete }}";
                    @endphp

                    <a href="{{ $urlWhatsapp }}" target="_blank"
                        class="w-full bg-green-500 text-white font-semibold py-3 px-4 rounded-lg hover:bg-green-600 transition duration-200 mb-4 flex items-center justify-center">
                        <i class="fab fa-whatsapp mr-2 text-xl"></i> Contactar por WhatsApp
                    </a>

                    {{-- <button wire:click="personalizarPaquete"
                        class="w-full bg-yellow-500 text-white font-semibold py-3 px-4 rounded-lg hover:bg-yellow-600 transition duration-200 mb-4">
                        Personalizar paquete
                    </button> --}}

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

    <!-- Sección de Comentarios -->
    <!-- Sección de Comentarios y Valoraciones -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Comentarios y valoraciones</h2>

            <!-- Resumen de valoraciones -->
            @if ($this->getTotalValoraciones() > 0)
                <div class="flex items-center space-x-2">
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $this->getPromedioValoracion() ? 'text-yellow-400' : 'text-gray-300' }}"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <span class="text-sm text-gray-600">{{ $this->getPromedioValoracion() }}
                        ({{ $this->getTotalValoraciones() }} valoraciones)</span>
                </div>
            @endif
        </div>

        <!-- Mensaje de éxito -->
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <!-- Formulario para nuevo comentario (solo si está autenticado) -->
        @auth
            <div class="mb-8 border-b pb-6">
                <form wire:submit.prevent="agregarComentario">
                    <div class="flex items-start space-x-4">
                        <img src="{{ auth()->user()->profile_photo_path
                            ? asset('storage/' . auth()->user()->profile_photo_path)
                            : asset('images/default-user.png') }}"
                            alt="Foto de perfil" class="w-10 h-10 rounded-full object-cover">
                        <div class="flex-1">
                            <!-- Sistema de valoración con estrellas -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tu valoración</label>
                                <div class="flex items-center space-x-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button type="button" wire:click="setValoracion({{ $i }})"
                                            wire:mouseenter="setValoracionHover({{ $i }})"
                                            wire:mouseleave="clearHover"
                                            class="focus:outline-none transition-colors duration-200">
                                            <svg class="w-8 h-8 {{ ($valoracionHover > 0 && $i <= $valoracionHover) || ($valoracionHover === 0 && $i <= $valoracion)
                                                ? 'text-yellow-400 hover:text-yellow-500'
                                                : 'text-gray-300 hover:text-yellow-400' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </button>
                                    @endfor
                                    <span class="ml-2 text-sm text-gray-600">
                                        @if ($valoracion > 0)
                                            {{ $valoracion }} {{ $valoracion == 1 ? 'estrella' : 'estrellas' }}
                                        @endif
                                    </span>
                                </div>
                                @error('valoracion')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Área de texto para el comentario -->
                            <textarea wire:model="nuevoComentario"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nuevoComentario') border-red-500 @enderror"
                                rows="3" placeholder="Escribe tu comentario sobre este paquete..."></textarea>
                            @error('nuevoComentario')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            <div class="mt-2 flex justify-between items-center">
                                <span class="text-xs text-gray-500">{{ strlen($nuevoComentario) }}/500 caracteres</span>
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 disabled:bg-gray-400"
                                    wire:loading.attr="disabled">
                                    <span wire:loading.remove>Publicar comentario</span>
                                    <span wire:loading>Publicando...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="mb-8 border-b pb-6">
                <div class="bg-gray-50 rounded-lg p-4 text-center">
                    <p class="text-gray-600">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">Inicia
                            sesión</a>
                        para dejar tu comentario y valoración sobre este paquete.
                    </p>
                </div>
            </div>
        @endauth

        <!-- Lista de comentarios -->
        <div class="space-y-6">
            @forelse ($paquete->comentarios as $comentario)
                <div class="border-b pb-6 last:border-b-0 last:pb-0">
                    <div class="flex items-start space-x-4 mb-4">
                        <img src="{{ $comentario->users->profile_photo_path
                            ? asset('storage/' . $comentario->users->profile_photo_path)
                            : asset('images/default-user.png') }}"
                            alt="Foto de {{ $comentario->users->name }}" class="w-10 h-10 rounded-full object-cover">
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-semibold text-gray-800">{{ $comentario->users->name }}</h4>
                                <span class="text-sm text-gray-500">
                                    {{ $comentario->fecha ? $comentario->fecha->format('d M Y') : 'Hace poco' }}
                                </span>
                            </div>

                            <!-- Mostrar valoración si existe -->
                            @if ($comentario->valoracion)
                                <div class="flex items-center mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $comentario->valoracion ? 'text-yellow-400' : 'text-gray-300' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                    <span class="ml-2 text-sm text-gray-600">{{ $comentario->valoracion }}/5</span>
                                </div>
                            @endif

                            <p class="text-gray-700 mt-1">{{ $comentario->comentario }}</p>

                            <!-- Botón para responder (solo si está autenticado) -->
                            @auth
                                <button wire:click="toggleRespuesta({{ $comentario->id }})"
                                    class="mt-2 text-sm text-blue-600 hover:text-blue-800 transition duration-200">
                                    {{ $mostrarRespuesta === $comentario->id ? 'Cancelar' : 'Responder' }}
                                </button>
                            @endauth

                            <!-- Formulario de respuesta (se muestra solo para el comentario seleccionado) -->
                            @if ($mostrarRespuesta === $comentario->id)
                                <div class="mt-4 pl-6">
                                    <form wire:submit.prevent="agregarRespuesta({{ $comentario->id }})">
                                        <div class="flex items-start space-x-4">
                                            <img src="{{ auth()->user()->profile_photo_path
                                                ? asset('storage/' . auth()->user()->profile_photo_path)
                                                : asset('images/default-user.png') }}"
                                                alt="Tu foto" class="w-8 h-8 rounded-full object-cover">
                                            <div class="flex-1">
                                                <textarea wire:model="nuevaRespuesta"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('nuevaRespuesta') border-red-500 @enderror"
                                                    rows="2" placeholder="Escribe tu respuesta..."></textarea>
                                                @error('nuevaRespuesta')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                                <div class="mt-2 flex justify-between items-center">
                                                    <span
                                                        class="text-xs text-gray-500">{{ strlen($nuevaRespuesta) }}/300
                                                        caracteres</span>
                                                    <div class="flex space-x-2">
                                                        <button type="button" wire:click="cancelarRespuesta"
                                                            class="px-3 py-1 text-gray-600 hover:text-gray-800 transition duration-200">
                                                            Cancelar
                                                        </button>
                                                        <button type="submit"
                                                            class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200 disabled:bg-gray-400"
                                                            wire:loading.attr="disabled">
                                                            <span wire:loading.remove>Enviar respuesta</span>
                                                            <span wire:loading>Enviando...</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Respuestas al comentario -->
                    @if ($comentario->respuestas && $comentario->respuestas->count() > 0)
                        <div class="ml-14 pl-4 border-l-2 border-gray-200 space-y-4">
                            @foreach ($comentario->respuestas as $respuesta)
                                <div class="flex items-start space-x-3">
                                    <img src="{{ $respuesta->usuario->profile_photo_url ?? asset('images/default-user.png') }}"
                                        alt="Foto de {{ $respuesta->usuario->name }}"
                                        class="w-8 h-8 rounded-full object-cover">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="text-sm font-medium text-gray-800">{{ $respuesta->usuario->name }}</span>
                                            <span class="text-xs text-gray-500">
                                                {{ $respuesta->fecha_respuesta ? $respuesta->fecha_respuesta->format('d M Y') : 'Hace poco' }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-700 mt-1">{{ $respuesta->respuesta }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    <div class="mb-4">
                        <svg class="mx-auto w-16 h-16 text-gray-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-lg font-medium text-gray-600">No hay comentarios aún</p>
                    <p class="text-sm text-gray-500 mt-1">¡Sé el primero en comentar y valorar este paquete!</p>
                    @guest
                        <p class="text-sm text-gray-500 mt-2">
                            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">Inicia
                                sesión</a>
                            para dejar tu comentario y valoración.
                        </p>
                    @endguest
                </div>
            @endforelse
        </div>
    </div>

    @if ($mostrarModalPago)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" x-data>
            <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">
                <!-- Encabezado -->
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-xl font-bold text-gray-900">Método de Pago</h3>
                    <button wire:click="$set('mostrarModalPago', false)" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Contenido principal - Diseño horizontal -->
                <div class="flex flex-1 overflow-hidden">
                    <!-- Columna izquierda - Métodos de pago -->
                    <div class="w-1/3 p-6 border-r overflow-y-auto">
                        <form>
                            <div class="space-y-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Seleccione método de
                                    pago</label>

                                <!-- Transferencia Bancaria -->
                                <div class="p-4 rounded-lg cursor-pointer transition-all duration-200 border-2 
                                {{ $metodoPago === 'transferencia' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-blue-300' }}"
                                    wire:click="$set('metodoPago', 'transferencia')">
                                    <div class="flex items-center">
                                        <input wire:model="metodoPago" id="transferencia" type="radio"
                                            value="transferencia"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <label for="transferencia"
                                            class="ml-3 block text-sm font-medium text-gray-700">
                                            Transferencia Bancaria
                                        </label>
                                    </div>
                                    @if ($metodoPago === 'transferencia')
                                        <div class="mt-3 text-xs text-gray-500">
                                            <p>Realiza la transferencia a nuestra cuenta bancaria:</p>
                                            <p class="font-medium mt-1">{{ $paquete->empresa->nombrebanco }}</p>
                                            <p class="font-medium">Cuenta: {{ $paquete->empresa->numero_cuenta }}</p>
                                            <p class="font-medium">CCI: {{ $paquete->empresa->numero_cci }}</p>
                                            <p class="font-medium">Titular: {{ $paquete->empresa->nameempresa }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Yape -->
                                <div class="p-4 rounded-lg cursor-pointer transition-all duration-200 border-2 
                                {{ $metodoPago === 'yape' ? 'border-purple-500 bg-purple-50' : 'border-gray-200 hover:border-purple-300' }}"
                                    wire:click="$set('metodoPago', 'yape')">
                                    <div class="flex items-center">
                                        <input wire:model="metodoPago" id="yape" type="radio" value="yape"
                                            class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300">
                                        <label for="yape" class="ml-3 block text-sm font-medium text-gray-700">
                                            Yape
                                        </label>
                                    </div>
                                    @if ($metodoPago === 'yape')
                                        <div class="mt-3 text-xs text-gray-500">
                                            <p>Escanea el código QR o yapea al número:</p>
                                            <p class="font-medium mt-1">{{ $paquete->empresa->telefonoempresa }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Plin -->
                                <div class="p-4 rounded-lg cursor-pointer transition-all duration-200 border-2 
                                {{ $metodoPago === 'plin' ? 'border-green-500 bg-green-50' : 'border-gray-200 hover:border-green-300' }}"
                                    wire:click="$set('metodoPago', 'plin')">
                                    <div class="flex items-center">
                                        <input wire:model="metodoPago" id="plin" type="radio" value="plin"
                                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                                        <label for="plin" class="ml-3 block text-sm font-medium text-gray-700">
                                            Plin
                                        </label>
                                    </div>
                                    @if ($metodoPago === 'plin')
                                        <div class="mt-3 text-xs text-gray-500">
                                            <p>Escanea el código QR o plinea al número:</p>
                                            <p class="font-medium mt-1">{{ $paquete->empresa->telefonoempresa }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Columna derecha - Detalles y QR -->
                    <div class="w-2/3 p-6 overflow-y-auto flex flex-col">
                        <!-- QR y detalles de pago -->
                        <div class="flex-1">
                            @if ($metodoPago === 'yape')
                                <div class="text-center">
                                    <h4 class="text-lg font-bold text-purple-700 mb-4">Paga con Yape</h4>
                                    <div
                                        class="mx-auto w-48 h-48 bg-purple-100 rounded-lg flex items-center justify-center p-2">
                                        <!-- Reemplaza con tu QR real -->
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=YAPE:987654321"
                                            alt="QR Yape" class="w-full h-full">
                                    </div>
                                    <p class="mt-3 text-sm text-gray-600">Escanea el código QR con Yape</p>
                                    <p class="text-sm font-medium text-purple-700">o yapea al número: 987 654 321</p>
                                </div>
                            @elseif($metodoPago === 'plin')
                                <div class="text-center">
                                    <h4 class="text-lg font-bold text-green-700 mb-4">Paga con Plin</h4>
                                    <div
                                        class="mx-auto w-48 h-48 bg-green-100 rounded-lg flex items-center justify-center p-2">
                                        <!-- Reemplaza con tu QR real -->
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=PLIN:987654321"
                                            alt="QR Plin" class="w-full h-full">
                                    </div>
                                    <p class="mt-3 text-sm text-gray-600">Escanea el código QR con Plin</p>
                                    <p class="text-sm font-medium text-green-700">o plinea al número: 987 654 321</p>
                                </div>
                            @elseif($metodoPago === 'transferencia')
                                <div class="text-center">
                                    <h4 class="text-lg font-bold text-blue-700 mb-4">Transferencia Bancaria</h4>
                                    <div class="bg-blue-50 rounded-lg p-4 max-w-md mx-auto">
                                        <div class="space-y-2 text-left">
                                            <p class="text-sm"><span class="font-medium">Banco:</span>
                                                {{ $paquete->empresa->nombrebanco }}</p>
                                            <p class="text-sm"><span class="font-medium">Cuenta:</span>
                                                {{ $paquete->empresa->numero_cuenta }}</p>
                                            <p class="text-sm"><span class="font-medium">CCI:</span>
                                                {{ $paquete->empresa->numero_cci }}</p>
                                            <p class="text-sm"><span class="font-medium">Titular:</span>
                                                {{ $paquete->empresa->nameempresa }}</p>
                                            <p class="text-sm"><span class="font-medium">Monto:</span>
                                                S/.{{ number_format(
                                                    $paquete->det_paquete->first()->promos
                                                        ? $paquete->preciopaquete * (1 - $paquete->det_paquete->first()->promos->descuento / 100) * $personas
                                                        : $paquete->preciopaquete * $personas,
                                                    2,
                                                ) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Comprobante de pago (si aplica) -->
                            @if (in_array($metodoPago, ['yape', 'plin']))
                                <div class="mt-8">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Subir comprobante de pago
                                    </label>
                                    <div class="mt-1 flex flex-col items-center">
                                        <div class="w-full max-w-xs">
                                            <input type="file" wire:model="comprobantePago" accept="image/*"
                                                class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    {{ $metodoPago === 'yape' ? 'file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100' : 'file:bg-green-50 file:text-green-700 hover:file:bg-green-100' }}">
                                        </div>
                                        @error('comprobantePago')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                        @if ($comprobantePago)
                                            <div class="mt-4">
                                                <p class="text-sm font-medium mb-2">Vista previa:</p>
                                                <img src="{{ $comprobantePago->temporaryUrl() }}" alt="Vista previa"
                                                    class="h-32 border rounded-lg">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Resumen y botones -->
                        <div class="mt-6">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-medium text-gray-900 mb-2">Resumen de reserva</h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Paquete:</span>
                                        <span class="font-medium">{{ $paquete->nombrepaquete }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Fecha de viaje:</span>
                                        <span
                                            class="font-medium">{{ \Carbon\Carbon::parse($fechaSeleccionada)->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Personas:</span>
                                        <span class="font-medium">{{ $personas }}</span>
                                    </div>
                                    <div class="flex justify-between border-t pt-2 mt-2">
                                        <span class="text-gray-600">Total a pagar:</span>
                                        <span class="font-bold text-blue-600">
                                            S/.{{ number_format(
                                                $paquete->det_paquete->first()->promos
                                                    ? $paquete->preciopaquete * (1 - $paquete->det_paquete->first()->promos->descuento / 100) * $personas
                                                    : $paquete->preciopaquete * $personas,
                                                2,
                                            ) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex space-x-3 pt-4">
                                <button type="button" wire:click="cerrarModal"
                                    class="flex-1 bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-200">
                                    Cancelar
                                </button>
                                <button type="button" wire:click="reservar"
                                    class="flex-1 bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200 flex items-center justify-center">
                                    <span wire:loading.remove wire:target="reservar">Confirmar reserva</span>
                                    <span wire:loading wire:target="reservar">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Procesando...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

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

                init() {
                    // Escuchar eventos de teclado
                    document.addEventListener('keydown', (e) => this.handleKeydown(e));

                    // Limpiar overflow cuando se cierre
                    this.$watch('lightboxOpen', (value) => {
                        if (!value) {
                            document.body.style.overflow = '';
                        }
                    });
                },

                openLightbox(index) {
                    this.lightboxIndex = index;
                    this.lightboxOpen = true;
                    this.currentImageLoaded = false;
                    document.body.style.overflow = 'hidden';
                    this.preloadImage(this.lightboxImages[index]);
                },

                nextImage() {
                    if (this.lightboxIndex < this.lightboxImages.length - 1) {
                        this.currentImageLoaded = false;
                        this.lightboxIndex++;
                        this.preloadImage(this.lightboxImages[this.lightboxIndex]);
                    }
                },

                prevImage() {
                    if (this.lightboxIndex > 0) {
                        this.currentImageLoaded = false;
                        this.lightboxIndex--;
                        this.preloadImage(this.lightboxImages[this.lightboxIndex]);
                    }
                },

                // Método para precargar imágenes
                preloadImage(src) {
                    this.currentImageLoaded = false;
                    const img = new Image();
                    img.onload = () => {
                        this.currentImageLoaded = true;
                    };
                    img.onerror = () => {
                        console.error('Error loading image:', src);
                        // Mostrar placeholder si la imagen falla
                        this.currentImageLoaded = true;
                    };
                    img.src = src;
                },

                // Método para cerrar el lightbox
                closeLightbox() {
                    this.lightboxOpen = false;
                    document.body.style.overflow = '';
                    // Mueve el setTimeout para asegurar la transición
                    setTimeout(() => {
                        this.currentImageLoaded = false;
                    }, 300);
                },

                // Navegación con teclado
                handleKeydown(event) {
                    if (!this.lightboxOpen) return;

                    switch (event.key) {
                        case 'Escape':
                            this.closeLightbox();
                            break;
                        case 'ArrowRight':
                            this.nextImage();
                            break;
                        case 'ArrowLeft':
                            this.prevImage();
                            break;
                    }
                }
            }
        }

        // Función para validar reserva
        function validarReserva() {
            return {
                procesandoReserva: false,

                async procesarReserva() {
                    // Verificar autenticación
                    if (!@json(auth()->check())) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Inicia sesión',
                            text: 'Debes iniciar sesión para realizar una reserva',
                            showCancelButton: true,
                            confirmButtonText: 'Iniciar sesión',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/login';
                            }
                        });
                        return;
                    }

                    // Verificar campos requeridos
                    const fecha = document.querySelector('select[wire\\:model="fechaSeleccionada"]')?.value;
                    const personas = document.querySelector('input[wire\\:model="personas"]')?.value;

                    if (!fecha) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Campo requerido',
                            text: 'Por favor selecciona una fecha de viaje'
                        });
                        return;
                    }

                    if (!personas || personas < 1 || personas > 10) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Número de personas inválido',
                            text: 'Ingresa un número válido de personas (1-10)'
                        });
                        return;
                    }

                    // Verificar disponibilidad
                    const cuposDisponibles = {{ $paquete->cantidadpaquete - $paquete->reservas->count() }};
                    if (cuposDisponibles < parseInt(personas)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'No hay suficientes cupos',
                            text: `Solo quedan ${cuposDisponibles} cupos disponibles`
                        });
                        return;
                    }

                    // Si todo está bien, llamar al método de Livewire
                    this.procesandoReserva = true;
                    try {
                        await Livewire.dispatch('abrirModalPago');
                    } catch (error) {
                        console.error('Error al procesar reserva:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error del sistema',
                            text: 'Ocurrió un error inesperado. Por favor intenta nuevamente.'
                        });
                    } finally {
                        this.procesandoReserva = false;
                    }
                }
            }
        }

        // Eventos para Livewire
        document.addEventListener('livewire:initialized', () => {
            // Manejar alertas del sistema
            Livewire.on('mostrarAlerta', (data) => {
                const alertData = Array.isArray(data) ? data[0] : data;

                Swal.fire({
                    icon: alertData.tipo,
                    title: alertData.tipo === 'success' ? '¡Éxito!' : alertData.tipo === 'warning' ?
                        '¡Atención!' : 'Error',
                    text: alertData.mensaje,
                    confirmButtonColor: alertData.tipo === 'success' ? '#10b981' : alertData
                        .tipo === 'warning' ? '#f59e0b' : '#ef4444',
                    confirmButtonText: 'Aceptar'
                });
            });

            // Manejar errores de validación
            Livewire.on('validationError', (data) => {
                const errorData = Array.isArray(data) ? data[0] : data;

                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: errorData.mensaje || 'Por favor revisa los datos ingresados',
                    confirmButtonColor: '#ef4444'
                });
            });
        });

        // Función para manejar el modal de pago
        function modalPago() {
            return {
                mostrarModal: false,
                metodoPago: 'yape',
                comprobante: null,

                cerrarModal() {
                    this.mostrarModal = false;
                    this.comprobante = null;
                },

                manejarArchivo(event) {
                    const file = event.target.files[0];
                    if (file) {
                        // Validar tipo de archivo
                        if (!file.type.startsWith('image/')) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Archivo inválido',
                                text: 'Por favor selecciona una imagen válida'
                            });
                            event.target.value = '';
                            return;
                        }

                        // Validar tamaño (2MB máximo)
                        if (file.size > 2 * 1024 * 1024) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Archivo muy grande',
                                text: 'El archivo no debe superar los 2MB'
                            });
                            event.target.value = '';
                            return;
                        }

                        this.comprobante = file;
                    }
                }
            }
        }
    </script>
</div>
