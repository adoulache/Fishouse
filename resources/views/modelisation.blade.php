@extends('base')

<!--Fonctionnalité principale : modélisation-->
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!--BLOC DE RECHERCHE-->
            <div class="col-md-3 col-sm-3 blocRecherche">
                <h3 class="h3BlocRecherche">Recherche</h3>
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
            </div>
            <div class="col-md-9 col-sm-9" style="margin-top: 20px;" id="container">
            <!-- Site des sources js : https://cdn.jsdelivr.net/npm/three@0.115.0/ -->

                <!-- Sources build -->
                <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/104/three.js"></script> -->
                <!-- <script src = "https://threejs.org/build/three.js "></script> -->

                <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/build/three.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/build/three.min.js"></script>
                <!-- <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/build/three.module.js"></script> -->

                <!-- Sources des fonctions dont on a besoin : examples / js / controls -->
                <script src="https://cdn.jsdelivr.net/npm/three@0.115/examples/js/controls/DragControls.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/three@0.115/examples/js/controls/TransformControls.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/examples/js/controls/OrbitControls.js"></script>

                <!-- Autres sources (utiles pour certaines fonctions) -->
                <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/examples/js/libs/inflate.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/examples/js/loaders/FBXLoader.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/three@0.115.0/examples/jsm/libs/stats.module.js"></script>


                <!-- Script pour gérer la modélisation 3D -->
                <!-- <script src="../js/_modelisation3D.js"></script> Script Clara modélisation 3D dans public/js -->
                <script src="../js/_modelisation3D.js"></script>

                <script src="../js/three.interaction.js"></script>
            </div>
        </div>


        <!-- Bouton pour la réinitialisation du projet -->
        <div>
            <p id=idProjetTest>test</p>
            <!--<button type="button" class="btn btn-dark" id="boutonReinit" onclick="reinitProjet('essai');"></button>-->
            <button type="button" class="btn btn-dark" id="boutonReinit">bouton test reinitialisation</button>
        </div>


        <!-- Bouton pour la sauvegarde du projet -->
        <div>
            <button type="button" class="btn btn-dark" id="boutonSauve">bouton test sauvegarde</button>
            <div id="sauveFaite" class="hidden" style="color:green;">Sauvegarde effectuée !</div>
        </div>
        <!-- Modal de demande du nom du projet -->
        <div class="modal fade" id="modalNomProjet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                <label for="nom-projet" class="col-form-label">Quel nom veux-tu donner à ton projet ?</label>
                                <!--<input type="text" class="form-control" id="nom-projet">-->
                                <input type="text" class="champ" id="nom-projet">
                            </div>
                            <div id="sauveOk" class="hidden" style="color:green;">Sauvegarde effectuée !</div>
                        <!--class="h3 text-center hidden"-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-dark" id="sauvegarde">Sauvegarder</button>
                    </div>
                </div>
            <!--</form>-->
            </div>
        </div>

        
        <!-- Modélisation 2D -->
        <div>
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
        <div >
            <canvas id="mod2D" width="600px" height="400px">Eh ben non !</canvas>
        </div>
    </div>
@endsection
