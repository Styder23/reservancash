<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Encabezado y buscador -->
    <div class="flex justify-between items-center mb-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Usuarios Registrados</h2>
            <p class="text-gray-600">Total: {{ $usuarios->total() }} usuarios</p>
        </div>
        <div class="flex items-center space-x-4">
            <!-- Buscador -->
            <div class="relative">
                <input type="text" wire:model.live="search" placeholder="Buscar usuarios..."
                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <!-- Botón nuevo usuario -->
            <button wire:click="abrirModalCrear"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Nuevo Usuario
            </button>
        </div>
    </div>

    <!-- Mensajes de éxito/error -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Tabla de usuarios -->
    <div class="overflow-x-auto bg-white rounded-xl shadow">
        <table class="min-w-full table-auto text-sm text-left">
            <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider">
                <tr>
                    <th class="p-4">
                        <i class="fas fa-user-circle mr-2"></i>Foto
                    </th>
                    <th class="p-4">
                        <i class="fas fa-user mr-2"></i>Nombre
                    </th>
                    <th class="p-4">
                        <i class="fas fa-id-card mr-2"></i>DNI
                    </th>
                    <th class="p-4">
                        <i class="fas fa-envelope mr-2"></i>Correo
                    </th>
                    <th class="p-4">
                        <i class="fas fa-user-tag mr-2"></i>Tipo
                    </th>
                    <th class="p-4">
                        <i class="fas fa-clock mr-2"></i>Último Acceso
                    </th>
                    <th class="p-4 text-right">
                        <i class="fas fa-cogs mr-2"></i>Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($usuarios as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-4">
                            <img src="{{ $user->profile_photo_url }}" alt="Foto"
                                class="w-10 h-10 rounded-full object-cover">
                        </td>
                        <td class="p-4">
                            <div>
                                <div class="font-medium">{{ $user->name }}</div>
                                @if ($user->persona)
                                    <div class="text-sm text-gray-500">
                                        {{ $user->persona->nombre }} {{ $user->persona->apellidos }}
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="p-4">
                            {{ $user->persona?->dni ?? 'Sin DNI' }}
                        </td>
                        <td class="p-4">{{ $user->email }}</td>
                        <td class="p-4">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                {{ $user->tipousu?->nametipo_usuarios ?? 'Sin tipo' }}
                            </span>
                        </td>
                        <td class="p-4">
                            {{ $user->ultimo_acceso ? \Carbon\Carbon::parse($user->ultimo_acceso)->diffForHumans() : 'Nunca' }}
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <button wire:click="editar({{ $user->id }})"
                                class="text-yellow-500 hover:text-yellow-600 font-medium">
                                <i class="fas fa-edit mr-1"></i>Editar
                            </button>
                            <button wire:click="confirmarEliminacion({{ $user->id }})"
                                class="text-red-500 hover:text-red-600 font-medium">
                                <i class="fas fa-trash mr-1"></i>Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-500">
                            <i class="fas fa-users text-4xl mb-4"></i>
                            <p>No hay usuarios registrados</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $usuarios->links() }}
    </div>

    <!-- Modal Crear/Editar Usuario -->
    @if ($modalAbierto)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ open: @entangle('modalAbierto') }">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <!-- Overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75" wire:click="cerrarModal"></div>
                </div>

                <!-- Modal -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                    <!-- Header -->
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                <i class="fas fa-user-plus mr-2"></i>
                                {{ $editando ? 'Editar Usuario' : 'Nuevo Usuario' }}
                            </h3>
                            <button wire:click="cerrarModal" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <!-- Formulario -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Datos de Persona -->
                            <div class="col-span-2">
                                <h4 class="text-md font-semibold text-gray-700 mb-3 border-b pb-2">
                                    <i class="fas fa-id-card mr-2"></i>Datos Personales
                                </h4>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">DNI *</label>
                                <input type="text" wire:model="form.dni" maxlength="8"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200">
                                @error('form.dni')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nombres *</label>
                                <input type="text" wire:model="form.nombre"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200">
                                @error('form.nombre')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Apellidos *</label>
                                <input type="text" wire:model="form.apellidos"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200">
                                @error('form.apellidos')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="text" wire:model="form.telefono"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200">
                                @error('form.telefono')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Persona *</label>
                                <input type="email" wire:model="form.email_persona"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200">
                                @error('form.email_persona')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Datos de Usuario -->
                            <div class="col-span-2 mt-4">
                                <h4 class="text-md font-semibold text-gray-700 mb-3 border-b pb-2">
                                    <i class="fas fa-user-cog mr-2"></i>Datos de Usuario
                                </h4>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nombre de Usuario *</label>
                                <input type="text" wire:model="form.name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200">
                                @error('form.name')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Usuario *</label>
                                <input type="email" wire:model="form.email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('form.email')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Contraseña {{ $editando ? '(Dejar vacío para mantener)' : '*' }}
                                </label>
                                <input type="password" wire:model="form.password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('form.password')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tipo de Usuario *</label>
                                <select wire:model="form.fk_idtipousu"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">Seleccione...</option>
                                    @foreach ($tiposUsuario as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->nametipo_usuarios }}</option>
                                    @endforeach
                                </select>
                                @error('form.fk_idtipousu')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Foto de Perfil</label>
                                <input type="file" wire:model="foto" accept="image/*">
                                @error('foto')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                                @if ($foto)
                                    <div class="mt-2">
                                        <img src="{{ $foto->temporaryUrl() }}"
                                            class="w-20 h-20 rounded-full object-cover">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="guardar"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            <i class="fas fa-save mr-2"></i>
                            {{ $editando ? 'Actualizar' : 'Guardar' }}
                        </button>
                        <button wire:click="cerrarModal"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de Confirmación de Eliminación -->
    @if ($modalConfirmacion)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <!-- Overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Confirmar Eliminación
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        ¿Estás seguro de que quieres eliminar al usuario
                                        <strong>{{ $usuarioEliminar?->name }}</strong>?
                                        Esta acción no se puede deshacer.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="eliminar"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            <i class="fas fa-trash mr-2"></i>
                            Eliminar
                        </button>
                        <button wire:click="cancelarEliminacion"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
