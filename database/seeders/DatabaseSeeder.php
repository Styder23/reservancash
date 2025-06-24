<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('tipo_usuarios')->insert([
            ['nametipo_usuarios' => 'SuperAdmin'],
            ['nametipo_usuarios' => 'Empresa'],
            ['nametipo_usuarios' => 'Cliente'],
        ]);

        DB::table('tipo_destinos')->insert([
            ['nametipo_destinos' => 'Lagunas'],
            ['nametipo_destinos' => 'Historico'],
            ['nametipo_destinos' => 'Trekking'],
        ]);
                
        DB::table('tipo_servicios')->insert([
            ['nametipo_servicios' => 'Tours'],
            ['nametipo_servicios' => 'Guias'],
            ['nametipo_servicios' => 'Misturas'],
        ]);

        DB::table('tipoequipos')->insert([
            ['nametipoequipos' => 'Mochilas'],
            ['nametipoequipos' => 'Carpas'],
            ['nametipoequipos' => 'Caña de pescar'],
        ]);

        DB::table('departamentos')->insert([
            ['namedepartamentos' => 'Ancash'],
        ]);  

        DB::table('provincias')->insert([
            ['nameprovincia' => 'AIJA','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'ANTONIO RAIMONDI','fk_iddepartamento' => '1'],
            // ['nameprovincia' => 'ANTONIO RAIMONDI','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'ASUNCION','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'BOLOGNESI','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'CARHUAZ','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'CARLOS FERMIN FITZCARRALD','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'CASMA','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'CORONGO','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'HUARAZ','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'HUARI','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'HUARMEY','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'HUAYLAS','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'MARISCAL LUZURIAGA','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'OCROS','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'PALLASCA','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'POMABAMBA','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'RECUAY','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'SANTA','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'SIHUAS','fk_iddepartamento' => '1'],
            ['nameprovincia' => 'YUNGAY','fk_iddepartamento' => '1'],
        ]);

        DB::table('distritos')->insert([
            ['namedistrito' => 'CORIS', 'fk_idprovincia' => 1],
            ['namedistrito' => 'AIJA', 'fk_idprovincia' => 1],
            ['namedistrito' => 'HUACLLAN', 'fk_idprovincia' => 1],
            ['namedistrito' => 'LA MERCED', 'fk_idprovincia' => 1],
            ['namedistrito' => 'SUCCHA', 'fk_idprovincia' => 1],
            ['namedistrito' => 'LLAMELLIN', 'fk_idprovincia' => 2],
            ['namedistrito' => 'ACZO', 'fk_idprovincia' => 2],
            ['namedistrito' => 'CHACCHO', 'fk_idprovincia' => 2],
            ['namedistrito' => 'CHINGAS', 'fk_idprovincia' => 2],
            ['namedistrito' => 'MIRGAS', 'fk_idprovincia' => 2],
            ['namedistrito' => 'SAN JUAN DE RONTOY', 'fk_idprovincia' => 2],
            ['namedistrito' => 'CHACAS', 'fk_idprovincia' => 3],
            ['namedistrito' => 'ACOCHACA', 'fk_idprovincia' => 3],
            ['namedistrito' => 'CHIQUIAN', 'fk_idprovincia' => 4],
            ['namedistrito' => 'ABELARDO PARDO LEZAMETA', 'fk_idprovincia' => 4],
            ['namedistrito' => 'ANTONIO RAIMONDI', 'fk_idprovincia' => 4],
            ['namedistrito' => 'AQUIA', 'fk_idprovincia' => 4],
            ['namedistrito' => 'CAJACAY', 'fk_idprovincia' => 4],
            ['namedistrito' => 'CANIS', 'fk_idprovincia' => 4],
            ['namedistrito' => 'COLQUIOC', 'fk_idprovincia' => 4],
            ['namedistrito' => 'HUALLANCA', 'fk_idprovincia' => 4],
            ['namedistrito' => 'HUASTA', 'fk_idprovincia' => 4],
            ['namedistrito' => 'HUAYLLACAYAN', 'fk_idprovincia' => 4],
            ['namedistrito' => 'LA PRIMAVERA', 'fk_idprovincia' => 4],
            ['namedistrito' => 'MANGAS', 'fk_idprovincia' => 4],
            ['namedistrito' => 'PACLLON', 'fk_idprovincia' => 4],
            ['namedistrito' => 'SAN MIGUEL DE CORPANQUI', 'fk_idprovincia' => 4],
            ['namedistrito' => 'TICLLOS', 'fk_idprovincia' => 4],
            ['namedistrito' => 'CARHUAZ', 'fk_idprovincia' => 5],
            ['namedistrito' => 'ACOPAMPA', 'fk_idprovincia' => 5],
            ['namedistrito' => 'AMASHCA', 'fk_idprovincia' => 5],
            ['namedistrito' => 'ANTA', 'fk_idprovincia' => 5],
            ['namedistrito' => 'ATAQUERO', 'fk_idprovincia' => 5],
            ['namedistrito' => 'MARCARA', 'fk_idprovincia' => 5],
            ['namedistrito' => 'PARIAHUANCA', 'fk_idprovincia' => 5],
            ['namedistrito' => 'SAN MIGUEL DE ACO', 'fk_idprovincia' => 5],
            ['namedistrito' => 'SHILLA', 'fk_idprovincia' => 5],
            ['namedistrito' => 'TINCO', 'fk_idprovincia' => 5],
            ['namedistrito' => 'YUNGAR', 'fk_idprovincia' => 5],
            ['namedistrito' => 'SAN LUIS', 'fk_idprovincia' => 6],
            ['namedistrito' => 'SAN NICOLAS', 'fk_idprovincia' => 6],
            ['namedistrito' => 'YAUYA', 'fk_idprovincia' => 6],
            ['namedistrito' => 'CASMA', 'fk_idprovincia' => 7],
            ['namedistrito' => 'BUENA VISTA ALTA', 'fk_idprovincia' => 7],
            ['namedistrito' => 'COMANDANTE NOEL', 'fk_idprovincia' => 7],
            ['namedistrito' => 'YAUTAN', 'fk_idprovincia' => 7],
            ['namedistrito' => 'CORONGO', 'fk_idprovincia' => 8],
            ['namedistrito' => 'ACO', 'fk_idprovincia' => 8],
            ['namedistrito' => 'BAMBAS', 'fk_idprovincia' => 8],
            ['namedistrito' => 'CUSCA', 'fk_idprovincia' => 8],
            ['namedistrito' => 'LA PAMPA', 'fk_idprovincia' => 8],
            ['namedistrito' => 'YANAC', 'fk_idprovincia' => 8],
            ['namedistrito' => 'YUPAN', 'fk_idprovincia' => 8],
            ['namedistrito' => 'HUARAZ', 'fk_idprovincia' => 9],
            ['namedistrito' => 'COCHABAMBA', 'fk_idprovincia' => 9],
            ['namedistrito' => 'COLCABAMBA', 'fk_idprovincia' => 9],
            ['namedistrito' => 'HUANCHAY', 'fk_idprovincia' => 9],
            ['namedistrito' => 'INDEPENDENCIA', 'fk_idprovincia' => 9],
            ['namedistrito' => 'JANGAS', 'fk_idprovincia' => 9],
            ['namedistrito' => 'LA LIBERTAD', 'fk_idprovincia' => 9],
            ['namedistrito' => 'OLLEROS', 'fk_idprovincia' => 9],
            ['namedistrito' => 'PAMPAS GRANDE', 'fk_idprovincia' => 9],
            ['namedistrito' => 'PARIACOTO', 'fk_idprovincia' => 9],
            ['namedistrito' => 'PIRA', 'fk_idprovincia' => 9],
            ['namedistrito' => 'TARICA', 'fk_idprovincia' => 9],
            ['namedistrito' => 'HUARI', 'fk_idprovincia' => 10],
            ['namedistrito' => 'ANRA', 'fk_idprovincia' => 10],
            ['namedistrito' => 'CAJAY', 'fk_idprovincia' => 10],
            ['namedistrito' => 'CHAVIN DE HUANTAR', 'fk_idprovincia' => 10],
            ['namedistrito' => 'HUACACHI', 'fk_idprovincia' => 10],
            ['namedistrito' => 'HUACCHIS', 'fk_idprovincia' => 10],
            ['namedistrito' => 'HUACHIS', 'fk_idprovincia' => 10],
            ['namedistrito' => 'HUANTAR', 'fk_idprovincia' => 10],
            ['namedistrito' => 'MASIN', 'fk_idprovincia' => 10],
            ['namedistrito' => 'PAUCAS', 'fk_idprovincia' => 10],
            ['namedistrito' => 'PONTO', 'fk_idprovincia' => 10],
            ['namedistrito' => 'RAHUAPAMPA', 'fk_idprovincia' => 10],
            ['namedistrito' => 'RAPAYAN', 'fk_idprovincia' => 10],
            ['namedistrito' => 'SAN MARCOS', 'fk_idprovincia' => 10],
            ['namedistrito' => 'SAN PEDRO DE CHANA', 'fk_idprovincia' => 10],
            ['namedistrito' => 'UCO', 'fk_idprovincia' => 10],
            ['namedistrito' => 'HUARMEY', 'fk_idprovincia' => 11],
            ['namedistrito' => 'COCHAPETI', 'fk_idprovincia' => 11],
            ['namedistrito' => 'CULEBRAS', 'fk_idprovincia' => 11],
            ['namedistrito' => 'HUAYAN', 'fk_idprovincia' => 11],
            ['namedistrito' => 'MALVAS', 'fk_idprovincia' => 11],
            ['namedistrito' => 'CARAZ', 'fk_idprovincia' => 12],
            ['namedistrito' => 'HUATA', 'fk_idprovincia' => 12],
            ['namedistrito' => 'HUAYLAS', 'fk_idprovincia' => 12],
            ['namedistrito' => 'MATO', 'fk_idprovincia' => 12],
            ['namedistrito' => 'PAMPAROMAS', 'fk_idprovincia' => 12],
            ['namedistrito' => 'PUEBLO LIBRE', 'fk_idprovincia' => 12],
            ['namedistrito' => 'SANTA CRUZ', 'fk_idprovincia' => 12],
            ['namedistrito' => 'SANTO TORIBIO', 'fk_idprovincia' => 12],
            ['namedistrito' => 'YURACMARCA', 'fk_idprovincia' => 12],
            ['namedistrito' => 'PISCOBAMBA', 'fk_idprovincia' => 13],
            ['namedistrito' => 'CASCA', 'fk_idprovincia' => 13],
            ['namedistrito' => 'ELEAZAR GUZMAN BARRON', 'fk_idprovincia' => 13],
            ['namedistrito' => 'FIDEL OLIVAS ESCUDERO', 'fk_idprovincia' => 13],
            ['namedistrito' => 'LLAMA', 'fk_idprovincia' => 13],
            ['namedistrito' => 'LLUMPA', 'fk_idprovincia' => 13],
            ['namedistrito' => 'LUCMA', 'fk_idprovincia' => 13],
            ['namedistrito' => 'MUSGA', 'fk_idprovincia' => 13],
            ['namedistrito' => 'OCROS', 'fk_idprovincia' => 14],
            ['namedistrito' => 'ACAS', 'fk_idprovincia' => 14],
            ['namedistrito' => 'CAJAMARQUILLA', 'fk_idprovincia' => 14],
            ['namedistrito' => 'CARHUAPAMPA', 'fk_idprovincia' => 14],
            ['namedistrito' => 'COCHAS', 'fk_idprovincia' => 14],
            ['namedistrito' => 'CONGAS', 'fk_idprovincia' => 14],
            ['namedistrito' => 'LLIPA', 'fk_idprovincia' => 14],
            ['namedistrito' => 'SAN CRISTOBAL DE RAJAN', 'fk_idprovincia' => 14],
            ['namedistrito' => 'SAN PEDRO', 'fk_idprovincia' => 14],
            ['namedistrito' => 'SANTIAGO DE CHILCAS', 'fk_idprovincia' => 14],
            ['namedistrito' => 'CABANA', 'fk_idprovincia' => 15],
            ['namedistrito' => 'BOLOGNESI', 'fk_idprovincia' => 15],
            ['namedistrito' => 'CONCHUCOS', 'fk_idprovincia' => 15],
            ['namedistrito' => 'HUACASCHUQUE', 'fk_idprovincia' => 15],
            ['namedistrito' => 'HUANDOVAL', 'fk_idprovincia' => 15],
            ['namedistrito' => 'LACABAMBA', 'fk_idprovincia' => 15],
            ['namedistrito' => 'LLAPO', 'fk_idprovincia' => 15],
            ['namedistrito' => 'PALLASCA', 'fk_idprovincia' => 15],
            ['namedistrito' => 'PAMPAS', 'fk_idprovincia' => 15],
            ['namedistrito' => 'SANTA ROSA', 'fk_idprovincia' => 15],
            ['namedistrito' => 'TAUCA', 'fk_idprovincia' => 15],
            ['namedistrito' => 'POMABAMBA', 'fk_idprovincia' => 16],
            ['namedistrito' => 'HUAYLLAN', 'fk_idprovincia' => 16],
            ['namedistrito' => 'PAROBAMBA', 'fk_idprovincia' => 16],
            ['namedistrito' => 'QUINUABAMBA', 'fk_idprovincia' => 16],
            ['namedistrito' => 'RECUAY', 'fk_idprovincia' => 17],
            ['namedistrito' => 'CATAC', 'fk_idprovincia' => 17],
            ['namedistrito' => 'COTAPARACO', 'fk_idprovincia' => 17],
            ['namedistrito' => 'HUAYLLAPAMPA', 'fk_idprovincia' => 17],
            ['namedistrito' => 'LLACLLIN', 'fk_idprovincia' => 17],
            ['namedistrito' => 'MARCA', 'fk_idprovincia' => 17],
            ['namedistrito' => 'PAMPAS CHICO', 'fk_idprovincia' => 17],
            ['namedistrito' => 'PARARIN', 'fk_idprovincia' => 17],
            ['namedistrito' => 'TAPACOCHA', 'fk_idprovincia' => 17],
            ['namedistrito' => 'TICAPAMPA', 'fk_idprovincia' => 17],
            ['namedistrito' => 'CHIMBOTE', 'fk_idprovincia' => 18],
            ['namedistrito' => 'CACERES DEL PERU', 'fk_idprovincia' => 18],
            ['namedistrito' => 'COISHCO', 'fk_idprovincia' => 18],
            ['namedistrito' => 'MACATE', 'fk_idprovincia' => 18],
            ['namedistrito' => 'MORO', 'fk_idprovincia' => 18],
            ['namedistrito' => 'NEPEÑA', 'fk_idprovincia' => 18],
            ['namedistrito' => 'SAMANCO', 'fk_idprovincia' => 18],
            ['namedistrito' => 'SANTA', 'fk_idprovincia' => 18],
            ['namedistrito' => 'NUEVO CHIMBOTE', 'fk_idprovincia' => 18],
            ['namedistrito' => 'SIHUAS', 'fk_idprovincia' => 19],
            ['namedistrito' => 'ACOBAMBA', 'fk_idprovincia' => 19],
            ['namedistrito' => 'ALFONSO UGARTE', 'fk_idprovincia' => 19],
            ['namedistrito' => 'CASHAPAMPA', 'fk_idprovincia' => 19],
            ['namedistrito' => 'CHINGALPO', 'fk_idprovincia' => 19],
            ['namedistrito' => 'HUAYLLABAMBA', 'fk_idprovincia' => 19],
            ['namedistrito' => 'QUICHES', 'fk_idprovincia' => 19],
            ['namedistrito' => 'RAGASH', 'fk_idprovincia' => 19],
            ['namedistrito' => 'SAN JUAN', 'fk_idprovincia' => 19],
            ['namedistrito' => 'SICSIBAMBA', 'fk_idprovincia' => 19],
            ['namedistrito' => 'YUNGAY', 'fk_idprovincia' => 20],
            ['namedistrito' => 'CASCAPARA', 'fk_idprovincia' => 20],
            ['namedistrito' => 'MANCOS', 'fk_idprovincia' => 20],
            ['namedistrito' => 'MATACOTO', 'fk_idprovincia' => 20],
            ['namedistrito' => 'QUILLO', 'fk_idprovincia' => 20],
            ['namedistrito' => 'RANRAHIRCA', 'fk_idprovincia' => 20],
            ['namedistrito' => 'SHUPLUY', 'fk_idprovincia' => 20],
            ['namedistrito' => 'YANAMA', 'fk_idprovincia' => 20]
        ]);
        
        DB::table('personas')->insert([
            [
                'dni' => '12345678',
                'nombre' => 'Styve',
                'apellidos' => 'Enriquez Rondan',
                'telefono' => '981231231',
                'email' => 'styve@gmail.com',
            ]
        ]);

        DB::table('users')->insert([
            [
                'name' => 'text user',
                'email' => 'test@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'estado_usu' => '1',
                'fk_idpersona' => null,
                'fk_idtipousu' => '1',
                'intentos_fallidos' => '0',
            ],
            [
                'name' => 'Styve Enriquez Rondan',
                'email' => 'styve@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'estado_usu' => '1',
                'fk_idpersona' => '1',
                'fk_idtipousu' => '2',
                'intentos_fallidos' => '0',
            ],
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