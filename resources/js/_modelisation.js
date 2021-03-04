
const idProjet = 123 // A RECUPERER DEPUIS LA PAGE QUAND SERA DISPO


/* PARTIE REINITIALISATION D'UN PROJET*/
$(function(){
    /* Réinitialisation du projet*/
    $('#boutonReinit').on('click', function() {
        console.log('on va demander confirmation pour la réinitisalisation')

        /* Affichage modal de confirmation */
        $('#modalReinitProjet').modal('show');

        /* Confirmation de l'utilisateur */
        $('#validReinit').on('click', function(){
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
                success: function (data) {
                    console.log('success');
                    messageValidation();
                },
                error : function(data){
                    console.log('error');
                    console.log(data);
                }
            });
        });
    });
});
/* Affichage message uilisateur */
function messageValidation(){
    $("#reinitOk").removeClass("d-none");
};


/* PARTIE SAUVEGARDE D'UN PROJET */
$(function(){
    $('#boutonSauve').on('click', function() {
        console.log('on rentre dans la fonction de sauvegarde');
        var exist='';
        console.log(idProjet);
        /* Vérification si l'id du projet existe dans la base */
        var retour = $.ajax({
            url: 'modelisation1',
            type: 'GET',
            data: 'idProjet=' + idProjet,
            async : false,
            dataType: 'JSON',
            success: function (data) {
                console.log('success getProjet');
                console.log(data);
            },
            error : function(text){
                console.log('error getProjet');
                console.log(text);
            }
        });
        var exist = JSON.parse(retour.responseText);
        console.log(exist.response);

        // CAS OU LE PROJET N EXISTE PAS ENCORE
        if(exist.response == "introuvable"){
            console.log('le projet n existe pas encore, on va demander son nom');

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
                    success: function (data) {
                        console.log('success postNom');
                    },
                    error : function(text){
                        console.log('error postNom');
                        console.log(text);
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
            console.log('Le projet existe, on va le sauvegarder');

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
                success: function (data) {
                    console.log('success postSauveProjet');
                    $("#sauveFaite").removeClass("d-none");
                },
                error : function(data){
                    console.log('error postSauveProjet');
                    console.log(data)
                }
            });
        }
  });
});
/* Fonction d'ajout du nom du projet dans la base */
function submitForm(){
    var nom = $("#nom-projet").val();
    $.ajax({
        type: "POST",
        url: "modelisation",
        data: "nomProjet=" + nom,
        async : false
    });
    return nom;
};
/* Affichage message uilisateur */
function formSuccess(){
     $("#sauveOk").removeClass("d-none");
};



/* PARTIE MODELISATION 2D */
const largeurCanvas = 600;
const hauteurCanvas = 400;
const hauteurAquarium = 330;
const grandeLargeurAquarium = 580;
const petiteLargeurAquarium = 300;
const margeGaucheLong = 10;
const margeGauchePetit = 150;
const margeDroiteLong = 10;
const margeDroitePetit = 150;
const margeHaut = 10;
const margeBas = 60;

$(function(){
    $('#aqFace').on('click', function() {
        /* Canvas 2D */
        var c = $('#mod2D').get(0);
        var ctx = c.getContext("2d");

        // Dessine le contour de l'aquarium
        traceGrandContour(ctx);

        // Récupère les éléments présents dans l'aquarium (plantes et décorations)
        let objetsAquarium = recupObjets();
        
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
            ajoutImageFace(ind, objetsAquarium, ctx);
            objetsAquarium.splice(ind,1);
        };
    });
});
$(function(){
    $('#aqFond').on('click', function() {
        /* Canvas 2D */
        var c = $('#mod2D').get(0);
        var ctx = c.getContext("2d");

        // Dessine le contour de l'aquarium
        traceGrandContour(ctx);

        // Récupère les éléments présents dans l'aquarium (plantes et décorations)
        let objetsAquarium = recupObjets();
        
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
            ajoutImageFond(ind, objetsAquarium, ctx);
            objetsAquarium.splice(ind,1);
        };
    });
});
$(function(){
    $('#aqDroite').on('click', function() {
        /* Canvas 2D */
        var c = $('#mod2D').get(0);
        var ctx = c.getContext("2d");
        
        // Dessine le contour de l'aquarium
        tracePetitContour(ctx);

        // Récupère les éléments présents dans l'aquarium (plantes et décorations)
        let objetsAquarium = recupObjets();

        // On ajoute les images dans l'ordre de la profondeur afin qu'elles se superposent dans le bon sens
        while (objetsAquarium.length > 0){
            let x=0;
            let ind=0;
            for (let i = 0; i <objetsAquarium.length; i++){
                if (objetsAquarium[i][0]<= x){
                    y = objetsAquarium[i][0];
                    ind = i;
                };
            };
            ajoutImageDroite(ind, objetsAquarium, ctx);
            objetsAquarium.splice(ind,1);
        };
    });
});
$(function(){
    $('#aqGauche').on('click', function() {
        /* Canvas 2D */
        var c = $('#mod2D').get(0);
        var ctx = c.getContext("2d");
        
        // Dessine le contour de l'aquarium
        tracePetitContour(ctx);

        // Récupère les éléments présents dans l'aquarium (plantes et décorations)
        let objetsAquarium = recupObjets();

        // On ajoute les images dans l'ordre de la profondeur afin qu'elles se superposent dans le bon sens
        while (objetsAquarium.length > 0){
            let x=1000;
            let ind=0;
            for (let i = 0; i <objetsAquarium.length; i++){
                if (objetsAquarium[i][0]>= x){
                    y = objetsAquarium[i][0];
                    ind = i;
                };
            };
            ajoutImageGauche(ind, objetsAquarium, ctx);
            objetsAquarium.splice(ind,1);
        };
    });
});

/* Fonction d'affichage de l'objet dans l'aquarium pour une vue de face */
function ajoutImageFace(ind, objetsAquarium, ctx){
    var largeurImage = 210; 
    var hauteurImage = 250;// peut poser pb quand image mal rognée
    var x = objetsAquarium[ind][0] + margeGaucheLong;
    //var y = 10 + (hauteur - (10 + 60) - (objetsAquarium[ind][2])) - hauteurImage;
    //margeHaut + (hauteurTotale - (margeHaut + margeBas) - z) - hauteurImage
    // x = x + marge de gauche
    // y = marge haut + (taille carré - z) - hauteur image

    /* Séparation en 2 lignes d'objets sur le sol en fonction de la profondeur */
    if (objetsAquarium[ind][1] < 50){
        var y = 340 - hauteurImage;
    }else{
        var y = 270 - hauteurImage;
    };

    // Si jamais l'image sort de l'aquarium, on la remet dedans
    if (x + largeurImage > largeurCanvas - margeDroiteLong){
        x = largeurCanvas - margeDroiteLong - largeurImage;
    }else if(x < margeGaucheLong){
        x = margeGaucheLong;
    };
    if (y + hauteurImage > margeHaut + hauteurAquarium){
        y = margeHaut + hauteurAquarium - hauteurImage; // normalement, déjà ok
    }else if(y < margeHaut){
        y = margeHaut;
    };

    var image = new Image();
    image.src = '../images/'+objetsAquarium[ind][3];
    image.onload = function(){
        ctx.globalCompositeOperation="destination-over";
        ctx.drawImage(this, x, y, largeurImage, hauteurImage);
    };
};
/* Fonction d'affichage de l'objet dans l'aquarium pour une vue de fond */
function ajoutImageFond(ind, objetsAquarium, ctx){
    var largeurImage = 210; 
    var hauteurImage = 250;// peut poser pb quand image mal rognée
    var x = largeurCanvas - margeDroiteLong - objetsAquarium[ind][0] - largeurImage;
    // x = largeur totale - marge droite - x - largeur image

    /* Séparation en 2 lignes d'objets sur le sol en fonction de la profondeur */
    if (objetsAquarium[ind][1] < 50){
        var y = 340 - hauteurImage
    }else{
        var y = 270 - hauteurImage;
    };

    // Si jamais l'image sort de l'aquarium, on la remet dedans 
    if (x + largeurImage > largeurCanvas - margeDroiteLong){
        x = largeurCanvas - margeDroiteLong - largeurImage;
    }else if(x < margeGaucheLong){
        x = margeGaucheLong;
    };
    if (y + hauteurImage > margeHaut + hauteurAquarium){
        y = margeHaut + hauteurAquarium - hauteurImage; // normalement, déjà ok
    }else if(y < margeHaut){
        y = margeHaut;
    };

    var image = new Image();
    image.src = '../images/'+objetsAquarium[ind][3];
    image.onload = function(){
        ctx.globalCompositeOperation="destination-over";
        ctx.drawImage(this, x, y, largeurImage, hauteurImage);
    };
};
/* Fonction d'affichage de l'objet dans l'aquarium pour une vue de droite */
function ajoutImageDroite(ind, objetsAquarium, ctx){
    var largeurImage = 180; 
    var hauteurImage = 230;// peut poser pb quand image mal rognée
    var x = objetsAquarium[ind][1] + margeGauchePetit
    // nouveau x = y + marge gauche

    /* Séparation en 2 lignes d'objets sur le sol en fonction de la profondeur */
    if (objetsAquarium[ind][0] > 200){
        var y = 340 - hauteurImage;
    }else{
        var y = 270 - hauteurImage;
    };

    // Si jamais l'image sort de l'aquarium, on la remet dedans
    if (x + largeurImage > margeGauchePetit + petiteLargeurAquarium){
        x = margeGauchePetit + petiteLargeurAquarium - largeurImage;
    }else if(x < margeGauchePetit){
        x = margeGauchePetit;
    };
    if (y + hauteurImage > margeHaut + hauteurAquarium){
        y = margeHaut + hauteurAquarium - hauteurImage; // normalement, déjà ok
    }else if(y < margeHaut){
        y = margeHaut;
    };

    var image = new Image();
    image.src = '../images/'+objetsAquarium[ind][3];
    image.onload = function(){
        ctx.globalCompositeOperation="source-over";
        ctx.drawImage(this, x, y, largeurImage, hauteurImage);
    };
};
/* Fonction d'affichage de l'objet dans l'aquarium pour une vue de gauche */
function ajoutImageGauche(ind, objetsAquarium, ctx){
    var largeurImage = 180; 
    var hauteurImage = 230;// peut poser pb quand image mal rognée
    var x = largeurCanvas - margeDroitePetit - objetsAquarium[ind][1] - largeurImage;
    // x = largeur totale - marge droite - y - largeurImage

    /* Séparation en 2 lignes d'objets sur le sol en fonction de la profondeur */
    if (objetsAquarium[ind][0] < 200){
        var y = 340 - hauteurImage; 
    }else{
        var y = 270 - hauteurImage;
    };

    // Si jamais l'image sort de l'aquarium, on la remet dedans
    if (x + largeurImage > margeGauchePetit + petiteLargeurAquarium){
        x = margeGauchePetit + petiteLargeurAquarium - largeurImage;
    }else if(x < margeGauchePetit){
        x = margeGauchePetit;
    };
    if (y + hauteurImage > margeHaut + hauteurAquarium){
        y = margeHaut + hauteurAquarium - hauteurImage; // normalement, déjà ok
    }else if(y < margeHaut){
        y = margeHaut;
    };

    var image = new Image();
    image.src = '../images/'+objetsAquarium[ind][3];
    image.onload = function(){
        ctx.globalCompositeOperation="destination-over";
        ctx.drawImage(this, x, y, largeurImage, hauteurImage);
    };
};
/* Trace les contours de l'aquarium pour les vues de face et de fond */
function traceGrandContour(ctx){
    ctx.clearRect(0, 0, largeurCanvas, hauteurCanvas);
    ctx.beginPath();
    ctx.moveTo(margeGaucheLong,margeHaut);
    ctx.lineTo(margeGaucheLong+grandeLargeurAquarium,margeHaut);
    ctx.lineTo(margeGaucheLong+grandeLargeurAquarium,margeHaut+hauteurAquarium);
    ctx.lineTo(margeGaucheLong,margeHaut+hauteurAquarium);
    ctx.lineTo(margeGaucheLong,margeHaut);
    ctx.closePath();
    ctx.lineWidth = 2; 
    ctx.stroke();
    // // "Sol" de l'aquarium
    // ctx.globalCompositeOperation="destination-over";
    // ctx.fillStyle = 'rgba(244,205,152,1)';
    // ctx.fillRect(11,205,578,134);
};
/* Trace les contours de l'aquarium pour les vues de côté */
function tracePetitContour(ctx){
    ctx.clearRect(0, 0, largeurCanvas, hauteurCanvas);
    ctx.beginPath();
    ctx.moveTo(margeGauchePetit,margeHaut);
    ctx.lineTo(margeGauchePetit+petiteLargeurAquarium,margeHaut);
    ctx.lineTo(margeGauchePetit+petiteLargeurAquarium,margeHaut+hauteurAquarium);
    ctx.lineTo(margeGauchePetit,margeHaut+hauteurAquarium);
    ctx.lineTo(margeGauchePetit,margeHaut);
    ctx.closePath();
    ctx.lineWidth = 2; 
    ctx.stroke();
};
/* Récupère les objets présents dans l'aquarium depuis la base de données */
function recupObjets(){
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