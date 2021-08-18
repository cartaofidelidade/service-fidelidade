<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataExpiracao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tokens_usuarios', function (Blueprint $table) {
            $table->dateTime('data_expiracao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tokens_usuarios', function (Blueprint $table) {
            $table->dropColumn('data_expiracao');
        });
    }
}
