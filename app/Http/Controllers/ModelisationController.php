<?php

// $nomProjet = $_POST["nom"];
 
// // redirect to success page
// if ($success){
//    echo "success";
// }else{
//     echo "invalid";
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use View;

class ModelisationController extends Controller
{
    /**
     * Vérifie si un projet existe.
     *
     */
    public function getProjet(){
        if(DB::table('projets')->where('id_projet', $_GET['idProjet'])->exists()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Insert le nom du projet dans la base temporaire
     */
    public function postNom(){
        $nom = $_POST['nomProjet'];
        DB::table('projets_temp')
              ->where('id_projet', $idProjet)
              ->update(['nom_projet' => $nom]);
    }

    /**
     * Sauvegarde d'un projet
     */
    public function postSauveProjet(){
        //table projets (insertion)
        DB::table('projets')
            ->updateOrInsert(
                ['id_projet' => $idProjet],
                function($idProjet){
                    $val = DB::table('projet_temp')
                            ->select('id_bac','id_user','nom_projet','partage')
                            ->where('id_projet',$idProjet)
                            ->get();
                    return $val;
                }
            );
        //table temporaire des projets (suppression)
        DB::table('projet_temp')->where('id_projet',$idProjet)->delete();

        //table projet_plante (suppression)
        DB::table('projet_plante')->where('id_projet',$idProjet)->delete();
        //table projet_plante (insertion)
        DB::table('projet_plante')
            ->insert(
                function($idProjet){
                    $val = DB::table('projet_plante_temp')
                            ->select('id_plante','coordx','coordy','coordz')
                            ->where('id_projet',$idProjet)
                            ->get();
                    return $val;
                }
            );
        //table temporaire des projet_plante (suppression)
        DB::table('projet_plante_temp')->where('id_projet',$idProjet)->delete();

        //table projet_decoration (suppression)
        DB::table('projet_decoration')->where('id_projet',$idProjet)->delete();
        //table projet_decoration (insertion)
        DB::table('projet_decoration')
            ->insert(
                function($idProjet){
                    $val = DB::table('projet_decoration_temp')
                            ->select('id_decoration','coordx','coordy','coordz')
                            ->where('id_projet',$idProjet)
                            ->get();
                    return $val;
                }
            );
        //table temporaire des projet_deoration (suppression)
        DB::table('projet_decoration_temp')->where('id_projet',$idProjet)->delete();

        //table projet_bac (suppression)
        DB::table('projet_bac')->where('id_projet',$idProjet)->delete();
        //table projet_bac (insertion)
        DB::table('projet_bac')
            ->insert(
                function($idProjet){
                    $val = DB::table('projet_bac_temp')
                            ->select('id_aquarium')
                            ->where('id_projet',$idProjet)
                            ->get();
                    return $val;
                }
            );
        //table temporaire des projet_bac (suppression)
        DB::table('projet_bac_temp')->where('id_projet',$idProjet)->delete();

    }
    
}
?>