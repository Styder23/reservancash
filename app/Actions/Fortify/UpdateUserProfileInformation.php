<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Personas;
use App\Models\Empresas;
use App\Models\Videos;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];

        if ($user->tipousu && $user->tipousu->id == 2) {
            $rules['company_video'] = ['nullable', 'mimetypes:video/mp4,video/quicktime', 'max:5120'];
            $rules['nombrebanco'] = ['nullable', 'string', 'max:255'];
            $rules['numero_cuenta'] = ['nullable', 'string', 'max:255'];
            $rules['numero_cci'] = ['nullable', 'string', 'max:255'];
            $rules['qr_yape'] = ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'];
            $rules['qr_plin'] = ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'];
        }

        Validator::make($input, $rules)->validateWithBag('updateProfileInformation');

        // Actualizar foto de perfil del usuario (para cliente o representante legal)
        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        // Si es empresa, manejar video y datos bancarios
        if ($user->tipousu && $user->tipousu->id == 2) {
            $this->handleCompanyUpdates($user, $input);
            $this->handleBankUpdates($user, $input);
        }

        // Actualizar email y nombre
        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }

        if ($user->persona) {
            $personaData = [
                'nombre' => $input['name'],
                'email' => $input['email'],
                'telefono' => $input['phone'] ?? $user->persona->telefono
            ];
            
            $user->persona->update($personaData);
        }
        
    }

    protected function handleBankUpdates(User $user, array $input): void
    {
        \Log::debug('Datos recibidos:', $input);
        \Log::debug('Archivo QR Yape recibido:', isset($input['qr_yape']) ? ['name' => $input['qr_yape']->getClientOriginalName()] : ['no_file']);
        
        $empresa = $user->persona->empresa->first()->empresa;
        
        $bankData = [
            'nombrebanco' => $input['nombrebanco'] ?? $empresa->nombrebanco,
            'numero_cuenta' => $input['numero_cuenta'] ?? $empresa->numero_cuenta,
            'numero_cci' => $input['numero_cci'] ?? $empresa->numero_cci,
        ];

        // Procesar QR Yape
        if (request()->hasFile('qr_yape')) {
            $file = request()->file('qr_yape');
            if ($file->isValid()) {
                if ($empresa->qr_yape) {
                    Storage::disk('public')->delete($empresa->qr_yape);
                }
                $bankData['qr_yape'] = $file->store('empresa/qr', 'public');
            }
        }

        // Procesar QR Plin
        if (request()->hasFile('qr_plin')) {
            $file = request()->file('qr_plin');
            if ($file->isValid()) {
                if ($empresa->qr_plin) {
                    Storage::disk('public')->delete($empresa->qr_plin);
                }
                $bankData['qr_plin'] = $file->store('empresa/qr', 'public');
            }
        }

        $empresa->update($bankData);
    }
    
    public function deleteQrYape(User $user)
    {
        $empresa = $user->persona->empresa->first()->empresa;
        Storage::disk('public')->delete($empresa->qr_yape);
        $empresa->update(['qr_yape' => null]);
    }

    public function deleteQrPlin(User $user)
    {
        $empresa = $user->persona->empresa->first()->empresa;
        Storage::disk('public')->delete($empresa->qr_plin);
        $empresa->update(['qr_plin' => null]);
    }

    protected function handleCompanyUpdates(User $user, array $input): void
    {
        $empresa = $user->persona->empresa->first()?->empresa;
        
        if ($empresa && isset($input['company_video'])) {
            // Eliminar video anterior si existe
            $empresa->videos()->where('tipo', 'principal')->delete();
            
            // Guardar nuevo video
            $path = $input['company_video']->store('company-videos', 'public');
            
            $empresa->videos()->create([
                'url' => $path,
                'tipo' => 'principal',
                'videoable_type' => Empresas::class,
                'videoable_id' => $empresa->id
            ]);
        }
    }
    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}