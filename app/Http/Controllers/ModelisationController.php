<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use View;

class ModelisationController extends Controller
{
    //OUVERTURE D'UN PROJET EXISTANT (via bouton Modifier de la page des projets)
    public function openProject($id, $name)
    {
        //Id de l'utilisateur courant
        $idUser = Auth::id();

        //Données du projet existant
        $Projet = DB::table('projets')
            ->select(['id_projet', 'id_bac', 'id_user', 'nom_projet', 'partage'])
            ->where('id_projet', $id)
            ->get();

        //Copie des données du projet dans la table temporaire des projets
        DB::table('projets_temp')
            ->insert([
                'id_projet' => $Projet[0]->id_projet,
                'id_bac' => $Projet[0]->id_bac,
                'id_user' => $Projet[0]->id_user,
                'nom_projet' => $Projet[0]->nom_projet,
                'partage' => $Projet[0]->partage
            ]);

        $idNewProjet = $Projet[0]->id_projet;
        $nomProjet = $Projet[0]->nom_projet;

        //Données de l'aquarium, relatif au projet existant
        if (DB::table('projet_aquarium')->where('id_projet', $id)->exists()) {
            $ProjetAquarium = DB::table('projet_aquarium')
                ->select(['id_projet', 'id_aquarium'])
                ->where('id_projet', $id)
                ->get();

            //Copie des données du projet dans la table temporaire des projets
            DB::table('projet_aquarium_temp')
                ->insert([
                    'id_projet' => $ProjetAquarium[0]->id_projet,
                    'id_aquarium' => $ProjetAquarium[0]->id_aquarium,
                ]);
        };

        //Données de l'aquarium, relatif au projet existant
        if (DB::table('projet_decoration')->where('id_projet', $id)->exists()) {
            $ProjetDecoration = DB::table('projet_decoration')
                ->select(['id_projet', 'id_decoration', 'coordx', 'coordy', 'coordz', 'rotation'])
                ->where('id_projet', $id)
                ->get();

            //Copie des données du projet dans la table temporaire des projets
            DB::table('projet_decoration_temp')
                ->insert([
                    'id_projet' => $ProjetDecoration[0]->id_projet,
                    'id_unique' => $ProjetDecoration[0]->id_unique,
                    'id_decoration' => $ProjetDecoration[0]->id_decoration,
                    'coordx' => $ProjetDecoration[0]->coordx,
                    'coordy' => $ProjetDecoration[0]->coordy,
                    'coordz' => $ProjetDecoration[0]->coordz,
                    'rotation' => $ProjetDecoration[0]->rotation
                ]);
        };

        //Données de l'aquarium, relatif au projet existant
        if (DB::table('projet_plante')->where('id_projet', $id)->exists()) {
            $ProjetPlante = DB::table('projet_plante')
                ->select(['id_projet', 'id_unique', 'id_plante', 'coordx', 'coordy', 'coordz', 'rotation'])
                ->where('id_projet', $id)
                ->get();

            //Copie des données du projet dans la table temporaire des projets
            DB::table('projet_plante_temp')
                ->insert([
                    'id_projet' => $ProjetPlante[0]->id_projet,
                    'id_plante' => $ProjetPlante[0]->id_plante,
                    'coordx' => $ProjetPlante[0]->coordx,
                    'coordy' => $ProjetPlante[0]->coordy,
                    'coordz' => $ProjetPlante[0]->coordz,
                    'rotation' => $ProjetPlante[0]->rotation
                ]);
        };

        $listeDecorations = DB::table('decorations')
            ->select(['id_decoration', 'nom', 'titre', 'description', 'nom_photo', 'tag', 'prix', 'taille'])
            ->get();

        $listePlantes = DB::table('plantes')
            ->select(['id_plante', 'nom_latin', 'titre', 'titre_latin', 'description', 'nom_photo', 'tag', 'prix', 'taille'])
            ->get();

        $listeDecorations3D = DB::table('decorations_3d')
            ->select(['id_decoration3d', 'nom', 'titre', 'description', 'nom_objet', 'tag', 'prix', 'taille'])
            ->get();

        $listePlantes3D = DB::table('plantes_3d')
            ->select(['id_plante3d', 'nom', 'titre', 'description', 'nom_objet', 'tag', 'prix', 'taille'])
            ->get();

        return view('modelisation', ['idNewProjet' => $idNewProjet, 'nomProjet' => $nomProjet,'listeDecorations' => $listeDecorations, 'listePlantes' => $listePlantes, 'listeDecorations3D' => $listeDecorations3D, 'listePlantes3D' => $listePlantes3D]);
    }

    public function addProject(Request $request)
    {
        //Id de l'utilisateur courant
        $idUser = Auth::id();

        //Id du dernier projet existant
        $idProjet = DB::table('projets')->max('id_projet');
        $idProjetTemp = DB::table('projets_temp')->max('id_projet');
        if (is_null($idProjet) && is_null($idProjetTemp)) {
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
                'nom_projet' => "projet_" . $idNewProjet,
                'partage' => false
            ]);

        $listeDecorations = DB::table('decorations')
            ->select(['id_decoration', 'nom', 'titre', 'description', 'nom_photo', 'tag', 'prix', 'taille'])
            ->get();

        $listePlantes = DB::table('plantes')
            ->select(['id_plante', 'nom_latin', 'titre', 'titre_latin', 'description', 'nom_photo', 'tag', 'prix', 'taille'])
            ->get();

        $listeDecorations3D = DB::table('decorations_3d')
            ->select(['id_decoration3d', 'nom', 'titre', 'description', 'nom_objet', 'tag', 'prix', 'taille'])
            ->get();

        $listePlantes3D = DB::table('plantes_3d')
            ->select(['id_plante3d', 'nom', 'titre', 'description', 'nom_objet', 'tag', 'prix', 'taille'])
            ->get();

        return view('modelisation', ['idNewProjet' => $idNewProjet, 'nomProjet' => "projet_".$idNewProjet, 'listeDecorations' => $listeDecorations, 'listePlantes' => $listePlantes, 'listeDecorations3D' => $listeDecorations3D, 'listePlantes3D' => $listePlantes3D]);
    }

    /**
     * Réinitialise un projet.
     */
    public function postReinitProjet()
    {
        $idProjet = $_POST['idProjet'];
        /*if (DB::table('projet_plante')->where('id_projet', $idProjet)->exists()) {
            DB::table('projet_plante')->where('id_projet', $idProjet)->delete();
        };*/
        if (DB::table('projet_plante_temp')->where('id_projet', $idProjet)->exists()) {
            DB::table('projet_plante_temp')->where('id_projet', $idProjet)->delete();
        };
        /*if (DB::table('projet_decoration')->where('id_projet', $idProjet)->exists()) {
            DB::table('projet_decoration')->where('id_projet', $idProjet)->delete();
        };*/
        if (DB::table('projet_decoration_temp')->where('id_projet', $idProjet)->exists()) {
            DB::table('projet_decoration_temp')->where('id_projet', $idProjet)->delete();
        };

        //return $this->openProject($idProjet,'projet_'.$idProjet);
    }

    /**
     * Vérifie si un projet existe.
     *
     * @return \Illuminate\Http\JsonResponse message de retour
     */
    public function getProjet()
    {
        if (DB::table('projets')->where('id_projet', $_GET['idProjet'])->exists()) {
            return response()->json(['response' => 'existe']);
        } else {
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
            //DB::table('projets_temp')->where('id_projet', $idProjet)->delete();
        }

        if (DB::table('projet_plante_temp')->where('id_projet', $idProjet)->exists()) {
            //table projet_plante (suppression)
            DB::table('projet_plante')->where('id_projet', $idProjet)->delete();

            //table projet_plante (insertion)
            $valPlante = DB::table('projet_plante_temp')->where('id_projet', $idProjet)->get();

            foreach ($valPlante as $plante) {
                DB::table('projet_plante')
                    ->insert(['id_projet' => $plante->id_projet, 'id_unique' => $plante->id_unique, 'id_plante' => $plante->id_plante, 'coordx' => $plante->coordx,
                        'coordy' => $plante->coordy, 'coordz' => $plante->coordz, 'rotation' => $plante->rotation]);
            };

            //table temporaire des projet_plante (suppression)
            //DB::table('projet_plante_temp')->where('id_projet', $idProjet)->delete();
        }else{
            // S'il n'y a plus de plantes, on supprime simplement celels de la table fixe
            //table projet_plante (suppression)
            DB::table('projet_plante')->where('id_projet', $idProjet)->delete();
        }

        if (DB::table('projet_decoration_temp')->where('id_projet', $idProjet)->exists()) {
            //table projet_decoration (suppression)
            DB::table('projet_decoration')->where('id_projet', $idProjet)->delete();

            //table projet_decoration (insertion)
            $valDeco = DB::table('projet_decoration_temp')->where('id_projet', $idProjet)->get();

            foreach ($valDeco as $deco) {
                DB::table('projet_decoration')
                    ->insert(['id_projet' => $deco->id_projet, 'id_unique'=> $deco->id_unique, 'id_decoration' => $deco->id_decoration, 'coordx' => $deco->coordx,
                    'coordy' => $deco->coordy, 'coordz' => $deco->coordz, 'rotation' => $deco->rotation]);
            };

            //table temporaire des projet_deoration (suppression)
            //DB::table('projet_decoration_temp')->where('id_projet', $idProjet)->delete();
        }else{
            // S'il n'y a plus de décorations, on supprime simplement celels de la table fixe
            //table projet_decoration (suppression)
            DB::table('projet_decoration')->where('id_projet', $idProjet)->delete();
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
            //DB::table('projet_aquarium_temp')->where('id_projet', $idProjet)->delete();
        }
        //return $this->openProject($idProjet,'projet_'.$idProjet);
    }

    /**
     * Récupère les plantes d'un projet
     *
     * @return JSON plantes se trouvant dans le projet
     */
    public function getPlantes()
    {
        /* Modification : récupération des éléments dans les bases temporaires
            (les bases fixes sont copiées dans les bases temporaires à l'ouverture du projet) */

        if (DB::table('projet_plante_temp')->where('id_projet', $_GET['idProjet'])->exists()) {
            $plantes = DB::table('projet_plante_temp')->where('id_projet', $_GET['idProjet'])->get();
            return response()->json(['plantes' => $plantes]);
        } else {
            return response()->json(['plantes' => '']);
        }
    }

    /**
     * Récupère les décorations d'un projet
     *
     * @return JSON décorations se trouvant dans le projet
     */
    public function getDecos()
    {
        /* Modification : récupération des éléments dans les bases temporaires
            (les bases fixes sont copiées dans les bases temporaires à l'ouverture du projet) */

        if (DB::table('projet_decoration_temp')->where('id_projet', $_GET['idProjet'])->exists()) {
            $decos = DB::table('projet_decoration_temp')->where('id_projet', $_GET['idProjet'])->get();
            return response()->json(['decos' => $decos]);
        } else {
            return response()->json(['decos' => '']);
        }
    }

    /**
     * Récupère le nom du fichier de la plante
     *
     * @return JSON nom du fichier de la plante
     */
    public function getCheminPlante()
    {
        if (DB::table('plantes')->where('id_plante', $_GET['idPlante'])->exists()) {
            $chemin = DB::table('plantes')->where('id_plante', $_GET['idPlante'])->value('nom_photo');
            return response()->json(['chemin' => $chemin]);
        } else {
            return response()->json(['chemin' => '']);
        }
    }

    /**
     * Récupère le nom du fichier de la décoration
     *
     * @return JSON nom du fichier de la décoration
     */
    public function getCheminDeco()
    {
        if (DB::table('decorations')->where('id_decoration', $_GET['idDeco'])->exists()) {
            $chemin = DB::table('decorations')->where('id_decoration', $_GET['idDeco'])->value('nom_photo');
            return response()->json(['chemin' => $chemin]);
        } else {
            return response()->json(['chemin' => '']);
        }
    }

    public function addOrUpdateElementToTmp()
    {

        if (DB::table('plantes')->where('nom_photo', $_GET['imageName'])->exists()) {

            // Get the element ID : id_plante
            $idPlante = DB::table('plantes')
                ->select('id_plante')
                ->where('nom_photo', $_GET['imageName'])
                ->get();

            if (DB::table('projet_plante_temp')->where('id_unique', $_GET['idUnique'])->exists()) {

                DB::table('projet_plante_temp')
                    ->where('id_unique', $_GET['idUnique'])->update([
                        'coordx' => $_GET['posX'],
                        'coordz' => $_GET['posZ'],
                    ]);

            } else {
                DB::table('projet_plante_temp')
                    ->insert([
                        'id_projet' => $_GET['idProjet'],
                        'id_unique' => $_GET['idUnique'],
                        'id_plante' => $idPlante[0]->id_plante,
                        'coordx' => $_GET['posX'],
                        'coordy' => 0,
                        'coordz' => $_GET['posZ'],
                        'rotation' => 0
                    ]);
            }

        } elseif (DB::table('decorations')->where('nom_photo', $_GET['imageName'])->exists()) {

            // Get the element ID : id_decoration
            $idDecoration = DB::table('decorations')
                ->select('id_decoration')
                ->where('nom_photo', $_GET['imageName'])
                ->get();

            if (DB::table('projet_decoration_temp')->where('id_unique', $_GET['idUnique'])->exists()) {

                DB::table('projet_decoration_temp')
                    ->where('id_unique', $_GET['idUnique'])->update([
                        'coordx' => $_GET['posX'],
                        'coordz' => $_GET['posZ'],
                    ]);

            } else {
                DB::table('projet_decoration_temp')
                    ->insert([
                        'id_projet' => $_GET['idProjet'],
                        'id_unique' => $_GET['idUnique'],
                        'id_decoration' => $idDecoration[0]->id_decoration,
                        'coordx' => $_GET['posX'],
                        'coordy' => 0,
                        'coordz' => $_GET['posZ'],
                        'rotation' => 0
                    ]);
            }

        }

    }

    public function deleteElementFromTmp(){
        if (DB::table('projet_plante_temp')->where('id_unique', $_GET['idUnique'])->exists()) {

            DB::table('projet_plante_temp')
                ->where('id_unique', $_GET['idUnique'])
                ->delete();

        }elseif (DB::table('projet_decoration_temp')->where('id_unique', $_GET['idUnique'])->exists()) {

            DB::table('projet_decoration_temp')
                ->where('id_unique', $_GET['idUnique'])
                ->delete();

        }
    }
    /**
     * Permet de mettre dans la table temporaire l'objet ajouté
     */
    public function insertObject3D()
    {
        $idProjet = $_POST['idProjet'];
        $nomObjet = $_POST['nomObjet'];

        $idDeco = DB::table('decorations_3d')
                ->select(['id_decoration3d'])
                ->where('nom_objet', $nomObjet)
                ->get();

        DB::table('projet_decorations_3d_temp')
                ->insert([
                        'id_projet' => $idProjet,
                        'id_decoration3d' => $idDeco[0]->id_decoration3d,
                        'coordx' => 1,
                        'coordy' => 1,
                        'coordz' => 1,
                        'rotationx' => -1.57,
                        'rotationy' => 0,
                        'rotationz' => 0
                    ]);
    }

    /**
     * Sauvegarde d'un projet
     */
    public function saveProject3D(Request $request)
    {
        $idProjet = $request->idProjet3D;
        $nomProjet = $request->nomProjet3D;

        if (DB::table('projets_temp')->where('id_projet', $idProjet)->exists()) {
            //table projets (insertion)
            DB::table('projets_temp')
                ->where('id_projet', $idProjet)
                ->update(['nom_projet' => $nomProjet,
                        'partage' => true]);
            $val = DB::table('projets_temp')->where('id_projet', $idProjet)->first();

            DB::table('projets')
                ->updateOrInsert(
                    ['id_projet' => $idProjet],
                    ['id_bac' => $val->id_bac, 'id_user' => $val->id_user, 'nom_projet' => $nomProjet, 'partage' => $val->partage]
                );

            //table temporaire des projets (suppression)
            DB::table('projets_temp')->where('id_projet', $idProjet)->delete();
        }

        if (DB::table('projet_plantes_3d_temp')->where('id_projet', $idProjet)->exists()) {
            //table projet_plante (suppression)
            DB::table('projet_plantes_3d')->where('id_projet', $idProjet)->delete();

            //table projet_plante (insertion)
            $valPlante = DB::table('projet_plantes_3d_temp')->where('id_projet', $idProjet)->get();

            foreach ($valPlante as $plante) {
                DB::table('projet_plantes_3d')
                    ->insert([
                        'id_projet' => $plante->id_projet,
                        'id_plante' => $plante->id_plante,
                        'coordx' => $plante->coordx,
                        'coordy' => $plante->coordy,
                        'coordz' => $plante->coordz,
                        'rotationx'=> $plante->rotationx,
                        'rotationy'=> $plante->rotationy,
                        'rotationz'=> $plante->rotationz
                    ]);
            };

            //table temporaire des projet_plante (suppression)
            DB::table('projet_plantes_3d_temp')->where('id_projet', $idProjet)->delete();
        }

        if (DB::table('projet_decorations_3d_temp')->where('id_projet', $idProjet)->exists()) {
            //table projet_decoration (suppression)
            DB::table('projet_decorations_3d')->where('id_projet', $idProjet)->delete();

            //table projet_decoration (insertion)
            $valDeco = DB::table('projet_decorations_3d_temp')->where('id_projet', $idProjet)->get();

            foreach ($valDeco as $deco) {
                DB::table('projet_decorations_3d')
                    ->insert([
                        'id_projet' => $deco->id_projet,
                        'id_decoration' => $deco->id_decoration,
                        'coordx' => $deco->coordx,
                        'coordy' => $deco->coordy,
                        'coordz' => $deco->coordz,
                        'rotationx' => $deco->rotationx,
                        'rotationy' => $deco->rotationy,
                        'rotationz' => $deco->rotationz
                    ]);
            };

            //table temporaire des projet_deoration (suppression)
            DB::table('projet_decorations_3d_temp')->where('id_projet', $idProjet)->delete();
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

        return redirect()->back()->with('alert', 'Sauvegarde réussie !');
    }

    /**
     * Réinitialise un projet.
     */
    public function resetProject3D(Request $request)
    {
        $idProjet = $request->idProjet3D;

        if (DB::table('projet_plantes_3d_temp')->where('id_projet', $idProjet)->exists()) {
            DB::table('projet_plantes_3d_temp')->where('id_projet', $idProjet)->delete();
        };

        if (DB::table('projet_decorations_3d_temp')->where('id_projet', $idProjet)->exists()) {
            DB::table('projet_decorations_3d_temp')->where('id_projet', $idProjet)->delete();
        };

        return redirect()->back()->with('alert', 'Réinitialisation réussie !');
    }
}

?>
