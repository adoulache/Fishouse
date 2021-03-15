<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetPlantes3d extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet_plantes_3d', function (Blueprint $table) {
            $table->integer('id_projet');
            $table->integer('id_plante3d');
            $table->integer('coordx');
            $table->integer('coordy');
            $table->integer('coordz');
            $table->integer('rotationx');
            $table->integer('rotationy');
            $table->integer('rotationz');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projet_plantes_3d');
    }
}
