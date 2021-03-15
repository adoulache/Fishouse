@extends('base')

<!--Fonctionnalité principale : modélisation-->
@section('content')
    @if (Auth::check())
    <div class="container" style="width:100%">  
        <br>
        <h3>Type de modélisation :</h3>  
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
                            <div class="newObjectCard row justify-content-center align-items-center" data-toggle="tooltip" data-placement="top" title="{{$listeDecoration->description}}">
                                <img src="{{ asset('../images/'.$listeDecoration->nom_photo) }}" class="newObjectPicture">
                                <div class="newObjectDescription">
                                    <p> {{ $listeDecoration->titre }} </p>
                                </div>
                            </div>
                            @endforeach
                            @foreach($listePlantes as $listePlante)
                            <div class="newObjectCard row justify-content-center align-items-center" data-toggle="tooltip" data-placement="top" title="{{$listePlante->description}}">
                                <img src="{{ asset('../images/'.$listePlante->nom_photo) }}" class="newObjectPicture">
                                <div class="newObjectDescription">
                                    <p> {{ $listePlante->titre }} </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 blocModelisation">
                    <!-- BOUTONS DU PROJET -->
                    <div class="boutonsProjet">
                        <!-- Bouton pour la réinitialisation du projet -->
                        <button type="button" class="btn btn-dark" id="boutonReinit">Reinitialiser</button>

                        <!-- Bouton pour la sauvegarde du projet -->
                        <button type="button" class="btn btn-dark" id="boutonSauve">Sauvegarder</button>
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

        <!-- ONGLET : MODELISATION 3D -->
        <div class="container-fluid tab-pane fade" id="model3D">
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
                            @foreach($listeDecorations3D as $listeDecoration3D)
                            <div class="newObjectCard row justify-content-center align-items-center" data-toggle="tooltip" data-placement="top" title="{{$listeDecoration3D->description}}">
                                <img src="{{ asset('../images/'.$listeDecoration3D->nom_objet.'.png') }}" class="newObjectPicture">
                                <div class="newObjectDescription">
                                    <p> {{ $listeDecoration3D->titre }} </p>
                                </div>
                            </div>
                            @endforeach
                            @foreach($listePlantes3D as $listePlante3D)
                            <div class="newObjectCard row justify-content-center align-items-center" data-toggle="tooltip" data-placement="top" title="{{$listePlante3D->description}}">
                                <img src="{{ asset('../images/'.$listePlante3D->nom_objet.'.png') }}" class="newObjectPicture">
                                <div class="newObjectDescription">
                                    <p> {{ $listePlante3D->titre }} </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 blocModelisation">
                    <!-- BOUTONS DU PROJET -->
                    <div class="boutonsProjet">
                        <!-- Bouton pour la réinitialisation du projet -->
                        <button type="button" class="btn btn-dark" id="boutonReinit">Reinitialiser</button>

                        <!-- Bouton pour la sauvegarde du projet -->
                        <button type="button" class="btn btn-dark" id="boutonSauve">Sauvegarder</button>
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
                    <!-- <script>
                        const scene = new THREE.Scene();
                        scene.background = new THREE.Color( 0xf0f0f0 );
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
                    </script>  -->
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="AccessDenied"> 
        <br>
        <img src="{{ asset('../images/id-card.png') }}" style="width:150px;">
        <p> Tu ne peux pas accéder à cette page, alors <br> <a class="btn btn-dark" href="{{ route('sign-in') }}">connecte-toi</a> ou <a class="btn btn-dark" href="{{ route('sign-up') }}">inscris-toi</a> !</p>
        <br>
    </div>
    @endif
@endsection
