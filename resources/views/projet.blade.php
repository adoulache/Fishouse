@extends('base')

<!--Fonctionnalité principale : projet-->
@section('content')
    <div class="projectText">
        Mes projets de modélisation<hr class="projectHr mx-auto">
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="projectBloc row justify-content-center align-items-center">
                <img src="{{ asset('../images/ajoutProjet.png') }}" class="imageAjoutProjet" type="button" data-toggle="modal" data-target="#popup" id="nouveauProjet">
            </div>

            <!-- Pop-up -->
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
                                    <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown">Catégorie
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Aquarium boule</a></li>
                                        <li><a href="#">Aquarium carré</a></li>
                                        <li><a href="#">Aquarium rectangle</a></li>
                                    </ul>
                                </div>
                                <input type="search" class="form-control rounded" placeholder="Recherche..." aria-label="Recherche" aria-describedby="search-addon"/>
                                <span class="input-group-text border-0" id="search-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                            <div class="container">
                                <form method="post" action="/mes_projets">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <!-- CARTE D'UN AQUARIUM -->
                                        @foreach ($listeBacs as $listeBac)
                                            <div class="col-lg-12 newAquarium">
                                                <img src="{{ asset('../images/'.$listeBac->nom_photo) }}" class="newAquariumPicture">
                                                <p class="font-weight-bold newAquariumTitle"> {{ $listeBac->nom }} </p>
                                                <hr class="newAquariumHr">
                                                <ul class="list-unstyled">
                                                    <li> {{ $listeBac->description }} </li>
                                                    <li> Taille (en cm) : {{ $listeBac->taille }} </li>
                                                    <li> Prix (en €) : {{ $listeBac->prix }} </li>
                                                </ul>
                                                <button type="button" class="btn btn-dark boutonChoix ajouterProjet" value="{{ $listeBac->id_bac }}">Choisir {{$listeBac->id_bac}} </button>
                                                <!--href="{{ route('modelisation') }}"-->
                                            </div>
                                        @endforeach
                                    </div>
                                </form> 
                            </div>
                        </div>
                        <!-- Footer pop-up -->
                        <div class="modal-footer">
                            <!-- <a type="submit" class="btn btn-dark" id="addProject" href="{{ route('modelisation') }}">Valider</a> -->
                            <a type="button" class="btn btn-dark" data-dismiss="modal">Abandonner</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection