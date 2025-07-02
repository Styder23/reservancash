<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        <div class="flex items-center text-purple-800">
            <i class="fas fa-user-circle text-2xl mr-3"></i>
            <span class="text-xl font-bold">Información del Perfil</span>
        </div>
    </x-slot>

    <x-slot name="description">
        <p class="text-gray-600">Actualiza tu información personal y preferencias.</p>
    </x-slot>

    <x-slot name="form">
        <!-- Sección de Foto de Perfil -->
        <div class="col-span-6 sm:col-span-4 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div x-data="{ photoName: null, photoPreview: null }">
                <h3 class="flex items-center text-lg font-medium text-purple-700 mb-4">
                    <i class="fas fa-camera-retro mr-2"></i> Foto de Perfil
                </h3>

                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <!-- Foto actual -->
                    <div class="relative group">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                            class="rounded-full size-32 object-cover border-4 border-purple-100 shadow-md transition-all duration-300 group-hover:border-jade-200">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-20 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white text-sm font-medium">Ver</span>
                        </div>
                    </div>

                    <!-- Controles de foto -->
                    <div class="flex flex-col gap-3 w-full sm:w-auto">
                        <x-secondary-button
                            class="w-full sm:w-auto justify-center bg-white hover:bg-gray-50 border border-purple-200 text-purple-700"
                            type="button" x-on:click.prevent="$refs.photo.click()">
                            <i class="fas fa-upload mr-2"></i> Cambiar Foto
                        </x-secondary-button>

                        <input type="file" id="photo" class="hidden" wire:model="photo" x-ref="photo"
                            x-on:change="
                                   photoName = $refs.photo.files[0].name;
                                   const reader = new FileReader();
                                   reader.onload = (e) => {
                                       photoPreview = e.target.result;
                                   };
                                   reader.readAsDataURL($refs.photo.files[0]);
                               " />

                        @if ($this->user->profile_photo_path)
                            <x-secondary-button type="button"
                                class="w-full sm:w-auto justify-center bg-white hover:bg-gray-50 border border-red-200 text-red-600"
                                wire:click="deleteProfilePhoto">
                                <i class="fas fa-trash-alt mr-2"></i> Eliminar
                            </x-secondary-button>
                        @endif
                    </div>
                </div>

                <!-- Vista previa de la nueva foto -->
                <div class="mt-4 text-center" x-show="photoPreview" style="display: none;">
                    <p class="text-sm text-gray-500 mb-2">Vista previa:</p>
                    <div class="inline-flex rounded-full size-24 border-4 border-jade-100 bg-cover bg-center shadow-sm"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </div>
                </div>

                <x-input-error for="photo" class="mt-3 text-sm" />
            </div>
        </div>

        <!-- Sección de Información Básica -->
        <div class="col-span-6 sm:col-span-4 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="flex items-center text-lg font-medium text-purple-700 mb-4">
                <i class="fas fa-id-card mr-2"></i> Información Personal
            </h3>

            <div class="space-y-4">
                <!-- Nombre -->
                <div>
                    <x-label for="name" value="Nombre Completo" class="block text-sm font-medium text-gray-700" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <x-input id="name" type="text" class="block w-full pl-10" wire:model="state.name"
                            required autocomplete="name" />
                    </div>
                    <x-input-error for="name" class="mt-1 text-sm" />
                </div>

                <!-- Email -->
                <div>
                    <x-label for="email" value="Correo Electrónico"
                        class="block text-sm font-medium text-gray-700" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <x-input id="email" type="email" class="block w-full pl-10" wire:model="state.email"
                            required autocomplete="email" />
                    </div>
                    <x-input-error for="email" class="mt-1 text-sm" />

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                            !$this->user->hasVerifiedEmail())
                        <div class="mt-2 text-sm">
                            <p class="text-amber-600">
                                <i class="fas fa-exclamation-circle mr-1"></i> Tu correo no está verificado.
                            </p>
                            <button type="button" class="mt-1 text-jade-600 hover:text-jade-800 font-medium text-sm"
                                wire:click.prevent="sendEmailVerification">
                                <i class="fas fa-paper-plane mr-1"></i> Reenviar correo de verificación
                            </button>
                            @if ($this->verificationLinkSent)
                                <p class="mt-1 text-sm text-jade-600">
                                    <i class="fas fa-check-circle mr-1"></i> ¡Nuevo enlace enviado!
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Teléfono -->
                @if ($this->user->persona)
                    <div>
                        <x-label for="phone" value="Teléfono" class="block text-sm font-medium text-gray-700" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <x-input id="phone" type="tel" class="block w-full pl-10" wire:model="state.phone"
                                autocomplete="tel" />
                        </div>
                        <x-input-error for="phone" class="mt-1 text-sm" />
                    </div>
                @endif
            </div>
        </div>

        <!-- Sección de Video para Empresas -->
        @if (
            $this->user->tipousu &&
                $this->user->tipousu->id == 2 &&
                $this->user->persona &&
                $this->user->persona->empresa->first())
            @php
                $empresa = $this->user->persona->empresa->first()->empresa;
                $videoPrincipal = $empresa->videoPrincipal;
            @endphp

            <div x-data="{ videoName: null }"
                class="col-span-6 sm:col-span-4 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="flex items-center text-lg font-medium text-purple-700 mb-4">
                    <i class="fas fa-video mr-2"></i> Video Promocional
                </h3>

                @if ($videoPrincipal)
                    <div class="mb-4 overflow-hidden rounded-lg border border-gray-200 shadow-sm">
                        <video controls class="w-full">
                            <source src="{{ Storage::url($videoPrincipal->url) }}" type="video/mp4">
                            Tu navegador no soporta el elemento de video.
                        </video>
                    </div>
                @else
                    <div class="mb-4 p-8 text-center bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                        <i class="fas fa-video-slash text-3xl text-gray-400 mb-2"></i>
                        <p class="text-gray-500">No hay video cargado</p>
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row gap-3">
                    <x-secondary-button
                        class="justify-center bg-white hover:bg-gray-50 border border-purple-200 text-purple-700"
                        type="button" x-on:click.prevent="$refs.video.click()">
                        <i class="fas fa-upload mr-2"></i>
                        {{ $videoPrincipal ? 'Cambiar Video' : 'Subir Video' }}
                    </x-secondary-button>

                    <input type="file" id="video" class="hidden" wire:model="company_video" x-ref="video"
                        x-on:change="videoName = $refs.video.files[0].name" accept="video/mp4,video/quicktime" />

                    @if ($videoPrincipal)
                        <x-secondary-button type="button"
                            class="justify-center bg-white hover:bg-gray-50 border border-red-200 text-red-600"
                            wire:click="deleteCompanyVideo">
                            <i class="fas fa-trash-alt mr-2"></i> Eliminar
                        </x-secondary-button>
                    @endif
                </div>

                <div class="mt-2 text-sm text-gray-500" x-show="videoName"
                    x-text="'Archivo seleccionado: ' + videoName"></div>
                <x-input-error for="company_video" class="mt-2 text-sm" />
            </div>
        @endif
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 w-full">
            <a href="{{ route('profile.show') }}" class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                <i class="fas fa-arrow-left mr-1"></i> Volver al perfil
            </a>

            <div class="flex items-center gap-3">
                <x-action-message class="text-sm text-jade-600 font-medium" on="saved">
                    <i class="fas fa-check-circle mr-1"></i> Cambios guardados
                </x-action-message>

                <x-button wire:loading.attr="disabled" wire:target="photo,company_video"
                    class="bg-jade-600 hover:bg-jade-700 focus:ring-jade-500">
                    <i class="fas fa-save mr-2"></i> Guardar cambios
                </x-button>
            </div>
        </div>
    </x-slot>
</x-form-section>
