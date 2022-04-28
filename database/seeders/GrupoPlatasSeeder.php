<?php

namespace Database\Seeders;

use App\Models\GrupoPlantas;
use Illuminate\Database\Seeder;

class GrupoPlatasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grupo1 = new GrupoPlantas();
        $grupo1->nome = 'Grupo 1';
        $grupo1->descricao = 'Grupo de plantas 1';
        $grupo1->save();

        $grupo2 = new GrupoPlantas();
        $grupo2->nome = 'Grupo 2';
        $grupo2->descricao = 'Grupo de plantas 2';
        $grupo2->save();
        
        $grupo3 = new GrupoPlantas();
        $grupo3->nome = 'Grupo 3';
        $grupo3->descricao = 'Grupo de plantas 3';
        $grupo3->save();
    }
}
