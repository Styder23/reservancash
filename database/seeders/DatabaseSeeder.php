<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        // Insertar categorías
        DB::table('categorias')->insert([
            ['namecategorias' => 'categoria 1'],
            ['namecategorias' => 'categoria 2']
        ]);

        // Insertar marcas
        DB::table('marcas')->insert([
            ['namemarcas' => 'marca 1'],
            ['namemarcas' => 'marca 2'],
            ['namemarcas' => 'marca 3']
        ]);

        // Insertar serie equipos
        DB::table('serie_equipos')->insert([
            ['nameserie' => 'Serie 1'],
            ['nameserie' => 'Serie 2'],
            ['nameserie' => 'Serie 3']
        ]);

        // Insertar tipo equipos
        DB::table('tipoequipos')->insert([
            ['nametipoequipos' => 'Escalada'],
            ['nametipoequipos' => 'Caminata'],
            ['nametipoequipos' => 'Mochilas']
        ]);

        // Insertar modelos
        DB::table('modelos')->insert([
            ['namemodelos' => 'Modelo 1'],
            ['namemodelos' => 'Modelo 2'],
            ['namemodelos' => 'Modelo 3']
        ]);

        // Insertar tipo destinos
        DB::table('tipo_destinos')->insert([
            ['nametipo_destinos' => 'Laguna'],
            ['nametipo_destinos' => 'Historicos'],
            ['nametipo_destinos' => 'Trekking']
        ]);

        // Insertar departamentos
        DB::table('departamentos')->insert([
            ['namedepartamentos' => 'Ancash']
        ]);

        // Insertar provincias
        DB::table('provincias')->insert([
            ['fk_iddepartamento' => 1, 'nameprovincia' => 'Yungay'],
            ['fk_iddepartamento' => 1, 'nameprovincia' => 'Huaraz']
        ]);

        // Insertar distritos
        DB::table('distritos')->insert([
            ['fk_idprovincia' => 1, 'namedistrito' => 'Yungay'],
            ['fk_idprovincia' => 2, 'namedistrito' => 'Huaraz'],
            ['fk_idprovincia' => 2, 'namedistrito' => 'Independencia']
        ]);

        // Insertar tipo servicios
        DB::table('tipo_servicios')->insert([
            ['nametipo_servicios' => 'Guias'],
            ['nametipo_servicios' => 'Tours'],
            ['nametipo_servicios' => 'Misturas']
        ]);


    }
}
