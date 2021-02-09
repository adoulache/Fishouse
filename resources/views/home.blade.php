@extends('base')

@section('content')
    <!--Fonctionnalité principale : modélisation-->
    <div class="modelisationContent">
        <img class="modelisationImageHome" src="{{ asset('../images/aquarium2.jpg') }}" alt="image accueil modelisation">

        <div class="modelisationTextHome">

            <span class="personnalisation">Personnalisation </span> <br>
            <hr class="hrModelisation">

            <div>
                <a href="{{ route('modelisation') }}" class="modelisation">Modélise ton aquarium !</a>
            </div>

        </div>
    </div>

    <!--Toutes les fonctionnalités-->



    <div class="fonctionnalitésText">
        Les fonctionnalités<hr class="hrFonctionnalites">
    </div>



    <!--Pas alternées-->
    <div class="card-group">
        <div class="card mb-3">
            <img src="{{ asset('../images/Modélisation2.png') }}" class="card-img-top" alt="fonctionnalité modélisation">
            <div class="card-body">
                <p class="card-text">La fonctionnalité "modélisation" te permet de créer et de simuler ton propre aquarium.</p>
                <p class="card-text"><small class="text-muted">Fais le test en cliquant sur le bouton MODELISER, juste au-dessus
                        !</small></p>
            </div>
        </div>
        <div class="card mb-3">
            <img src="{{ asset('../images/Catalogue2.png') }}" class="card-img-bottom" alt="fonctionnalité catalogue">
            <div class="card-body">
                <p class="card-text">Le catalogue contient tous les éléments que tu recherches. Parcours-le et regarde ce que tu
                    aimerais pour ton aquarium !</p>
                <p class="card-text"><small class="text-muted">Décorations, plantes, poissons...</small></p>
            </div>
        </div>

        <div class="card mb-3">
            <img src="{{ asset('../images/Forum2.png') }}" class="card-img-top" alt="fonctionnalité forum">
            <div class="card-body">
                <p class="card-text">Un souci ? Viens poser ta question et obtiens une réponse claire de passionnés, voire même
                    de professionnels !</p>
                <p class="card-text"><small class="text-muted">Ou trouve ta réponse dans les sujets déjà créés.</small></p>
            </div>
        </div>
        <div class="card mb-3">
            <img src="{{ asset('../images/Fiches2.png') }}" class="card-img-bottom" alt="fonctionnalité fiches techniques">
            <div class="card-body">
                <p class="card-text">Retrouve tous les éléments techniques dont tu as besoin, sur les plantes ou les poissons.
                </p>
                <p class="card-text"><small class="text-muted">Tout ce que tu doit savoir se trouve dans l'onglet
                        correspondant.</small></p>
            </div>
        </div>
    </div>


    <p> ICIIIIIII <div id="imageDeco"></div> </p>
@endsection
