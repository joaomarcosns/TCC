<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKcPlantaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kc_planta', function (Blueprint $table) {
            $table->id();
            $table->string('cultura', 100)->nullable(false)->comment("Nome da planta");
            $table->double('kc_poda', 8,2)->nullable(false)->comment("Coeficiente de crecimiento da planta na poda");
            $table->tinyInteger('dias_poda')->nullable(false)->comment("Quantidade de dias de nivel de poda");
            $table->double('kc_cescimento', 8,2)->nullable(false)->comment("Coeficiente de crecimiento da planta no cescimento");
            $table->tinyInteger('dias_cescimento')->nullable(false)->comment("Quantidade de dias de nivel de cescimento");
            $table->double('kc_producao', 8,2)->nullable(false)->comment("Coeficiente de crecimiento da planta na produção");
            $table->tinyInteger('dias_producao')->nullable(false)->comment("Quantidade de dias de nivel de producao");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kc_planta');
    }
}
