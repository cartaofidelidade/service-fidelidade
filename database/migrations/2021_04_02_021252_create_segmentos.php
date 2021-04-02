<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegmentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('segmentos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome', 100);
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
        Schema::dropIfExists('segmentos');
    }
}
