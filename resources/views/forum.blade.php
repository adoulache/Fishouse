@extends('base')

@section('content')
    <h1 class="titleForum">Le forum
        <hr class='hrForum'>
    </h1>

    <div class="container">
        <form action="/recherche/" method="get">
            <fieldset>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <select id="oCategorie" name="oCategorie" class="custom-select">
                            <option selected="selected" value="0">Catégorie</option>
                            <option value="1">Bacs aquarium</option>
                            <option value="2">Décorations</option>
                            <option value="3">Plantes</option>
                            <option value="4">Poissons</option>
                            <option value="3">Pompes</option>
                        </select>
                    </div>
                    <input id="oSaisie" name="oSaisie" type="text" class="form-control" aria-label="Saisie de mots clés"
                           placeholder="Mot(s) clé(s)" required="required">
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="submit">Recherche</button>
                    </div>
                </div>
            </fieldset>
        </form>

        <br>

        <h4> Questions les plus fréquemment posées </h4>

        <div class="card-group">
            <div class="card mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Question 1</h5>
                        <p class="card-text">Réponse 1.</p>
                        <a class="btn btn-dark" href="Sujet.html"> <small>Voir le détail de cette question</small></a>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Question 1</h5>
                        <p class="card-text">Réponse 1.</p>
                        <a class="btn btn-dark" href="Sujet.html"> <small>Voir le détail de cette question</small></a>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Question 1</h5>
                        <p class="card-text">Réponse 1.</p>
                        <a class="btn btn-dark" href="Sujet.html"> <small>Voir le détail de cette question</small></a>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Question 1</h5>
                        <p class="card-text">Réponse 1.</p>
                        <a class="btn btn-dark" href="Sujet.html"> <small>Voir le détail de cette question</small></a>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-group">
            <div class="card mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Question 1</h5>
                        <p class="card-text">Réponse 1.</p>
                        <a class="btn btn-dark" href="Sujet.html"> <small>Voir le détail de cette question</small></a>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Question 1</h5>
                        <p class="card-text">Réponse 1.</p>
                        <a class="btn btn-dark" href="Sujet.html"> <small>Voir le détail de cette question</small></a>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Question 1</h5>
                        <p class="card-text">Réponse 1.</p>
                        <a class="btn btn-dark" href="Sujet.html"> <small>Voir le détail de cette question</small></a>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Question 1</h5>
                        <p class="card-text">Réponse 1.</p>
                        <a class="btn btn-dark" href="Sujet.html"> <small>Voir le détail de cette question</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
