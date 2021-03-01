<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetDecorationTemp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet_decoration_temp', function (Blueprint $table) {
            $table->integer('id_projet');
            $table->integer('id_decoration');
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
        Schema::dropIfExists('projet_decoration_temp');
    }
}
