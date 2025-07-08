<div class="max-w-full">
    <form wire:submit.prevent="updateProfileInformation" class="space-y-6">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center text-purple-800 mb-4">
                    <i class="fas fa-user-circle text-2xl mr-3"></i>
                    <span class="text-xl font-bold">Información del Perfil</span>
                </div>
                <p class="text-gray-600">Actualiza tu información personal y preferencias.</p>
            </div>
        </div>

        <!-- Contenedor principal con mejor distribución -->
        <div class="w-full space-y-6">
            <!-- Primera fila: Información básica -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <!-- Sección de Foto de Perfil -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div x-data="{ photoName: null, photoPreview: null }">
                        <h3 class="flex items-center text-lg font-medium text-purple-700 mb-4">
                            <i class="fas fa-camera-retro mr-2"></i> Foto de Perfil
                        </h3>

                        <div class="flex flex-col items-center gap-4">
                            <!-- Foto actual -->
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $this->user->profile_photo_path) }}"
                                    alt="{{ $this->user->name }}"
                                    class="rounded-full size-28 object-cover border-4 border-purple-100 shadow-md transition-all duration-300 group-hover:border-jade-200">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-20 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <span class="text-white text-sm font-medium">Ver</span>
                                </div>
                            </div>

                            <!-- Controles de foto -->
                            <div class="flex flex-col gap-2 w-full">
                                <button type="button"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-white border border-purple-200 rounded-md font-semibold text-xs text-purple-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                    x-on:click.prevent="$refs.photo.click()">
                                    <i class="fas fa-upload mr-2"></i> Cambiar Foto
                                </button>

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
                                    <button type="button"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-white border border-red-200 rounded-md font-semibold text-xs text-red-600 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                        wire:click="deleteProfilePhoto">
                                        <i class="fas fa-trash-alt mr-2"></i> Eliminar
                                    </button>
                                @endif
                            </div>

                            <!-- Vista previa de la nueva foto -->
                            <div class="text-center" x-show="photoPreview" style="display: none;">
                                <p class="text-sm text-gray-500 mb-2">Vista previa:</p>
                                <div class="inline-flex rounded-full size-20 border-4 border-jade-100 bg-cover bg-center shadow-sm"
                                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </div>
                            </div>

                            <!-- Error de foto -->
                            @error('photo')
                                <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Sección de Información Básica -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="flex items-center text-lg font-medium text-purple-700 mb-4">
                        <i class="fas fa-id-card mr-2"></i> Información Personal
                    </h3>

                    <div class="space-y-4">
                        <!-- Nombre -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre
                                Completo</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input id="name" type="text"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    wire:model="state.name" required autocomplete="name" />
                            </div>
                            @error('name')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Correo
                                Electrónico</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input id="email" type="email"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    wire:model="state.email" required autocomplete="email" />
                            </div>
                            @error('email')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror

                            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                                    !$this->user->hasVerifiedEmail())
                                <div class="mt-2 text-sm">
                                    <p class="text-amber-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i> Tu correo no está verificado.
                                    </p>
                                    <button type="button"
                                        class="mt-1 text-jade-600 hover:text-jade-800 font-medium text-sm"
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
                                <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400"></i>
                                    </div>
                                    <input id="phone" type="tel"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        wire:model="state.phone" autocomplete="tel" />
                                </div>
                                @error('phone')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Segunda fila: Video promocional (ancho completo) -->
            @if (
                $this->user->tipousu &&
                    $this->user->tipousu->id == 2 &&
                    $this->user->persona &&
                    $this->user->persona->empresa->first())
                @php
                    $empresa = $this->user->persona->empresa->first()->empresa;
                    $videoPrincipal = $empresa->videoPrincipal;
                @endphp

                <div x-data="{ videoName: null }" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="flex items-center text-lg font-medium text-purple-700 mb-4">
                        <i class="fas fa-video mr-2"></i> Video Promocional
                    </h3>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            @if ($videoPrincipal)
                                <div class="overflow-hidden rounded-lg border border-gray-200 shadow-sm">
                                    <video controls class="w-full">
                                        <source src="{{ Storage::url($videoPrincipal->url) }}" type="video/mp4">
                                        Tu navegador no soporta el elemento de video.
                                    </video>
                                </div>
                            @else
                                <div
                                    class="p-8 text-center bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                                    <i class="fas fa-video-slash text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-500">No hay video cargado</p>
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col justify-center">
                            <div class="flex flex-col gap-3">
                                <button type="button"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-white border border-purple-200 rounded-md font-semibold text-xs text-purple-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                    x-on:click.prevent="$refs.video.click()">
                                    <i class="fas fa-upload mr-2"></i>
                                    {{ $videoPrincipal ? 'Cambiar Video' : 'Subir Video' }}
                                </button>

                                <input type="file" id="video" class="hidden" wire:model="company_video"
                                    x-ref="video" x-on:change="videoName = $refs.video.files[0].name"
                                    accept="video/mp4,video/quicktime" />

                                @if ($videoPrincipal)
                                    <button type="button"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-white border border-red-200 rounded-md font-semibold text-xs text-red-600 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                        wire:click="deleteCompanyVideo">
                                        <i class="fas fa-trash-alt mr-2"></i> Eliminar
                                    </button>
                                @endif
                            </div>

                            <div class="mt-2 text-sm text-gray-500" x-show="videoName"
                                x-text="'Archivo seleccionado: ' + videoName"></div>
                            @error('company_video')
                                <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tercera fila: Información bancaria (ancho completo) -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="flex items-center text-lg font-medium text-purple-700 mb-4">
                        <i class="fas fa-university mr-2"></i> Información Bancaria
                    </h3>

                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                        <!-- Información Bancaria -->
                        <div class="space-y-4">
                            <h4 class="text-md font-medium text-gray-800 flex items-center">
                                <i class="fas fa-credit-card mr-2 text-purple-600"></i> Datos Bancarios
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Nombre del Banco -->
                                <div class="md:col-span-2">
                                    <label for="nombrebanco" class="block text-sm font-medium text-gray-700">Nombre
                                        del Banco</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-university text-gray-400"></i>
                                        </div>
                                        <input id="nombrebanco" type="text"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            wire:model="state.nombrebanco"
                                            placeholder="Ej: Banco de Crédito del Perú" />
                                    </div>
                                    @error('nombrebanco')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Número de Cuenta -->
                                <div>
                                    <label for="numero_cuenta" class="block text-sm font-medium text-gray-700">Número
                                        de Cuenta</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-hashtag text-gray-400"></i>
                                        </div>
                                        <input id="numero_cuenta" type="text"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            wire:model="state.numero_cuenta" placeholder="Ej: 123-456789-0-12" />
                                    </div>
                                    @error('numero_cuenta')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Número CCI -->
                                <div>
                                    <label for="numero_cci" class="block text-sm font-medium text-gray-700">Número
                                        CCI</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-barcode text-gray-400"></i>
                                        </div>
                                        <input id="numero_cci" type="text"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            wire:model="state.numero_cci" placeholder="Ej: 00212345678901234567"
                                            maxlength="20" />
                                    </div>
                                    @error('numero_cci')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Códigos QR -->
                        <div class="space-y-4">
                            <h4 class="text-md font-medium text-gray-800 flex items-center">
                                <i class="fas fa-qrcode mr-2 text-purple-600"></i> Códigos QR de Pago
                            </h4>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <!-- QR Yape -->
                                <div x-data="{ qrYapeName: null, qrYapePreview: null }">
                                    <label for="qr_yape" class="block text-sm font-medium text-gray-700">QR
                                        Yape</label>

                                    @if ($empresa->qr_yape)
                                        <div class="mt-2 mb-3 flex justify-center">
                                            <img src="{{ Storage::url($empresa->qr_yape) }}" alt="QR Yape"
                                                class="w-24 h-24 object-cover rounded-lg border-2 border-purple-100 shadow-sm">
                                        </div>
                                    @endif

                                    <div class="flex gap-2">
                                        <button type="button"
                                            class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-white border border-purple-200 rounded-md font-semibold text-xs text-purple-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                            x-on:click.prevent="$refs.qrYape.click()">
                                            <i class="fas fa-upload mr-2"></i>
                                            {{ $empresa->qr_yape ? 'Cambiar' : 'Subir' }}
                                        </button>

                                        @if ($empresa->qr_yape)
                                            <button type="button"
                                                class="inline-flex items-center justify-center px-4 py-2 bg-white border border-red-200 rounded-md font-semibold text-xs text-red-600 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                                wire:click="deleteQrYape">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                    </div>

                                    <input type="file" id="qr_yape" class="hidden" wire:model="qr_yape"
                                        x-ref="qrYape"
                                        x-on:change="
                                            qrYapeName = $refs.qrYape.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                qrYapePreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.qrYape.files[0]);
                                        "
                                        accept="image/jpeg,image/png,image/jpg" />

                                    <div class="mt-2 text-xs text-gray-500" x-show="qrYapeName"
                                        x-text="'Archivo: ' + qrYapeName"></div>
                                    @error('qr_yape')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- QR Plin -->
                                <div x-data="{ qrPlinName: null, qrPlinPreview: null }">
                                    <label for="qr_plin" class="block text-sm font-medium text-gray-700">QR
                                        Plin</label>

                                    @if ($empresa->qr_plin)
                                        <div class="mt-2 mb-3 flex justify-center">
                                            <img src="{{ Storage::url($empresa->qr_plin) }}" alt="QR Plin"
                                                class="w-24 h-24 object-cover rounded-lg border-2 border-purple-100 shadow-sm">
                                        </div>
                                    @endif

                                    <div class="flex gap-2">
                                        <button type="button"
                                            class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-white border border-purple-200 rounded-md font-semibold text-xs text-purple-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                            x-on:click.prevent="$refs.qrPlin.click()">
                                            <i class="fas fa-upload mr-2"></i>
                                            {{ $empresa->qr_plin ? 'Cambiar' : 'Subir' }}
                                        </button>

                                        @if ($empresa->qr_plin)
                                            <button type="button"
                                                class="inline-flex items-center justify-center px-4 py-2 bg-white border border-red-200 rounded-md font-semibold text-xs text-red-600 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                                wire:click="deleteQrPlin">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                    </div>

                                    <input type="file" id="qr_plin" class="hidden" wire:model="qr_plin"
                                        x-ref="qrPlin"
                                        x-on:change="
                                            qrPlinName = $refs.qrPlin.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                qrPlinPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.qrPlin.files[0]);
                                        "
                                        accept="image/jpeg,image/png,image/jpg" />

                                    <div class="mt-2 text-xs text-gray-500" x-show="qrPlinName"
                                        x-text="'Archivo: ' + qrPlinName"></div>
                                    @error('qr_plin')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Actions -->
        <div
            class="bg-white px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-lg shadow-sm border border-gray-100">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 w-full">
                <a href="{{ route('dashboard.empresa') }}"
                    class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                    <i class="fas fa-arrow-left mr-1"></i> Volver al Inicio
                </a>

                <div class="flex items-center gap-3">
                    <!-- Mensaje de éxito -->
                    <div x-data="{ show: false }" x-on:saved.window="show = true; setTimeout(() => show = false, 3000)"
                        x-show="show" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        class="text-sm text-jade-600 font-medium" style="display: none;">
                        <i class="fas fa-check-circle mr-1"></i> Cambios guardados
                    </div>

                    <button type="submit" wire:loading.attr="disabled"
                        wire:target="photo,company_video,qr_yape,qr_plin"
                        class="inline-flex items-center px-4 py-2 bg-jade-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-jade-700 focus:bg-jade-700 active:bg-jade-900 focus:outline-none focus:ring-2 focus:ring-jade-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        <i class="fas fa-save mr-2"></i> Guardar cambios
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
