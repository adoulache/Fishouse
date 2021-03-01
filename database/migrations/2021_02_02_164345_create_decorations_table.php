<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecorationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decorations', function (Blueprint $table) {
            $table->increments('id_decoration');
            $table->string('nom');
            $table->string('titre');
            $table->string('description');
            $table->string('nom_photo');
            $table->string('tag');
            $table->float('prix');
            $table->string('taille');
        });


        // Décoration 1 : bois 
        DB::table('decorations')->insert(array(
            'nom' => 'bois',
            'titre' => 'Morceau de bois',
            'description' => "Morceau de bois pour aquarium.",
            'nom_photo' => 'bois.png',
            'tag' => 'bois',
            'prix' => 8.99,
            'taille' => "20"
        ));

        // Décoration 2 : bois usé
        DB::table('decorations')->insert(array(
            'nom' => 'bois_use',
            'titre' => 'Bois usé',
            'description' => "Morceau de bois usé pour aquarium.",
            'nom_photo' => 'boisUse.png',
            'tag' => 'bois',
            'prix' => 10.99,
            'taille' => "25"
        ));

    
        // Décoration 3 : bois lisse 
        DB::table('decorations')->insert(array(
            'nom' => 'bois_lisse',
            'titre' => 'Bois lisse',
            'description' => "Morceau de bois lisse pour aquarium.",
            'nom_photo' => 'boisLisse.png',
            'tag' => 'bois',
            'prix' => 6.99,
            'taille' => "30"
        ));

        // Décoration 4 : tonneau
        DB::table('decorations')->insert(array(
            'nom' => 'tonneau',
            'titre' => 'Tonneau',
            'description' => "Tonneau pour aquarium.",
            'nom_photo' => 'tonneau.png',
            'tag' => 'tonneau',
            'prix' => 12.99,
            'taille' => "40"
        ));

        // Décoration 5 : petite île
        DB::table('decorations')->insert(array(
            'nom' => 'ile',
            'titre' => 'Ile',
            'description' => "Petite île pour aquarium.",
            'nom_photo' => 'ile.png',
            'tag' => 'ile',
            'prix' => 4.99,
            'taille' => "10"
        ));

        // Décoration 6 : chaussure usée avec fleur et escargot 
        DB::table('decorations')->insert(array(
            'nom' => 'chaussure',
            'titre' => 'Chaussure',
            'description' => "Chaussure pour aquarium.",
            'nom_photo' => 'chaussure.png',
            'tag' => 'chaussure',
            'prix' => 6.99,
            'taille' => "20"
        ));

        // Décoration 7 : petit pont 
        DB::table('decorations')->insert(array(
            'nom' => 'pont',
            'titre' => 'Pont',
            'description' => "Pont pour aquarium.",
            'nom_photo' => 'pont.png',
            'tag' => 'pont',
            'prix' => 8.99,
            'taille' => "30"
        ));
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('decorations');
    }
}
