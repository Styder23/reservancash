<div class="min-h-screen bg-gray-50 p-4">
    <div class="max-w-8xl mx-auto">
        <h1 class="text-2xl font-bold text-center text-green-700 mb-6">Compara Paquetes Turísticos</h1>

        <!-- Contenedor principal de dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Columna Izquierda -->
            <div class="bg-white p-4 rounded-xl shadow-sm">
                <!-- Buscador -->
                <div class="relative mb-4">
                    <input type="text"
                        class="w-full p-3 pl-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Buscar destino...">
                    <div class="absolute left-3 top-3.5 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <select class="p-2 border rounded-lg text-sm">
                        <option>Precio</option>
                        <option>Menor a mayor</option>
                        <option>Mayor a menor</option>
                    </select>
                    <select class="p-2 border rounded-lg text-sm">
                        <option>Duración</option>
                        <option>1 día</option>
                        <option>2 días</option>
                    </select>
                    <select class="p-2 border rounded-lg text-sm">
                        <option>Fecha</option>
                        <option>Próxima semana</option>
                        <option>Próximo mes</option>
                    </select>
                    <select class="p-2 border rounded-lg text-sm">
                        <option>Servicios</option>
                        <option>Con alimentación</option>
                        <option>Con guía</option>
                    </select>
                </div>

                <!-- Lista de Cards -->
                <div class="space-y-4">
                    <!-- Card 1 con imagen referencial -->
                    <a href="destino-detalle"
                        class="block border rounded-lg hover:border-green-400 transition-colors overflow-hidden">
                        <div class="relative h-40">
                            <img src="inicioarriba.jpg" alt="Laguna 69" class="w-full h-full object-cover">
                            <button onclick="toggleLike(event)"
                                class="absolute top-2 left-2 bg-white hover:bg-red-500 p-1 rounded-full shadow-md transition-colors like-btn">
                                <img src="me-gusta.png" alt="Me gusta" class="h-5 w-5">
                            </button>
                            <span
                                class="absolute top-2 right-2 bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">Recomendado</span>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">Laguna 69</h3>
                                    <p class="text-sm text-gray-500">Empresa Aventura Total</p>
                                </div>
                                <img src="logo-Principal.png" alt="Logo empresa" class="h-12">
                            </div>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-2xl font-bold text-green-600">S/ 120</span>
                                <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">12 horas</span>
                            </div>
                            <div class="mt-2 text-right">
                                <label class="text-sm text-gray-500">
                                    <input type="checkbox" class="compare-checkbox"
                                        value="Laguna 69 - S/120 - 12h">Comparar
                                </label>
                            </div>
                        </div>
                    </a>

                    <!-- Card 2 con imagen referencial -->
                    <a href="destino-detalle"
                        class="block border rounded-lg hover:border-green-400 transition-colors overflow-hidden">
                        <div class="relative h-40">
                            <img src="inicioarriba.jpg" alt="Laguna 69" class="w-full h-full object-cover">
                            <button onclick="toggleLike(event)"
                                class="absolute top-2 left-2 bg-white hover:bg-red-500 p-1 rounded-full shadow-md transition-colors like-btn">
                                <img src="me-gusta.png" alt="Me gusta" class="h-5 w-5">
                            </button>
                            <span
                                class="absolute top-2 right-2 bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-medium">Oferta</span>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">Laguna 69</h3>
                                    <p class="text-sm text-gray-500">Empresa Trekking Perú</p>
                                </div>
                                <img src="logo-Principal.png" alt="Logo empresa" class="h-12">
                            </div>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-2xl font-bold text-green-600">S/ 150</span>
                                <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">10 horas</span>
                            </div>
                        </div>
                    </a>

                    <!-- Card 3 con imagen referencial -->
                    <a href="destino-detalle"
                        class="block border rounded-lg hover:border-green-400 transition-colors overflow-hidden">
                        <div class="relative h-40">
                            <img src="inicioarriba.jpg" alt="Laguna 69" class="w-full h-full object-cover">
                            <button onclick="toggleLike(event)"
                                class="absolute top-2 left-2 bg-white hover:bg-red-500 p-1 rounded-full shadow-md transition-colors like-btn">
                                <img src="me-gusta.png" alt="Me gusta" class="h-5 w-5">
                            </button>
                            <span
                                class="absolute top-2 right-2 bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-medium">Oferta</span>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">Laguna 69</h3>
                                    <p class="text-sm text-gray-500">Empresa Trekking Perú</p>
                                </div>
                                <img src="logo-Principal.png" alt="Logo empresa" class="h-12">
                            </div>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-2xl font-bold text-green-600">S/ 150</span>
                                <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">10 horas</span>
                            </div>
                        </div>
                    </a>

                    <!-- Card 4 con imagen referencial -->
                    <a href="destino-detalle"
                        class="block border rounded-lg hover:border-green-400 transition-colors overflow-hidden">
                        <div class="relative h-40">
                            <img src="inicioarriba.jpg" alt="Laguna 69" class="w-full h-full object-cover">
                            <button onclick="toggleLike(event)"
                                class="absolute top-2 left-2 bg-white hover:bg-red-500 p-1 rounded-full shadow-md transition-colors like-btn">
                                <img src="me-gusta.png" alt="Me gusta" class="h-5 w-5">
                            </button>
                            <span
                                class="absolute top-2 right-2 bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-medium">Oferta</span>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">Laguna 69</h3>
                                    <p class="text-sm text-gray-500">Empresa Trekking Perú</p>
                                </div>
                                <img src="logo-Principal.png" alt="Logo empresa" class="h-12">
                            </div>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-2xl font-bold text-green-600">S/ 150</span>
                                <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">10 horas</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="text-center mt-6">
                    <button onclick="compareSelected()"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        Comparar Seleccionados
                    </button>
                </div>



                <div id="comparison-result" class="mt-6 bg-yellow-100 p-4 rounded-lg hidden">
                    <h2 class="font-bold text-lg text-yellow-800 mb-2">Comparación:</h2>
                    <ul id="comparison-list" class="list-disc pl-5 text-sm text-gray-700"></ul>
                </div>

            </div>





            <!-- Columna Derecha -->
            <div class="bg-white p-4 rounded-xl shadow-sm">
                <!-- Buscador -->
                <div class="relative mb-4">
                    <input type="text"
                        class="w-full p-3 pl-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Buscar destino...">
                    <div class="absolute left-3 top-3.5 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <select class="p-2 border rounded-lg text-sm">
                        <option>Precio</option>
                        <option>Menor a mayor</option>
                        <option>Mayor a menor</option>
                    </select>
                    <select class="p-2 border rounded-lg text-sm">
                        <option>Duración</option>
                        <option>1 día</option>
                        <option>2 días</option>
                    </select>
                    <select class="p-2 border rounded-lg text-sm">
                        <option>Fecha</option>
                        <option>Próxima semana</option>
                        <option>Próximo mes</option>
                    </select>
                    <select class="p-2 border rounded-lg text-sm">
                        <option>Servicios</option>
                        <option>Con alimentación</option>
                        <option>Con guía</option>
                    </select>
                </div>

                <!-- Lista de Cards -->
                <div class="space-y-4">
                    <!-- Card 3 con imagen referencial -->
                    <a href="destino-detalle""
                        class="block border rounded-lg hover:border-green-400 transition-colors overflow-hidden">
                        <div class="relative h-40">
                            <img src="inicioarriba.jpg" alt="Laguna Churup" class="w-full h-full object-cover">
                            <button onclick="toggleLike(event)"
                                class="absolute top-2 left-2 bg-white hover:bg-red-500 p-1 rounded-full shadow-md transition-colors like-btn">
                                <img src="me-gusta.png" alt="Me gusta" class="h-5 w-5">
                            </button>
                            <span
                                class="absolute top-2 right-2 bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs font-medium">Nuevo</span>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">Laguna Churup</h3>
                                    <p class="text-sm text-gray-500">Empresa Andes Travel</p>
                                </div>
                                <img src="logo-Principal.png" alt="Logo empresa" class="h-12">
                            </div>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-2xl font-bold text-green-600">S/ 90</span>
                                <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">8 horas</span>
                            </div>
                            <div class="mt-2 text-right">
                                <label class="text-sm text-gray-500">
                                    <input type="checkbox" class="compare-checkbox"
                                        value="Laguna 69 - S/120 - 12h">Comparar
                                </label>
                            </div>
                        </div>
                    </a>

                    <!-- Card 4 con imagen referencial -->
                    <a href="destino-detalle"
                        class="block border rounded-lg hover:border-green-400 transition-colors overflow-hidden">
                        <div class="relative h-40">
                            <img src="inicioarriba.jpg" alt="Laguna Parón" class="w-full h-full object-cover">
                            <button onclick="toggleLike(event)"
                                class="absolute top-2 left-2 bg-white hover:bg-red-500 p-1 rounded-full shadow-md transition-colors like-btn">
                                <img src="me-gusta.png" alt="Me gusta" class="h-5 w-5">
                            </button>
                            <span
                                class="absolute top-2 right-2 bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-medium">Últimos
                                cupos</span>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">Laguna Parón</h3>
                                    <p class="text-sm text-gray-500">Empresa Nature Tours</p>
                                </div>
                                <img src="logo-Principal.png" alt="Logo empresa" class="h-12">
                            </div>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-2xl font-bold text-green-600">S/ 180</span>
                                <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">14 horas</span>
                            </div>
                        </div>
                    </a>

                    <!-- Card 3 con imagen referencial -->
                    <a href="destino-detalle"
                        class="block border rounded-lg hover:border-green-400 transition-colors overflow-hidden">
                        <div class="relative h-40">
                            <img src="inicioarriba.jpg" alt="Laguna 69" class="w-full h-full object-cover">
                            <button onclick="toggleLike(event)"
                                class="absolute top-2 left-2 bg-white hover:bg-red-500 p-1 rounded-full shadow-md transition-colors like-btn">
                                <img src="me-gusta.png" alt="Me gusta" class="h-5 w-5">
                            </button>
                            <span
                                class="absolute top-2 right-2 bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-medium">Oferta</span>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">Laguna 69</h3>
                                    <p class="text-sm text-gray-500">Empresa Trekking Perú</p>
                                </div>
                                <img src="logo-Principal.png" alt="Logo empresa" class="h-12">
                            </div>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-2xl font-bold text-green-600">S/ 150</span>
                                <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">10 horas</span>
                            </div>
                        </div>
                    </a>

                    <!-- Card 4 con imagen referencial -->
                    <a href="destino-detalle"
                        class="block border rounded-lg hover:border-green-400 transition-colors overflow-hidden">
                        <div class="relative h-40">
                            <img src="inicioarriba.jpg" alt="Laguna 69" class="w-full h-full object-cover">
                            <button onclick="toggleLike(event)"
                                class="absolute top-2 left-2 bg-white hover:bg-red-500 p-1 rounded-full shadow-md transition-colors like-btn">
                                <img src="me-gusta.png" alt="Me gusta" class="h-5 w-5">
                            </button>
                            <span
                                class="absolute top-2 right-2 bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-medium">Oferta</span>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">Laguna 69</h3>
                                    <p class="text-sm text-gray-500">Empresa Trekking Perú</p>
                                </div>
                                <img src="logo-Principal.png" alt="Logo empresa" class="h-12">
                            </div>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-2xl font-bold text-green-600">S/ 150</span>
                                <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">10 horas</span>
                            </div>
                        </div>
                    </a>

                </div>
                <div class="text-center mt-6">
                    <button onclick="compareSelected()"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        Comparar Seleccionados
                    </button>
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

<script>
    function compareSelected() {
        const checkboxes = document.querySelectorAll('.compare-checkbox:checked');
        const comparisonList = document.getElementById('comparison-list');
        const resultBox = document.getElementById('comparison-result');

        comparisonList.innerHTML = '';

        if (checkboxes.length !== 2) {
            alert('Por favor selecciona exactamente 2 paquetes para comparar.');
            resultBox.classList.add('hidden');
            return;
        }

        checkboxes.forEach(cb => {
            const li = document.createElement('li');
            li.textContent = cb.value;
            comparisonList.appendChild(li);
        });

        resultBox.classList.remove('hidden');
        resultBox.scrollIntoView({ behavior: 'smooth' });
    }
</script>

