@extends('base')

<!--Fonctionnalité principale : modélisation-->
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-3 blocRecherche">
                <h3 style="margin-top: 10px;">Recherche</h3>
                <div class="input-group rounded">
                    <input type="search" class="form-control rounded" placeholder="Recherche..." aria-label="Recherche"
                           aria-describedby="search-addon"/>
                    <span class="input-group-text border-0" id="search-addon">
          <i class="fa fa-search"></i>
        </span>
                </div>
                <hr>
            </div>
            <div class="col-md-9 col-sm-9" style="margin-top: 20px;">
                <h2>TITLE HEADING</h2>
                <h5>Title description, Dec 7, 2017</h5>
                <div class="fakeimg">Fake Image</div>
                <p>Some text..</p>
                <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco.</p>
                <br>
                <h2>TITLE HEADING</h2>
                <h5>Title description, Sep 2, 2017</h5>
                <div class="fakeimg">Fake Image</div>
                <p>Some text..</p>
                <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco.</p>
            </div>
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
                        <button type="submit" class="btn btn-primary" id="sauvegarde">Sauvegarder</button>
                    </div>
                </div>
            <!--</form>-->
            </div>
        </div>
    </div>
@endsection
