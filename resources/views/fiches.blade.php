@extends('base')

@section('content')
    <!-- Début des fiches techniques -->
    <div class="container-fluid">
        <div class='row'>
            <div class='col-2' id='historique'>
                <div class="container-fluid pt-4">
                    Historique
                </div>
            </div>
            <div class='col-10'>
                <div class="container-fluid p-3">
                    <h2 id="titleFiche" style="font-family: 'Palatino Linotype';">Fiches techniques</h2>
                    <hr id="hrFiche">
                </div>
                <div class="container-fluid">
                    <!-- Onglets -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="poisson-tab" data-toggle="tab" href="#poisson" role="tab" aria-controls="poisson" aria-selected="true">Poissons</a>
                        </li>
                        <li class="nav-item" >
                            <a class="nav-link" id="plante-tab" data-toggle="tab" href="#plante" role="tab" aria-controls="plante" aria-selected="false">Plantes et coraux</a>
                        </li>
                    </ul>
                    <!-- Contenu des onglets -->
                    <div class="tab-content" id="myTabContent">
                        <!-- Onglet n°1 : poissons -->
                        <div class="tab-pane fade show active" id="poisson" role="tabpanel" aria-labelledby="poisson-tab">
                            <!-- Barre de recherche -->
                            <div class="mt-3">
                                <form class="form-inline">
                                    <select class="form-control mr-sm-2">
                                        <option selected="selected" value="0">Catégorie</option>
                                        <option value="1">Cat 1</option>
                                    </select>
                                    <input class="form-control mr-sm-2" type="search" placeholder="Poisson rouge, tetra, guppy, ..." id="barre-recherche-poisson">
                                    <button class="btn btn-dark" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <!-- Fiches des poissons -->
                            <div class="card-deck mt-3">

                                <button class="card" style="border-color: white;" data-toggle="modal" data-target="#modalPoisson" data-titre="Néon bleu" data-image="https://www.zooplus.fr/magazine/wp-content/uploads/2018/01/fotolia_70329422.jpg">
                                    <img src="https://www.zooplus.fr/magazine/wp-content/uploads/2018/01/fotolia_70329422.jpg" class="card-img-top" alt="Néon bleu">
                                    <div class="card-footer container-fluid">Néon bleu</div>
                                </button>

                                <button class="card" data-toggle="modal" data-target="#modalPoisson" data-image="https://image.freepik.com/photos-gratuite/poisson-betta-demi-lune-poisson-combattant-siamois-capture-poisson-mouvement-betta-splendens_41969-211.jpg" data-titre="Combattant">
                                    <img src="https://image.freepik.com/photos-gratuite/poisson-betta-demi-lune-poisson-combattant-siamois-capture-poisson-mouvement-betta-splendens_41969-211.jpg"
                                         class="card-img-top" alt="Combattant">
                                    <div class="card-footer container-fluid">Combattant</div>
                                </button>

                                <button class="card" data-toggle="modal" data-target="#modalPoisson" data-image="https://image.freepik.com/photos-gratuite/poisson-clown-dans-anemone_38810-7634.jpg" data-titre="Poisson clown">
                                    <img src="https://image.freepik.com/photos-gratuite/poisson-clown-dans-anemone_38810-7634.jpg"
                                         class="card-img-top" alt="Poisson clown">
                                    <div class="card-footer container-fluid">Poisson clown</div>
                                </button>

                                <button class="card" data-toggle="modal" data-target="#modalPoisson" data-image="https://media.istockphoto.com/photos/pecimen-of-longsnouted-hippocampus-in-the-aquarium-picture-id1193485569?k=6&m=1193485569&s=612x612&w=0&h=jdfJORxLoW86oynoqngENvQFqMpCw9YW0H7aCYRCEGM=" data-titre="Hippocampe">
                                    <img src="https://media.istockphoto.com/photos/pecimen-of-longsnouted-hippocampus-in-the-aquarium-picture-id1193485569?k=6&m=1193485569&s=612x612&w=0&h=jdfJORxLoW86oynoqngENvQFqMpCw9YW0H7aCYRCEGM="
                                         class="card-img-top" alt="Hippocampe">
                                    <div class="card-footer container-fluid">Hippocampe</div>
                                </button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modalPoisson" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-2 text-center" id="modal-image-poisson"></div>
                                                    <div class="col-9 pl-5">
                                                        <h3 class="container-fluid p-3" id="modal-nom-poisson"></h3>
                                                        <div class="container-fluid p-3">Description et informations</div>
                                                        <!-- Si l'utilisateur n'est pas connecté -->
                                                        <div class="container-fluid p-3">Pour en savoir plus, <a href="#" role="button">inscris-toi</a> ou <a href="#" role="button">connecte-toi</a></div>
                                                    </div>
                                                    <div class="col-1">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $('#modalPoisson').on('show.bs.modal', function (event) {
                                    $('#modal-image-poisson').empty()
                                    var button = $(event.relatedTarget)
                                    var recipient = button.data('titre')
                                    var image = button.data('image')
                                    var modal = $(this)
                                    var im = new Image()
                                    im.src=image
                                    $('#modal-nom-poisson').text(recipient)
                                    //im.style.height='150px'
                                    im.style.width='200px'
                                    $('#modal-image-poisson').append(im)
                                })

                            </script>

                            <!-- Pagination -->
                            <div class="mt-3">
                                <nav aria-label="Exemple de pagination">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item"><a class="page-link" href="#">Précédent</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Suivant</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <!-- Onglet n°2 : plantes -->
                        <div class="tab-pane fade" id="plante" role="tabpanel" aria-labelledby="plante-tab">
                            <!-- Barre de recherche -->
                            <div class="mt-3">
                                <form class="form-inline">
                                    <select class="form-control mr-sm-2">
                                        <option selected="selected" value="0">Catégorie</option>
                                        <option value="1">Cat 1</option>
                                    </select>
                                    <input class="form-control mr-sm-2" type="search" placeholder="Anémone, échinodorus, ..." id="barre-recherche-plante">
                                    <button class="btn btn-dark" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>

                            <!-- Fiches des plantes -->
                            <div class="card-deck mt-3">
                                <button class="card" data-toggle="modal" data-target="#modalPlante" data-image="https://media.cdnws.com/_i/1792/2847/1/50/anubias-barteri-var-nana.jpeg" data-titre="Anubias">
                                    <img src="https://media.cdnws.com/_i/1792/2847/1/50/anubias-barteri-var-nana.jpeg" class="card-img-top" alt="Anubias">
                                    <div class="card-footer container-fluid">Anubias</div>
                                </button>
                                <button class="card" data-toggle="modal" data-target="#modalPlante" data-image="https://www.nausicaa.fr/content/uploads/2018/04/1280x677-Corail-Tubastrea-faulkneri-Justin-Casp-copie-compressor.jpg" data-titre="Tubastrea">
                                    <img src="https://www.nausicaa.fr/content/uploads/2018/04/1280x677-Corail-Tubastrea-faulkneri-Justin-Casp-copie-compressor.jpg"
                                         class="card-img-top" alt="Corail tubastrée orange">
                                    <div class="card-footer container-fluid">Tubastrea</div>
                                </button>
                                <button class="card" data-toggle="modal" data-target="#modalPlante" data-image="https://cdn.shopify.com/s/files/1/1163/2672/products/Dark_Red_Ludwigia_9_1024x1024.jpg?v=1565098815" data-titre="Ludwigia">
                                    <img src="https://cdn.shopify.com/s/files/1/1163/2672/products/Dark_Red_Ludwigia_9_1024x1024.jpg?v=1565098815"
                                         class="card-img-top" alt="Ludwigia">
                                    <div class="card-footer container-fluid">Ludwigia</div>
                                    </buton>
                                    <button class="card" data-toggle="modal" data-target="#modalPlante" data-image="https://lh3.googleusercontent.com/proxy/wABG7TQgpUxLhwCHMwJXJXz_J20lxWEmwjp8dsX65HcN09stO1TqbSyeLU0JrDvdoh7anhTGoF9p5XX3M_K1BW6ldPcW2btPumLlC4WOIGrNxHpP5jpbcPDXmsg1PVA" data-titre="Euphyllia">
                                        <img src="https://lh3.googleusercontent.com/proxy/wABG7TQgpUxLhwCHMwJXJXz_J20lxWEmwjp8dsX65HcN09stO1TqbSyeLU0JrDvdoh7anhTGoF9p5XX3M_K1BW6ldPcW2btPumLlC4WOIGrNxHpP5jpbcPDXmsg1PVA"
                                             class="card-img-top" alt="Euphyllia">
                                        <div class="card-footer container-fluid">Euphyllia</div>
                                    </button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="modalPlante" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-2 text-center" id="modal-image-plante"></div>
                                                    <div class='col-9 pl-5'>
                                                        <h3 class="container-fluid p-3" id="modal-nom-plante"></h3>
                                                        <div class="container-fluid p-3">Description et informations</div>
                                                    </div>
                                                    <div class="col-1">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <hr class="barreModalPlante">
                                                <div class="row container-fluid mt-3">
                                                    <!--<div class='col bg-light border m-1'>-->
                                                    <div class="col-2" style="background-color: white;text-align: center;">
                                                        <h6 class="p-2">Type d'eau</h6>
                                                        <div><i class="fa fa-thermometer-half" aria-hidden="true"></i> bla</div>
                                                        <div><i class="fa fa-tint" aria-hidden="true" style="color: blue;"></i> bla</div>
                                                        <div><i class="fa fa-tint" aria-hidden="true" style="color: red;"></i> bla</div>
                                                        <div>eau douce / eau salée</div>
                                                    </div>
                                                    <!--<div class='col bg-light border m-1'>-->
                                                    <div class="col-3" style="background-color: white;text-align: center;">
                                                        <h6 class="p-2">Poissons les plus compatibles</h6>
                                                        <div>Poisson 1</div>
                                                        <div>Poisson 2</div>
                                                        <div>Poisson 3</div>
                                                    </div>
                                                    <!--<div class='col bg-light border m-1'>-->
                                                    <div class="col-4" style="background-color: white;text-align: center;">
                                                        <h6 class="p-2">Plantes les moins compatibles</h6>
                                                        <div>Plante 1</div>
                                                        <div>Plante 2</div>
                                                        <div>Plante 3</div>
                                                    </div>
                                                    <!--<div class='col bg-light border m-1'>-->
                                                    <div class="col-3" style="background-color: white;text-align: center;">
                                                        <h6 class="p-2">Facilité d'entretien</h6>
                                                        <div>
                                                            5/5
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success" style="width: 100%;" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="barreModalPlante">
                                                <div class="row">
                                                    <!--<div class='col-9'>-->
                                                    <h5 class="container-fluid p-3">Commentaires</h5>
                                                    <!--<div class="card-deck mt-3">-->
                                                    <div class="card w-100 m-2">
                                                        <div class="card-header">
                                                            Photo - Titre - Commentaire de ... le ...
                                                        </div>
                                                        <div class="card-body">
                                                            <div>
                                                                Message
                                                            </div>
                                                            <div>
                                                                Note / utile / Pas utile
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card w-100 m-2">
                                                        <div class="card-header">
                                                            Photo - Titre - Commentaire de ... le ...
                                                        </div>
                                                        <div class="card-body">
                                                            <div>
                                                                Message
                                                            </div>
                                                            <div>
                                                                Note / utile / Pas utile
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--</div>-->
                                                    <!--</div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $('#modalPlante').on('show.bs.modal', function (event) {
                                    $('#modal-image-plante').empty()
                                    var button = $(event.relatedTarget)
                                    var recipient = button.data('titre')
                                    var image = button.data('image')
                                    var modal = $(this)
                                    var im = new Image()
                                    im.src=image
                                    //im.className="center-block"
                                    $('#modal-nom-plante').text(recipient)
                                    //im.style.height='150px'
                                    im.style.width='200px'
                                    $('#modal-image-plante').append(im)
                                })

                            </script>

                            <!-- Pagination -->
                            <div class="mt-3">
                                <nav aria-label="Exemple de pagination">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item"><a class="page-link" href="#">Précédent</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Suivant</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- Script pour passer d'un onglet à l'autre -->
                        <script>
                            $('#myTab a').on('click', function (e) {
                                e.preventDefault()
                                $(this).tab('show')
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
