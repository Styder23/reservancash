<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            <span class="text-purple-600">Nuestras </span> Empresas
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($empresas as $empresa)
                <a href="{{ route('', $empresa->id) }}" class="block">
                    <div
                        class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-lg transition duration-300 cursor-pointer">
                        <div
                            class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 overflow-hidden">
                            @if ($empresa->logoempresa)
                                <img src="{{ asset('storage/' . $empresa->logoempresa) }}"
                                    alt="{{ $empresa->nameempresa }}" class="w-16 h-16 object-cover rounded-full">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold mb-2">{{ $empresa->nameempresa }}</h3>
                        <p class="text-gray-600 mb-1">{{ $empresa->rucempresa }}</p>
                        <p class="text-gray-600 mb-1">{{ $empresa->razonsocial }}</p>
                        <p class="text-gray-500 text-sm">{{ $empresa->direccionempresa }}</p>
                        <p class="text-gray-500 text-sm">Tel: {{ $empresa->telefonoempresa }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
