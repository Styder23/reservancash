<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Inicio;
use App\Livewire\Destinos\Destinos;
use App\Livewire\Servicios;
use App\Livewire\Equipos\Equipos;
use App\Livewire\Equipos\DetalleEquipos;

use App\Livewire\Paquetes;
use App\Livewire\Promociones;
use App\Livewire\Empresas;
use App\Livewire\Dashcliente;
use App\Livewire\Dashempresa;
use App\Livewire\Admin;
use App\Http\Controllers\Auth\LoginController;
use App\Livewire\DestinoDetalle;
use App\Livewire\Pantalladividida;
use App\Livewire\dividida;
use App\Livewire\Favoritos;
use App\Livewire\Crearpaquete;

// para las empresas
use App\Livewire\Admin\PanelDestino;
use App\Livewire\Admin\Panelequipos;
use App\Livewire\Admin\Panelservicios;
use App\Livewire\Admin\Panelpaquetes;
use App\Livewire\Admin\Panelpromociones;

Route::get('/', function () {
    return redirect('/inicio');
});

Route::get('/inicio', Inicio::class)->name('inicioapp');
Route::get('/servicios', Servicios::class)->name('servicios');
Route::get('/destinos', Destinos::class)->name('destinos');
Route::get('/paquetes', Paquetes::class)->name('paquetes');
Route::get('/empresas', Empresas::class)->name('empresas');

Route::get('/pantalladividida', Pantalladividida::class)->name('pantalladividida');
Route::get('/dividida', Dividida::class)->name('dividida');
Route::get('/favoritos', Favoritos::class)->name('favoritos');
Route::get('/panelservicios', Panelservicios::class)->name('panelservicios');
Route::get('/dashempresa', Dashempresa::class)->name('dashempresa');
Route::get('/crearpaquete', Crearpaquete::class)->name('crearpaquete');

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
Route::get('/admin', Admin::class)->name('administrador');
Route::get('/equipo', Equipos::class)->name('equipos');

// para las empresas
Route::get('/det_equipo', Panelequipos::class)->name('det_equipos');
Route::get('/det_destinos', PanelDestino::class)->name('det_destinos');
Route::get('/det_servicio', Panelservicios::class)->name('det_servicios');
Route::get('/det_promociones', Panelpromociones::class)->name('det_promociones');
Route::get('/det_paquetes', Panelpaquetes::class)->name('det_paquetes');