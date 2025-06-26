<?php

// namespace App\Http\Controllers;

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;

class RegisteredUserController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct()
    {
        $this->guard = Auth::guard();
    }

    /**
     * Create a new registered user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Contracts\CreatesNewUsers  $creator
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,
                          CreatesNewUsers $creator)
    {
        event(new Registered($user = $creator->create($request->all())));

        // No autenticar automáticamente al usuario
        $this->guard->login($user);

        // Retornar respuesta JSON para mostrar el modal
        return $request->wantsJson()
                    ? new JsonResponse(['message' => 'Usuario creado correctamente', 'redirect' => route('login')], 201)
                    : redirect()->route('login')->with('success', 'Usuario creado correctamente. Por favor inicia sesión.');
    }
}