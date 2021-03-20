@extends('base')

<!--Fonctionnalité principale : contact + info-->
@section('content')

<div class="bg-light">
  <div class="container py-5" style="margin:auto">
    <div class="row h-100 align-items-center py-5">
      <div class="col-lg-7">
        <h1 class="display-4">A propos de FisHouse</h1>
        <p class="lead text-muted mb-0">Nous sommes une jeune entreprise, dont les membres sont tous droits sortis de l'IDMC de Nancy ! Nous sommes actuellement en Master Sciences Cognitives et nous faisons ce projet dans le cadre de plusieurs cours comme "Ergonomie des applications", "Introduction à l'IHM" et "Technologies du web avancées".</p>
      </div>
      <div class="col-lg-5 d-none d-lg-block"><img src="{{ asset('../images/professional.png') }}" style="width:75%;margin:auto" alt="" class="img-fluid"></div>
    </div>
  </div>
</div>

<div class="bg-white py-5">
  <div class="container py-5">
    <div class="row align-items-center mb-5">
      <div class="col-lg-6 order-2 order-lg-1"><i class="fa fa-bar-chart fa-2x mb-3 text-primary"></i>
        <h2 class="font-weight-light">Nous avons conçu ce site pour te permettre de rester chez toi</h2>
        <p class="font-italic text-muted mb-4">Tu peux ainsi créer l'aquarium de tes rêves ou même simplement faire des recherches pour en savoir plus sur les poissons, tout en restant bien confortablement assis dans ton canapé !</p><a href="#" class="btn btn-light px-5 rounded-pill shadow-sm">Learn More</a>
      </div>
      <div class="col-lg-5 px-5 mx-auto order-1 order-lg-2"><img src="{{ asset('../images/atHome.png') }}" alt="" class="img-fluid mb-4 mb-lg-0"></div>
    </div>
    <div class="row align-items-center">
      <div class="col-lg-5 px-5 mx-auto"><img src="{{ asset('../images/shareBuying.jpg') }}" alt="" class="img-fluid mb-4 mb-lg-0"></div>
      <div class="col-lg-6"><i class="fa fa-leaf fa-2x mb-3 text-primary"></i>
        <h2 class="font-weight-light">Tu peux également faire ta liste de courses directement depuis FisHouse</h2>
        <p class="font-italic text-muted mb-4">FisHouse te permet de sauvegarder ton panier et de vérifier où les articles que tu as choisi sont disponibles, dans un périmètre autour de chez toi. Ensuite, tu n'as plus qu'à aller les récupérer en magasin, après les avoir réservés !</p><a href="#" class="btn btn-light px-5 rounded-pill shadow-sm">Learn More</a>
      </div>
    </div>
  </div>
</div>

<div class="bg-light py-5">
  <div class="container py-5">
    <div class="row mb-4">
      <div class="col-lg-8">
        <h2 class="display-4 font-weight-light">Notre équipe</h2>
        <p class="font-italic text-muted">Notre équipe est composée de personnes aux talents multiples, ce qui nous permet de nous compléter en compétences.</p>
      </div>
    </div>

    <div class="row text-center">
      <!-- Team item-->
      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="{{ asset('../images/iconWoman3.png') }}" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
          <h5 class="mb-0">Amélie Delain</h5><span class="small text-uppercase text-muted">Fondatrice de FisHouse</span>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
      <!-- End-->

      <!-- Team item-->
      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="{{ asset('../images/iconWoman2.png') }}" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
          <h5 class="mb-0">Clara Schott</h5><span class="small text-uppercase text-muted">Fondatrice de FisHouse</span>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
      <!-- End-->

      <!-- Team item-->
      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="{{ asset('../images/iconMan.png') }}" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
          <h5 class="mb-0">Anass Doulache</h5><span class="small text-uppercase text-muted">Fondateur de FisHouse</span>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
      <!-- End-->

      <!-- Team item-->
      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="{{ asset('../images/iconWoman1.png') }}" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
          <h5 class="mb-0">Cynthia Laurent</h5><span class="small text-uppercase text-muted">Fondatrice de FisHouse</span>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
      <!-- End-->

    </div>
  </div>
</div>

@endsection