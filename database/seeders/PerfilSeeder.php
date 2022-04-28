<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::create([
            'perfil' => 'Administrador',
            'nivel_acesso' => 1,
        ]);

        Perfil::create([
            'perfil' => 'Funciónario',
            'nivel_acesso' => 2,
        ]);
    }
}
