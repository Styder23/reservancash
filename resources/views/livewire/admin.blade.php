<div>

    <div x-data="adminPanel()" class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 text-white w-64 fixed inset-y-0 left-0 transform sidebar-transition z-50"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">

            <!-- Logo -->
            <div class="flex items-center justify-center h-16 bg-blue-950">
                <i class="fas fa-plane text-2xl mr-2"></i>
                <h1 class="text-xl font-bold">TurismoAdmin</h1>
            </div>

            <!-- Navigation -->
            <nav class="mt-8">
                <template x-for="item in menuItems" :key="item.id">
                    <a href="#" @click="activeSection = item.id"
                        class="flex items-center px-6 py-3 text-gray-300 hover:bg-blue-700 hover:text-white transition-colors duration-200"
                        :class="activeSection === item.id ? 'bg-blue-700 text-white border-r-4 border-blue-300' : ''">
                        <i :class="item.icon" class="w-5 h-5 mr-3"></i>
                        <span x-text="item.name"></span>
                    </a>
                </template>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 lg:ml-64">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 lg:hidden">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-2xl font-semibold text-gray-800 ml-4 lg:ml-0" x-text="getCurrentSectionTitle()">
                        </h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
                            @click="showCreateModal = true">
                            <i class="fas fa-plus mr-2"></i>
                            <span x-text="'Crear ' + getCurrentSectionName()"></span>
                        </button>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-user-circle text-2xl mr-2"></i>
                            <span>Administrador</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="p-6">
                <!-- Dashboard -->
                <div x-show="activeSection === 'dashboard'" class="fade-in">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm">Total Destinos</p>
                                    <p class="text-3xl font-bold text-blue-600">24</p>
                                </div>
                                <i class="fas fa-map-marker-alt text-blue-500 text-2xl"></i>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm">Paquetes Activos</p>
                                    <p class="text-3xl font-bold text-green-600">18</p>
                                </div>
                                <i class="fas fa-suitcase text-green-500 text-2xl"></i>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm">Servicios</p>
                                    <p class="text-3xl font-bold text-purple-600">12</p>
                                </div>
                                <i class="fas fa-concierge-bell text-purple-500 text-2xl"></i>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-orange-500">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm">Promociones</p>
                                    <p class="text-3xl font-bold text-orange-600">8</p>
                                </div>
                                <i class="fas fa-percent text-orange-500 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Tables -->
                <div x-show="activeSection !== 'dashboard'" class="fade-in">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Table Header -->
                        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <input type="text" placeholder="Buscar..."
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <select
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option>Todos los estados</option>
                                    <option>Activo</option>
                                    <option>Inactivo</option>
                                </select>
                            </div>
                            <div class="text-sm text-gray-600">
                                Mostrando <span x-text="getCurrentTableData().length"></span> registros
                            </div>
                        </div>

                        <!-- Table Content -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <template x-for="header in getCurrentTableHeaders()" :key="header">
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                x-text="header"></th>
                                        </template>
                                        <th
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <template x-for="item in getCurrentTableData()" :key="item.id">
                                        <tr class="hover:bg-gray-50">
                                            <template x-for="(value, key) in item" :key="key">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                                    x-show="key !== 'id'" x-text="value"></td>
                                            </template>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button @click="editItem(item)"
                                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button @click="deleteItem(item.id)"
                                                    class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Create/Edit Modal -->
        <div x-show="showCreateModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-screen overflow-y-auto"
                @click.away="showCreateModal = false">
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900"
                        x-text="editingItem ? 'Editar ' + getCurrentSectionName() : 'Crear ' + getCurrentSectionName()">
                    </h3>
                    <button @click="showCreateModal = false" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form @submit.prevent="saveItem()" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-html="getCurrentFormFields()">
                    </div>

                    <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                        <button type="button" @click="showCreateModal = false"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <span x-text="editingItem ? 'Actualizar' : 'Crear'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDeleteModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl p-6 max-w-md mx-4">
                <div class="flex items-center mb-4">
                    <i class="fas fa-exclamation-triangle text-red-500 text-2xl mr-3"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Confirmar Eliminación</h3>
                </div>
                <p class="text-gray-600 mb-6">¿Estás seguro de que deseas eliminar este elemento? Esta acción no se
                    puede deshacer.</p>
                <div class="flex justify-end space-x-4">
                    <button @click="showDeleteModal = false"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                        Cancelar
                    </button>
                    <button @click="confirmDelete()"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    function adminPanel() {
        return {
            sidebarOpen: false,
            activeSection: 'dashboard',
            showCreateModal: false,
            showDeleteModal: false,
            editingItem: null,
            deleteItemId: null,

            menuItems: [{
                    id: 'dashboard',
                    name: 'Dashboard',
                    icon: 'fas fa-tachometer-alt'
                },
                {
                    id: 'destinos',
                    name: 'Destinos',
                    icon: 'fas fa-map-marker-alt'
                },
                {
                    id: 'paquetes',
                    name: 'Paquetes',
                    icon: 'fas fa-suitcase'
                },
                {
                    id: 'servicios',
                    name: 'Servicios',
                    icon: 'fas fa-concierge-bell'
                },
                {
                    id: 'promociones',
                    name: 'Promociones',
                    icon: 'fas fa-percent'
                },
                {
                    id: 'equipos',
                    name: 'Equipos',
                    icon: 'fas fa-users'
                }
            ],

            // Sample data
            destinos: [{
                    id: 1,
                    nombre: 'Machu Picchu',
                    pais: 'Perú',
                    ciudad: 'Cusco',
                    estado: 'Activo'
                },
                {
                    id: 2,
                    nombre: 'Amazonas',
                    pais: 'Perú',
                    ciudad: 'Iquitos',
                    estado: 'Activo'
                },
                {
                    id: 3,
                    nombre: 'Paracas',
                    pais: 'Perú',
                    ciudad: 'Ica',
                    estado: 'Inactivo'
                }
            ],

            paquetes: [{
                    id: 1,
                    nombre: 'Tour Machu Picchu 3D/2N',
                    precio: 'S/. 450',
                    destino: 'Machu Picchu',
                    estado: 'Activo'
                },
                {
                    id: 2,
                    nombre: 'Aventura Amazonas 5D/4N',
                    precio: 'S/. 650',
                    destino: 'Amazonas',
                    estado: 'Activo'
                }
            ],

            servicios: [{
                    id: 1,
                    nombre: 'Transporte Terrestre',
                    categoria: 'Transporte',
                    precio: 'S/. 50',
                    estado: 'Activo'
                },
                {
                    id: 2,
                    nombre: 'Guía Turístico',
                    categoria: 'Guía',
                    precio: 'S/. 80',
                    estado: 'Activo'
                }
            ],

            promociones: [{
                    id: 1,
                    nombre: '20% Off Machu Picchu',
                    descuento: '20%',
                    vigencia: '2024-12-31',
                    estado: 'Activo'
                },
                {
                    id: 2,
                    nombre: 'Paga 2 Lleva 3',
                    descuento: '33%',
                    vigencia: '2024-11-30',
                    estado: 'Activo'
                }
            ],

            equipos: [{
                    id: 1,
                    nombre: 'Juan Pérez',
                    cargo: 'Guía Principal',
                    especialidad: 'Historia',
                    estado: 'Activo'
                },
                {
                    id: 2,
                    nombre: 'María García',
                    cargo: 'Coordinadora',
                    especialidad: 'Logística',
                    estado: 'Activo'
                }
            ],

            getCurrentSectionTitle() {
                const section = this.menuItems.find(item => item.id === this.activeSection);
                return section ? section.name : 'Dashboard';
            },

            getCurrentSectionName() {
                const section = this.menuItems.find(item => item.id === this.activeSection);
                return section ? section.name.slice(0, -1) : '';
            },

            getCurrentTableHeaders() {
                const headers = {
                    destinos: ['Nombre', 'País', 'Ciudad', 'Estado'],
                    paquetes: ['Nombre', 'Precio', 'Destino', 'Estado'],
                    servicios: ['Nombre', 'Categoría', 'Precio', 'Estado'],
                    promociones: ['Nombre', 'Descuento', 'Vigencia', 'Estado'],
                    equipos: ['Nombre', 'Cargo', 'Especialidad', 'Estado']
                };
                return headers[this.activeSection] || [];
            },

            getCurrentTableData() {
                return this[this.activeSection] || [];
            },

            getCurrentFormFields() {
                const fields = {
                    destinos: `
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del Destino</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">País</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Ciudad</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                                <textarea rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Imagen</label>
                                <input type="file" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                        `,
                    paquetes: `
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del Paquete</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Precio</label>
                                <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Destino</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option>Seleccionar destino</option>
                                    <option>Machu Picchu</option>
                                    <option>Amazonas</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Duración (días)</label>
                                <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Capacidad</label>
                                <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                                <textarea rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>
                        `,
                    servicios: `
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del Servicio</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option>Transporte</option>
                                    <option>Hospedaje</option>
                                    <option>Guía</option>
                                    <option>Alimentación</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Precio</label>
                                <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                                <textarea rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>
                        `
                };
                return fields[this.activeSection] || '<p class="text-gray-500">Formulario no disponible</p>';
            },

            editItem(item) {
                this.editingItem = item;
                this.showCreateModal = true;
            },

            deleteItem(id) {
                this.deleteItemId = id;
                this.showDeleteModal = true;
            },

            confirmDelete() {
                // Aquí iría la lógica para eliminar el item
                console.log('Eliminando item:', this.deleteItemId);
                this.showDeleteModal = false;
                this.deleteItemId = null;
            },

            saveItem() {
                // Aquí iría la lógica para guardar/actualizar el item
                console.log('Guardando item');
                this.showCreateModal = false;
                this.editingItem = null;
            }
        }
    }
</script>
