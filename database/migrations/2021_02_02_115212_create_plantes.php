<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantes', function (Blueprint $table) {
            $table->increments('id_plante');
            $table->string('nom');
            $table->string('nom_latin');
            $table->string('description');
            $table->string('facilite');
            $table->string('nom_photo');
            $table->string('tag');
            $table->string('type_eau');
            $table->float('prix');
            $table->string('taille');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantes');
    }
}
