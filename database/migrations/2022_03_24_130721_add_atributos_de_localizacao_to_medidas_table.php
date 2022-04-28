<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAtributosDeLocalizacaoToMedidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medidas', function (Blueprint $table) {
            $table->string('latitude')->nullable(false)->after('hectares');
            $table->string('longitude')->nullable(false)->after('latitude');
            $table->decimal('latitude_graus', 10, 8)->nullable(false)->default(0)->after('longitude'); 
            $table->decimal('longitude_graus', 11, 8)->nullable(false)->default(0)->after('latitude_graus');
            $table->decimal('latitude_minutos', 10, 8)->nullable(false)->default(0)->after('latitude_graus');
            $table->decimal('longitude_minutos', 11, 8)->nullable(false)->default(0)->after('longitude_graus');
            $table->decimal('latitude_segundos', 10, 8)->nullable(false)->default(0)->after('latitude_minutos');
            $table->decimal('longitude_segundos', 11, 8)->nullable(false)->default(0)->after('longitude_minutos');
            $table->integer('hemisferio')->nullable(false)->default(-1)->after('latitude_segundos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medidas', function (Blueprint $table) {
            //
        });
    }
}
