<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medidas', function (Blueprint $table) {
            $table->id();
            $table->double('altura_total', 10, 2)->nullable(true)->comment("Altura total da propriedade em relação ao mar");
            $table->double('largura_total', 10, 2)->nullable(true)->comment("Largura total da propriedade");
            $table->double('comprimento_total', 10, 2)->nullable(true)->comment("Comprimentos total da propriedade");
            $table->double('hectares', 10, 2)->nullable(true)->comment("Quantidade de hectares total da propriedade");
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
        Schema::dropIfExists('medidas');
    }
}
