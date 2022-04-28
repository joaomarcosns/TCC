<?php

namespace Database\Seeders;

use App\Models\Plantas;
use Illuminate\Database\Seeder;

class PlantasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Plantas::create([
            'nome' => 'Uva',
            'temperatura_base' => 10,
            'grupo_planta_id' => 1,
        ]);

        Plantas::create([
            'nome' => 'Milho',
            'temperatura_base' => 10,
            'grupo_planta_id' => 2,
        ]);


        Plantas::create([
            'nome' => 'Manga',
            'temperatura_base' => 13,
            'grupo_planta_id' => 3,
        ]);
    }
}
