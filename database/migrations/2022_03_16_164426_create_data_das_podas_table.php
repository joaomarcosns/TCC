<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataDasPodasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_das_podas', function (Blueprint $table) {
            $table->id();
            $table->date('data_poda')->nullable(false)->comment("Data da poda");
            $table->unsignedBigInteger('setor_id')->nullable(false)->comment("ID da setor");
            $table->timestamps();
            $table->foreign('setor_id')->references('id')->on('setor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_das_podas');
    }
}
