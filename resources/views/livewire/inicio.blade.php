<div>
        <!-- Hero Section con imagen de fondo -->
        <div class="relative bg-cover bg-center h-96" style="background-image: url('inicioarriba.jpg')">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative container mx-auto px-6 flex flex-col items-center justify-center h-full text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-center">Descubre los mejores destinos turísticos</h1>
                <p class="text-xl md:text-2xl mb-8 text-center">Encuentra servicios, itinerarios y equipos para tu
                    próxima aventura</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#servicios"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">Ver
                        Servicios</a>
                    <a href="#contacto"
                        class="bg-transparent hover:bg-white hover:text-blue-600 text-white font-bold py-3 px-6 rounded-lg border-2 border-white transition duration-300">Contactar</a>
                </div>
            </div>
        </div>

        <!-- Buscador de servicios turísticos -->
        <div class="bg-white py-8 shadow-md">
            <div class="container mx-auto px-6">
                <form class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <label for="destino" class="block text-sm font-medium text-gray-700 mb-1">Destino</label>
                        <select id="destino"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="">Todos los destinos</option>
                            <option value="playa">Lagunas</option>
                            <option value="montaña">Montaña</option>
                            <option value="selva">Selva</option>
                            <option value="ciudad">Ciudad</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="servicio" class="block text-sm font-medium text-gray-700 mb-1">Tipo de
                            servicio</label>
                        <select id="servicio"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="">Todos los servicios</option>
                            <option value="hospedaje">Hospedaje</option>
                            <option value="transporte">Transporte</option>
                            <option value="guia">Guías turísticos</option>
                            <option value="completo">Paquete completo</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                        <input type="date" id="fecha"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sección de servicios destacados -->
        <div id="servicios" class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-8">Servicios destacados</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Servicio 1 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="{{ 'images.jfif' }}" alt="Servicio playa" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">Paquete lagunas 69</h3>
                            <p class="text-gray-700 mb-4">Disfruta de un tour concoiendo una de las lagunas mas famosas
                                de la laguna 69.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-600 font-bold">$1,200</span>
                                <a href="#"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">Ver
                                    detalles</a>
                            </div>
                        </div>
                    </div>

                    <!-- Servicio 2 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="{{ 'huayhuash-coordillera.jpg' }}" alt="Servicio montaña"
                            class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">Aventura en Montaña</h3>
                            <p class="text-gray-700 mb-4">Expedición de 3 días con equipo especializado, guías expertos
                                y hospedaje en cabañas.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-600 font-bold">$850</span>
                                <a href="#"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">Ver
                                    detalles</a>
                            </div>
                        </div>
                    </div>

                    <!-- Servicio 3 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="{{ 'Plaza-de-armas-de-Huaraz.jpg' }}" alt="Servicio ciudad"
                            class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">Tour Cultural Urbano</h3>
                            <p class="text-gray-700 mb-4">Recorrido por los principales puntos culturales e históricos
                                con guía especializado y transporte.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-600 font-bold">$450</span>
                                <a href="#"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">Ver
                                    detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-8">
                    <a href="#"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">Ver
                        todos los servicios</a>
                </div>
            </div>
        </div>

        <!-- Sección de equipos de turismo -->
        <div class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-8">Equipos para tu aventura</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Equipo 1 -->
                    <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-lg transition duration-300">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Equipos de camping</h3>
                        <p class="text-gray-600">Carpas, sacos de dormir y utensilios para acampar.</p>
                    </div>

                    <!-- Equipo 2 -->
                    <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-lg transition duration-300">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 22V12h6v10" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Equipos de buceo</h3>
                        <p class="text-gray-600">Trajes, tanques y accesorios para exploración submarina.</p>
                    </div>

                    <!-- Equipo 3 -->
                    <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-lg transition duration-300">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Equipos de escalada</h3>
                        <p class="text-gray-600">Cuerdas, arneses y equipamiento para montañismo.</p>
                    </div>

                    <!-- Equipo 4 -->
                    <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-lg transition duration-300">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Vehículos todo terreno</h3>
                        <p class="text-gray-600">Jeeps, cuatrimotos y vehículos para terrenos difíciles.</p>
                    </div>
                </div>
                <div class="text-center mt-8">
                    <a href="#"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">Ver
                        todos los equipos</a>
                </div>
            </div>
        </div>

        <!-- Sección de itinerarios populares -->
        <div class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-8">Itinerarios populares</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Itinerario 1 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">Ruta del Sol - 7 días</h3>
                            <p class="text-gray-700 mb-4">Recorrido por las mejores playas con actividades acuáticas y
                                experiencias culturales.</p>
                            <ul class="space-y-2 mb-4">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Día 1-2: Playa principal
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Día 3-4: Islas cercanas
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Día 5-7: Pueblo costero
                                </li>
                            </ul>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Ver itinerario
                                completo →</a>
                        </div>
                    </div>

                    <!-- Itinerario 2 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">Aventura en los Andes - 5 días</h3>
                            <p class="text-gray-700 mb-4">Expedición por las montañas con caminatas, cascadas y
                                paisajes impresionantes.</p>
                            <ul class="space-y-2 mb-4">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Día 1: Llegada y aclimatación
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Día 2-3: Trekking y lagos
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Día 4-5: Cima y descenso
                                </li>
                            </ul>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Ver itinerario
                                completo →</a>
                        </div>
                    </div>

                    <!-- Itinerario 3 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">Tour Urbano Cultural - 3 días</h3>
                            <p class="text-gray-700 mb-4">Recorrido por los puntos históricos y culturales más
                                importantes de la ciudad.</p>
                            <ul class="space-y-2 mb-4">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Día 1: Centro histórico
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Día 2: Museos y galerías
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Día 3: Gastronomía local
                                </li>
                            </ul>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Ver itinerario
                                completo →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de promociones -->
        <div class="py-16 bg-blue-50">
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
        </div>

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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Teléfono</h3>
                                    <p class="text-gray-600">+123 456 7890</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Email</h3>
                                    <p class="text-gray-600">info@turismo-aventura.com</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                    <label for="telefono"
                                        class="block text-sm font-medium text-gray-700">Teléfono</label>
                                    <input type="tel" id="telefono"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>
                                <div>
                                    <label for="mensaje"
                                        class="block text-sm font-medium text-gray-700">Mensaje</label>
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

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-8">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-bold mb-4">Turismo Aventura</h3>
                        <p class="text-gray-400">Descubre los mejores destinos y experiencias turísticas con nuestros
                            servicios especializados.</p>
                    </div>
                    <div>
                        <h4 class="text-md font-bold mb-4">Enlaces rápidos</h4>
                        <ul class="space-y-2">
                            <li><a href="#"
                                    class="text-gray-400 hover:text-white transition duration-300">Inicio</a></li>
                            <li><a href="#servicios"
                                    class="text-gray-400 hover:text-white transition duration-300">Servicios</a></li>
                            <li><a href="#contacto"
                                    class="text-gray-400 hover:text-white transition duration-300">Contacto</a></li>
                            <li><a href="#"
                                    class="text-gray-400 hover:text-white transition duration-300">Blog</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-md font-bold mb-4">Servicios</h4>
                        <ul class="space-y-2">
                            <li><a href="#"
                                    class="text-gray-400 hover:text-white transition duration-300">Paquetes
                                    turísticos</a></li>
                            <li><a href="#"
                                    class="text-gray-400 hover:text-white transition duration-300">Alquiler de
                                    equipos</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Guías
                                    especializados</a></li>
                            <li><a href="#"
                                    class="text-gray-400 hover:text-white transition duration-300">Transporte</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-md font-bold mb-4">Suscríbete</h4>
                        <p class="text-gray-400 mb-4">Recibe nuestras ofertas y novedades en tu correo.</p>
                        <form class="flex">
                            <input type="email" placeholder="Tu email"
                                class="px-4 py-2 rounded-l-lg focus:outline-none text-gray-800 w-full">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-r-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; 2025 ReservAncash pagina del Grupo de tecnologia web. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
</div>
