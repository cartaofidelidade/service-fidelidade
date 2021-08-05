<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstabelecimentosPlanos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estabelecimentos_planos', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->date('data_fidelidade')->nullable();
            $table->tinyInteger('ativo')->default(1);

            $table->timestamp('data_cadastro')->useCurrent();
            $table->timestamp('data_alteracao')->useCurrent();

            $table->foreignUuid('estabelecimentos_id')->references('id')->on('estabelecimentos');
            $table->foreignUuid('planos_id')->references('id')->on('planos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estabelecimentos_planos');
    }
}
