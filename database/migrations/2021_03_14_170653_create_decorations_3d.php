<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecorations3d extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decorations_3d', function (Blueprint $table) {
            $table->increments('id_decoration3d');
            $table->string('nom');
            $table->string('titre');
            $table->string('description');
            $table->string('nom_objet');
            $table->string('tag');
            $table->float('prix');
            $table->string('taille');
        });

        // Décoration 1 : Château  
        DB::table('decorations_3d')->insert(array(
            'nom' => 'chateau',
            'titre' => 'Château',
            'description' => "Château pour aquarium.",
            'nom_objet' => 'Aquarium_Castle',
            'tag' => 'chateau',
            'prix' => 14.99,
            'taille' => "20"
        ));

        // Décoration 2 : Plongeur  
        DB::table('decorations_3d')->insert(array(
            'nom' => 'plongeur',
            'titre' => 'Plongeur',
            'description' => "Plongeur pour aquarium.",
            'nom_objet' => 'Aquarium_Deep_Sea_Diver',
            'tag' => 'plongeur',
            'prix' => 12.99,
            'taille' => "10"
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('decorations_3d');
    }
}
