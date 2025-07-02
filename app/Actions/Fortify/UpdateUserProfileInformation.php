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

        // Si es empresa, agregar reglas para el video
        if ($user->tipousu && $user->tipousu->id == 2) {
            $rules['company_video'] = ['nullable', 'mimetypes:video/mp4,video/quicktime', 'max:5120'];
        }

        Validator::make($input, $rules)->validateWithBag('updateProfileInformation');

        // Actualizar foto de perfil del usuario (para cliente o representante legal)
        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        // Si es empresa, manejar video
        if ($user->tipousu && $user->tipousu->id == 2) {
            $this->handleCompanyUpdates($user, $input);
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

        // Actualizar datos de persona asociada
        if ($user->persona) {
            $personaData = [
                'nombre' => $input['name'],
                'email' => $input['email'],
                'telefono' => $input['phone'] ?? $user->persona->telefono
            ];
            
            $user->persona->update($personaData);
        }
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