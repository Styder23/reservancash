<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow rounded-2xl p-6 space-y-6">

            {{-- Encabezado de la empresa --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <img src="{{ 'Alpamayo en 4k.jpg' }}" alt="Logo Empresa" class="w-24 h-24 rounded-full object-cover">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Nombre de la Empresa</h1>
                        <p class="text-gray-500">Rubro / Tipo de empresa</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400">RUC: 12345678901</p>
                    <p class="text-sm text-gray-400">Correo: empresa@email.com</p>
                </div>
            </div>

            {{-- Descripción --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Descripción</h2>
                <p class="text-gray-700 mt-2">
                    Somos una empresa dedicada a brindar experiencias turísticas inolvidables en el corazón del Perú.
                    Contamos con más de 10 años de experiencia...
                </p>
            </div>

            {{-- Ubicación --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Ubicación</h2>
                <p class="text-gray-700 mt-2">Av. Los Libertadores 123, Huaraz - Áncash</p>
                {{-- Aquí puedes incrustar un mapa de Google si lo deseas --}}
            </div>

            {{-- Galería de Fotos --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Galería</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
                    <img src="{{ 'Alpamayo en 4k.jpg' }}" class="rounded-xl object-cover h-40 w-full" alt="">
                    <img src="{{ 'Alpamayo en 4k.jpg' }}" class="rounded-xl object-cover h-40 w-full" alt="">
                    <img src="{{ 'Alpamayo en 4k.jpg' }}" class="rounded-xl object-cover h-40 w-full" alt="">
                    <img src="{{ 'Alpamayo en 4k.jpg' }}" class="rounded-xl object-cover h-40 w-full" alt="">
                </div>
            </div>

            {{-- Video institucional (opcional) --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Video Institucional</h2>
                <div class="aspect-w-16 aspect-h-9 mt-4">
                    <iframe class="rounded-xl w-full h-96"
                        src="https://www.youtube.com/shorts/uT1USSrmN7c?feature=share" frameborder="0"
                        allowfullscreen></iframe>
                    <a href="https://www.youtube.com/shorts/uT1USSrmN7c?feature=share" target="_blank"
                        class="text-blue-600 underline"> Ver video institucional</a>

                </div>
            </div>

            {{-- Personal y gerencia --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Equipo de Trabajo</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    <div class="bg-gray-50 rounded-xl p-4 shadow">
                        <img src="{{ 'Alpamayo en 4k.jpg' }}" class="w-20 h-20 rounded-full mx-auto object-cover"
                            alt="">
                        <div class="text-center mt-2">
                            <h3 class="font-semibold text-lg">Juan Pérez</h3>
                            <p class="text-gray-500 text-sm">Gerente General</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 shadow">
                        <img src="{{ 'Alpamayo en 4k.jpg' }}" class="w-20 h-20 rounded-full mx-auto object-cover"
                            alt="">
                        <div class="text-center mt-2">
                            <h3 class="font-semibold text-lg">Ana López</h3>
                            <p class="text-gray-500 text-sm">Atención al cliente</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 shadow">
                        <img src="{{ 'Alpamayo en 4k.jpg' }}" class="w-20 h-20 rounded-full mx-auto object-cover"
                            alt="">
                        <div class="text-center mt-2">
                            <h3 class="font-semibold text-lg">Carlos Gómez</h3>
                            <p class="text-gray-500 text-sm">Guía turístico</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Otros datos importantes --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Datos adicionales</h2>
                <ul class="list-disc pl-6 mt-2 text-gray-700 space-y-1">
                    <li>Año de fundación: 2015</li>
                    <li>Certificación de calidad turística</li>
                    <li>Miembro de la Cámara de Comercio de Huaraz</li>
                </ul>
            </div>

            {{-- Paquetes Turísticos --}}
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
                    Que ofrecemos...
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

        </div>
    </div>

</div>
