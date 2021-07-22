<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampanhas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanhas', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('nome');
            $table->tinyInteger('tipo')->default(0)->comment('0 - pontos, 1 - carimbos');

            $table->integer('pontos')->nullable();
            $table->integer('quantidade_carimbos')->nullable();
            $table->integer('limite_carimbos_dia')->nullable()->default(0);

            $table->date('data_inicio')->nullable(false);
            $table->date('data_final')->nullable(false);

            $table->text('descricao')->nullable();

            $table->string('imagem_carimbo_preenchido', 255)->nullable();
            $table->string('imagem_carimbo_vazio', 255)->nullable();

            $table->tinyInteger('ativo')->default(1);

            $table->timestamp('data_cadastro', 0);
            $table->timestamp('data_alteracao', 0);

            $table->foreignUuid('estabelecimentos_id')->references('id')->on('estabelecimentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campanhas');
    }
}
