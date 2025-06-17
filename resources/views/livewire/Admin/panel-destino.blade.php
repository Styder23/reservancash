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
                        <p class="text-blue-100 mt-1">Gestión de Destinos Turísticos</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                            <span class="text-white font-medium">{{ $destinos->count() }} destinos registrados</span>
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
                    <button wire:click="openModal"
                        class="btn-primary text-white px-6 py-3 rounded-lg font-medium flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        <span>Nuevo Destino</span>
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" wire:model.live="searchQuery" placeholder="Buscar destinos..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Destinos Grid -->
            @if ($destinos->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($destinos as $destino)
                        <div class="bg-white rounded-xl card-shadow hover-lift overflow-hidden animate-fade-in">
                            <!-- Image -->
                            <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-500 relative overflow-hidden">
                                @if ($destino->imagenes)
                                    <img src="{{ Storage::url($destino->imagenes) }}" alt="{{ $destino->namedestino }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <div class="text-center text-white">
                                            <svg class="w-16 h-16 mx-auto mb-2 opacity-75" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <p class="font-medium">Sin imagen</p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Badge tipo -->
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $destino->tipoDestino->nametipo_destinos ?? 'Sin tipo' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $destino->namedestino }}</h3>
                                    <div class="flex space-x-1">
                                        <button wire:click="editDestino({{ $destino->id }})"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button wire:click="confirmDelete({{ $destino->id }})"
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

                                <div class="flex items-center text-gray-600 mb-3">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span
                                        class="text-sm">{{ $destino->distrito->namedistrito ?? 'Sin distrito' }}</span>
                                </div>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ Str::limit($destino->descripciondestino, 120) }}
                                </p>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span>{{ $destino->ubicaciondestino }}</span>
                                    </div>
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
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No hay destinos</h3>
                    <p class="text-gray-600 mb-4">Comienza creando tu primer destino turístico</p>
                    <button wire:click="openModal" class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                        Crear Destino
                    </button>
                </div>
            @endif
        </main>
    </div>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <div
                    class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full">
                    <!-- Modal Header -->
                    <div class="gradient-bg px-6 py-4 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-white">
                            {{ $editingId ? 'Editar Destino' : 'Crear Nuevo Destino' }}
                        </h2>
                        <button wire:click="closeModal" class="text-white hover:text-gray-200 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex flex-col lg:flex-row">
                        <!-- Modal Body -->
                        <div class="flex-1 p-6 border-r border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Información del Destino</h3>
                            <form wire:submit="saveDestino" class="space-y-6">
                                <!-- Nombre -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del
                                        Destino</label>
                                    <input type="text" wire:model="namedestino"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('namedestino') border-red-500 @enderror"
                                        placeholder="Ingresa el nombre del destino">
                                    @error('namedestino')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Tipo y Distrito -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de
                                            Destino</label>
                                        <select wire:model="fk_idtipodestino"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('fk_idtipodestino') border-red-500 @enderror">
                                            <option value="">Seleccionar tipo</option>
                                            @foreach ($tiposDestino as $tipo)
                                                <option value="{{ $tipo->id }}">{{ $tipo->nametipo_destinos }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('fk_idtipodestino')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Distrito</label>
                                        <select wire:model="fk_iddistrito"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('fk_iddistrito') border-red-500 @enderror">
                                            <option value="">Seleccionar distrito</option>
                                            @foreach ($distritos as $distrito)
                                                <option value="{{ $distrito->id }}">{{ $distrito->namedistrito }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('fk_iddistrito')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Descripción -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                                    <textarea wire:model="descripciondestino" rows="4"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none @error('descripciondestino') border-red-500 @enderror"
                                        placeholder="Describe el destino turístico..."></textarea>
                                    @error('descripciondestino')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Ubicación -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Ubicación</label>
                                    <input type="text" wire:model="ubicaciondestino"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('ubicaciondestino') border-red-500 @enderror"
                                        placeholder="Ej: Av. Principal 123, Centro de la ciudad">
                                    @error('ubicaciondestino')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                    <p class="text-sm text-gray-500 mt-1">Ingresa la dirección o descripción de la
                                        ubicación
                                    </p>
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-end space-x-4 pt-4 border-t">
                                    <button type="button" wire:click="closeModal"
                                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                        Cancelar
                                    </button>
                                    <button type="submit"
                                        class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                                        {{ $editingId ? 'Actualizar' : 'Crear' }}
                                    </button>
                                </div>
                            </form>


                        </div>
                        <div class="flex-1 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Imágenes</h3>

                            <!-- Imagen Principal -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Imagen Principal</label>
                                <input type="file" wire:model="imagenPrincipal" accept="image/*"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('imagenPrincipal') border-red-500 @enderror">
                                @error('imagenPrincipal')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror

                                @if ($imagenPrincipal)
                                    <div class="mt-2">
                                        <img src="{{ $imagenPrincipal->temporaryUrl() }}"
                                            alt="Vista previa principal" class="w-32 h-32 object-cover rounded-lg">
                                    </div>
                                @elseif ($editingId && $imagenPrincipalActual)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($imagenPrincipalActual) }}" alt="Imagen actual"
                                            class="w-32 h-32 object-cover rounded-lg">
                                    </div>
                                @endif
                            </div>

                            <!-- Imágenes Adicionales -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Imágenes
                                    Adicionales</label>
                                <input type="file" wire:model="imagenesAdicionales" accept="image/*" multiple
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('imagenesAdicionales') border-red-500 @enderror @error('imagenesAdicionales.*') border-red-500 @enderror">

                                @error('imagenesAdicionales')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror

                                @error('imagenesAdicionales.*')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror

                                <div class="text-xs text-gray-500 mt-1">
                                    Puedes seleccionar múltiples imágenes. Máximo 2MB por imagen.
                                </div>

                                <!-- Vista previa de imágenes adicionales -->
                                @if ($imagenesAdicionales && count($imagenesAdicionales) > 0)
                                    <div class="mt-2 grid grid-cols-3 gap-2">
                                        @foreach ($imagenesAdicionales as $index => $imagen)
                                            @if ($imagen)
                                                <div class="relative">
                                                    <img src="{{ $imagen->temporaryUrl() }}" alt="Vista previa"
                                                        class="w-20 h-20 object-cover rounded-lg">
                                                    <div
                                                        class="absolute -top-1 -right-1 bg-blue-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                                                        {{ $index + 1 }}
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Imágenes adicionales existentes (en edición) -->
                                @if ($editingId && $imagenesAdicionalesActuales && count($imagenesAdicionalesActuales) > 0)
                                    <div class="mt-4">
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Imágenes actuales:</h4>
                                        <div class="grid grid-cols-3 gap-2">
                                            @foreach ($imagenesAdicionalesActuales as $index => $imagen)
                                                <div class="relative">
                                                    <img src="{{ Storage::url($imagen['url']) }}" alt="Imagen actual"
                                                        class="w-20 h-20 object-cover rounded-lg">
                                                    <button type="button"
                                                        wire:click="eliminarImagenAdicional({{ $index }})"
                                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 transition-colors">
                                                        ×
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif

    <!-- Modal de confirmación de eliminación -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('show-delete-modal', () => {
                if (confirm('¿Estás seguro de que quieres eliminar este destino?')) {
                    @this.deleteDestino();
                } else {
                    @this.cancelDelete();
                }
            });
        });
    </script>
</div>
