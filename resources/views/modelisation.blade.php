@extends('base')

<!--Fonctionnalité principale : modélisation-->
@section('content')
    @if (Auth::check())
    <div class="container" style="width:100%">
        <br>
        @if (session('alert'))
            <div class="alert alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{ session('alert') }}
            </div>
        @endif
        <p class="h3">Type de modélisation :</p>
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link active" href="#model2D" data-toggle="tab"> Modélisation 2D </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#model3D" data-toggle="tab"> Modélisation 3D </a>
            </li>
        </ul>
        <br>
    </div>
    <div class="tab-content">
        <!-- ONGLET : MODELISATION 2D -->
        <div class="container-fluid tab-pane fade show active" id="model2D">
            <div class="row">
                <!--BLOC DE RECHERCHE-->
                <div class="col-md-3 col-sm-3 blocRecherche" style="overflow:auto; height:600px">
                    <p class="titreBlocRecherche">Recherche un objet</p>
                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded" placeholder="Recherche..." aria-label="Recherche" aria-describedby="search-addon" />
                        <span class="input-group-text border-0" id="search-addon">
                            <i class="fa fa-search"></i>
                        </span>
                        </div>
                        <!-- <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filtrer par
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div> -->
                        <hr class="hrBlocRecherche">
                        <!-- CATALOGUE -->
                        <div class="container-fluid">
                            <div class="row">
                                @foreach($listeDecorations as $listeDecoration)
                                    <div class="newObjectCard row justify-content-center align-items-center"
                                         data-toggle="tooltip" data-placement="top"
                                         title="{{$listeDecoration->description}}">
                                        <img src="{{ asset('../images/'.$listeDecoration->nom_photo) }}"
                                             class="newObjectPicture yes-drop" value="">
                                        <div class="newObjectDescription">
                                            <p> {{ $listeDecoration->titre }} </p>
                                        </div>
                                    </div>
                                @endforeach
                                @foreach($listePlantes as $listePlante)
                                    <div class="newObjectCard row justify-content-center align-items-center"
                                         data-toggle="tooltip" data-placement="top"
                                         title="{{$listePlante->description}}">
                                        <img src="{{ asset('../images/'.$listePlante->nom_photo) }}"
                                             class="newObjectPicture yes-drop" value="">
                                        <div class="newObjectDescription">
                                            <p> {{ $listePlante->titre }} </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 col-sm-9 blocModelisation justify-content-center align-items-center">
                        <div id="idProjetCache" class="d-none">{{ $idNewProjet }}</div>
                        <!-- BOUTONS DU PROJET -->
                        <div class="boutonsProjet row">
                            <!-- Bouton pour la réinitialisation du projet -->
                            <button type="button" class="btn btn-dark" id="boutonReinit">Reinitialiser</button>

                            <!-- Bouton pour la sauvegarde du projet -->
                            <button type="button" class="btn btn-dark" id="boutonSauve">Sauvegarder</button>
                            <div id="sauveFaite" class="d-none msgValide">Sauvegarde effectuée !</div>
                        </div>

                        <div style="text-align: right">
                            <button type="button" class="btn btn-light" id="aqFace">
                                <img src="{{ asset('../images/face.png') }}" style="width:50px;">
                            </button>
                            <button type="button" class="btn btn-light" id="aqGauche">
                                <img src="{{ asset('../images/gauche.png') }}" style="width:50px;">
                            </button>
                            <button type="button" class="btn btn-light" id="aqFond">
                                <img src="{{ asset('../images/fond.png') }}" style="width:50px;">
                            </button>
                            <button type="button" class="btn btn-light" id="aqDroite">
                                <img src="{{ asset('../images/droite.png') }}" style="width:50px;">
                            </button>
                        </div>
                        <div id="avantMod2D">
                            <div id="mod2D-test" class="dropzone cadreMod2D" style="width:1000px;height:500px;"></div>

                        </div>
                        <!-- style="z-index:auto;width:1000px;height:500px;"></div>-->

                        <!-- Modal de demande du nom du projet -->
                        <div class="modal fade" id="modalNomProjet" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <!--<form id="formulaire" role='form'>-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Sauvegarde d'un nouveau projet</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nom-projet" class="col-form-label">Quel nom veux-tu donner à
                                                ton projet ?</label>
                                            <!--<input type="text" class="form-control" id="nom-projet">-->
                                            <input type="text" class="champ" id="nom-projet">
                                        </div>
                                        <div id="sauveOk" class="d-none msgValide">Sauvegarde effectuée
                                            !
                                        </div>
                                        <!--class="h3 text-center hidden"-->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Annuler
                                        </button>
                                        <button type="submit" class="btn btn-dark" id="sauvegarde">Sauvegarder
                                        </button>
                                    </div>
                                </div>
                                <!--</form>-->
                            </div>
                        </div>
                        <!-- Modal de confirmation réinitialisation du projet -->
                        <div class="modal fade" id="modalReinitProjet" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Réinitialisation du projet</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div>Es-tu sûr de vouloir réinitialiser ton projet ?</div>
                                        <br>
                                        <div>Attention, après sauvegarde, tous les éléments de ton aquarium seront
                                            définitivement supprimés.
                                        </div>
                                        <div id="reinitOk" class="d-none msgValide">Réinitialisation
                                            effectuée !
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Annuler
                                        </button>
                                        <button type="submit" class="btn btn-dark" id="validReinit">Réinitialiser
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ONGLET : MODELISATION 3D -->
            <div class="container-fluid tab-pane fade" id="model3D">
                <div class="row">
                    <!--BLOC DE RECHERCHE-->
                    <div class="col-md-3 col-sm-3 blocRecherche" style="overflow:auto; height:600px">
                        <p class="titreBlocRecherche">Recherche un objet</p>
                        <div class="input-group rounded">
                            <input type="search" class="form-control rounded" placeholder="Recherche..."
                                   aria-label="Recherche" aria-describedby="search-addon"/>
                            <span class="input-group-text border-0" id="search-addon">
                            <i class="fa fa-search"></i>
                        </span>
                        </div>
                        <!-- CATALOGUE -->
                        <div class="container-fluid">
                            <hr class="hrBlocRecherche">
                            <!-- CATALOGUE -->
                            <div class="container-fluid">
                                <div class="row">
                                    @foreach($listeDecorations3D as $listeDecoration3D)
                                        <div class="newObjectCard row justify-content-center align-items-center" data-toggle="tooltip" data-placement="top" title="{{$listeDecoration3D->description}}">
                                            <img src="{{ asset('../images/'.$listeDecoration3D->nom_objet.'.png') }}" class="newObjectPicture">
                                            <div class="newObjectDescription">
                                                <p> {{ $listeDecoration3D->titre }} </p>
                                                <a class="btn btn-dark btnAjoutObjet" id="{{ $listeDecoration3D->nom_objet }}">Ajouter</a>
                                                <input id="idProjet3D" name="idProjet3D" type="hidden" value="{{ $idNewProjet }}">
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($listePlantes3D as $listePlante3D)
                                        <div class="newObjectCard row justify-content-center align-items-center"
                                             data-toggle="tooltip" data-placement="top"
                                             title="{{$listePlante3D->description}}">
                                            <img src="{{ asset('../images/'.$listePlante3D->nom_objet.'.png') }}"
                                                 class="newObjectPicture">
                                            <div class="newObjectDescription">
                                                <p> {{ $listePlante3D->titre }} </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- BLOC DE MODELISATION -->
                <div class="col-md-9 col-sm-9 blocModelisation" id="container">
                    <!-- BOUTONS DU PROJET -->
                    <div class="boutonsProjet">
                        <button type="button" class="btn btn-dark" href="#" data-toggle="modal" data-target="#help">
                            <i class="fa fa-question"></i>
                        </button>
                        <!-- Bouton pour la réinitialisation du projet -->
                        <button type="button" class="btn btn-dark btnReini3D" id="boutonReinit3D" data-toggle="modal" data-target="#resetProject3D">Réinitialiser</button>

                        <!-- Le nom d'un projet, par défaut, est 'projet_' + id -->
                        <!-- Si ce nom est différent, alors le nom a déjà été modifié et ce n'est pas nécessaire de le redemander -->
                        @if (strpos($nomProjet, 'projet_') !== false)
                        <!-- Bouton pour la sauvegarde du projet -->
                        <button type="button" class="btn btn-dark" id="boutonSauve3D" data-toggle="modal" data-target="#nameProject3D">Sauvegarder</button>
                        @else
                        <br>
                        <form method="post" action="{{ route('nameProjet3D') }}">
                            <input id="nomProjet3D" name="nomProjet3D" type="hidden" value="{{ $nomProjet }}">
                            <input id="idProjet3D" name="idProjet3D" type="hidden" value="{{ $idNewProjet }}">
                            <button type="submit" class="btn btn-dark boutonName3D" name="nameProjet3D">Sauvegarder</button>
                        </form>
                        @endif
                    </div>

                    <!-- DEBUT POP-UP, aide -->
                    <div id="help" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Header pop-up -->
                                <div class="modal-header">
                                    <p class="modal-title newprojectText"> Aide - touches raccourcis <span id="supprId"></span> </p>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Body pop-up -->
                                <div class="modal-body container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Raccourci</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Touche "w"</td>
                                                <td>Affichage des axes de déplacement</td>
                                            </tr>
                                            <tr>
                                                <td>Touche "e"</td>
                                                <td>Affichage des axes de rotation</td>
                                            </tr>
                                            <tr>
                                                <td>Touche "r"</td>
                                                <td>Affichage des axes de redimensionnement</td>
                                            </tr>
                                            <tr>
                                                <td>Touche "+"</td>
                                                <td>Augmente la taille des axes</td>
                                            </tr>
                                            <tr>
                                                <td>Touche "-"</td>
                                                <td>Diminue la taille des axes</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Footer pop-up -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--FIN POP-UP -->
                    <!--OK-->

                    <!-- DEBUT POP-UP, demande du nom du projet 3D -->
                    <div class="modal fade" id="nameProject3D" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form method="post" action="{{ route('nameProjet3D') }}">
                                {{ csrf_field() }}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Sauvegarde d'un nouveau projet</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nom-projet-3D" class="col-form-label">Quel nom veux-tu donner à ton projet ?</label>
                                            <input type="text" class="champ" name="nomProjet3D" id="nomProjet3D">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input id="idProjet3D" name="idProjet3D" type="hidden" value="{{ $idNewProjet }}">
                                        <button type="submit" class="btn btn-dark boutonName3D" name="nameProjet3D">Valider et confirmer</button>
                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Annuler</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--FIN POP-UP -->

                    <!-- DEBUT POP-UP, confirmation réinitialisation du projet -->
                    <div class="modal fade" id="resetProject3D" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Réinitialisation du projet</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div>Es-tu sûr de vouloir réinitialiser ton projet ?</div><br>
                                    <div>Attention, après sauvegarde, tous les éléments de ton aquarium seront définitivement supprimés.</div>
                                </div>
                                <div class="modal-footer">
                                    <form method="post" action="{{ route('suppProjet') }}">
                                        {{ csrf_field() }}
                                        <input id="reinitIdHidden" name="idReinit" type="hidden" value="{{ $idNewProjet }}">
                                        <button type="submit" class="btn btn-dark boutonReinit" name="reinitProjet3D">Valider et confirmer</button>
                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Annuler</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--FIN POP-UP -->

                    <!-- ICI PARTIE CLARA -->
                    <!-- Site des sources js : https://cdn.jsdelivr.net/npm/three@0.115.0/ -->

                    <!-- Sources build -->
                    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/104/three.js"></script> -->
                    <!-- <script src = "https://threejs.org/build/three.js "></script> -->

                    <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/build/three.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/build/three.min.js"></script>

                    <!-- Sources des fonctions dont on a besoin : examples / js / controls -->
                    <script
                        src="https://cdn.jsdelivr.net/npm/three@0.115/examples/js/controls/DragControls.js"></script>
                    <script
                        src="https://cdn.jsdelivr.net/npm/three@0.115/examples/js/controls/TransformControls.js"></script>
                    <script
                        src="https://cdn.jsdelivr.net/npm/three@0.115.0/examples/js/controls/OrbitControls.js"></script>

                    <!-- Autres sources (utiles pour certaines fonctions) -->
                    <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/examples/js/libs/inflate.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/examples/js/loaders/OBJLoader.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/examples/js/loaders/MTLLoader.js"></script>

                    <!-- Stats -->
                    <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/examples/jsm/libs/stats.module.js"></script>
                    <script src='//mrdoob.github.io/stats.js/build/stats.min.js'></script>

                    <!-- Renderer -->
                    <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/examples/js/renderers/Projector.js"></script>

                    <!-- Script pour gérer la modélisation 3D -->
                    <script src="../js/_modelisation3D.js"></script>

                    <script src="../js/three.interaction.js"></script>
             </div>
        </div>

    <!-- Page accessible uniquement si utilisateur connecté -->
    <!-- Affichage d'un message de refus d'accès, nécessité de s'inscrire ou se connecter -->
    @else
    <div class="AccessDenied">
        <br>
        <img src="{{ asset('../images/id-card.png') }}" style="width:150px;margin:auto">
        <p> Tu ne peux pas accéder à cette page, alors <br> <a class="btn btn-dark" href="{{ route('sign-in') }}">connecte-toi</a> ou <a class="btn btn-dark" href="{{ route('sign-up') }}">inscris-toi</a> !</p>
        <br>
    </div>
    @endif

    <ul class='custom-menu'>
        <li data-action="delete">Supprimer</li>
        <li data-action="action1">Action 1</li>
        <li data-action="action2">Action 2</li>
    </ul>
@endsection
