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
    </div>
@endsection
