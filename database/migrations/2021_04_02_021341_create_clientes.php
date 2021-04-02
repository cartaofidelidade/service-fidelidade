<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('nome', 100);
            $table->string('email', 100)->unique();
            $table->string('senha', 100);

            $table->string('latitude', 100)->nullable();
            $table->string('longitude', 100)->nullable();

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
        Schema::dropIfExists('clientes');
    }
}
