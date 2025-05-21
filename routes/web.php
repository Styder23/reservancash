<?php






use Illuminate\Support\Facades\Route;
use App\Livewire\Inicio;
use App\Livewire\Destinos;
use App\Livewire\Servicios;
use App\Livewire\Equipos;
use App\Livewire\Paquetes;
use App\Livewire\Promociones;
use App\Livewire\Empresas;


Route::get('/', function () {
    return redirect('/inicio');
});

Route::get('/inicio', Inicio::class)->name('inicioapp');
Route::get('/servicios', Servicios::class)->name('servicios');
Route::get('/destinos', Destinos::class)->name('destinos');
Route::get('/equipos', Equipos::class)->name('equipos');
Route::get('/paquetes', Paquetes::class)->name('paquetes');
Route::get('/empresas', Empresas::class)->name('empresas');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});