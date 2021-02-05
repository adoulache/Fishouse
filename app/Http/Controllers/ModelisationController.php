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
     *
     * @param  string  $idProjet
     */
    public function postReinitProjet(){
        // if (isset($_POST['id']){
        // }
        DB::table('projet_plante')->where('id_projet', '=', $idProjet)->delete();
        //return(View("modelisation.blade.php"))
        return view("modelisation");
    }
    
}
