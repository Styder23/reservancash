<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    /**
     * Número máximo de intentos de login
     */
    const MAX_ATTEMPTS = 5;
    
    /**
     * Tiempo de bloqueo en minutos
     */
    const LOCKOUT_TIME = 60;

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');

    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Obtener credenciales
        $email = $request->input('email');
        $password = $request->input('password');
        
        // Verificar si el usuario existe
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return back()->withErrors([
                'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            ])->onlyInput('email');
        }

        // Verificar si el usuario está activo
        if (!$user->estado_usu) {
            return back()->withErrors([
                'email' => 'Tu cuenta está inactiva. Contacta al administrador.',
            ])->onlyInput('email');
        }

        // Verificar si el usuario está bloqueado por intentos fallidos
        if ($this->isUserBlocked($user)) {
            $remainingTime = $this->getRemainingBlockTime($user);
            return back()->withErrors([
                'email' => "Cuenta bloqueada por múltiples intentos fallidos. Intenta nuevamente en {$remainingTime} minutos.",
            ])->onlyInput('email');
        }

        // Intentar autenticación
        if (!Hash::check($password, $user->password)) {
            $this->recordFailedAttempt($user);
            
            $remainingAttempts = self::MAX_ATTEMPTS - ($user->intentos_fallidos ?? 0);
            
            if ($remainingAttempts <= 0) {
                return back()->withErrors([
                    'email' => 'Cuenta bloqueada por múltiples intentos fallidos.',
                ])->onlyInput('email');
            }
            
            return back()->withErrors([
                'email' => "Contraseña incorrecta. Te quedan {$remainingAttempts} intentos.",
            ])->onlyInput('email');
        }

        // Login exitoso - limpiar intentos fallidos
        $this->clearFailedAttempts($user);
        
        // Autenticar usuario
        // Auth::login($user);
        $request->session()->regenerate();
        
        // Obtener el tipo de usuario basándose en fk_idtipousu
        $userTypeName = $this->getUserTypeName($user->fk_idtipousu);
        
        // Guardar información en sesión
        session([
            'user_type' => $userTypeName,
            'user_type_id' => $user->fk_idtipousu,
            'user_name' => $user->name
        ]);

        // Redireccionar según el tipo de usuario
        return $this->redirectUserByType($user->fk_idtipousu);
    }

    /**
     * Verificar si el usuario está bloqueado
     */
    private function isUserBlocked(User $user): bool
    {
        if (!$user->bloqueado_hasta) {
            return false;
        }
        
        return Carbon::parse($user->bloqueado_hasta)->isFuture();
    }

    /**
     * Obtener tiempo restante de bloqueo
     */
    private function getRemainingBlockTime(User $user): int
    {
        if (!$user->bloqueado_hasta) {
            return 0;
        }
        
        $now = Carbon::now();
        $blockedUntil = Carbon::parse($user->bloqueado_hasta);
        
        return $now->diffInMinutes($blockedUntil, false);
    }

    /**
     * Registrar intento fallido
     */
    private function recordFailedAttempt(User $user): void
    {
        $intentos = ($user->intentos_fallidos ?? 0) + 1;
        
        $updateData = ['intentos_fallidos' => $intentos];
        
        // Si alcanza el máximo de intentos, bloquear usuario
        if ($intentos >= self::MAX_ATTEMPTS) {
            $updateData['bloqueado_hasta'] = Carbon::now()->addMinutes(self::LOCKOUT_TIME);
        }
        
        $user->update($updateData);
    }

    /**
     * Limpiar intentos fallidos
     */
    private function clearFailedAttempts(User $user): void
    {
        $user->update([
            'intentos_fallidos' => 0,
            'bloqueado_hasta' => null,
            'ultimo_acceso' => Carbon::now()
        ]);
    }

    /**
     * Obtener nombre del tipo de usuario basándose en el ID
     */
    private function getUserTypeName(int $tipoUsuarioId): string
    {
        switch ($tipoUsuarioId) {
            case 1:
                return 'admin';
            case 2:
                return 'empresa';
            case 3:
                return 'cliente';
            default:
                return 'unknown';
        }
    }

    /**
     * Redireccionar según tipo de usuario
     */
    private function redirectUserByType(int $tipoUsuarioId): RedirectResponse
    {
        switch ($tipoUsuarioId) {
            case 1: // Admin
                return redirect()->route('dashboard');
            case 2: // Empresa
                return redirect()->route('dashboard.empresa');
            case 3: // Cliente
                return redirect()->route('dashboard.cliente');
            // default:
            //     return redirect()->route('dashboard'); // aqui 
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('inicioapp');
    }
}