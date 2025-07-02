<div>
    <!-- Hero Section con imagen de fondo -->
    <div class="relative bg-cover bg-center h-96" style="background-image: url('inicioarriba.jpg')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative container mx-auto px-6 flex flex-col items-center justify-center h-full text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-center">Descubre los mejores destinos turísticos</h1>
            <p class="text-xl md:text-2xl mb-8 text-center">Encuentra paquetes, itinerarios, servicos y equipos para tu
                próxima aventura</p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#servicios"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">Ver
                    Paquetes</a>
                <a href="#contacto"
                    class="bg-transparent hover:bg-white hover:text-blue-600 text-white font-bold py-3 px-6 rounded-lg border-2 border-white transition duration-300">Contactar</a>
            </div>
        </div>
    </div>

    <!-- Buscador de servicios turísticos -->
    <div class="bg-white py-8 shadow-md">
        <div class="container mx-auto px-6">
            <form class="flex flex-col md:flex-row gap-4">
                <!-- Option Destinos -->
                <div class="flex-1">
                    <label for="destino" class="block text-sm font-medium text-gray-700 mb-2">Destinos</label>
                    <select id="destino"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2"
                        onchange="updatePlaceholder(this)">
                        <option value="" class="text-gray-400" selected>Todos los destinos...</option>
                        @foreach ($destinos as $destino)
                            <option value="{{ $destino->id }}">{{ $destino->namedestino }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Option Precio-->
                <?php
                // Ejemplo en tu componente Livewire o Controller
                $precioMin = \App\Models\Paquetes::min('preciopaquete');
                $precioMax = \App\Models\Paquetes::max('preciopaquete');
                
                // Redondea hacia abajo y arriba para que los rangos sean claros
                $precioMin = floor($precioMin);
                $precioMax = ceil($precioMax);
                
                // Genera los rangos de 20 en 20 soles
                $rangosPrecio = [];
                $inicio = $precioMin;
                while ($inicio < $precioMax) {
                    $fin = $inicio + 10;
                    $rangosPrecio[] = [
                        'min' => $inicio,
                        'max' => $fin,
                        'label' => "S/ {$inicio} - S/ {$fin}",
                    ];
                    $inicio = $fin;
                }
                ?>
                <div class="flex-1">
                    <label for="precio" class="block text-sm font-medium text-gray-700 mb-2">Precio</label>
                    <select id="precio"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2">
                        <option value="">Todos los precios...</option>
                        @foreach ($rangosPrecio as $rango)
                            <option value="{{ $rango['min'] }}-{{ $rango['max'] }}">{{ $rango['label'] }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Option Duración-->
                <div class="flex-1">
                    <label for="duracion" class="block text-sm font-medium text-gray-700 mb-2">Duración</label>
                    <select id="duracion"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2">
                        <option value="">Duración...</option>
                        @foreach ($rangosDuracion as $rango)
                            <option value="{{ $rango['min'] }}-{{ $rango['max'] }}">{{ $rango['label'] }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Option Horario-->
                <div class="flex-1">
                    <label for="distrito" class="block text-sm font-medium text-gray-700 mb-2">Distrito</label>
                    <select id="distrito"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2">
                        <option value="">Distrito...</option>
                        @foreach ($distritos as $distrito)
                            <option value="{{ $distrito->id }}">{{ $distrito->namedistrito }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Opcion Fecha-->
                <div class="flex-1">
                    <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
                    <input type="date" id="fecha"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>
            </form>
        </div>
    </div>

    <!-- Sección de paquetes destacados -->
    <div id="servicios" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-8">Paquetes destacados</h2>
            <!-- Contenedor de los N paquetes -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Paquetes Nº # -->
                @foreach ($paquetes->take(3) as $paquete)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                        <div class="relative">
                            <img src="{{ asset('storage/' . ($paquete->imagen_principal ?? 'images.jfif')) }}"
                                alt="{{ $paquete->nombrepaquete }}" class="w-full h-48 object-cover">
                            <div
                                class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                                {{ $paquete->estado ?? 'Disponible' }}
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-bold text-gray-800">{{ $paquete->nombrepaquete }}</h3>
                                <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded">
                                    Nuevo
                                </span>
                            </div>
                            <p class="text-gray-600 mb-4">{{ $paquete->descripcion }}</p>

                            <div class="flex items-center mb-4">
                                <span class="text-sm text-gray-500 ml-2">
                                    {{-- Aquí podrías mostrar la cantidad de detalles o viajeros si tienes ese dato --}}
                                    Incluye {{ $paquete->det_paquete->count() }} servicios/equipos
                                </span>
                            </div>

                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-lg font-bold text-blue-600">
                                        S/ {{ number_format($paquete->preciopaquete, 2) }}
                                    </span>
                                    <span class="text-sm text-gray-500">/por persona</span>
                                </div>
                                <a href="{{ route('vistapaquete', ['id' => $paquete->id]) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                    Ver detalles
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="paquetes"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">Ver
                    todos los paquetes</a>
            </div>
        </div>
    </div>

    <!-- Sección de promociones destacados -->
    <div id="servicios" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-8">Promociones destacados</h2>
            <!-- Contenedor de las N promociones -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Promociones Nº # -->
                @foreach ($paquetesConPromocion->take(3) as $paquete)
                    @php
                        $detallePromo = $paquete->detalles->first(function ($d) {
                            return $d->promocion && $d->promocion->descuento > 0;
                        });
                        $descuento = $detallePromo ? $detallePromo->promocion->descuento : 0;
                        $precioOriginal = $paquete->preciopaquete;
                        $precioDescuento =
                            $descuento > 0 ? $precioOriginal - ($precioOriginal * $descuento) / 100 : $precioOriginal;
                    @endphp
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 relative flex flex-col h-full">
                        @if ($descuento > 0)
                            <div
                                class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full z-10">
                                -{{ $descuento }}%
                            </div>
                        @endif
                        <div class="relative">
                            <img src="{{ asset('storage/' . ($paquete->imagen_principal ?? 'images.jfif')) }}"
                                alt="{{ $paquete->nombrepaquete }}" class="w-full h-48 object-cover">
                            <div
                                class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                                {{ $paquete->estado ?? 'Disponible' }}
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-bold text-gray-800">{{ $paquete->nombrepaquete }}</h3>
                                <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded">
                                    Promoción
                                </span>
                            </div>
                            <p class="text-gray-600 mb-4">{{ $paquete->descripcion }}</p>
                            <div class="flex items-center mb-4">
                                <span class="text-sm text-gray-500 ml-2">
                                    Incluye {{ $paquete->detalles->count() }} servicios/equipos
                                </span>
                            </div>
                            <div>
                                @if ($descuento > 0)
                                    <span class="text-sm text-gray-400 line-through">
                                        S/ {{ number_format($precioOriginal, 2) }}
                                    </span><br>
                                    <span class="text-lg font-bold text-red-600">
                                        S/ {{ number_format($precioDescuento, 2) }}
                                    </span>
                                    <span class="text-sm text-gray-500">/por persona</span>
                                @else
                                    <span class="text-lg font-bold text-blue-600">
                                        S/ {{ number_format($precioOriginal, 2) }}
                                    </span>
                                    <span class="text-sm text-gray-500">/por persona</span>
                                @endif
                            </div>
                            <div class="flex-1"></div>
                            <div class="w-full flex justify-end mt-4">
                                <a href="{{ route('vistapaquete', ['id' => $paquete->id]) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                    Ver detalles
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="promociones"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">Ver
                    todos las promociones</a>
            </div>
        </div>
    </div>

    <!-- Sección de emopresas de turismo -->
    <div class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-8">Nuestras Empresas</h2>
            <!-- Contenedor de las empresas disponibles -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Empresa Nº # -->
                @foreach ($empresas as $empresa)
                    <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-lg transition duration-300">
                        <div
                            class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 overflow-hidden">
                            @if ($empresa->logoempresa)
                                <img src="{{ asset('storage/' . $empresa->logoempresa) }}"
                                    alt="{{ $empresa->nameempresa }}" class="w-16 h-16 object-cover rounded-full">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold mb-2">{{ $empresa->nameempresa }}</h3>
                        <p class="text-gray-600 mb-1">{{ $empresa->rucempresa }}</p>
                        <p class="text-gray-600 mb-1">{{ $empresa->razonsocial }}</p>
                        <p class="text-gray-500 text-sm">{{ $empresa->direccionempresa }}</p>
                        <p class="text-gray-500 text-sm">Tel: {{ $empresa->telefonoempresa }}</p>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="empresas"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">Ver
                    todas los empresas</a>
            </div>
        </div>
    </div>

    <!-- Sección de itinerarios populares -->
    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-8">Itinerarios populares</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($itinerarios as $itinerario)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">
                                {{ $itinerario->paquete->nombrepaquete ?? 'Itinerario' }} - Día {{ $itinerario->dia }}
                            </h3>
                            <p class="text-gray-700 mb-4">
                                {{ $itinerario->descripcion }}
                            </p>
                            <ul class="space-y-2 mb-4">
                                @foreach ($itinerario->itinerariosRutas as $itRuta)
                                    <li class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Ruta: {{ $itRuta->ruta->namerutas ?? 'Sin ruta' }}
                                        @if ($itRuta->ruta && $itRuta->ruta->rutasParadas->count())
                                            <ul class="ml-4 list-disc">
                                                @foreach ($itRuta->ruta->rutasParadas as $parada)
                                                    <li>
                                                        Parada: {{ $parada->parada->nombre ?? 'Sin nombre' }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Ver itinerario
                                completo →</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">
                        No hay itinerarios disponibles por ahora.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Sección de promociones -->
    <!--div class="py-16 bg-blue-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-8">Promociones especiales</h2>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-8">
                        <span
                            class="inline-block bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full mb-4">¡Oferta
                            por tiempo limitado!</span>
                        <h3 class="text-2xl font-bold mb-4">20% de descuento en paquetes de aventura</h3>
                        <p class="text-gray-700 mb-6">Reserva cualquier paquete de aventura para los próximos 3
                            meses y obtén un 20% de descuento. Incluye equipamiento, guías especializados y
                            transporte.</p>
                        <div class="flex items-center mb-6">
                            <div class="text-3xl font-bold text-blue-600 mr-2">$799</div>
                            <div class="text-xl text-gray-500 line-through">$999</div>
                        </div>
                        <a href="#"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">Reservar
                            ahora</a>
                    </div>
                    <div class="hidden md:block">
                        <img src="{{ 'huaraz-tour-escolares-580pix.jpg' }}" alt="Promoción especial"
                            class="h-full w-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div-->

    <!-- Sección de contacto -->
    <div id="contacto" class="py-16 bg-gray-100">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-3xl font-bold mb-6">Contáctanos</h2>
                    <p class="text-gray-700 mb-8">¿Tienes alguna pregunta o necesitas información personalizada?
                        Estamos aquí para ayudarte.</p>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Teléfono</h3>
                                <p class="text-gray-600">+51 928 671 412</p>
                                <p class="text-gray-600">+51 983 470 161</p>
                                <p class="text-gray-600">+51 946 849 348</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Email</h3>
                                <p class="text-gray-600">reservancash@gmail.com</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Dirección</h3>
                                <p class="text-gray-600">Av. Principal #123, Ciudad Turística</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex space-x-4">
                        <a href="#" class="text-blue-600 hover:text-blue-800">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                            </svg>
                        </a>
                        <a href="#" class="text-blue-600 hover:text-blue-800">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" />
                            </svg>
                        </a>
                        <a href="#" class="text-blue-600 hover:text-blue-800">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <form>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre
                                    completo</label>
                                <input type="text" id="nombre"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Correo
                                    electrónico</label>
                                <input type="email" id="email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="tel" id="telefono"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label for="mensaje" class="block text-sm font-medium text-gray-700">Mensaje</label>
                                <textarea id="mensaje" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"></textarea>
                            </div>
                            <div>
                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                                    Enviar mensaje
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
