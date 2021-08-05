<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planos', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('nome', 100)->nullable();
            $table->text('descricao')->nullable();

            $table->smallInteger('prazo_fidelidade')->default(1)->comment('1 - 7 Dias, 2 - 14 Dias,  3 - Sem prazo de fidelidade');

            $table->float('valor', 10, 2)->default(0);
            $table->float('valor_desconto', 10, 2)->default(0)->nullable();

            $table->tinyInteger('ativo')->default(1);

            $table->timestamp('data_cadastro')->useCurrent();
            $table->timestamp('data_alteracao')->useCurrent();

            $table->foreignUuid('produtos_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planos');
    }
}
