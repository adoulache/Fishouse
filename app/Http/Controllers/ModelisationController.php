<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use View;

class ModelisationController extends Controller
{
    /**
     * Réinitialise un projet.
     */
    public function postReinitProjet()
    {
        $idProjet = $_POST['idProjet'];
        if (DB::table('projet_plante')->where('id_projet', $idProjet)->exists()) {
            DB::table('projet_plante')->where('id_projet', $idProjet)->delete();
        };
        if (DB::table('projet_decoration')->where('id_projet', $idProjet)->exists()) {
            DB::table('projet_decoration')->where('id_projet', $idProjet)->delete();
        };
    }

    /**
     * Vérifie si un projet existe.
     */
    public function getProjet()
    {
        if (DB::table('projets')->where('id_projet', $_GET['idProjet'])->exists()) {
            // $response = new JsonResponse();
            // $response->setData(array('rep'=> 1));
            // echo $response;
            //return '1';
            return response()->json(['response' => 'existe']);
        } else {
            //echo json_encode(-1);
            // echo '-1';
            // return '-1';
            return response()->json(['response' => 'introuvable']);
        }
    }

    /**
     * Insert le nom du projet dans la base temporaire
     */
    public function postNom()
    {
        $nom = $_POST['nomProjet'];
        $idProjet = $_POST['idProjet'];
        DB::table('projets_temp')
            ->where('id_projet', $idProjet)
            ->update(['nom_projet' => $nom]);
    }

    /**
     * Sauvegarde d'un projet
     */
    public function postSauveProjet()
    {
        $idProjet = $_POST['idProjet'];

        if (DB::table('projets_temp')->where('id_projet', $idProjet)->exists()) {
            //table projets (insertion)
            $val = DB::table('projets_temp')->where('id_projet', $idProjet)->first();

            DB::table('projets')
                ->updateOrInsert(
                    ['id_projet' => $idProjet],
                    ['id_bac' => $val->id_bac, 'id_user' => $val->id_user, 'nom_projet' => $val->nom_projet, 'partage' => $val->partage]
                );

            //table temporaire des projets (suppression)
            DB::table('projets_temp')->where('id_projet', $idProjet)->delete();
        }

        if (DB::table('projet_plante_temp')->where('id_projet', $idProjet)->exists()) {
            //table projet_plante (suppression)
            DB::table('projet_plante')->where('id_projet', $idProjet)->delete();

            //table projet_plante (insertion)
            $valPlante = DB::table('projet_plante_temp')->where('id_projet', $idProjet)->get();

            foreach ($valPlante as $plante) {
                DB::table('projet_plante')
                    ->insert(['id_projet' => $plante->id_projet, 'id_plante' => $plante->id_plante, 'coordx' => $plante->coordx, 'coordy' => $plante->coordy, 'coordz' => $plante->coordz]);
            };

            //table temporaire des projet_plante (suppression)
            DB::table('projet_plante_temp')->where('id_projet', $idProjet)->delete();
        }

        if (DB::table('projet_decoration_temp')->where('id_projet', $idProjet)->exists()) {
            //table projet_decoration (suppression)
            DB::table('projet_decoration')->where('id_projet', $idProjet)->delete();

            //table projet_decoration (insertion)
            $valDeco = DB::table('projet_decoration_temp')->where('id_projet', $idProjet)->get();

            foreach ($valDeco as $deco) {
                DB::table('projet_decoration')
                    ->insert(['id_projet' => $deco->id_projet, 'id_decoration' => $deco->id_decoration, 'coordx' => $deco->coordx, 'coordy' => $deco->coordy, 'coordz' => $deco->coordz]);
            };

            //table temporaire des projet_deoration (suppression)
            DB::table('projet_decoration_temp')->where('id_projet', $idProjet)->delete();
        }

        if (DB::table('projet_aquarium_temp')->where('id_projet', $idProjet)->exists()) {

            //table projet_bac (suppression)
            DB::table('projet_aquarium')->where('id_projet', $idProjet)->delete();

            //table projet_bac (insertion)
            $valBac = DB::table('projet_aquarium_temp')->where('id_projet', $idProjet)->get();

            foreach ($valBac as $bac) {
                DB::table('projet_aquarium')
                    ->insert(['id_projet' => $bac->id_projet, 'id_aquarium' => $bac->id_aquarium]);
            };

            //table temporaire des projet_bac (suppression)
            DB::table('projet_aquarium_temp')->where('id_projet', $idProjet)->delete();

        }
    }
}

?>
