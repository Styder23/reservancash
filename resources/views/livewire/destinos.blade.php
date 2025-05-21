<div>
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
                    <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha Inicio</label>
                    <input type="date" id="fecha"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>
                <div class="flex-1">
                    <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha Fin</label>
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

    <div class="container mx-auto px-6 mt-4">
        <h2 class="text-3xl font-bold text-center mb-8"> VISITAS TURISTICAS A LAGUNAS </h2>

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
                <img src="{{ 'huayhuash-coordillera.jpg' }}" alt="Servicio montaña" class="w-full h-48 object-cover">
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
                <img src="{{ 'Plaza-de-armas-de-Huaraz.jpg' }}" alt="Servicio ciudad" class="w-full h-48 object-cover">
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

        <h2 class="text-3xl font-bold text-center mb-8 mt-6"> VISITAS TURISTICAS A MONTAÑAS </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Servicio 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ 'Plaza-de-armas-de-Huaraz.jpg' }}" alt="Servicio ciudad" class="w-full h-48 object-cover">
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

            <!-- Servicio 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ 'Plaza-de-armas-de-Huaraz.jpg' }}" alt="Servicio ciudad" class="w-full h-48 object-cover">
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

        <h2 class="text-3xl font-bold text-center mb-8 mt-6"> VISITAS TURISTICAS A LUGARES </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
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

    </div>

    <footer class="bg-gray-800 text-white py-8 mt-6">
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
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Blog</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-bold mb-4">Servicios</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Paquetes
                                turísticos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Alquiler
                                de
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
