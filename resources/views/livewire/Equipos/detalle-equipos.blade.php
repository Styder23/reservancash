<div class="p-6 max-w-7xl mx-auto">

    <h2 class="text-2xl font-bold text-gray-800 mb-4">Administrar Equipos</h2>

    <button wire:click="abrirModalCrear"
        class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 mb-6 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Nuevo Equipo
    </button>

    <!-- Tabla de equipos -->
    <div class="overflow-x-auto bg-white rounded-xl shadow">
        <table class="min-w-full text-sm text-gray-800">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-3">Imagen</th>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Precio</th>
                    <th class="px-4 py-3">Stock</th>
                    <th class="px-4 py-3">Categoría</th>
                    <th class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($equipos as $equipo)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-3">
                            @if ($equipo->Det_equipo->imagenes_equipo)
                                <img src="{{ asset('storage/' . $equipo->Det_equipo->imagenes_equipo) }}"
                                    alt="{{ $equipo->Det_equipo->name_equipo }}"
                                    class="w-12 h-12 object-cover rounded-lg">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $equipo->Det_equipo->name_equipo }}</td>
                        <td class="px-4 py-3 text-green-600 font-semibold">S/ {{ $equipo->Det_equipo->precio_equipo }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                {{ $equipo->cantidadequipo }} unidades
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $equipo->Det_equipo->categoria->namecategorias ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-2">
                                <button wire:click="editar({{ $equipo->id }})"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Editar
                                </button>
                                <button wire:click="eliminar({{ $equipo->id }})"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                            No hay equipos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Crear/Editar Equipo -->
    @if ($modal)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 p-4">
            <div class="bg-white w-full max-w-5xl rounded-xl shadow-lg relative max-h-[90vh] overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl font-semibold flex items-center gap-2">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        {{ $modoEditar ? 'Editar Equipo' : 'Crear Nuevo Equipo' }}
                    </h3>
                </div>

                <div class="p-6 overflow-y-auto max-h-[calc(90vh-140px)]">
                    <form wire:submit.prevent="{{ $modoEditar ? 'actualizar' : 'guardar' }}">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <!-- Formulario - 2 columnas -->
                            <div class="lg:col-span-2 space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del
                                            equipo</label>
                                        <input type="text" wire:model="form.name_equipo"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                            placeholder="Ingresa el nombre del equipo" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Precio</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-3 text-gray-500">S/</span>
                                            <input type="number" wire:model="form.precio_equipo" step="0.01"
                                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                                placeholder="0.00" required>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                                    <textarea wire:model="form.descripcion_equipo" rows="3"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                        placeholder="Describe las características del equipo"></textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                                        <select wire:model="form.fk_idcategoria"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                            <option value="">-- Selecciona una categoría --</option>
                                            @foreach ($categorias as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->namecategorias }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Serie</label>
                                        <select wire:model="form.fk_idserie"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                            <option value="">-- Selecciona una serie --</option>
                                            @foreach ($series as $serie)
                                                <option value="{{ $serie->id }}">{{ $serie->nameserie }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Marca</label>
                                        <select wire:model="form.fk_idmarca"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                            <option value="">-- Selecciona una marca --</option>
                                            @foreach ($marcas as $marca)
                                                <option value="{{ $marca->id }}">{{ $marca->namemarcas }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Modelo</label>
                                        <select wire:model="form.fk_idmodelo"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                            <option value="">-- Selecciona un modelo --</option>
                                            @foreach ($modelos as $modelo)
                                                <option value="{{ $modelo->id }}">{{ $modelo->namemodelos }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                                        <select wire:model="form.fk_idtipoequipo"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                            <option value="">-- Selecciona un tipo --</option>
                                            @foreach ($tipos as $tipo)
                                                <option value="{{ $tipo->id }}">{{ $tipo->nametipoequipos }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Cantidad</label>
                                        <input type="number" wire:model="form.cantidadequipo"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                            placeholder="1" min="1" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de imagen - 1 columna -->
                            <div class="lg:col-span-1">
                                <div class="bg-gray-50 rounded-lg p-6 h-full">
                                    <label class="block text-sm font-medium text-gray-700 mb-4">Imagen del
                                        equipo</label>

                                    <!-- Vista previa de imagen -->
                                    <div class="mb-4">
                                        @if ($form['imagenes_equipo'])
                                            <div class="relative">
                                                <img src="{{ $form['imagenes_equipo']->temporaryUrl() }}"
                                                    alt="Vista previa"
                                                    class="w-full h-48 object-cover rounded-lg border-2 border-dashed border-gray-300">
                                                <button type="button" wire:click="$set('form.imagenes_equipo', null)"
                                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        @else
                                            <div
                                                class="w-full h-48 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-100">
                                                <div class="text-center">
                                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                    <p class="text-gray-500 text-sm">Sin imagen seleccionada</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Input de archivo -->
                                    <div class="relative">
                                        <input type="file" wire:model="form.imagenes_equipo" id="imagen-upload"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                            accept="image/*">
                                        <label for="imagen-upload"
                                            class="flex items-center justify-center w-full px-4 py-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            <span class="text-sm text-gray-600">Seleccionar imagen</span>
                                        </label>
                                    </div>

                                    <p class="text-xs text-gray-500 mt-2">
                                        Formatos: JPG, PNG, GIF (máx. 2MB)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="mt-8 flex justify-end space-x-3 pt-6 border-t border-gray-200">
                            <button type="button" wire:click="cerrarModal"
                                class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancelar
                            </button>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $modoEditar ? 'Actualizar' : 'Guardar' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
