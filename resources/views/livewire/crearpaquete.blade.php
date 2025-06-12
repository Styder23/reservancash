<div>

    <!-- resources/views/empresa/crear-paquete.blade.php -->
    <div x-data="{ showItinerario: false, showNuevoLugar: false }" class="p-6 max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">🎒 Crear nuevo paquete turístico</h1>

        <!-- CARD CONTENEDORA -->
        <div class="space-y-6">

            <!-- Nombre del paquete -->
            <div class="bg-white rounded-xl shadow p-6">
                <label class="text-lg font-semibold block mb-2">📝 Nombre del paquete</label>
                <input type="text" class="w-full border border-gray-300 p-3 rounded-lg"
                    placeholder="Ej: Tour Laguna 69">
            </div>

            <!-- Precio y cupos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow p-6">
                    <label class="text-lg font-semibold block mb-2">💰 Precio</label>
                    <input type="number" class="w-full border p-3 rounded-lg" placeholder="S/.">
                </div>
                <div class="bg-white rounded-xl shadow p-6">
                    <label class="text-lg font-semibold block mb-2">🎟️ Cupos disponibles</label>
                    <input type="number" class="w-full border p-3 rounded-lg">
                </div>
            </div>

            <!-- Descripción -->
            <div class="bg-white rounded-xl shadow p-6">
                <label class="text-lg font-semibold block mb-2">🖊️ Descripción</label>
                <textarea rows="4" class="w-full border p-3 rounded-lg"
                    placeholder="Una descripción atractiva para el cliente..."></textarea>
            </div>

            <!-- Imágenes y videos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow p-6">
                    <label class="text-lg font-semibold block mb-2">🖼️ Imágenes</label>
                    <div class="border-dashed border-2 border-gray-300 rounded-lg p-6 text-center">
                        <p class="text-gray-500 mb-2">Arrastra aquí tus imágenes o haz clic</p>
                        <input type="file" multiple accept="image/*" class="mx-auto text-sm">
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow p-6">
                    <label class="text-lg font-semibold block mb-2">🎥 Videos</label>
                    <div class="border-dashed border-2 border-gray-300 rounded-lg p-6 text-center">
                        <p class="text-gray-500 mb-2">Arrastra aquí tus videos o haz clic</p>
                        <input type="file" multiple accept="video/*" class="mx-auto text-sm">
                    </div>
                </div>
            </div>

            <!-- Punto de inicio y llegada -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Punto de inicio con botón + al lado -->
                <div class="bg-white rounded-xl shadow p-6">
                    <label class="text-lg font-semibold block mb-2">🚏 Punto de inicio</label>
                    <div class="flex items-center gap-2">
                        <select class="w-full border p-3 rounded-lg">
                            <option>Selecciona uno existente</option>
                        </select>
                        <!-- Botón + -->
                        <button @click="showNuevoLugar = true"
                            class="flex items-center justify-center w-10 h-10 bg-blue-600 text-white text-xl font-bold rounded-full hover:bg-blue-700 focus:outline-none">
                            +
                        </button>
                    </div>
                </div>

                <!-- Punto de llegada -->
                <div class="bg-white rounded-xl shadow p-6">
                    <label class="text-lg font-semibold block mb-2">🏁 Punto de llegada</label>
                    <select class="w-full border p-3 rounded-lg">
                        <option>Selecciona uno existente</option>
                    </select>
                </div>
            </div>

            <!-- Qué incluye -->
            <div class="bg-white rounded-xl shadow p-6">
                <label class="text-lg font-semibold block mb-2">✅ ¿Qué incluye?</label>
                <textarea class="w-full border p-3 rounded-lg" placeholder="Transporte, guía turístico, almuerzo, etc."></textarea>
            </div>

            <!-- Información importante -->
            <div class="bg-white rounded-xl shadow p-6">
                <label class="text-lg font-semibold block mb-2">📌 Información importante</label>
                <textarea class="w-full border p-3 rounded-lg" placeholder="Ej: Llevar DNI, ropa cómoda, protección solar, etc."></textarea>
            </div>

            <!-- Horario -->
            <div class="bg-white rounded-xl shadow p-6">
                <label class="text-lg font-semibold block mb-2">⏰ Horario</label>
                <input type="time" class="w-full border p-3 rounded-lg">
            </div>

            <!-- Punto de encuentro -->
            <div class="bg-white rounded-xl shadow p-6">
                <label class="text-lg font-semibold block mb-2">📍 Puntos de encuentro</label>
                <input type="text" class="w-full border p-3 rounded-lg" placeholder="Ej: Terminal Terrestre Huaraz">
            </div>

            <!-- Botón agregar itinerario -->
            <div class="text-center">
                <button @click="showItinerario = true"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 text-lg">
                    ➕ Agregar Itinerario
                </button>
            </div>

            <!-- Botón guardar -->
            <div class="text-right">
                <button class="bg-green-600 text-white px-8 py-3 rounded-lg text-lg hover:bg-green-700">💾
                    Guardar</button>
            </div>
        </div>








        <!-- Modal: NUEVO PUNTO -->
        <div x-show="showNuevoLugar" x-transition
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50" x-cloak>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-xl font-bold mb-4">🆕 Agregar nuevo punto</h2>
                <input type="text" class="w-full border p-3 rounded mb-4" placeholder="Ej: Plaza de Armas de Caraz">
                <div class="flex justify-end space-x-2">
                    <button @click="showNuevoLugar = false"
                        class="bg-gray-400 px-4 py-2 text-white rounded hover:bg-gray-500">
                        Cancelar
                    </button>
                    <button @click="showNuevoLugar = false"
                        class="bg-blue-600 px-4 py-2 text-white rounded hover:bg-blue-700">
                        Guardar
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal: ITINERARIO -->
        <div x-show="showItinerario" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-50"
            x-cloak>
            <div class="bg-white rounded-xl p-6 w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-xl">
                <h3 class="text-2xl font-bold mb-4">🗺️ Itinerario del Tour</h3>

                <template x-for="i in 3" :key="i">
                    <div class="mb-4 border-b pb-4">
                        <label class="block text-md font-semibold mb-2">Punto <span x-text="i"></span></label>
                        <input type="text" class="w-full border p-2 rounded mb-2" placeholder="Nombre del lugar">
                        <textarea class="w-full border p-2 rounded" placeholder="Descripción..."></textarea>
                    </div>
                </template>

                <div class="flex justify-end gap-3 mt-4">
                    <button @click="showItinerario = false"
                        class="bg-gray-500 px-4 py-2 text-white rounded">Cancelar</button>
                    <button @click="showItinerario = false"
                        class="bg-green-600 px-4 py-2 text-white rounded">Guardar</button>
                </div>
            </div>
        </div>
    </div>







    <!-- Punto de inicio -->
    <div x-data="{ showSlideOver: false, tipoCampo: '' }" class="relative space-y-2">
        <label class="font-semibold block mb-1">🚩 Punto de inicio</label>
        <div class="flex gap-2">
            <select class="w-full border p-2 rounded">
                <option>Selecciona un punto</option>
                <option>Huaraz</option>
                <option>Cusco</option>
            </select>
            <button @click="showSlideOver = true; tipoCampo = 'destino'"
                class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700 transition">
                +
            </button>
        </div>

        <!-- Panel tipo slide-over para añadir nuevo -->
        <div x-show="showSlideOver" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="transform translate-x-0"
            x-transition:leave-end="transform translate-x-full"
            class="fixed top-0 right-0 w-full max-w-md h-full bg-white shadow-lg z-50 p-6 overflow-auto" x-cloak>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold" x-text="'Agregar nuevo ' + tipoCampo"></h2>
                <button @click="showSlideOver = false"
                    class="text-gray-500 hover:text-red-500 text-2xl">&times;</button>
            </div>

            <!-- Formulario dentro del panel -->
            <div class="space-y-4">
                <label class="block font-semibold">Nombre</label>
                <input type="text" class="w-full border p-2 rounded" placeholder="Ej. Nuevo destino, distrito...">

                <!-- Campo adicional si lo deseas -->
                <label class="block font-semibold">Descripción</label>
                <textarea rows="3" class="w-full border p-2 rounded" placeholder="Información adicional..."></textarea>

                <div class="flex justify-end gap-2 mt-4">
                    <button @click="showSlideOver = false"
                        class="px-4 py-2 rounded bg-gray-400 text-white">Cancelar</button>
                    <button @click="showSlideOver = false"
                        class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Guardar</button>
                </div>
            </div>
        </div>



        <!-- Fondo oscuro al abrir el panel -->
        <div x-show="showSlideOver" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 z-40"
            @click="showSlideOver = false" x-cloak></div>
    </div>








</div>
