<x-guest-layout>
    <div class="min-h-screen bg-cover bg-center flex items-center justify-center relative"
        style="background-image: url('Alpamayo en 4k.jpg');">
        {{-- Overlay transparente oscuro para mejor contraste --}}
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        {{-- Contenedor del formulario con z-index para estar encima --}}
        <div class="relative w-full max-w-md p-8 bg-white bg-opacity-90 rounded-lg shadow-lg">
            <div class="flex flex-col items-center mb-8">
                <img src="{{ asset('logo.webp') }}" alt="Logo" class="w-24 h-24 mb-4 rounded-full shadow" />

                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    {{ config('app.nameee', 'ReservÁncash') }}
                </h1>

                <p class="mt-2 text-sm text-gray-600">
                    {{ __('Por favor, inicia sesión para continuar') }}
                </p>
            </div>

            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <div class="text-center mt-6">
                    <x-button class="hover:bg-blue-600 py-3 px-20 rounded-lg  transition-colors duration-200">
                        {{ __('Log in') }}
                    </x-button>
                </div>


                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @else
                        <div></div> {{-- Espaciador para mantener la alineación --}}
                    @endif

                    @if (Route::has('register'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2            focus:ring-indigo-500"
                            href="{{ route('register') }}">
                            {{ __('Registrarse') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
        <!-- Modal de confirmación -->
        <!-- Modal de confirmación de registro exitoso -->
        @if (session('success'))
            <div id="successModal" class="modal-overlay">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-check-circle"></i> ¡Registro Exitoso!</h3>
                    </div>
                    <div class="modal-body">
                        <p>{{ session('success') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button onclick="closeModal()" class="btn btn-primary">Continuar</button>
                    </div>
                </div>
            </div>

            <style>
                .modal-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.5);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    z-index: 1000;
                }

                .modal-content {
                    background: white;
                    padding: 2rem;
                    border-radius: 8px;
                    max-width: 400px;
                    width: 90%;
                    text-align: center;
                    animation: modalSlide 0.3s ease-out;
                }

                .modal-header h3 {
                    margin: 0 0 1rem 0;
                    color: #059669;
                }

                .modal-header i {
                    font-size: 2rem;
                    margin-right: 0.5rem;
                }

                .modal-body {
                    margin-bottom: 1.5rem;
                }

                .modal-footer .btn {
                    padding: 0.75rem 2rem;
                    background: #3b82f6;
                    color: white;
                    border: none;
                    border-radius: 6px;
                    cursor: pointer;
                    font-size: 1rem;
                }

                .modal-footer .btn:hover {
                    background: #2563eb;
                }

                @keyframes modalSlide {
                    from {
                        opacity: 0;
                        transform: scale(0.8);
                    }

                    to {
                        opacity: 1;
                        transform: scale(1);
                    }
                }
            </style>

            <script>
                function closeModal() {
                    document.getElementById('successModal').style.display = 'none';
                }

                // Cerrar modal con Escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closeModal();
                    }
                });
            </script>
        @endif
    </div>
</x-guest-layout>
