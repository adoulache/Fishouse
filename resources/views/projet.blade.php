@extends('base')

<!--Fonctionnalité principale : projet-->
@section('content')
    @if (Auth::check())
    <div class="projectText">
        Mes projets de modélisation
        <hr class="projectHr mx-auto">
    </div>

    <div class="container-fluid">
        <div class="row">

            @foreach($listeProjets as $listeProjet)
            <div class="projectBloc row justify-content-center align-items-center">
                <h2 class="projectTitle"> {{ $listeProjet->nom_projet }} </h2>
                <img src="{{ asset('../images/aquarium.jpg') }}" class="imageProjetExistant" id="projetExistant"/>
                <div class="buttonProjetsExistants">            
                    <a class="btn btn-dark" href="{{ route('openProjet',['id'=>$listeProjet->id_projet, 'name'=>$listeProjet->nom_projet]) }}">Modifier</a>
                    <a class="btn btn-dark btnSupprimer" id="{{ $listeProjet->id_projet }}" href="#contact" data-toggle="modal" data-target="#delete">Supprimer</a>
                    <a class="btn btn-dark fa fa-ellipsis-h" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item btn-dark btnRenommer" id="{{ $listeProjet->id_projet }}" href="#" data-toggle="modal" data-target="#rename">Renommer</a>
                        <a class="dropdown-item btn-dark btnPartager" id="{{ $listeProjet->id_projet }}" href="#" data-toggle="modal" data-target="#share">Partager</a>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="projectBloc row justify-content-center align-items-center">
                <img src="{{ asset('../images/ajoutProjet.png') }}" class="imageAjoutProjet" type="button"
                     data-toggle="modal" data-target="#popup" id="newAquarium"/>
            </div>

            <!-- DEBUT POP-UP, suppression d'un projet existant -->
            <div id="delete" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Header pop-up -->
                        <div class="modal-header">
                            <p class="modal-title newprojectText"> Supprimer le projet n° <span id="supprId"></span> </p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Body pop-up -->
                        <div class="modal-body">
                            <p>Confirmes-tu la suppression définitive de ce projet ?</p>
                        </div>
                        <!-- Footer pop-up -->
                        <div class="modal-footer">
                            <form method="post" action="{{ route('suppProjet') }}">
                                {{ csrf_field() }}
                                <input id="supprIdHidden" name="idSuppresion" type="hidden" value="">
                                <button type="submit" class="btn btn-dark boutonSuppr" name="supprProjet">Valider et confirmer</button>
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Annuler</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--FIN POP-UP -->

            <!-- DEBUT POP-UP, renommage d'un projet existant -->
            <div id="rename" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Header pop-up -->
                        <div class="modal-header">
                            <p class="modal-title newprojectText"> Renommer le projet n° <span id="renommeId"></span> </p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Body pop-up -->
                        <form method="post" action="{{ route('renameProjet') }}">
                        {{ csrf_field() }}
                            <div class="modal-body">
                                <p>Comment souhaites-tu renommer ton projet ?</p>
                                <input type="text" id="newName" name="newName">
                                <input id="renommeIdHidden" name="idRenomme" type="hidden" value="">
                            </div>
                            <!-- Footer pop-up -->
                            <div class="modal-footer">
                                <button type="submit" value="Submit" class="btn btn-dark boutonRenom" name="renameProjet">Valider et confirmer</button>
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--FIN POP-UP -->

            <!-- DEBUT POP-UP, activation du partage d'un projet existant -->
            <div id="share" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Header pop-up -->
                        <div class="modal-header">
                            <p class="modal-title newprojectText"> Partager le projet n° <span id="partageId"></span> </p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Body pop-up -->
                        <div class="modal-body">
                            <p>Souhaites-tu vraiment partager ton projet avec les autres membres de Fishouse ?</p>
                        </div>
                        <!-- Footer pop-up -->
                        <div class="modal-footer">
                            <form method="post" action="{{ route('shareProjet') }}">
                                {{ csrf_field() }}
                                <input id="partageIdHidden" name="idPartage" type="hidden" value="">
                                <button type="submit" class="btn btn-dark boutonParta" name="shareProjet">Valider et confirmer</button>
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Annuler</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--FIN POP-UP -->

            <!-- DEBUT POP-UP, création d'un nouveau projet -->
            <div id="popup" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Header pop-up -->
                        <div class="modal-header">
                            <p class="modal-title newprojectText"> Créer un nouveau projet </p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Body pop-up -->
                        <div class="modal-body">
                            <div class="input-group rounded">
                                <div class="dropdown">
                                    <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown">
                                        Catégorie
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Aquarium boule</a></li>
                                        <li><a href="#">Aquarium carré</a></li>
                                        <li><a href="#">Aquarium rectangle</a></li>
                                    </ul>
                                </div>
                                <input type="search" class="form-control rounded" placeholder="Recherche..."
                                       aria-label="Recherche" aria-describedby="search-addon"/>
                                <span class="input-group-text border-0" id="search-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                            <div class="container-fluid">
                                <div class="row">
                                    @foreach ($listeBacs as $listeBac)
                                        <form method="post" action="{{ route('ajoutProjet') }}">
                                        {{ csrf_field() }}
                                            <!-- CARTE D'UN AQUARIUM -->
                                            <div class="newAquariumCard row justify-content-center align-items-center">
                                                <img src="{{ asset('../images/'.$listeBac->nom_photo) }}" class="newAquariumPicture">
                                                <div class="newAquariumDescription">
                                                    <p class="font-weight-bold"> {{ $listeBac->titre }} </p>
                                                    <hr class="newAquariumHr">
                                                    <ul class="list-unstyled">
                                                        <li> {{ $listeBac->description }} </li>
                                                        <li> Taille (en cm) : {{ $listeBac->taille }} </li>
                                                        <li> Prix (en €) : {{ $listeBac->prix }} </li>
                                                    </ul>
                                                    <input id="idBack" name="idBack" type="hidden" value="{{ $listeBac->id_bac }}">
                                                    <button type="submit" class="btn btn-dark boutonChoix ajouterProjet"> Choisir </button>
                                                </div>
                                            </div>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Footer pop-up -->
                        <div class="modal-footer">
                            <a type="button" class="btn btn-dark" data-dismiss="modal">Abandonner</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--FIN POP-UP -->
        </div>
    </div>
    @else
    <div class="AccessDenied"> 
        <br>
        <img src="{{ asset('../images/id-card.png') }}" style="width:150px;margin:auto">
        <p> Tu ne peux pas accéder à cette page, alors <br> <a class="btn btn-dark" href="{{ route('sign-in') }}">connecte-toi</a> ou <a class="btn btn-dark" href="{{ route('sign-up') }}">inscris-toi</a> !</p>
        <br>
    </div>
    @endif

@endsection
