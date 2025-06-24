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

        .badge-active {
            background-color: #10B981;
            color: white;
        }

        .badge-inactive {
            background-color: #EF4444;
            color: white;
        }

        .date-badge {
            background-color: #3B82F6;
            color: white;
        }
    </style>

    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="gradient-bg shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Panel de Promociones</h1>
                        <p class="text-blue-100 mt-1">Gestión de promociones de tu empresa</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                            <span class="text-white font-medium">{{ $promociones->count() }} Promociones</span>
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
                        <span>Nueva Promoción</span>
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" wire:model.live="searchQuery" placeholder="Buscar promociones..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Promociones Grid -->
            @if ($promociones->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($promociones as $promo)
                        <div class="bg-white rounded-xl card-shadow hover-lift overflow-hidden animate-fade-in">
                            <!-- Imagen de la promoción -->
                            <div class="h-48 bg-gradient-to-br from-purple-400 to-blue-500 relative overflow-hidden">
                                @if ($promo->imagenes->count() > 0)
                                    <img src="{{ asset('storage/' . $promo->imagenes->first()->url) }}"
                                        alt="{{ $promo->namepromocion }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white opacity-70" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Badge de estado -->
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-sm font-medium {{ $promo->estado == 'Promocion Activa' ? 'badge-active' : 'badge-inactive' }}">
                                        {{ $promo->estado }}
                                    </span>
                                </div>

                                <!-- Badge de descuento -->
                                <div class="absolute top-4 right-4">
                                    <span
                                        class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $promo->descuento }}% OFF
                                    </span>
                                </div>
                            </div>

                            <!-- Contenido -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $promo->namepromocion }}</h3>
                                    <div class="flex space-x-1">
                                        <button wire:click="editar({{ $promo->id }})"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button wire:click="eliminar({{ $promo->id }})"
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

                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ Str::limit($promo->descripcion, 120) }}
                                </p>

                                <div class="flex flex-wrap gap-2 mt-4">
                                    <span class="date-badge px-2 py-1 rounded-full text-xs">
                                        Inicio: {{ \Carbon\Carbon::parse($promo->fechainicio)->format('d/m/Y') }}
                                    </span>
                                    <span class="date-badge px-2 py-1 rounded-full text-xs">
                                        Fin: {{ \Carbon\Carbon::parse($promo->fechafin)->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                {{-- <div class="mt-6">
                    {{ $promociones->links() }}
                </div> --}}
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No hay promociones registradas</h3>
                    <p class="text-gray-600 mb-4">Comienza creando tu primera promoción para atraer más clientes</p>
                    <button wire:click="abrirModalCrear"
                        class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                        Crear promoción
                    </button>
                </div>
            @endif
        </main>
    </div>

    <!-- Modal Crear/Editar Promoción -->
    @if ($modal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <div
                    class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                    <!-- Modal Header -->
                    <div class="gradient-bg px-6 py-4 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-white">
                            {{ $modoEditar ? 'Editar Promoción' : 'Crear Nueva Promoción' }}
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
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre de la
                                            promoción</label>
                                        <input type="text" wire:model="form.namepromocion"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('form.namepromocion') border-red-500 @enderror"
                                            placeholder="Ej: Verano 2023" required>
                                        @error('form.namepromocion')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Descuento
                                            (%)</label>
                                        <input type="number" wire:model="form.descuento" min="1"
                                            max="100"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('form.descuento') border-red-500 @enderror"
                                            placeholder="Ej: 20" required>
                                        @error('form.descuento')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                                    <textarea wire:model="form.descripcion" rows="4"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none @error('form.descripcion') border-red-500 @enderror"
                                        placeholder="Describe los detalles de la promoción"></textarea>
                                    @error('form.descripcion')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de
                                            inicio</label>
                                        <input type="date" wire:model="form.fechainicio"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('form.fechainicio') border-red-500 @enderror"
                                            required>
                                        @error('form.fechainicio')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de
                                            fin</label>
                                        <input type="date" wire:model="form.fechafin"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('form.fechafin') border-red-500 @enderror"
                                            required>
                                        @error('form.fechafin')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Sección de imágenes -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-4">Imágenes de la
                                        promoción</label>

                                    <!-- Vista previa de imágenes existentes -->
                                    @if ($modoEditar && $imagenesExistentes->count() > 0)
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-4">
                                            @foreach ($imagenesExistentes as $imagen)
                                                <div class="relative aspect-square group">
                                                    <img src="{{ asset('storage/' . $imagen->url) }}"
                                                        class="w-full h-full object-cover rounded-lg border-2 border-gray-200">
                                                    <button type="button"
                                                        wire:click="eliminarImagen({{ $imagen->id }})"
                                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors shadow-lg opacity-0 group-hover:opacity-100">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Vista previa de nuevas imágenes -->
                                    @if ($imagenesAdicionales && count($imagenesAdicionales) > 0)
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-4">
                                            @foreach ($imagenesAdicionales as $index => $imagen)
                                                <div class="relative aspect-square group">
                                                    <img src="{{ $imagen->temporaryUrl() }}"
                                                        class="w-full h-full object-cover rounded-lg border-2 border-green-200">
                                                    <button type="button"
                                                        wire:click="removeImage({{ $index }})"
                                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors shadow-lg">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Input para subir imágenes -->
                                    <div class="relative">
                                        <input type="file" wire:model="imagenesAdicionales"
                                            id="imagenes-promocion" multiple
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                            accept="image/*">
                                        <label for="imagenes-promocion"
                                            class="flex items-center justify-center w-full px-4 py-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            <span class="text-sm text-gray-600">
                                                {{ $modoEditar ? 'Añadir más imágenes' : 'Seleccionar imágenes' }}
                                            </span>
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">
                                        Formatos: JPG, PNG, GIF (máx. 5MB cada una)
                                    </p>
                                    @error('imagenesAdicionales.*')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Sección de videos -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-4">Videos de la
                                        promoción</label>

                                    <!-- Vista previa de videos existentes -->
                                    @if ($modoEditar && $videosExistentes->count() > 0)
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                            @foreach ($videosExistentes as $video)
                                                <div class="relative">
                                                    <video controls class="w-full rounded-lg border border-gray-200">
                                                        <source src="{{ asset('storage/' . $video->url) }}"
                                                            type="video/mp4">
                                                        Tu navegador no soporta el elemento de video.
                                                    </video>
                                                    <button type="button"
                                                        wire:click="eliminarVideo({{ $video->id }})"
                                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors shadow-lg">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if ($videosAdicionales && count($videosAdicionales) > 0)
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                            @foreach ($videosAdicionales as $index => $video)
                                                <div class="relative">
                                                    <video controls class="w-full rounded-lg border border-green-200">
                                                        <source src="{{ $video->temporaryUrl() }}" type="video/mp4">
                                                        Tu navegador no soporta el elemento de video.
                                                    </video>
                                                    <button type="button"
                                                        wire:click="removeVideo({{ $index }})"
                                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors shadow-lg">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <!-- Input para subir videos -->
                                    <div class="relative">
                                        <input type="file" wire:model="videosAdicionales" id="videos-promocion"
                                            multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                            accept="video/*">
                                        <label for="videos-promocion"
                                            class="flex items-center justify-center w-full px-4 py-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span class="text-sm text-gray-600">
                                                {{ $modoEditar ? 'Añadir más videos' : 'Seleccionar videos' }}
                                            </span>
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">
                                        Formatos: MP4, MOV (máx. 10MB cada uno)
                                    </p>
                                    @error('videosAdicionales.*')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
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

    <!-- Modal Eliminar Promoción -->
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
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                    </path>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Confirmar Eliminación
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        ¿Estás seguro de que deseas eliminar esta promoción? Esta acción no se puede
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
</div>
