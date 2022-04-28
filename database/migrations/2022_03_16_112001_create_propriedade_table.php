<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropriedadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propriedade', function (Blueprint $table) {
            $table->id();
            $table->string('nome_proprietario')->nullable(false);
            $table->string('nome_propriedade')->nullable(false);
            $table->string('rua')->nullable(false);
            $table->string('numero', 10)->nullable(false);
            $table->string('bairro', 150)->nullable(false);
            $table->string('cidade', 150)->nullable(false);
            $table->string('cep', 9)->nullable(false);
            $table->string('estado', 2)->nullable(false)->comment("Unidade Ferderativa (UF)");
            $table->unsignedBigInteger('medida_id')->nullable(false)->comment("ID das medidas da proprietário");
            $table->timestamps();

            $table->foreign('medida_id')->references('id')->on('medidas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propriedade');
    }
}
