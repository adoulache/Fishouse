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
            $table->string('description');
            $table->string('nom_photo');
            $table->float('prix');
            $table->string('taille');
        });

        DB::table('bacs')->insert(array(
            
            'nom' => 'bac_rond',
            'description' => "Bac aquarium rond.",
            'nom_photo' => 'aquariumRond.png',
            'prix' => 50,
            'taille' => "25x22"
        ));
    
        DB::table('bacs')->insert(array(
            
            'nom' => 'bac_rectangle',
            'description' => "Bac aquarium rectangle.",
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
