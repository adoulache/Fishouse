<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetPlanteTemp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet_plante_temp', function (Blueprint $table) {
            $table->integer('id_projet');
            $table->string('id_unique');
            $table->integer('id_plante');
            $table->integer('coordx');
            $table->integer('coordy');
            $table->integer('coordz');
            $table->integer('rotation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projet_plante_temp');
    }
}
