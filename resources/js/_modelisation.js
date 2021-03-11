
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

$(function(){
    /* Attention, lignes suivantes ne fonctionnent peut-être pas sous IE */
    var largeurFenetre = (window.innerWidth);
    var hauteurFenetre = (window.innerHeight);
    //console.log(largeurFenetre);
    //console.log(hauteurFenetre);

    /* Adaptation de la taille de l'aquarium en fonction 
    de la taille de la fenêtre */

    const marge = 10; // marge de 10 pixels autour de l'aquarium

    // Taille du "grand" aquarium
    const longGrand = 800;
    const profGrand = 260;
    const hautGrand = 400;

    // Taille du "petit" aquarium
    const longPetit = 600;
    const profPetit = 200;
    const hautPetit = 300;

    let dimensions; // longueur, profondeur, hauteur
    let can;
    let ctx2;

    //valeur abberantes car on n'utilisera que le petit
    if (largeurFenetre < 150000 && hauteurFenetre < 750000 ){ 
        dimensions = [longPetit, profPetit, hautPetit]; 
    }else{
        dimensions = [longGrand, profGrand, hautGrand];
    };

    // Création du canvas
    can = $('#mod2D-test').get(0);
    //can.width = 2*marge + dimensions[0];
    //can.height = 2*marge + dimensions[2];
    const larCanvas = 2*marge + longPetit;
    const hautCanvas = 2*marge + hautPetit;
    can.width = larCanvas;
    can.height = hautCanvas;
    ctx2 = can.getContext("2d");

    // Affichage de face initial
    //traceContour(ctx2, can, dimensions[0], dimensions[2]);
    traceContour(ctx2, can, longPetit, hautPetit);
    let objetsAquarium = recupObjets2();
    afficheContenu(objetsAquarium, 'face', ctx2);

    function afficheContenu(obj, vue, ctx2){
        // On ajoute les images selon l'ordre de profondeur
        
        // Récupère une liste triée en fonction de la profondeur
        let objetsTries = trieObjetsAquarium(obj, vue);
        console.log(objetsTries);

        // Ajoute les images au canva
        rempliCanvas(objetsTries, vue, ctx2);
    }; 

    /*
        Pour les affichages de face ou de fond : ctx, can, longueur, hauteur
        Pour les affichages de côté : ctx, can, profondeur, hauteur
    */
    function traceContour(ctx2, can, dimx, hauteur){
        ctx2.clearRect(0, 0, can.width, can.height);
        ctx2.beginPath();
        ctx2.moveTo(marge,marge);
        ctx2.lineTo(marge + dimx,marge);
        ctx2.lineTo(marge + dimx,marge + hauteur);
        ctx2.lineTo(marge,marge + hauteur);
        ctx2.lineTo(marge,marge);
        ctx2.closePath();
        ctx2.lineWidth = 2; 
        ctx2.stroke();
    };

    /* Récupère les objets présents dans l'aquarium depuis la base de données */
    function recupObjets2(){
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

    function trieObjetsAquarium(obj, vue){
        // On classe les objets de l'aquarium dans l'ordre de la profondeur
        // en fonction de la vue souhaitée
        if (vue == "face"){
            // Dans une vue de face, les objets les plus proches ont
            // un y le plus petit
            let objetsTries=[];
            while (obj.length > 0){
                // On cherche l'objet le plus proche de la liste
                let y =1000000;
                let ind = -1;
                for (let i=0; i<obj.length;i++){
                    if(obj[i][1] <= y){
                        y = obj[i][1];
                        ind = i;
                    };
                };
                // On ajoute cet objet dans la nouvelle liste triée
                objetsTries.push(obj[ind]);
                // On le supprime de la liste actuelle
                obj.splice(ind,1);
            };
            return objetsTries;
        }else if(vue == "fond"){
            // Dans une vue de fond, les objets les plus proches ont
            // un y le plus grand
            let objetsTries=[];
            while (obj.length > 0){
                // On cherche l'objet le plus proche de la liste
                let y = -1;
                let ind = -1;
                for (let i=0; i<obj.length;i++){
                    if(obj[i][1] >= y){
                        y = obj[i][1];
                        ind = i;
                    };
                };
                // On ajoute cet objet dans la nouvelle liste triée
                objetsTries.push(obj[ind]);
                // On le supprime de la liste actuelle
                obj.splice(ind,1);
            };
            return objetsTries;
        }else if(vue == "droite"){
            // Dans une vue de droite, les objets les plus proches ont
            // un x le plus grand
            let objetsTries=[];
            while (obj.length > 0){
                // On cherche l'objet le plus proche de la liste
                let x = -1;
                let ind = -1;
                for (let i=0; i<obj.length;i++){
                    if(obj[i][0] >= x){
                        x = obj[i][0];
                        ind = i;
                    };
                };
                // On ajoute cet objet dans la nouvelle liste triée
                objetsTries.push(obj[ind]);
                // On le supprime de la liste actuelle
                obj.splice(ind,1);
            };
            return objetsTries;
        }else if(vue == "gauche"){
            // Dans une vue de gauche, les objets les plus proches ont
            // un x le plus petit
            let objetsTries=[];
            while (obj.length > 0){
                // On cherche l'objet le plus proche de la liste
                let x = 1000000;
                let ind = -1;
                for (let i=0; i<obj.length;i++){
                    if(obj[i][0] <= x){
                        x = obj[i][0];
                        ind = i;
                    };
                };
                // On ajoute cet objet dans la nouvelle liste triée
                objetsTries.push(obj[ind]);
                // On le supprime de la liste actuelle
                obj.splice(ind,1);
            };
            return objetsTries;
        };
    };

    function rempliCanvas(obj, vue, ctx2){
        obj.forEach(o => {
            var image = new Image();
            image.src = '../images/'+o[3];
            image.onload = function(){
                //img.height;
                //img.width;

                let largeur = image.width/1.5;
                let hauteur = image.height/1.5;
                if (hauteur >= hautPetit){
                    let newhauteur = hautPetit - 5;
                    largeur = largeur * (newhauteur / hauteur); // toujours proportionnel
                    hauteur = newhauteur;
                };
                if (vue == "droite" || vue == "gauche"){
                    if (largeur >= profPetit){
                        let newlargeur = profPetit - 5;
                        hauteur = hauteur * (newlargeur / largeur);
                        largeur = newlargeur;
                    };
                };

                let x;
                let y;
                if (vue == "face"){
                    x = o[0] + marge ; //coordx + marge
                    y = hautCanvas - marge - o[2] - hauteur;
                }else if(vue == "fond"){
                    x = larCanvas - marge - o[0] - largeur;
                    y = hautCanvas - marge - o[2] - hauteur;
                }else if(vue == "droite"){
                    x = o[1] + marge;
                    y = hautCanvas - marge - o[2] - hauteur;
                }else if(vue == "gauche"){
                    x = larCanvas - marge - (longPetit - profPetit) - o[1] - largeur;
                    y = hautCanvas - marge - o[2] - hauteur;
                }
                // Si jamais l'image sort de l'aquarium, on la remet dedans 
                //if (x + largeurImage > largeurCanvas - margeDroiteLong){
                if (vue == "droite" || vue == "gauche"){
                    if (x + largeur > marge +  profPetit){
                        x = marge +  profPetit - largeur;
                    }else if(x < marge){
                        x = marge;
                    };
                }else{
                    if (x + largeur > marge +  longPetit){
                        x = marge +  longPetit - largeur;
                    }else if(x < marge){
                        x = marge;
                    };
                };
                if (y + hauteur > marge + hautPetit){
                    y = marge + hautPetit - hauteur
                }else if(y < marge){
                    y = marge;
                };
            
                ctx2.globalCompositeOperation="destination-over";
                ctx2.drawImage(this, x, y, largeur, hauteur);//,largeurImage, hauteurImage);
                
            };
        });
    };

    $('#aqFace').on('click', function() {
        traceContour(ctx2, can, longPetit, hautPetit);
        let objetsAquarium = recupObjets2();
        afficheContenu(objetsAquarium, 'face', ctx2);
    });
    $('#aqFond').on('click', function() {
        traceContour(ctx2, can, longPetit, hautPetit);
        let objetsAquarium = recupObjets2();
        afficheContenu(objetsAquarium, 'fond', ctx2);
    });
    $('#aqGauche').on('click', function() {
        traceContour(ctx2, can, profPetit, hautPetit);
        let objetsAquarium = recupObjets2();
        afficheContenu(objetsAquarium, 'gauche', ctx2);
    });
    $('#aqDroite').on('click', function() {
        traceContour(ctx2, can, profPetit, hautPetit);
        let objetsAquarium = recupObjets2();
        afficheContenu(objetsAquarium, 'droite', ctx2);
    });


    // Fonction 1
    // Quand clique sur canvas
    // Affiche / démasque une div en lui donnant un emplacement (à calculer)
    // Mettre l'image dans la div, la superposer au canvas
    // Afficher canvas sans objet
    $('#mod2D-test').on('click', function(){
        $("#divImg").removeClass("d-none")
        let objet;
        $("#divImg").append("<img src='"+objet[3]+".png'/>");
        
    });


    // Fonction 2
    // Quand déselectionne div
    // Récupère emplacement objet et objet
    // Affiche canvas avec tous les objets
    // Enlève image de la div
    // Cache la div

    // A quoi correspondent les coordonnées qui sont récupérées ?


});




   /*
    // canvas related variables
    // references to canvas and its context and its position on the page
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var $canvas = $("#canvas");
    var canvasOffset = $canvas.offset();
    var offsetX = canvasOffset.left;
    var offsetY = canvasOffset.top;
    var scrollX = $canvas.scrollLeft();
    var scrollY = $canvas.scrollTop();
    var cw = canvas.width;
    var ch = canvas.height;

    // flag to indicate a drag is in process
    // and the last XY position that has already been processed
    var isDown = false;
    var lastX;
    var lastY;

    // the radian value of a full circle is used often, cache it
    var PI2 = Math.PI * 2;

    // variables relating to existing circles
    var circles = [];
    var stdRadius = 10;
    var draggingCircle = -1;

    // clear the canvas and redraw all existing circles
    function drawAll() {
        ctx.clearRect(0, 0, cw, ch);
        for (var i = 0; i < circles.length; i++) {
            var circle = circles[i];
            ctx.beginPath();
            ctx.arc(circle.x, circle.y, circle.radius, 0, PI2);
            ctx.closePath();
            ctx.fillStyle = circle.color;
            ctx.fill();
        }
    }

    function handleMouseDown(e) {
        // tell the browser we'll handle this event
        e.preventDefault();
        e.stopPropagation();

        // save the mouse position
        // in case this becomes a drag operation
        lastX = parseInt(e.clientX - offsetX);
        lastY = parseInt(e.clientY - offsetY);

        // hit test all existing circles
        var hit = -1;
        for (var i = 0; i < circles.length; i++) {
            var circle = circles[i];
            var dx = lastX - circle.x;
            var dy = lastY - circle.y;
            if (dx * dx + dy * dy < circle.radius * circle.radius) {
                hit = i;
            }
        }

        // if no hits then add a circle
        // if hit then set the isDown flag to start a drag
        if (hit < 0) {
            circles.push({
                x: lastX,
                y: lastY,
                radius: stdRadius,
                color: randomColor()
            });
            drawAll();
        } else {
            draggingCircle = circles[hit];
            isDown = true;
        }

    }

    function handleMouseUp(e) {
        // tell the browser we'll handle this event
        e.preventDefault();
        e.stopPropagation();

        // stop the drag
        isDown = false;
    }

    function handleMouseMove(e) {

        // if we're not dragging, just exit
        if (!isDown) {
            return;
        }

        // tell the browser we'll handle this event
        e.preventDefault();
        e.stopPropagation();

        // get the current mouse position
        mouseX = parseInt(e.clientX - offsetX);
        mouseY = parseInt(e.clientY - offsetY);

        // calculate how far the mouse has moved
        // since the last mousemove event was processed
        var dx = mouseX - lastX;
        var dy = mouseY - lastY;

        // reset the lastX/Y to the current mouse position
        lastX = mouseX;
        lastY = mouseY;

        // change the target circles position by the 
        // distance the mouse has moved since the last
        // mousemove event
        draggingCircle.x += dx;
        draggingCircle.y += dy;

        // redraw all the circles
        drawAll();
    }

    // listen for mouse events
    $("#canvas").mousedown(function (e) {
        handleMouseDown(e);
    });
    $("#canvas").mousemove(function (e) {
        handleMouseMove(e);
    });
    $("#canvas").mouseup(function (e) {
        handleMouseUp(e);
    });
    $("#canvas").mouseout(function (e) {
        handleMouseUp(e);
    });

    //////////////////////
    // Utility functions

    function randomColor() {
        return ('#' + Math.floor(Math.random() * 16777215).toString(16));
    }*/