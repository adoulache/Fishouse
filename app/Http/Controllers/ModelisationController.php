<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use View;

class ModelisationController extends Controller
{
    /**
     * Réinitialise un projet.
     */
    public function postReinitProjet(){
        $idProjet = $_POST['idProjet'];
        if (DB::table('projet_plante')->where('id_projet', $idProjet)->exists()) {
            DB::table('projet_plante')->where('id_projet',$idProjet)->delete();
        };
        if (DB::table('projet_decoration')->where('id_projet', $idProjet)->exists()) {
            DB::table('projet_decoration')->where('id_projet',$idProjet)->delete();
        };
    }
    
}
?>
