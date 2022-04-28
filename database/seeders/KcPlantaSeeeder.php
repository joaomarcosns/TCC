<?php

namespace Database\Seeders;

use App\Models\KcPlanta;
use Illuminate\Database\Seeder;

class KcPlantaSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KcPlanta::create([
            'cultura' => 'Uva Isabel',
            'kc_poda' => 0.30,
            'dias_poda' => 42,
            'kc_cescimento' => 0.85,
            'dias_cescimento' => 83,
            'kc_producao' => 0.45,
            'dias_producao' => 50,
        ]);
    }
}
