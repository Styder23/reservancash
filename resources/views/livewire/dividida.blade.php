<div class="min-h-screen bg-gray-50 p-4">
    <div class="max-w-8xl mx-auto">
        <h1 class="text-3xl font-bold text-center text-green-700 mb-4">Compara Paquetes Turísticos</h1>

        <!-- Contenedor principal de dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Columna Izquierda -->
            <div class="bg-white    p-4 rounded-xl shadow-sm bg-gray-900">
                <!-- Header del Tour -->
                <div class="relative h-60 bg-gradient-to-r from-blue-900 to-blue-700 shadow-md">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <div class="relative z-10 container mx-auto px-4 h-full flex items-center">
                        <div class="text-white max-w-3xl">
                            <button onclick="toggleLike(event)"
                                class="absolute top-3 left-3 bg-white hover:bg-red-500 p-1 rounded-full shadow-md transition-colors like-btn">
                                <img src="flecha-atras.png" alt="Me gusta" class="h-7 w-7">
                            </button>
                            <h1 class="text-4xl font-bold mb-2">Trekking Cordillera Huayhuash: Aventura de 5 Días</h1>
                            <p class="text-xl text-gray-200">Descubre los paisajes más espectaculares de los Andes peruanos en esta inolvidable expedición de alta montaña.</p>
                        </div>
                    </div>
                </div>

                <!-- Contenido general del paquete-->
                <div class="container mx-auto px-auto py-4">
                    <div class="grid lg:grid-cols-2 gap-8">
                        <!-- Contenido Principal -->
                        <div class="lg:col-span-2">
                            <!-- Galería de Imágenes -->
                            <div class="mb-14 shadow-md">
                                <div class="grid grid-cols-4 gap-2 h-96">
                                    <div class="col-span-2 row-span-2">
                                        <img src="{{ 'huayhuash-coordillera.jpg' }}" alt="Cordillera Huayhuash"
                                            class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="col-span-2">
                                        <img src="{{ 'Alpamayo en 4k.jpg' }}"
                                            alt="Laguna en Huayhuash" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div>
                                        <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80"
                                            alt="Campamento" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="relative">
                                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80"
                                            alt="Vista panorámica" class="w-full h-full object-cover rounded-lg">
                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-60 rounded-lg flex items-center justify-center">
                                            <span class="text-white font-semibold">+12 fotos</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Información del Tour -->
                            <div class="bg-white rounded-xl shadow-md p-6 mb-4">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">Información sobre el tour</h2>
                                
                                <div class="grid md:grid-cols-2 gap-6 mb-6">
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center mr-3">
                                            <img src="cheque.png" alt="" class="w-8 h-8 sm:w-10 sm:h-10 md:w-14 md:h-12 text-green-600">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Cancelación gratuita</p>
                                            <p class="text-sm text-gray-600">Cancela con hasta 24 horas de antelación y recibe un reembolso completo</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="w-10 h-10 flex items-center justify-center mr-3">
                                            <img src="24-horas.png" alt="" class="w-8 h-8 sm:w-10 sm:h-10 md:w-10 md:h-10 text-green-600">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Duración 5 días</p>
                                            <p class="text-sm text-gray-600">Comprueba la disponibilidad para ver los
                                                horarios de inicio</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center mr-3">
                                            <img src="grupo-de-personas.png" alt="" class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 md text-green-600">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Grupo pequeño</p>
                                            <p class="text-sm text-gray-600">Máximo 12 personas por grupo</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center mr-3">
                                            <img src="libro-turistico (2).png" alt="" class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 text-green-600">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Guía</p>
                                            <p class="text-sm text-gray-600">Español, Inglés</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t pt-6">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Lo que incluye el servicio</h3>
                                    <div class="grid md:grid-cols-2 gap-4">
                                        <div class="flex items-center">
                                            <img src="doble-tic.png" alt="Check" class="w-7 h-7 text-green-500 mr-2">
                                            <span class="text-gray-700">Equipo de campamento completo</span>
                                        </div>
                                        <div class="flex items-center">
                                            <img src="doble-tic.png" alt="Check" class="w-7 h-7 text-green-500 mr-2">
                                            <span class="text-gray-700">Todas las comidas incluidas</span>
                                        </div>
                                        <div class="flex items-center">
                                            <img src="doble-tic.png" alt="Check" class="w-7 h-7 text-green-500 mr-2">
                                            <span class="text-gray-700">Transporte desde Huaraz</span>
                                        </div>
                                        <div class="flex items-center">
                                            <img src="doble-tic.png" alt="Check" class="w-7 h-7 text-green-500 mr-2">
                                            <span class="text-gray-700">Guía profesional certificado</span>
                                        </div>
                                        <div class="flex items-center">
                                            <img src="doble-tic.png" alt="Check" class="w-7 h-7 text-green-500 mr-2">
                                            <span class="text-gray-700">Seguro de aventura</span>
                                        </div>
                                        <div class="flex items-center">
                                            <img src="doble-tic.png" alt="Check" class="w-7 h-7 text-green-500 mr-2">
                                            <span class="text-gray-700">Arrieros y animales de carga</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Descripción del Tour -->
                            <div class="bg-white rounded-xl shadow-md p-6 mb-4">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">Descripción del tour</h2>
                                <p class="text-gray-600 leading-relaxed mb-4">
                                    Vive una experiencia única en la Cordillera Huayhuash, considerada una de las rutas
                                    de trekking más espectaculares del mundo. Durante 5 días, caminarás por paisajes de
                                    ensueño, rodeado de picos nevados que superan los 6,000 metros de altura, lagunas de
                                    color turquesa y valles glaciares que te dejarán sin aliento.
                                </p>
                                <p class="text-gray-600 leading-relaxed">
                                    Este circuito te llevará por algunos de los lugares más remotos y pristinos de los
                                    Andes peruanos, incluyendo vistas del imponente Yerupajá (6,617m), la segunda
                                    montaña más alta del Perú. Nuestros guías expertos te acompañarán en cada paso,
                                    compartiendo su conocimiento sobre la flora, fauna y cultura local de esta región
                                    extraordinaria.
                                </p>
                            </div>

                            <!-- Reseñas -->
                            <div class="bg-white rounded-xl shadow-md p-6">
                                <h2 class="text-2xl font-bold text-gray-800 mb-6">Reseñas destacadas de otros viajeros</h2>
                                <div class="space-y-6">
                                    <div class="border-b pb-6">
                                        <div class="flex items-center mb-3">
                                            <div
                                                class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white font-semibold">A</span>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-800">Ana — Colombia</h4>
                                                <div class="flex text-yellow-400">
                                                    <span>★★★★★</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-gray-600">"Una experiencia increíble. Los paisajes son
                                            simplemente espectaculares y el servicio del equipo fue excepcional.
                                            Totalmente recomendado para los amantes del trekking."</p>
                                    </div>

                                    <div class="border-b pb-6">
                                        <div class="flex items-center mb-3">
                                            <div
                                                class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white font-semibold">M</span>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-800">Miguel — España</h4>
                                                <div class="flex text-yellow-400">
                                                    <span>★★★★★</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-gray-600">"La organización fue perfecta desde el primer día. Los
                                            guías muy profesionales y conocedores de la zona. Sin duda, una de las
                                            mejores aventuras que he vivido."</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Panel de Reserva -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
                                <div class="text-center mb-6">
                                    <span
                                        class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full">Casi
                                        agotado</span>
                                </div>

                                <div class="text-center mb-6">
                                    <div class="text-3xl font-bold text-blue-600 mb-1">$2,500 USD</div>
                                    <div class="text-gray-600">por persona</div>
                                </div>

                                <div class="space-y-4 mb-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de
                                            inicio</label>
                                        <input type="date"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Número de
                                            personas</label>
                                        <select
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option>1 persona</option>
                                            <option>2 personas</option>
                                            <option>3 personas</option>
                                            <option>4 personas</option>
                                        </select>
                                    </div>
                                </div>

                                <button
                                    class="w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 mb-4">
                                    Ver disponibilidad
                                </button>

                                <div class="text-center mb-4">
                                    <span class="text-sm text-gray-600">
                                        <span class="underline cursor-pointer">Reservar ahora y pagar después</span> te
                                        permite asegurarte una plaza, sin que se realice ningún cargo hoy
                                    </span>
                                </div>

                                <div class="border-t pt-4">
                                    <div class="flex items-center text-sm text-gray-600 mb-2">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Cancelación gratuita hasta 24h antes</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
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

            </div>





            <!-- Columna Derecha -->
            <div class="bg-white p-4 rounded-xl shadow-sm bg-gray-900">
                <!-- Header del Tour -->
                <div class="relative h-60 bg-gradient-to-r from-blue-900 to-blue-700">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <div class="relative z-10 container mx-auto px-4 h-full flex items-center">
                        <div class="text-white max-w-3xl">
                            <button onclick="toggleLike(event)"
                                class="absolute top-3 left-3 bg-white hover:bg-red-500 p-1 rounded-full shadow-md transition-colors like-btn">
                                <img src="flecha-atras.png" alt="Me gusta" class="h-7 w-7">
                            </button>
                            <h1 class="text-4xl font-bold mb-2">Trekking Cordillera Huayhuash: Aventura de 5 Días</h1>
                            <p class="text-xl text-gray-200">Descubre los paisajes más espectaculares de los Andes peruanos en esta inolvidable expedición de alta montaña.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Contenido general del paquete-->
                <div class="container mx-auto px-auto py-4">
                    <div class="grid lg:grid-cols-2 gap-8">
                        <!-- Contenido Principal -->
                        <div class="lg:col-span-2">
                            <!-- Galería de Imágenes -->
                            <div class="mb-14">
                                <div class="grid grid-cols-4 gap-2 h-96">
                                    <div class="col-span-2 row-span-2">
                                        <img src="{{ 'huayhuash-coordillera.jpg' }}" alt="Cordillera Huayhuash"
                                            class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="col-span-2">
                                        <img src="{{ 'Alpamayo en 4k.jpg' }}"
                                            alt="Laguna en Huayhuash" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div>
                                        <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80"
                                            alt="Campamento" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="relative">
                                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80"
                                            alt="Vista panorámica" class="w-full h-full object-cover rounded-lg">
                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-60 rounded-lg flex items-center justify-center">
                                            <span class="text-white font-semibold">+12 fotos</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Información del Tour -->
                            <div class="bg-white rounded-xl shadow-md p-6 mb-4">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">Información sobre el tour</h2>
                                
                                <div class="grid md:grid-cols-2 gap-6 mb-6">
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center mr-3">
                                            <img src="cheque.png" alt="" class="w-8 h-8 sm:w-10 sm:h-10 md:w-14 md:h-12 text-green-600">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Cancelación gratuita</p>
                                            <p class="text-sm text-gray-600">Cancela con hasta 24 horas de antelación y recibe un reembolso completo</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="w-10 h-10 flex items-center justify-center mr-3">
                                            <img src="24-horas.png" alt="" class="w-8 h-8 sm:w-10 sm:h-10 md:w-10 md:h-10 text-green-600">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Duración 5 días</p>
                                            <p class="text-sm text-gray-600">Comprueba la disponibilidad para ver los
                                                horarios de inicio</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center mr-3">
                                            <img src="grupo-de-personas.png" alt="" class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 md text-green-600">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Grupo pequeño</p>
                                            <p class="text-sm text-gray-600">Máximo 12 personas por grupo</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center mr-3">
                                            <img src="libro-turistico (2).png" alt="" class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 text-green-600">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Guía</p>
                                            <p class="text-sm text-gray-600">Español, Inglés</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t pt-6">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Lo que incluye el servicio</h3>
                                    <div class="grid md:grid-cols-2 gap-4">
                                        <div class="flex items-center">
                                            <img src="doble-tic.png" alt="Check" class="w-7 h-7 text-green-500 mr-2">
                                            <span class="text-gray-700">Equipo de campamento completo</span>
                                        </div>
                                        <div class="flex items-center">
                                            <img src="doble-tic.png" alt="Check" class="w-7 h-7 text-green-500 mr-2">
                                            <span class="text-gray-700">Todas las comidas incluidas</span>
                                        </div>
                                        <div class="flex items-center">
                                            <img src="doble-tic.png" alt="Check" class="w-7 h-7 text-green-500 mr-2">
                                            <span class="text-gray-700">Transporte desde Huaraz</span>
                                        </div>
                                        <div class="flex items-center">
                                            <img src="doble-tic.png" alt="Check" class="w-7 h-7 text-green-500 mr-2">
                                            <span class="text-gray-700">Guía profesional certificado</span>
                                        </div>
                                        <div class="flex items-center">
                                            <img src="doble-tic.png" alt="Check" class="w-7 h-7 text-green-500 mr-2">
                                            <span class="text-gray-700">Seguro de aventura</span>
                                        </div>
                                        <div class="flex items-center">
                                            <img src="doble-tic.png" alt="Check" class="w-7 h-7 text-green-500 mr-2">
                                            <span class="text-gray-700">Arrieros y animales de carga</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Descripción del Tour -->
                            <div class="bg-white rounded-xl shadow-md p-6 mb-4">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">Descripción del tour</h2>
                                <p class="text-gray-600 leading-relaxed mb-4">
                                    Vive una experiencia única en la Cordillera Huayhuash, considerada una de las rutas
                                    de trekking más espectaculares del mundo. Durante 5 días, caminarás por paisajes de
                                    ensueño, rodeado de picos nevados que superan los 6,000 metros de altura, lagunas de
                                    color turquesa y valles glaciares que te dejarán sin aliento.
                                </p>
                                <p class="text-gray-600 leading-relaxed">
                                    Este circuito te llevará por algunos de los lugares más remotos y pristinos de los
                                    Andes peruanos, incluyendo vistas del imponente Yerupajá (6,617m), la segunda
                                    montaña más alta del Perú. Nuestros guías expertos te acompañarán en cada paso,
                                    compartiendo su conocimiento sobre la flora, fauna y cultura local de esta región
                                    extraordinaria.
                                </p>
                            </div>

                            <!-- Reseñas -->
                            <div class="bg-white rounded-xl shadow-md p-6">
                                <h2 class="text-2xl font-bold text-gray-800 mb-6">Reseñas destacadas de otros viajeros</h2>
                                <div class="space-y-6">
                                    <div class="border-b pb-6">
                                        <div class="flex items-center mb-3">
                                            <div
                                                class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white font-semibold">A</span>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-800">Ana — Colombia</h4>
                                                <div class="flex text-yellow-400">
                                                    <span>★★★★★</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-gray-600">"Una experiencia increíble. Los paisajes son
                                            simplemente espectaculares y el servicio del equipo fue excepcional.
                                            Totalmente recomendado para los amantes del trekking."</p>
                                    </div>

                                    <div class="border-b pb-6">
                                        <div class="flex items-center mb-3">
                                            <div
                                                class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white font-semibold">M</span>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-800">Miguel — España</h4>
                                                <div class="flex text-yellow-400">
                                                    <span>★★★★★</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-gray-600">"La organización fue perfecta desde el primer día. Los
                                            guías muy profesionales y conocedores de la zona. Sin duda, una de las
                                            mejores aventuras que he vivido."</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Panel de Reserva -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
                                <div class="text-center mb-6">
                                    <span
                                        class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full">Casi
                                        agotado</span>
                                </div>

                                <div class="text-center mb-6">
                                    <div class="text-3xl font-bold text-blue-600 mb-1">$2,500 USD</div>
                                    <div class="text-gray-600">por persona</div>
                                </div>

                                <div class="space-y-4 mb-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de
                                            inicio</label>
                                        <input type="date"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Número de
                                            personas</label>
                                        <select
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option>1 persona</option>
                                            <option>2 personas</option>
                                            <option>3 personas</option>
                                            <option>4 personas</option>
                                        </select>
                                    </div>
                                </div>

                                <button
                                    class="w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 mb-4">
                                    Ver disponibilidad
                                </button>

                                <div class="text-center mb-4">
                                    <span class="text-sm text-gray-600">
                                        <span class="underline cursor-pointer">Reservar ahora y pagar después</span> te
                                        permite asegurarte una plaza, sin que se realice ningún cargo hoy
                                    </span>
                                </div>

                                <div class="border-t pt-4">
                                    <div class="flex items-center text-sm text-gray-600 mb-2">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Cancelación gratuita hasta 24h antes</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
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

            </div>
        </div>
    </div>
</div>


<script>
    function toggleLike(event) {
        event.preventDefault(); // Evita que se active el enlace
        event.stopPropagation(); // Evita que se propague el evento

        const button = event.currentTarget;

        if (button.classList.contains('bg-red-500')) {
            button.classList.remove('bg-red-500');
            button.classList.add('bg-white');
        } else {
            button.classList.remove('bg-white');
            button.classList.add('bg-red-500');
        }
    }
</script>

