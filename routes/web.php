<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Inicio;
use App\Livewire\Destinos;
use App\Livewire\Servicios;
use App\Livewire\Equipos;
use App\Livewire\Paquetes;
use App\Livewire\Promociones;
use App\Livewire\Empresas;
use App\Livewire\Dashcliente;
use App\Livewire\Dashempresa;
use App\Http\Controllers\Auth\LoginController;
use App\Livewire\DestinoDetalle;
use App\Livewire\Pantalladividida;
use App\Livewire\dividida;

Route::get('/', function () {
    return redirect('/inicio');
});

Route::get('/inicio', Inicio::class)->name('inicioapp');
Route::get('/servicios', Servicios::class)->name('servicios');
Route::get('/destinos', Destinos::class)->name('destinos');
Route::get('/equipos', Equipos::class)->name('equipos');
Route::get('/paquetes', Paquetes::class)->name('paquetes');
Route::get('/empresas', Empresas::class)->name('empresas');
Route::get('/pantalladividida', Pantalladividida::class)->name('pantalladividida');




// Rutas personalizadas de autenticación
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    // Dashboard por defecto
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Dashboard específico para cliente
    Route::get('/dashboard/cliente', Dashcliente::class)->name('dashboard.cliente');

    // Dashboard específico para empresa
    Route::get('/dashboard/empresa', Dashempresa::class)->name('dashboard.empresa');
    
});

Route::get('/destino-detalle', DestinoDetalle::class)->name('destino_detalle');