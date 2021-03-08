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

    public function Aquarium()
    {
        //Id de l'utilisateur courant
        $idUser = Auth::id();

        //Liste des projets existants
        $listeProjets = DB::table('projets')
            ->select(['id_projet', 'id_bac', 'id_user', 'nom_projet', 'partage'])
            ->where('id_user', $idUser) //remettre au propre avec $idUser
            ->get();

        //Images des bacs
        $listeBacs = DB::table('bacs')
            ->select(['description', 'titre', 'nom_photo', 'prix', 'taille', 'nom', 'id_bac'])
            ->get();

        return view('projet', ['listeBacs' => $listeBacs, 'listeProjets' => $listeProjets]);
    }

    public function deleteProject(Request $request)
    {
        $idProjet = $request->idSuppresion;

        if (DB::table('projets')->where('id_projet', $idProjet)->exists()) {
            DB::table('projets')->where('id_projet', $idProjet)->delete();
        };

        return redirect()->route('projet');
    }

    public function renameProject(Request $request)
    {
        $idProjet = $request->idRenomme;
        $newName = $request->newName;

        if (DB::table('projets')->where('id_projet', $idProjet)->exists()) {
            DB::table('projets')->where('id_projet', $idProjet)->update(['nom_projet' => $newName]);
        };

        return redirect()->route('projet');
    }

    public function shareProject(Request $request)
    {
        $idProjet = $request->idPartage;

        if (DB::table('projets')->where('id_projet', $idProjet)->exists()) {
            DB::table('projets')->where('id_projet', $idProjet)->update(['partage' => true]);
        };

        return redirect()->route('projet');
    }

    public function addProject(Request $request)
    {
        //Id de l'utilisateur courant
        $idUser = Auth::id();

        //Id du dernier projet existant
        $idProjet = DB::table('projets') -> max('id_projet');
        $idProjetTemp = DB::table('projets_temp') -> max('id_projet');
        if (is_null($idProjet) && is_null($idProjetTemp)){
            $idProjet = 0;
        }

        $idNewProjet = max($idProjet, $idProjetTemp) + 1;

        $idBac = $request->idBack;

        //Insertion dans la BDD
        DB::table('projets_temp')
            ->insert([
                'id_projet' => $idNewProjet,
                'id_bac' => $idBac,
                'id_user' => $idUser, //Après le merge il faut remplacer le 1 par $idUser
                'nom_projet' => "projet_".$idNewProjet,
                'partage' => false
        ]);

        return view('modelisation', ['idProjet' => $idNewProjet, 'nomProjet' => "projet_".$idNewProjet]);
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
