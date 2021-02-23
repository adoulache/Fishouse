<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use View;

header('Content-Type: text/html; charset=ISO-8859-15');

class ProjectController extends Controller
{
    public function newAquarium(){

        //Images des bacs
        $listeBacs = DB::table('bacs')
            ->select(['description', 'nom_photo', 'prix', 'taille', 'nom', 'id_bac'])
            ->get();

        return view('projet', ['listeBacs' => $listeBacs]);
    }

    public function addProject(Request $request)
    {
        //Id de l'utilisateur courant
        $idUser = Auth::id();

        //Id du dernier projet existant
        $idProjet = DB::table('projets') -> max('id_projet'); // WARNING : La requete recupère toujours 1 !!!
        if (is_null($idProjet)){
            $idProjet = 0;
        }

        $idNewProjet = $idProjet + 1;

        $idBac = $request->idBack;

        //Insertion dans la BDD
        DB::table('projets_temp')
            ->insert([
                'id_projet' => $idNewProjet,
                'id_bac' => $idBac,
                'id_user' => 1, //Après le merge il faut remplacer le 1 par $idUser
                'nom_projet' => "test".$idNewProjet,
                'partage' => false
        ]);

        return response()->json(['success'=>'Got Simple Ajax Request.']);
    }

    /*public function shareProject($idProject)
    {
        $affected = DB::update(
            'update projet set partage = ',true,' where name = ?',
            [$idProject]
        );
    } */
}

?>
