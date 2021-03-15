<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantes3d extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantes_3d', function (Blueprint $table) {
            $table->increments('id_plante3d');
            $table->string('nom');
            $table->string('titre');
            $table->string('description');
            $table->string('facilite');
            $table->string('nom_objet');
            $table->string('tag');
            $table->string('type_eau');
            $table->float('prix');
            $table->string('taille');
        });

        // Plante 1 : Leaves 
        DB::table('plantes_3d')->insert(array(
            'nom' => "feuilles",
            'titre' => 'Feuilles',
            'description' => "Jolies petites feuilles vertes.",
            'facilite' => "facile",
            'nom_objet' => "Leaves",
            'tag' => "feuilles",
            'type_eau' => "toutes", //pour salée et douce
            'prix' => 3.99,
            'taille' => "15",
        ));

        // Plante 2 : Couronne d'épines 
        DB::table('plantes_3d')->insert(array(
            'nom' => "couronne_epines",
            'titre' => "Couronne d'épines",
            'description' => "Etoile de mer couronne d'épines, corallivore naturel sur les récifs coralliens (Source : reefresilience.org).",
            'facilite' => "facile",
            'nom_objet' => "Xfrogplants",
            'tag' => "couronne",
            'type_eau' => "toutes", //pour salée et douce
            'prix' => 6.99,
            'taille' => "15",
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantes_3d');
    }
}
