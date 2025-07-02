<!-- resources/views/livewire/admin-cruds.blade.php -->

<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-purple-700 text-white shadow-md">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-3xl font-bold">Administración del Sistema</h1>
            <p class="mt-2">Gestión de datos principales</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Tabs Navigation -->
        <div class="mb-8 border-b border-gray-200">
            <nav class="flex space-x-8">
                @foreach (['Categorías', 'Marcas', 'Modelos', 'Tipos de Equipo', 'Tipos de Servicio'] as $tab)
                    <button wire:click="setActiveTab('{{ $tab }}')"
                        class="@if ($activeTab === $tab) border-b-2 border-jade-500 text-jade-600 font-medium @else text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif py-4 px-1 text-sm font-medium whitespace-nowrap">
                        {{ $tab }}
                    </button>
                @endforeach
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="bg-white shadow rounded-lg p-6">
            <!-- Categorías -->
            @if ($activeTab === 'Categorías')
                <div class="mb-6 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-purple-800">Gestión de Categorías</h2>
                    <button wire:click="openCreateModal('Categoria')"
                        class="bg-jade-500 hover:bg-jade-600 text-white px-4 py-2 rounded-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Nueva Categoría
                    </button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($categorias as $categoria)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $categoria->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $categoria->namecategorias }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button wire:click="edit('Categoria', {{ $categoria->id }})"
                                            class="text-purple-600 hover:text-purple-900 mr-3">Editar</button>
                                        <button wire:click="confirmDelete('Categoria', {{ $categoria->id }})"
                                            class="text-red-600 hover:text-red-900">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Marcas -->
            @if ($activeTab === 'Marcas')
                <div class="mb-6 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-purple-800">Gestión de Marcas</h2>
                    <button wire:click="openCreateModal('Marca')"
                        class="bg-jade-500 hover:bg-jade-600 text-white px-4 py-2 rounded-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Nueva Marca
                    </button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($marcas as $marca)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $marca->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $marca->namemarcas }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button wire:click="edit('Marca', {{ $marca->id }})"
                                            class="text-purple-600 hover:text-purple-900 mr-3">Editar</button>
                                        <button wire:click="confirmDelete('Marca', {{ $marca->id }})"
                                            class="text-red-600 hover:text-red-900">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Modelos -->
            @if ($activeTab === 'Modelos')
                <div class="mb-6 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-purple-800">Gestión de Modelos</h2>
                    <button wire:click="openCreateModal('Modelo')"
                        class="bg-jade-500 hover:bg-jade-600 text-white px-4 py-2 rounded-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Nuevo Modelo
                    </button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($modelos as $modelo)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $modelo->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $modelo->namemodelos }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button wire:click="edit('Modelo', {{ $modelo->id }})"
                                            class="text-purple-600 hover:text-purple-900 mr-3">Editar</button>
                                        <button wire:click="confirmDelete('Modelo', {{ $modelo->id }})"
                                            class="text-red-600 hover:text-red-900">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Tipos de Equipo -->
            @if ($activeTab === 'Tipos de Equipo')
                <div class="mb-6 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-purple-800">Gestión de Tipos de Equipo</h2>
                    <button wire:click="openCreateModal('TipoEquipo')"
                        class="bg-jade-500 hover:bg-jade-600 text-white px-4 py-2 rounded-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Nuevo Tipo
                    </button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tipoEquipos as $tipo)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $tipo->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $tipo->nametipoequipos }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button wire:click="edit('TipoEquipo', {{ $tipo->id }})"
                                            class="text-purple-600 hover:text-purple-900 mr-3">Editar</button>
                                        <button wire:click="confirmDelete('TipoEquipo', {{ $tipo->id }})"
                                            class="text-red-600 hover:text-red-900">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Tipos de Servicio -->
            @if ($activeTab === 'Tipos de Servicio')
                <div class="mb-6 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-purple-800">Gestión de Tipos de Servicio</h2>
                    <button wire:click="openCreateModal('TipoServicios')"
                        class="bg-jade-500 hover:bg-jade-600 text-white px-4 py-2 rounded-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Nuevo Tipo
                    </button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tipoServicios as $tipo)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $tipo->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $tipo->nametipo_servicios }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button wire:click="edit('TipoServicios', {{ $tipo->id }})"
                                            class="text-purple-600 hover:text-purple-900 mr-3">Editar</button>
                                        <button wire:click="confirmDelete('TipoServicios', {{ $tipo->id }})"
                                            class="text-red-600 hover:text-red-900">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>

    <!-- Create/Edit Modal -->
    @if ($showModal)
        <div class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50">
            <div class="fixed inset-0 transform transition-all" wire:click="closeModal">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div
                class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg sm:mx-auto">
                <div class="bg-purple-700 px-4 py-3 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-white">{{ $modalTitle }}</h3>
                    <button wire:click="closeModal" class="text-white hover:text-gray-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="px-4 py-5 sm:p-6">
                    <form wire:submit.prevent="save">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" wire:model="currentItem.name" id="name"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                            @error('currentItem.name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-5 sm:mt-6 flex justify-end">
                            <button type="button" wire:click="closeModal"
                                class="mr-3 inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-jade-500 hover:bg-jade-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-jade-500">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50">
            <div class="fixed inset-0 transform transition-all" wire:click="closeDeleteModal">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div
                class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg sm:mx-auto">
                <div class="bg-red-500 px-4 py-3">
                    <h3 class="text-lg font-medium text-white">Confirmar Eliminación</h3>
                </div>

                <div class="px-4 py-5 sm:p-6">
                    <p class="text-gray-700 mb-4">¿Estás seguro de que deseas eliminar este registro? Esta acción no se
                        puede deshacer.</p>

                    <div class="mt-5 sm:mt-6 flex justify-end">
                        <button type="button" wire:click="closeDeleteModal"
                            class="mr-3 inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Cancelar
                        </button>
                        <button type="button" wire:click="deleteItem"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
