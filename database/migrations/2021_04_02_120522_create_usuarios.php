<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->smallInteger('origem')->default(1)->comment('1 - estabelecimento, 2 - cliente');
            $table->uuid('origem_id');
            $table->string('login', 100);
            $table->string('senha', 100);

            $table->tinyInteger('ativo')->default(1);
            $table->timestamp('data_cadastro', 0);
            $table->timestamp('data_alteracao', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
