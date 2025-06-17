<div>
    <div class="max-w-8xl mx-auto px-6 sm:px-6 lg:px-8 py-3">
        <!-- Filtros mejorados -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Encuentra tu experiencia perfecta</h2>
            <form class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label for="provincia" class="block text-sm font-medium text-gray-700 mb-1">Provincia</label>
                    <select id="provincia"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border">
                        <option value="">Todas las provincias</option>
                        <option value="huaraz">Huaraz</option>
                        <option value="carhuaz">Carhuaz</option>
                        <option value="yungay">Yungay</option>
                    </select>
                </div>
                <div>
                    <label for="distrito" class="block text-sm font-medium text-gray-700 mb-1">Distrito</label>
                    <select id="distrito"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border">
                        <option value="">Todos los distritos</option>
                        <option value="centro">Centro</option>
                        <option value="independencia">Independencia</option>
                    </select>
                </div>
                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de destino</label>
                    <select id="tipo"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border">
                        <option value="">Todos los tipos</option>
                        <option value="laguna">Lagunas</option>
                        <option value="montaña">Montañas</option>
                        <option value="historico">Lugares históricos</option>
                    </select>
                </div>
                <div>
                    <label for="fecha-inicio" class="block text-sm font-medium text-gray-700 mb-1">Fecha inicio</label>
                    <input type="date" id="fecha-inicio"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border">
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 shadow-md">
                        Buscar
                    </button>
                </div>
            </form>
        </div>

        <!-- Sección de destinos -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 mr-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Lagunas más visitadas
                </h2>
                <button class="flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                    Ver más destinos
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tarjeta de destino mejorada -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative">
                        <img src="{{ 'images.jfif' }}" alt="Laguna 69" class="w-full h-48 object-cover">
                        <div
                            class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            Disponible
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-800">Paquete Laguna 69</h3>
                            <span
                                class="bg-blue-100 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded">Nuevo</span>
                        </div>
                        <p class="text-gray-600 mb-4">Disfruta de un tour conociendo una de las lagunas más famosas de
                            Áncash.</p>

                        <div class="flex items-center mb-4">
                            <div class="flex -space-x-1">
                                <img class="w-6 h-6 rounded-full border-2 border-white"
                                    src="https://randomuser.me/api/portraits/women/11.jpg" alt="">
                                <img class="w-6 h-6 rounded-full border-2 border-white"
                                    src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
                                <img class="w-6 h-6 rounded-full border-2 border-white"
                                    src="https://randomuser.me/api/portraits/women/22.jpg" alt="">
                            </div>
                            <span class="text-sm text-gray-500 ml-2">+20 viajeros esta semana</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg font-bold text-blue-600">$1,200</span>
                                <span class="text-sm text-gray-500">/por persona</span>
                            </div>
                            <a href="{{ route('destino_detalle') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
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

                <!-- Otras tarjetas de destino (similar estructura) -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative">
                        <img src="{{ 'huayhuash-coordillera.jpg' }}" alt="Cordillera Huayhuash"
                            class="w-full h-48 object-cover">
                        <div
                            class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            Últimos cupos
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-800">Trekking Huayhuash</h3>
                            <span
                                class="bg-green-100 text-green-800 text-sm font-semibold px-2.5 py-0.5 rounded">Popular</span>
                        </div>
                        <p class="text-gray-600 mb-4">Aventura de 5 días por la espectacular Cordillera Huayhuash.</p>

                        <div class="flex items-center mb-4">
                            <div class="flex items-center text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-gray-700 ml-1">4.8 (36 reseñas)</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg font-bold text-blue-600">$2,500</span>
                                <span class="text-sm text-gray-500">/por persona</span>
                            </div>
                            <a href="{{ route('destino_detalle') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
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

                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative">
                        <img src="{{ 'Plaza-de-armas-de-Huaraz.jpg' }}" alt="City Tour Huaraz"
                            class="w-full h-48 object-cover">
                        <div
                            class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            Todo el año
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">City Tour Huaraz</h3>
                        <p class="text-gray-600 mb-4">Recorrido por los principales atractivos culturales e históricos
                            de
                            la ciudad.</p>

                        <div class="mb-4">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-600 ml-2 text-sm">Duración: 4 horas</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg font-bold text-blue-600">$150</span>
                                <span class="text-sm text-gray-500">/por persona</span>
                            </div>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
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
            </div>
        </div>

        <!-- Más secciones de destinos (montañas, lugares históricos, etc.) -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 mr-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Aventuras en montaña
                </h2>
                <button class="flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                    Ver más destinos
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Tarjeta de destino mejorada -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative">
                        <img src="{{ 'images.jfif' }}" alt="Laguna 69" class="w-full h-48 object-cover">
                        <div
                            class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            Disponible
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-800">Paquete Laguna 69</h3>
                            <span
                                class="bg-blue-100 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded">Nuevo</span>
                        </div>
                        <p class="text-gray-600 mb-4">Disfruta de un tour conociendo una de las lagunas más famosas de
                            Áncash.</p>

                        <div class="flex items-center mb-4">
                            <div class="flex -space-x-1">
                                <img class="w-6 h-6 rounded-full border-2 border-white"
                                    src="https://randomuser.me/api/portraits/women/11.jpg" alt="">
                                <img class="w-6 h-6 rounded-full border-2 border-white"
                                    src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
                                <img class="w-6 h-6 rounded-full border-2 border-white"
                                    src="https://randomuser.me/api/portraits/women/22.jpg" alt="">
                            </div>
                            <span class="text-sm text-gray-500 ml-2">+20 viajeros esta semana</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg font-bold text-blue-600">$1,200</span>
                                <span class="text-sm text-gray-500">/por persona</span>
                            </div>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
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

                <!-- Otras tarjetas de destino (similar estructura) -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative">
                        <img src="{{ 'huayhuash-coordillera.jpg' }}" alt="Cordillera Huayhuash"
                            class="w-full h-48 object-cover">
                        <div
                            class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            Últimos cupos
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-800">Trekking Huayhuash</h3>
                            <span
                                class="bg-green-100 text-green-800 text-sm font-semibold px-2.5 py-0.5 rounded">Popular</span>
                        </div>
                        <p class="text-gray-600 mb-4">Aventura de 5 días por la espectacular Cordillera Huayhuash.</p>

                        <div class="flex items-center mb-4">
                            <div class="flex items-center text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-gray-700 ml-1">4.8 (36 reseñas)</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg font-bold text-blue-600">$2,500</span>
                                <span class="text-sm text-gray-500">/por persona</span>
                            </div>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
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

                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative">
                        <img src="{{ 'Plaza-de-armas-de-Huaraz.jpg' }}" alt="City Tour Huaraz"
                            class="w-full h-48 object-cover">
                        <div
                            class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            Todo el año
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">City Tour Huaraz</h3>
                        <p class="text-gray-600 mb-4">Recorrido por los principales atractivos culturales e históricos
                            de
                            la ciudad.</p>

                        <div class="mb-4">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-600 ml-2 text-sm">Duración: 4 horas</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg font-bold text-blue-600">$150</span>
                                <span class="text-sm text-gray-500">/por persona</span>
                            </div>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
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
            </div>
        </div>

        <div class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 mr-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Lugares historicos
                </h2>
                <button class="flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                    Ver más destinos
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Tarjeta de destino mejorada -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative">
                        <img src="{{ 'images.jfif' }}" alt="Laguna 69" class="w-full h-48 object-cover">
                        <div
                            class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            Disponible
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-800">Paquete Laguna 69</h3>
                            <span
                                class="bg-blue-100 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded">Nuevo</span>
                        </div>
                        <p class="text-gray-600 mb-4">Disfruta de un tour conociendo una de las lagunas más famosas de
                            Áncash.</p>

                        <div class="flex items-center mb-4">
                            <div class="flex -space-x-1">
                                <img class="w-6 h-6 rounded-full border-2 border-white"
                                    src="https://randomuser.me/api/portraits/women/11.jpg" alt="">
                                <img class="w-6 h-6 rounded-full border-2 border-white"
                                    src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
                                <img class="w-6 h-6 rounded-full border-2 border-white"
                                    src="https://randomuser.me/api/portraits/women/22.jpg" alt="">
                            </div>
                            <span class="text-sm text-gray-500 ml-2">+20 viajeros esta semana</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg font-bold text-blue-600">$1,200</span>
                                <span class="text-sm text-gray-500">/por persona</span>
                            </div>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
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

                <!-- Otras tarjetas de destino (similar estructura) -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative">
                        <img src="{{ 'huayhuash-coordillera.jpg' }}" alt="Cordillera Huayhuash"
                            class="w-full h-48 object-cover">
                        <div
                            class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            Últimos cupos
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-800">Trekking Huayhuash</h3>
                            <span
                                class="bg-green-100 text-green-800 text-sm font-semibold px-2.5 py-0.5 rounded">Popular</span>
                        </div>
                        <p class="text-gray-600 mb-4">Aventura de 5 días por la espectacular Cordillera Huayhuash.</p>

                        <div class="flex items-center mb-4">
                            <div class="flex items-center text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-gray-700 ml-1">4.8 (36 reseñas)</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg font-bold text-blue-600">$2,500</span>
                                <span class="text-sm text-gray-500">/por persona</span>
                            </div>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
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

                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative">
                        <img src="{{ 'Plaza-de-armas-de-Huaraz.jpg' }}" alt="City Tour Huaraz"
                            class="w-full h-48 object-cover">
                        <div
                            class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            Todo el año
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">City Tour Huaraz</h3>
                        <p class="text-gray-600 mb-4">Recorrido por los principales atractivos culturales e históricos
                            de
                            la ciudad.</p>

                        <div class="mb-4">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-600 ml-2 text-sm">Duración: 4 horas</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg font-bold text-blue-600">$150</span>
                                <span class="text-sm text-gray-500">/por persona</span>
                            </div>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
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
            </div>
        </div>

        <!-- Sección de testimonios -->
        <div class="bg-blue-50 rounded-xl p-8 mb-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Experiencias de viajeros</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4">
                        <img class="w-12 h-12 rounded-full mr-4"
                            src="https://randomuser.me/api/portraits/women/43.jpg" alt="María González">
                        <div>
                            <h4 class="font-bold text-gray-800">María González</h4>
                            <div class="flex text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"La laguna 69 fue una experiencia increíble. Los guías muy
                        profesionales y el paisaje es simplemente espectacular. ¡Volvería sin duda!"</p>
                </div>

                <!-- Otros testimonios (similar estructura) -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4">
                        <img class="w-12 h-12 rounded-full mr-4" src="https://randomuser.me/api/portraits/men/65.jpg"
                            alt="Carlos Mendoza">
                        <div>
                            <h4 class="font-bold text-gray-800">Carlos Mendoza</h4>
                            <div class="flex text-yellow-400">
                                <!-- Iconos de estrellas -->
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"El trekking por Huayhuash fue el desafío perfecto. La organización
                        impecable y los paisajes son de otro planeta. Recomiendo totalmente esta agencia."</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4">
                        <img class="w-12 h-12 rounded-full mr-4"
                            src="https://randomuser.me/api/portraits/women/28.jpg" alt="Lucía Fernández">
                        <div>
                            <h4 class="font-bold text-gray-800">Lucía Fernández</h4>
                            <div class="flex text-yellow-400">
                                <!-- Iconos de estrellas -->
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"El city tour nos permitió conocer la historia de Huaraz de una
                        manera
                        muy amena. El guía conocía todos los detalles y nos hizo sentir como locales."</p>
                </div>
            </div>
        </div>
    </div>
    
</div>