<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartelas', function (Blueprint $table) {
            $table->uuid('id')->primary()->nullable(false);

            $table->tinyInteger('ativo')->default(1);

            $table->timestamps();

            $table->foreignUuid('campanhas_id')->references('id')->on('campanhas');
            $table->foreignUuid('clientes_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartelas');
    }
}
