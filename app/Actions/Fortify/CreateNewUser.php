<?php

namespace App\Actions\Fortify;

use App\Models\Empresas;
use App\Models\Personas;
use App\Models\RepreLegal;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; // ← AGREGAR ESTA LÍNEA
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        // Log para debug
        Log::info('Datos recibidos en CreateNewUser:', $input);

        // Validación común para todos los usuarios 
        $validator = Validator::make($input, [
            'user_type' => ['required', 'in:2,3'], 
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ]);

        // Validación para clientes (user_type = 3) - CORREGIDO
        if ($input['user_type'] == '3') {
            $validator->addRules([
                'document_type' => ['required', 'string', 'in:dni'], // Solo DNI por ahora
                'document_number' => ['required', 'string', 'max:8', 'unique:personas,dni'], // Máximo 8 para DNI
                'nombres' => ['required', 'string', 'max:255'],
                'apellidos' => ['required', 'string', 'max:255'],
                'telefono' => ['required', 'string', 'max:9'], // Máximo 9 para teléfono peruano
            ]);
        }

        // Validación para empresas (user_type = 2)
        if ($input['user_type'] == '2') {
            $validator->addRules([
                // Datos de la empresa
                'nombre_empresa' => ['required', 'string', 'max:255'],
                'ruc' => ['required', 'string', 'max:11', 'unique:empresas,rucempresa'],
                'razon_social' => ['required', 'string', 'max:255'],
                'direccion_empresa' => ['required', 'string', 'max:255'],
                'telefono_empresa' => ['required', 'string', 'max:9'],
                'logo_empresa' => ['nullable', 'image', 'max:2048'],
                
                // Datos del representante legal
                'doc_type_representante' => ['required', 'string', 'in:dni'],
                'doc_number_representante' => ['required', 'string', 'max:8', 'unique:personas,dni'],
                'nombres_representante' => ['required', 'string', 'max:255'],
                'apellidos_representante' => ['required', 'string', 'max:255'],
            ]);
        }

        // Validar
        $validator->validate();
        
        $persona = null;
        $user = null;

        // Crear registros según el tipo de usuario
        if ($input['user_type'] == '3') {
            // CLIENTE
            Log::info('Creando cliente');
            
            // Crear persona (cliente)
            $persona = Personas::create([
                'dni' => $input['document_number'],
                'nombre' => $input['nombres'],
                'apellidos' => $input['apellidos'],
                'telefono' => $input['telefono'],
                'email' => $input['email'],
            ]);

            Log::info('Persona creada:', $persona->toArray());

            // Crear usuario
            $user = User::create([
                'name' => $input['nombres'] . ' ' . $input['apellidos'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'fk_idpersona' => $persona->id,
                'fk_idtipousu' => $input['user_type'],
            ]);

            Log::info('Usuario cliente creado:', $user->toArray());

        } elseif ($input['user_type'] == '2') {
            // EMPRESA
            Log::info('Creando empresa');
            
            // Crear persona (representante legal)
            $persona = Personas::create([
                'dni' => $input['doc_number_representante'],
                'nombre' => $input['nombres_representante'],
                'apellidos' => $input['apellidos_representante'],
                'telefono' => $input['telefono_empresa'], // Usamos el teléfono de la empresa
                'email' => $input['email'],
            ]);

            Log::info('Persona representante creada:', $persona->toArray());

            // Crear empresa
            $empresa = Empresas::create([
                'nameempresa' => $input['nombre_empresa'],
                'rucempresa' => $input['ruc'],
                'razonsocial' => $input['razon_social'],
                'direccionempresa' => $input['direccion_empresa'],
                'telefonoempresa' => $input['telefono_empresa'],
            ]);

            Log::info('Empresa creada:', $empresa->toArray());

            // Manejar la subida del logo si existe
            if (isset($input['logo_empresa']) && $input['logo_empresa']) {
                $logoPath = $input['logo_empresa']->store('empresas/logos', 'public');
                $empresa->logoempresa = $logoPath;
                $empresa->save();
                Log::info('Logo subido:', ['path' => $logoPath]);
            }

            // Crear usuario
            $user = User::create([
                'name' => $input['nombre_empresa'], // Nombre de la empresa como nombre de usuario
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'fk_idpersona' => $persona->id,
                'fk_idtipousu' => $input['user_type'],
            ]);

            Log::info('Usuario empresa creado:', $user->toArray());

            // Crear relación representante legal
            RepreLegal::create([
                'fecha' => now(),
                'fk_idempresa' => $empresa->id,
                'fk_idpersona' => $persona->id,
            ]);

            Log::info('Relación representante legal creada');
        }

        $user->should_auto_login = false;
        return $user;
    }
}