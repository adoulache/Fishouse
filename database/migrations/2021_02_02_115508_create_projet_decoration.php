<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetDecoration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet_decoration', function (Blueprint $table) {
            $table->integer('id_projet');
            $table->integer('id_decoration');
            $table->integer('coordx');
            $table->integer('coordy');
            $table->integer('coordz');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projet_decoration');
    }
}
