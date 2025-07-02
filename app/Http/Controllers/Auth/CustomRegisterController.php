<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CustomRegisterController extends Controller
{
    protected $creator;

    public function __construct(CreateNewUser $creator)
    {
        $this->creator = $creator;
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        try {
            // Crear el usuario usando la misma lógica de Fortify
            $user = $this->creator->create($request->all());
            
            // Determinar mensaje según tipo de usuario
            $message = $user->fk_idtipousu == 2 ? 
                'Empresa registrada exitosamente. Ahora puedes iniciar sesión.' : 
                'Usuario registrado exitosamente. Ahora puedes iniciar sesión.';
            
            // Verificar si es una petición AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'redirect' => route('login')
                ]);
            }
            
            // Redireccionar al login con mensaje de éxito (petición normal)
            return redirect()->route('login')->with('success', $message);
            
        } catch (ValidationException $e) {
            // Errores de validación
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Por favor corrige los errores en el formulario.',
                    'errors' => $e->errors()
                ], 422);
            }
            
            return back()->withErrors($e->errors())->withInput()
                        ->with('error', 'Por favor corrige los errores en el formulario.');
            
        } catch (\Exception $e) {
            // Otros errores (duplicados, etc.)
            $errorMessage = 'Error al registrar usuario.';
            
            // Personalizar mensaje según el error
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                if (str_contains($e->getMessage(), 'email')) {
                    $errorMessage = 'Este correo electrónico ya está registrado.';
                } elseif (str_contains($e->getMessage(), 'dni')) {
                    $errorMessage = 'Este número de documento ya está registrado.';
                } elseif (str_contains($e->getMessage(), 'ruc')) {
                    $errorMessage = 'Este RUC ya está registrado.';
                }
            }
            
            // Log del error para debugging
            \Log::error('Error en registro de usuario: ' . $e->getMessage(), [
                'user_data' => $request->except(['password', 'password_confirmation']),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 500);
            }
            
            return back()->with('error', $errorMessage)->withInput();
        }
    }
}