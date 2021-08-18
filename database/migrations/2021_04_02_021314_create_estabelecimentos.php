<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstabelecimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estabelecimentos', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->tinyInteger('tipo_pessoa')->default(2)->comment('1 física, 2 jurídica');

            $table->string('nome', 100)->nullable();
            $table->string('nome_fantasia', 100)->nullable();
            $table->string('documento', 20)->nullable();

            $table->string('email', 100)->unique();
            $table->string('celular', 15)->nullable();
            $table->string('telefone', 15)->nullable();

            $table->string('facebook', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('site', 255)->nullable();

            $table->string('cep', 8)->nullable();
            $table->string('logradouro', 100)->nullable();
            $table->integer('numero')->nullable();
            $table->string('complemento', 100)->nullable();
            $table->string('bairro', 100)->nullable();

            $table->string('senha', 50)->nullable(false)->nullable();
            $table->string('logomarca', 255)->nullable();

            $table->tinyInteger('ativo')->default(1)->nullable();

            $table->timestamp('data_cadastro')->useCurrent();
            $table->timestamp('data_alteracao')->useCurrent();

            $table->uuid('estados_id')->nullable();
            $table->uuid('cidades_id')->nullable();
            $table->uuid('segmentos_id')->nullable();

            $table->foreign('estados_id')->references('id')->on('estados');
            $table->foreign('cidades_id')->references('id')->on('cidades');
            $table->foreign('segmentos_id')->references('id')->on('segmentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estabelecimentos');
    }
}
