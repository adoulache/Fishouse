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
            <div class="col-md-9 col-sm-9" style="margin-top: 20px;" id="contrainer">
                <script src="js/three.js"></script>
                <script>
                    const scene = new THREE.Scene();
                    const camera = new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 0.05, 1000 );

                    const renderer = new THREE.WebGLRenderer();
                    renderer.setSize( window.innerWidth, window.innerHeight );
                    document.body.appendChild( renderer.domElement );

                    const geometry = new THREE.BoxGeometry(1,0.5,0.5);
                    const material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
                    const cube = new THREE.Mesh( geometry, material );
                    scene.add( cube );

                    //Plus le chiffre est grand, plus on est loin
                    camera.position.z = 10;

                    

                    function animate() {
                        requestAnimationFrame( animate );
                        cube.rotation.x += 0.01;
                        cube.rotation.y += 0.01;
                        renderer.render( scene, camera );
                    }
                    animate();
                </script>
            </div>
        </div>


        <!-- Bouton pour la réinitialisation du projet -->
        <div>
            <!--<button type="button" class="btn btn-dark" id="boutonReinit" onclick="reinitProjet('essai');"></button>-->
            <button type="button" class="btn btn-dark" id="boutonReinit">bouton test reinitialisation</button>
        </div>
        <!-- Modal de confirmation réinitialisation du projet -->
        <div class="modal fade" id="modalReinitProjet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Réinitialisation du projet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                            <!--<div class="form-group">
                                <label for="nom-projet" class="col-form-label">Quel nom veux-tu donner à ton projet ?</label>
                                <input type="text" class="champ" id="nom-projet">
                            </div>
                            <div id="sauveOk" class="d-none" style="color:green;">Sauvegarde effectuée !</div>
                        class="h3 text-center hidden"-->
                        <div>Es-tu sûr de vouloir réinitialiser ton projet ?</div><br>
                        <div>Attention, après sauvegarde, tous les éléments de ton aquarium seront définitivement supprimés.</div>
                        <div id="reinitOk" class="d-none" style="color:green;">Réinitialisation effectuée !</div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-dark" id="validReinit">Réinitialiser</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Bouton pour la sauvegarde du projet -->
        <div>
            <button type="button" class="btn btn-dark" id="boutonSauve">bouton test sauvegarde</button>
            <div id="sauveFaite" class="d-none" style="color:green;">Sauvegarde effectuée !</div>
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
                            <div id="sauveOk" class="d-none" style="color:green;">Sauvegarde effectuée !</div>
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
