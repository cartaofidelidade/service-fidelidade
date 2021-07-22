<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartelasHistorico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartelas_historico', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->integer('quantidade');

            $table->tinyInteger('ativo')->default(1);

            $table->timestamp('data_cadastro', 0);
            $table->timestamp('data_alteracao', 0);

            $table->foreignUuid('cartelas_id')->references('id')->on('cartelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartelas_historico');
    }
}
