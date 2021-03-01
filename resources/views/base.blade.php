<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Fishouse, le site fait pour vos poissons !')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{​​{​​ csrf_token() }​​}​​">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="http://mrdoob.github.com/three.js/build/three.min.js"></script>
    <!--<script src="../controller/Modélisation.js"></script>-->
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>

<!--HEADER-->
<header class="header">
    <div class="buttonHeader">
        <a class="btn btn-dark" href="#home">Connexion</a>
        <a class="btn btn-dark" href="#contact">Inscription</a>
    </div>
</header>

<!--BAR DE NAVIGATION-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item hover:black">
                <a class="nav-link" href="{{ route('accueil') }}">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('projet') }}">Modélisation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Catalogue</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('forum') }}">Forum</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('fiches') }}">Fiches techniques</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Aide / Contact</a>
            </li>
        </ul>
    </div>
</nav>

@yield('content')

<!--FOOTER-->
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8 col-xs-12">
                <p class="copyright-text">Copyright &copy; 2021 Tous droits réservés par
                    <a href="{{ route('accueil') }}">FisHouse</a>.
                </p>
            </div>

            <div class="col-md-3 col-sm-4 col-xs-12 wrapper">
                <ul>
                    <li class="facebook"> <a href="#"><i class="fa fa-facebook"></i></a> </li>
                    <li class="twitter"> <a href="#"><i class="fa fa-twitter"></i></a> </li>
                    <li class="instagram"> <a href="#"><i class="fa fa-instagram"></i></a> </li>
                    <li class="google"> <a href="#"><i class="fa fa-google"></i></a> </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
