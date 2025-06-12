<!DOCTYPE html>
<html lang="es">

<head>
    @livewireStyles
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="flex">
        @include('livewire.sidebar')
        <div class="flex-1 p-8">
            {{ $slot }}
        </div>
    </div>
    @livewireScripts
</body>

</html>
