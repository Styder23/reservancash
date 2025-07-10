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
            'phone' => ['nullable', 'string', 'max:20'],
        ];

        if ($user->tipousu && $user->tipousu->id == 2) {
            $rules = array_merge($rules, [
                'company_video' => ['nullable', 'mimetypes:video/mp4,video/quicktime', 'max:5120'],
                'nombrebanco' => ['nullable', 'string', 'max:255'],
                'numero_cuenta' => ['nullable', 'string', 'max:255'],
                'numero_cci' => ['nullable', 'string', 'max:255'],
                'qr_yape' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
                'qr_plin' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            ]);
        }

        Validator::make($input, $rules)->validateWithBag('updateProfileInformation');

        // Actualizar foto de perfil
        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        // Actualizar datos básicos
        $userData = [
            'name' => $input['name'],
            'email' => $input['email'],
        ];

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $user->forceFill(array_merge($userData, [
                'email_verified_at' => null,
            ]))->save();
            $user->sendEmailVerificationNotification();
        } else {
            $user->forceFill($userData)->save();
        }

        // Actualizar datos de persona
        if ($user->persona) {
            $user->persona->update([
                'nombre' => $input['name'],
                'email' => $input['email'],
                'telefono' => $input['phone'] ?? $user->persona->telefono
            ]);
        }

        // Actualizar datos de empresa si es necesario
        if ($user->tipousu && $user->tipousu->id == 2 && $user->persona && $user->persona->empresa->first()) {
            $this->handleCompanyUpdates($user, $input);
            $this->handleBankUpdates($user, $input);
        }
    }

    protected function handleBankUpdates(User $user, array $input): void
    {
        $empresa = $user->persona->empresa->first()->empresa;
        
        $bankData = [
            'nombrebanco' => $input['nombrebanco'] ?? $empresa->nombrebanco,
            'numero_cuenta' => $input['numero_cuenta'] ?? $empresa->numero_cuenta,
            'numero_cci' => $input['numero_cci'] ?? $empresa->numero_cci,
        ];

        // Procesar QR Yape
        if (isset($input['qr_yape']) && $input['qr_yape']->isValid()) {
            // Eliminar anterior si existe
            if ($empresa->qr_yape && Storage::disk('public')->exists($empresa->qr_yape)) {
                Storage::disk('public')->delete($empresa->qr_yape);
            }
            // Guardar nuevo
            $bankData['qr_yape'] = $input['qr_yape']->store('empresa/qr', 'public');
        }

        // Procesar QR Plin
        if (isset($input['qr_plin']) && $input['qr_plin']->isValid()) {
            // Eliminar anterior si existe
            if ($empresa->qr_plin && Storage::disk('public')->exists($empresa->qr_plin)) {
                Storage::disk('public')->delete($empresa->qr_plin);
            }
            // Guardar nuevo
            $bankData['qr_plin'] = $input['qr_plin']->store('empresa/qr', 'public');
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