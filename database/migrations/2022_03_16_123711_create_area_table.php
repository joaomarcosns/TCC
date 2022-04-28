<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100)->nullable(false)->comment("Nome da área");
            $table->text('descricao', 255)->nullable(true)->comment("Descrição da área");
            $table->unsignedBigInteger('propriedade_id')->nullable(false)->comment("ID da setor");
            $table->timestamps();
            $table->foreign('propriedade_id')->references('id')->on('propriedade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kc_area');
    }
}
