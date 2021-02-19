$(function(){
    /* Réinitialisation du projet*/
    $('#boutonReinit').on('click', function() {
    //   var id = document.getElementById('idProjetTest').textContent;
    //   console.log(id);
        var idProjet = 123;
        console.log(idProjet);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'modelisation4',
            type:'POST',
            data: 'idProjet=' + idProjet,
            async : false,
            // success: function() {
            //      alert('OK');
            // },
            // error: function() {
            //   alert('KO');
            // }
            success: function (data) {
                console.log(data);
                console.log('success');
            },
            error : function(data){
                console.log('error');
                console.log(data);
            }
        });
    });
});

/* Clic sur le bouton sauvegarde*/
$(function(){
    $('#boutonSauve').on('click', function() {
        console.log('clic sur le bouton sauvegarde');
        var idProjet = 123; // A MODIFIER quand on saura où il apparait
        var exist='';

        /* Vérification si l'id du projet existe dans la base */
        var retour = $.ajax({
            url: 'modelisation1',
            type: 'GET',
            data: 'idProjet=' + idProjet,
            async : false,
            dataType: 'JSON',
            success: function (data) {
                //console.log(data);
                console.log('success getProjet');
                console.log(data);
                // console.log(data.response);
                // console.log(data);
            },
            error : function(text){
                //console.log(text);
                console.log('error getProjet');
                // console.log(text.response);
                // console.log(text);
            }
        });
        //console.log(retour.responseJSON.get());
        var exist = JSON.parse(retour.responseText);
        console.log(exist.response);


        /* Retour : le projet n'existe pas encore (nouveau projet) */
        // ajout if(){} : A AJOUTER
        //if (retour.statusText!="OK"){

        // CAS OU LE PROJET N EXISTE PAS ENCORE
        if(exist.response == "introuvable"){
            console.log('le projet n existe pas encore');

            /* Affichage modal demande du nom du projet */
            $('#modalNomProjet').modal('show');

            $('#sauvegarde').click(function(event){
                event.preventDefault();
                var nomProjet = $('#nom-projet').val();
                console.log(nomProjet);

                /* insertion du nom du projet dans la base temporaire*/
                $.ajaxSetup({
                         headers: {
                               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           }
                       });
                $.ajax({
                    url: 'modelisation2',
                    type: 'POST',
                    data: 'nomProjet=' + nomProjet + '&idProjet=' + idProjet,
                    async : false,
                    // success : function(text){
                    //     if (text == "success"){
                    //         console.log('C est ok');
                    //     }
                    // }
                    success: function (data) {
                        console.log('success postNom');
                    },
                    error : function(text){
                        console.log('error postNom');
                    }
                });

                /* sauvegarde du projet dans la base */
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'modelisation3',
                    type: 'POST',
                    async : false,
                    data : {'idProjet':idProjet},
                    //data : 'idProjet=' + idProjet,
                    success: function (data) {
                        console.log('success postSauveProjet');
                        formSuccess();
                    },
                    error : function(data){
                        console.log('error postSauveProjet');
                    }
                });

            });

        }else{
        // CAS OU LE PROJET EXISTE
            console.log('projet existe déjà');

            /* sauvegarde du projet dans la base */
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'modelisation3',
                type: 'POST',
                async : false,
                data : {'idProjet':idProjet},
                //data : 'idProjet=' + idProjet,
                success: function (data) {
                    console.log('success postSauveProjet');
                    $("#sauveFaite").removeClass("hidden");
                },
                error : function(data){
                    console.log('error postSauveProjet');
                }
            });

        }
  });
});

function submitForm(){
    var nom = $("#nom-projet").val();
    $.ajax({
        type: "POST",
        url: "modelisation",
        data: "nomProjet=" + nom,
        async : false
        // success : function(text){
        //     if (text == "success"){
        //         formSuccess();
        //     }
        // }
    });

    return nom;

};
function formSuccess(){
     $("#sauveOk").removeClass("hidden");
};

/* Partie modélisation 2D */
$(function(){
    $('#aqFace').on('click', function() {
        var c = $('#mod2D').get(0);
        var ctx = c.getContext("2d");

        var idProjet = 123;

        // Dessine le contour de l'aquarium
        var hauteur = traceGrandContour(ctx);

        // Récupère les éléments présents dans l'aquarium (plantes et décorations)
        let objetsAquarium = recupObjets(idProjet);
        
        // On ajoute les images dans l'ordre de la profondeur afin qu'elles se superposent dans le bon sens
        while (objetsAquarium.length > 0){
            let y=1000;
            let ind=0;
            for (let i = 0; i <objetsAquarium.length; i++){
                if (objetsAquarium[i][1]<= y){
                    y = objetsAquarium[i][1];
                    ind = i;
                };
            };
            ajoutImageFace(ind, objetsAquarium, hauteur, ctx);
            objetsAquarium.splice(ind,1);
        };
    });
});
$(function(){
    $('#aqFond').on('click', function() {
        var c = $('#mod2D').get(0);
        var ctx = c.getContext("2d");

        var idProjet = 123;

        // Dessine le contour de l'aquarium
        var hauteur = traceGrandContour(ctx);

        // Récupère les éléments présents dans l'aquarium (plantes et décorations)
        let objetsAquarium = recupObjets(idProjet);
        
        // On ajoute les images dans l'ordre de la profondeur afin qu'elles se superposent dans le bon sens
        while (objetsAquarium.length > 0){
            let y=0;
            let ind=0;
            for (let i = 0; i <objetsAquarium.length; i++){
                if (objetsAquarium[i][1]>= y){
                    y = objetsAquarium[i][1];
                    ind = i;
                };
            };
            ajoutImageFond(ind, objetsAquarium, hauteur, ctx);
            objetsAquarium.splice(ind,1);
        };

        // Calcule quels éléments doivent être devant ou derrière (plus proche : y le plus grand dans la bdd)

        // Affiche les éléments dans l'aquarium en fonction des superpositions
        // et en fonction de l'axe des x (x pour aquarium et bdd mais inversé)
    });
});
$(function(){
    $('#aqDroite').on('click', function() {
        var c = $('#mod2D').get(0);
        var ctx = c.getContext("2d");
        
        // Dessine le contour de l'aquarium
        tracePetitContour(ctx);

        // Récupère les éléments présents dans l'aquarium (plantes et décorations)
    });
});
$(function(){
    $('#aqGauche').on('click', function() {

        var c = $('#mod2D').get(0);
        var ctx = c.getContext("2d");
        
        // Dessine le contour de l'aquarium
        tracePetitContour(ctx);

        // Récupère les éléments présents dans l'aquarium (plantes et décorations)
    });
});

function ajoutImageFace(ind, objetsAquarium, hauteur, ctx){
    var largeurImage = 210; 
    var hauteurImage = 250;// peut poser pb quand image mal rognée
    var x = objetsAquarium[ind][0]+10;
    //var y = 10 + (hauteur - (10 + 60) - (objetsAquarium[ind][2])) - hauteurImage;
    //margeHaut + (hauteurTotale - (margeHaut + margeBas) - z) - hauteurImage
    // x = x + marge de gauche
    // y = marge haut + (taille carré - z) - hauteur image

    /* Séparation en 2 lignes d'objets sur le sol en fonction de la profondeur */
    if (objetsAquarium[ind][1] < 50){
        var y = 340 - hauteurImage
    }else{
        var y = 270 - hauteurImage;
    };

    var image = new Image();
    image.src = '../images/'+objetsAquarium[ind][3];
    image.onload = function(){
        ctx.globalCompositeOperation="destination-over";
        ctx.drawImage(this, x, y, largeurImage, hauteurImage);
    };
};
function ajoutImageFond(ind, objetsAquarium, hauteur, ctx){
    var largeurImage = 210; 
    var hauteurImage = 250;// peut poser pb quand image mal rognée
    var x = 600 - 10 - objetsAquarium[ind][0] - largeurImage;
    // x = largeur totale - marge droite - x - largeur image

    /* Séparation en 2 lignes d'objets sur le sol en fonction de la profondeur */
    if (objetsAquarium[ind][1] < 50){
        var y = 340 - hauteurImage
    }else{
        var y = 270 - hauteurImage;
    };

    var image = new Image();
    image.src = '../images/'+objetsAquarium[ind][3];
    image.onload = function(){
        ctx.globalCompositeOperation="destination-over";
        ctx.drawImage(this, x, y, largeurImage, hauteurImage);
    };
};

function traceGrandContour(ctx){
    ctx.clearRect(0, 0, 600, 400);
    ctx.beginPath();
    ctx.moveTo(10,10);
    ctx.lineTo(590,10);
    ctx.lineTo(590,340);
    ctx.lineTo(10,340);
    ctx.lineTo(10,10);
    ctx.closePath();
    ctx.lineWidth = 2; 
    ctx.stroke();
    // "Sol" de l'aquarium
    // ctx.globalCompositeOperation="destination-over";
    // ctx.fillStyle = 'rgba(244,205,152,1)';
    // ctx.fillRect(11,205,578,134);    
    return 400;
};
function tracePetitContour(ctx){
    ctx.clearRect(0, 0, 600, 400);
    ctx.beginPath();
    ctx.moveTo(150,10);
    ctx.lineTo(450,10);
    ctx.lineTo(450,340);
    ctx.lineTo(150,340);
    ctx.lineTo(150,10);
    ctx.closePath();
    ctx.lineWidth = 2; 
    ctx.stroke();
};
function recupObjets(idProjet){
    /* PLANTES */
    var retour = $.ajax({
        url: 'modelisation5',
        type: 'GET',
        data: 'idProjet=' + idProjet,
        async : false,
        dataType: 'JSON',
        success: function (data) {
            console.log('success getPlantes');
        },
        error : function(text){
            console.log('error getPlantes');
        }
    });
    var reponsePlante = JSON.parse(retour.responseText);
    var plantesAquarium = [];
    if (reponsePlante.plantes.length > 0){
        reponsePlante.plantes.forEach((item)=>{
            /* Récupération du chemin de la plante */
            var retourChemin = $.ajax({
                url: 'modelisation7',
                type: 'GET',
                data: 'idPlante=' + item.id_plante,
                async : false,
                dataType: 'JSON',
                success: function (data) {
                    console.log('success getCheminPlantes');
                },
                error : function(text){
                    console.log('error getCheminPlantes');
                }
            });
            var parseChemin = JSON.parse(retourChemin.responseText);
            plantesAquarium.push([item.coordx, item.coordy, item.coordz, parseChemin.chemin]);
        });
    };

    /* DECORATIONS */
    var retourDeco = $.ajax({
        url: 'modelisation6',
        type: 'GET',
        data: 'idProjet=' + idProjet,
        async : false,
        dataType: 'JSON',
        success: function (data) {
            console.log('success getDecos');
        },
        error : function(text){
            console.log('error getDecos');
        }
    });
    var reponseDeco = JSON.parse(retourDeco.responseText);
    var decosAquarium = [];
    if (reponseDeco.decos.length > 0){
        reponseDeco.decos.forEach((item)=>{
            /* Récupération du chemin de la décoration */
            var retourCheminDeco = $.ajax({
                url: 'modelisation8',
                type: 'GET',
                data: 'idDeco=' + item.id_decoration,
                async : false,
                dataType: 'JSON',
                success: function (data) {
                    console.log('success getCheminDeco');
                },
                error : function(text){
                    console.log('error getCheminDeco');
                }
            });
            var parseCheminDeco = JSON.parse(retourCheminDeco.responseText);
            decosAquarium.push([item.coordx, item.coordy, item.coordz, parseCheminDeco.chemin]);
        });
    };

    // objets Aquarium contient les coordonnées des objets ainsi que leur nom permettant de trouver leur photo
    let objetsAquarium = plantesAquarium.concat(decosAquarium);
    return objetsAquarium;
    };