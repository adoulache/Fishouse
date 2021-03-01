<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantesTable extends Migration
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
            $table->string('titre');
            $table->string('titre_latin');
            $table->string('description');
            $table->string('facilite');
            $table->string('nom_photo');
            $table->string('tag');
            $table->string('type_eau');
            $table->float('prix');
            $table->string('taille');
        });

        // Décoration 1 : ceratophyllum demersum 
        DB::table('plantes')->insert(array(
            'nom' => "cornifle",
            'nom_latin' => "ceratophyllum_demersum",
            'titre' => 'Cornifle',
            'titre_latin' => 'Ceratophyllum Demersum',
            'description' => "Espèce de plantes aquatiques supportant des températures d'eau de 18 à 22°C, et un pH de 6 à 9 (Source : Wikipédia).",
            'facilite' => "facile",
            'nom_photo' => "cornifle.png",
            'tag' => "plante",
            'type_eau' => "toutes", //pour salée et douce
            'prix' => 3.99,
            'taille' => "20",
        ));

        // Décoration 2 : anubias barteri
        DB::table('plantes')->insert(array(
            'nom' => "anubias_de_barter",
            'nom_latin' => "anubias_barteri",
            'titre' => 'Anubias de Barter',
            'titre_latin' => 'Anubias Barteri',
            'description' => "Plante d'origine d'Afrique à ne surtout pas planter mais à attacher sur un élément de décoration (Source : Aquas).",
            'facilite' => "facile",
            'nom_photo' => "anubias.png",
            'tag' => "anubias",
            'type_eau' => "douce",
            'prix' => 6.90,
            'taille' => "30",
        ));

    
        // Décoration 3 : posidonie 
        DB::table('plantes')->insert(array(
            'nom' => "posidonie",
            'nom_latin' => "posidoniaceae",
            'titre' => 'Posidonie',
            'titre_latin' => 'Posidoniaceae',
            'description' => "Plantes à fleurs monocotylédones sous marines (Source : Wikipédia).",
            'facilite' => "moyenne",
            'nom_photo' => "posidonie.png",
            'tag' => "posidonie",
            'type_eau' => "salee",
            'prix' => 8.85,
            'taille' => "35",
        ));

        // Décoration 4 : Alternanthera rosaefolia
        DB::table('plantes')->insert(array(
            'nom' => "etoile_des_marais",
            'nom_latin' => "alternanthera_rosaefolia",
            'titre' => 'Etoile des marais',
            'titre_latin' => 'Alternanthera Rosaefolia',
            'description' => "Alternanthera rosaefolia mini est une plante est l'une des seule plante d'aquarium d'avant-plan avec un feuillage de couleur rouge. Ses feuilles d'un rouge éclatant nécessitent un fort éclairage (Source : AquaStore).",
            'facilite' => "moyen",
            'nom_photo' => "alternanthera.png",
            'tag' => "alternanthera",
            'type_eau' => "douce",
            'prix' => 4.99,
            'taille' => "20",
        ));

        // Décoration 5 : ammania pedicellata
        DB::table('plantes')->insert(array(
            'nom' => "ammania",
            'nom_latin' => "ammania_pedicellata",
            'titre' => 'Ammania',
            'titre_latin' => 'Ammania Pedicellata',
            'description' => "Ammania pedicellata gold est une plante d'aquarium pouvant atteindre les 50 cm, qui convient à la fois au milieu et à l'arrière plan. Les tiges gardent une couleur brun-rouge qui contraste avec celle du feuillage (Source : AquaStore).",
            'facilite' => "moyenne",
            'nom_photo' => "ammania.png",
            'tag' => "ammania",
            'type_eau' => "douce",
            'prix' => 5.95,
            'taille' => "30",
        ));

        // Décoration 6 : Bacopa amplexicaulis 
        DB::table('plantes')->insert(array(
            'nom' => "bacopa",
            'nom_latin' => "bacopa_amplexicaulis",
            'titre' => 'Bacopa',
            'titre_latin' => 'Bacopa Amplexicaulis',
            'description' => "Bacopa amplexicaulis est une plante d'aquarium facile à croissance rapide avec un feuillage robuste de couleur verte. Elle appréciera les sols riches en nutriments et elle pourra dans certains cas atteindre 40 cm de hauteur (Source : AquaStore).",
            'facilite' => "facile",
            'nom_photo' => "bacopa.png",
            'tag' => "bacopa",
            'type_eau' => "douce",
            'prix' => 11.99,
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
        Schema::dropIfExists('plantes');
    }
}
