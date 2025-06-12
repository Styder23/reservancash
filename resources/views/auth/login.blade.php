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

                {{-- Selector de tipo de usuario --}}
                <div class="mb-4">
                    <x-label for="user_type" value="{{ __('Tipo de Usuario') }}" />
                    <select id="user_type" name="user_type"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        required>
                        <option value="">{{ __('Selecciona tipo de usuario') }}</option>
                        <option value="cliente" {{ old('user_type') == 'cliente' ? 'selected' : '' }}>
                            {{ __('Cliente') }} </option>
                        <option value="empresa" {{ old('user_type') == 'empresa' ? 'selected' : '' }}>
                            {{ __('Empresa') }} </option>
                    </select>
                </div>

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
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('register') }}">
                            {{ __('Registrarse') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>