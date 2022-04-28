<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatecontatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->string('telefone', 15)->nullable(false)->comment("Telefone do propriedade");
            $table->string('email', 100)->nullable(true)->comment("email do propriedade");
            $table->unsignedBigInteger('propriedade_id')->nullable(false)->comment("ID da propriedade");
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
        Schema::dropIfExists('pcontatos');
    }
}
