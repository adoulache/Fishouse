<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bacs', function (Blueprint $table) {
            $table->increments('id_bac');
            $table->string('nom');
            $table->string('titre');
            $table->string('description');
            $table->string('nom_photo');
            $table->float('prix');
            $table->string('taille');
        });

        DB::table('bacs')->insert(array(
            
            'nom' => 'bac_carre',
            'titre' => 'Bac carré',
            'description' => "Bac aquarium de forme carrée.",
            'nom_photo' => 'aquariumCarre.png',
            'prix' => 50,
            'taille' => "50x50"
        ));
    
        DB::table('bacs')->insert(array(
            
            'nom' => 'bac_rectangle',
            'titre' => 'Bac rectangulaire',
            'description' => "Bac aquarium rectangulaire.",
            'nom_photo' => 'aquariumRectangle.png',
            'prix' => 100,
            'taille' => "120x140x50"
        ));
    
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bacs');
    }
}
