<?php

namespace App\Console\Commands;

use App\Http\Controllers\api\v1\EstacaoController;
use App\Models\GDD;
use Illuminate\Console\Command;

class GDDDeHoje extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GDDDeHoje:verificar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Capturar GDD de hoje';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $gdd = EstacaoController::gdd();
        try {
            GDD::create([
                'gdd' => $gdd
            ]);
            
        } catch (\Exception $e) {
            echo $e->getMessage();	
        }
        echo "GDD de hoje: " . $gdd . "\n";
        
    }
}
