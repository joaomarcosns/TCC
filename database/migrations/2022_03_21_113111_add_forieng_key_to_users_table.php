<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForiengKeyToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('perfil_id')->nullable(false)->comment("ID do perfil do usuário");
            $table->unsignedBigInteger('propriedade_id')->nullable(false)->comment("ID da propriedade do usuário");
            $table->foreign('perfil_id')->references('id')->on('perfil')->onDelete('cascade');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_perfil_id_foreign');
            $table->dropForeign('users_propriedade_id_foreign');
            $table->dropColumn('perfil_id');
            $table->dropColumn('propriedade_id');
        });
    }
}
