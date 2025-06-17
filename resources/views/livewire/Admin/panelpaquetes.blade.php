<div>
    <!-- Estilos CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="gradient-bg shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Panel Administrativo</h1>
                        <p class="text-blue-100 mt-1">Gestión de Servicios</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                            <span class="text-white font-medium">{{ $servicios->count() }} Servicos registrados</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mensajes Flash -->
        @if (session()->has('message'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Action Bar -->
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center space-x-4">
                    <button wire:click="abrirModalCrear"
                        class="btn-primary text-white px-6 py-3 rounded-lg font-medium flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        <span>Nuevo Servicio</span>
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" wire:model.live="searchQuery1" placeholder="Buscar Servicios..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Equipos Grid -->
            @if ($servicios->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($servicios as $servicio)
                        <div class="bg-white rounded-xl card-shadow hover-lift overflow-hidden animate-fade-in">
                            <!-- Image -->
                            <div class="h-48 bg-gradient-to-br from-purple-400 to-blue-500 relative overflow-hidden">
                                @if ($servicio->Det_equipo->imagenes_equipo)
                                    <img src="{{ asset('storage/' . $equipo->Det_equipo->imagenes_equipo) }}"
                                        alt="{{ $servicio->Det_equipo->name_equipo }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <div class="text-center text-white">
                                            <svg class="w-16 h-16 mx-auto mb-2 opacity-75" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                </path>
                                            </svg>
                                            <p class="font-medium">Sin imagen</p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Badge categoria -->
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $servicio->Det_equipo->categoria->namecategorias ?? 'Sin categoría' }}
                                    </span>
                                </div>

                                <!-- Badge stock -->
                                <div class="absolute top-4 right-4">
                                    <span
                                        class="bg-blue-500/90 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $servicio->cantidadequipo }} unidades
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $servicio->Det_equipo->name_equipo }}
                                    </h3>
                                    <div class="flex space-x-1">
                                        <button wire:click="editar({{ $servicio->id }})"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button wire:click="eliminar({{ $servicio->id }})"
                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="flex items-center text-green-600 mb-3">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                        </path>
                                    </svg>
                                    <span class="text-lg font-bold">S/ {{ $servicio->Det_equipo->precio_equipo }}</span>
                                </div>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ Str::limit($servicio->Det_equipo->descripcion_equipo ?? 'Sin descripción disponible', 120) }}
                                </p>

                                <div class="space-y-2">
                                    @if ($servicio->Det_equipo->marca)
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                </path>
                                            </svg>
                                            <span>{{ $servicio->Det_equipo->marca->namemarcas }}</span>
                                        </div>
                                    @endif

                                    @if ($servicio->Det_equipo->modelo)
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            <span>{{ $servicio->Det_equipo->modelo->namemodelos }}</span>
                                        </div>
                                    @endif

                                    @if ($servicio->Det_equipo->serie)
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14">
                                                </path>
                                            </svg>
                                            <span>Serie: {{ $servicio->Det_equipo->serie->nameserie }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No hay Servicios</h3>
                    <p class="text-gray-600 mb-4">Comienza creando tu primer equipo</p>
                    <button wire:click="abrirModalCrear"
                        class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                        Crear servicio
                    </button>
                </div>
            @endif
        </main>
    </div>

    <!-- Modal Crear/Editar Equipo -->
    @if ($modal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <div
                    class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full">
                    <!-- Modal Header -->
                    <div class="gradient-bg px-6 py-4 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-white">
                            {{ $modoEditar ? 'Editar Equipo' : 'Crear Nuevo Equipo' }}
                        </h2>
                        <button wire:click="cerrarModal" class="text-white hover:text-gray-200 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6 overflow-y-auto max-h-[calc(90vh-140px)]">
                        <form wire:submit.prevent="{{ $modoEditar ? 'actualizar' : 'guardar' }}">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <!-- Formulario - 2 columnas -->
                                <div class="lg:col-span-2 space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del
                                                servicio</label>
                                            <input type="text" wire:model="form.name_equipo"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('form.name_equipo') border-red-500 @enderror"
                                                placeholder="Ingresa el nombre del equipo" required>
                                            @error('form.name_equipo')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Precio</label>
                                            <div class="relative">
                                                <span class="absolute left-3 top-3 text-gray-500">S/</span>
                                                <input type="number" wire:model="form.precio_equipo" step="0.01"
                                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('form.precio_equipo') border-red-500 @enderror"
                                                    placeholder="0.00" required>
                                            </div>
                                            @error('form.precio_equipo')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                                        <textarea wire:model="form.descripcion_equipo" rows="4"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none @error('form.descripcion_equipo') border-red-500 @enderror"
                                            placeholder="Describe las características del equipo"></textarea>
                                        @error('form.descripcion_equipo')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                                            <select wire:model="form.fk_idtipoequipo"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('form.fk_idtipoequipo') border-red-500 @enderror">
                                                <option value="">-- Selecciona un tipo --</option>
                                                @foreach ($tipos as $tipo)
                                                    <option value="{{ $tipo->id }}">{{ $tipo->nametipoequipos }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('form.fk_idtipoequipo')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-2">Cantidad</label>
                                            <input type="number" wire:model="form.cantidadequipo"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('form.cantidadequipo') border-red-500 @enderror"
                                                placeholder="1" min="1" required>
                                            @error('form.cantidadequipo')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Sección de imagen - 1 columna -->
                                <div class="lg:col-span-1">
                                    <div class="bg-gray-50 rounded-lg p-6 h-full">
                                        <label class="block text-sm font-medium text-gray-700 mb-4">Imagen del
                                            servicio</label>

                                        <!-- Vista previa de imagen -->
                                        <div class="mb-4">
                                            @if ($form['imagenes_servicio'])
                                                <div class="relative">
                                                    <img src="{{ $form['imagenes_servicio']->temporaryUrl() }}"
                                                        alt="Vista previa"
                                                        class="w-full h-48 object-cover rounded-lg border-2 border-dashed border-gray-300">
                                                    <button type="button"
                                                        wire:click="$set('form.imagenes_servicio', null)"
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
                                                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-4"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                            <input type="file" wire:model="form.imagenes_servicio"
                                                id="imagen-upload"
                                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                                accept="image/*">
                                            <label for="imagen-upload"
                                                class="flex items-center justify-center w-full px-4 py-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                    </path>
                                                </svg>
                                                <span class="text-sm text-gray-600">Seleccionar imagen</span>
                                            </label>
                                        </div>

                                        <p class="text-xs text-gray-500 mt-2">
                                            Formatos: JPG, PNG, GIF (máx. 2MB)
                                        </p>
                                        @error('form.imagenes_servicio')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="mt-8 flex justify-end space-x-4 pt-6 border-t border-gray-200">
                                <button type="button" wire:click="cerrarModal"
                                    class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                                    {{ $modoEditar ? 'Actualizar' : 'Guardar' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Eliminar Equipo -->
    @if ($modalConfirmacion)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Confirmar Eliminación
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        ¿Estás seguro de que deseas eliminar este servicio? Esta acción no se puede
                                        deshacer.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="confirmarEliminar" type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Eliminar
                        </button>
                        <button wire:click="cancelarEliminar" type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Script para confirmación de eliminación -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('confirmarEliminar', (id) => {
                if (confirm('¿Estás seguro de que quieres eliminar este servicio?')) {
                    @this.eliminar(id);
                }
            });
        });
    </script>
</div>
