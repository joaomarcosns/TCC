<?php

namespace App\Console\Commands;

use App\Http\Controllers\api\v1\EstacaoController;
use App\Models\ET0;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EToDeHj extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'EToDeHj:verificar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listar ETo (evatraspiração) de hoje';

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
        $eto  = EstacaoController::et0();

        try {
            ET0::create([
                'et0' => $eto
            ]);
            echo "ETo de hoje: $eto\n";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
