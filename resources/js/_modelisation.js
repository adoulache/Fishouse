$(function () {
    const idProjet = $('#idProjetCache').text();
    $('#nomFaceCache').text("face");

    console.log('id_projet _modelisation.js ' + idProjet);

    $(function () {
        $.ajax({
            url: 'ma_modelisation',
            type: 'GET',
            async: false,
            success: function (data) {
                console.log('SUCCES dans la récupération des decorations et des plantes pour catalogue');
            },
            error: function (data) {
                console.log('ERREUR dans la récupération des decorations et des plantes pour catalogue')
            }
        });
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });


    /* PARTIE REINITIALISATION D'UN PROJET*/
    $(function () {
        /* Réinitialisation du projet*/
        $('#boutonReinit').on('click', function () {
            $("#reinitOk").addClass("d-none")
            //console.log('on va demander confirmation pour la réinitisalisation')

            /* Affichage modal de confirmation */
            $('#modalReinitProjet').modal('show');

            /* Confirmation de l'utilisateur */
            $('#validReinit').on('click', function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'modelisation4',
                    type: 'POST',
                    data: 'idProjet=' + idProjet,
                    async: false,
                    success: function (data) {
                        console.log('succès réinitialisation du projet');
                        messageValidation();
                    },
                    error: function (data) {
                        console.log('erreur réinitialisation du projet');
                        console.log(data);
                    }
                });
            });
        });
    });

    /* Affichage message uilisateur */
    function messageValidation() {
        $("#reinitOk").removeClass("d-none");
    };


    /* PARTIE SAUVEGARDE D'UN PROJET */
    $(function () {
        $('#boutonSauve').on('click', function () {
            $("#sauveOk").addClass("d-none");
            $("#sauveFaite").addClass("d-none")
            //console.log('on rentre dans la fonction de sauvegarde');
            var exist = '';
            //console.log(idProjet);
            /* Vérification si l'id du projet existe dans la base */
            var retour = $.ajax({
                url: 'modelisation1',
                type: 'GET',
                data: 'idProjet=' + idProjet,
                async: false,
                dataType: 'JSON',
                success: function (data) {
                    console.log('success getProjet');
                    //console.log(data);
                },
                error: function (text) {
                    console.log('error getProjet');
                    //console.log(text);
                }
            });
            var exist = JSON.parse(retour.responseText);
            //console.log(exist.response);

            // CAS OU LE PROJET N EXISTE PAS ENCORE
            if (exist.response == "introuvable") {
                //console.log('le projet n existe pas encore, on va demander son nom');

                /* Affichage modal demande du nom du projet */
                $('#modalNomProjet').modal('show');

                $('#sauvegarde').click(function (event) {
                    event.preventDefault();
                    var nomProjet = $('#nom-projet').val();
                    //console.log(nomProjet);
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
                        async: false,
                        success: function (data) {
                            console.log('success postNom');
                        },
                        error: function (text) {
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
                        async: false,
                        data: {'idProjet': idProjet},
                        success: function (data) {
                            console.log('success postSauveProjet');
                            formSuccess();
                        },
                        error: function (data) {
                            console.log('error postSauveProjet');
                        }
                    });
                });

            } else {
                // CAS OU LE PROJET EXISTE
                //console.log('Le projet existe, on va le sauvegarder');

                /* sauvegarde du projet dans la base */
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'modelisation3',
                    type: 'POST',
                    async: false,
                    data: {'idProjet': idProjet},
                    success: function (data) {
                        console.log('success postSauveProjet');
                        $("#sauveFaite").removeClass("d-none");
                        setTimeout(function () {
                            $("#sauveFaite").addClass("d-none");
                        }, 3000);
                    },
                    error: function (data) {
                        console.log('error postSauveProjet');
                        console.log(data)
                    }
                });
            }
        });
    });

/* Affichage message uilisateur */
function formSuccess(){
     $("#sauveOk").removeClass("d-none");
};

    /* PARTIE MODELISATION 2D */

    $(function () {
        /* Attention, lignes suivantes ne fonctionnent peut-être pas sous IE */
        var largeurFenetre = (window.innerWidth);
        var hauteurFenetre = (window.innerHeight);
        //console.log(largeurFenetre);
        //console.log(hauteurFenetre);

        /* Adaptation de la taille de l'aquarium en fonction
        de la taille de la fenêtre */

        const marge = 0;//10; // marge de 10 pixels autour de l'aquarium

        // Taille du "grand" aquarium
        const longGrand = 800;
        const profGrand = 260;
        const hautGrand = 400;

        // Taille du "petit" aquarium
        /*const longPetit = 600;
        const profPetit = 200;
        const hautPetit = 300;*/
        const longPetit = 1000;
        const profPetit = 333;
        const hautPetit = 500;

        /* Plus utile puisque plus de canvas
        let dimensions; // longueur, profondeur, hauteur
        let can;
        let ctx2;
        */

        //valeur abberantes car on n'utilisera que le petit
        if (largeurFenetre < 150000 && hauteurFenetre < 750000) {
            dimensions = [longPetit, profPetit, hautPetit];
        } else {
            dimensions = [longGrand, profGrand, hautGrand];
        }
        ;

        // Création du canvas
        //can = $('#mod2D-test').get(0);
        //can.width = 2*marge + dimensions[0];
        //can.height = 2*marge + dimensions[2];
        const larCanvas = 2 * marge + longPetit;
        const hautCanvas = 2 * marge + hautPetit;
        //can.width = larCanvas;
        //can.height = hautCanvas;
        //ctx2 = can.getContext("2d");

        // Affichage de face initial
        //traceContour(ctx2, can, longPetit, hautPetit);
        let objetsAquarium = recupObjets2();
        //afficheContenu(objetsAquarium, 'face', ctx2);
        afficheContenu(objetsAquarium, 'face');

        //function afficheContenu(obj, vue, ctx2){
        function afficheContenu(obj, vue) {
            // On ajoute les images selon l'ordre de profondeur

            // Récupère une liste triée en fonction de la profondeur
            let objetsTries = trieObjetsAquarium(obj, vue);
            //console.log(objetsTries);

            // Ajoute les images au canva
            //rempliCanvas(objetsTries, vue, ctx2);
            rempliCanvas(objetsTries, vue);
        };

        /*
            Pour les affichages de face ou de fond : ctx, can, longueur, hauteur
            Pour les affichages de côté : ctx, can, profondeur, hauteur
        */
        /* Plus utile car plus de canvas
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
         };*/

        /* Récupère les objets présents dans l'aquarium depuis la base de données */
        function recupObjets2() {
            /* PLANTES */
            //console.log(idProjet);
            var retour = $.ajax({
                url: 'modelisation5',
                type: 'GET',
                data: 'idProjet=' + idProjet,
                async: false,
                dataType: 'JSON',
                success: function (data) {
                    console.log('success getPlantes');
                },
                error: function (text) {
                    console.log('error getPlantes');
                }
            });
            var reponsePlante = JSON.parse(retour.responseText);
            var plantesAquarium = [];
            if (reponsePlante.plantes.length > 0) {
                reponsePlante.plantes.forEach((item) => {
                    /* Récupération du chemin de la plante */
                    var retourChemin = $.ajax({
                        url: 'modelisation7',
                        type: 'GET',
                        data: 'idPlante=' + item.id_plante,
                        async: false,
                        dataType: 'JSON',
                        success: function (data) {
                            console.log('success getCheminPlantes');
                        },
                        error: function (text) {
                            console.log('error getCheminPlantes');
                        }
                    });
                    var parseChemin = JSON.parse(retourChemin.responseText);
                    plantesAquarium.push([item.coordx, item.coordy, item.coordz, parseChemin.chemin, item.id_unique]);
                });
            }
            ;

            /* DECORATIONS */
            var retourDeco = $.ajax({
                url: 'modelisation6',
                type: 'GET',
                data: 'idProjet=' + idProjet,
                async: false,
                dataType: 'JSON',
                success: function (data) {
                    console.log('success getDecos');
                },
                error: function (text) {
                    console.log('error getDecos');
                }
            });
            var reponseDeco = JSON.parse(retourDeco.responseText);
            var decosAquarium = [];
            if (reponseDeco.decos.length > 0) {
                reponseDeco.decos.forEach((item) => {
                    /* Récupération du chemin de la décoration */
                    var retourCheminDeco = $.ajax({
                        url: 'modelisation8',
                        type: 'GET',
                        data: 'idDeco=' + item.id_decoration,
                        async: false,
                        dataType: 'JSON',
                        success: function (data) {
                            console.log('success getCheminDeco');
                        },
                        error: function (text) {
                            console.log('error getCheminDeco');
                        }
                    });
                    var parseCheminDeco = JSON.parse(retourCheminDeco.responseText);
                    decosAquarium.push([item.coordx, item.coordy, item.coordz, parseCheminDeco.chemin, item.id_unique]);
                });
            }
            ;

            // objets Aquarium contient les coordonnées des objets ainsi que leur nom permettant de trouver leur photo
            let objetsAquarium = plantesAquarium.concat(decosAquarium);
            return objetsAquarium;
        };

        function trieObjetsAquarium(obj, vue) {
            // On classe les objets de l'aquarium dans l'ordre de la profondeur
            // en fonction de la vue souhaitée
            if (vue == "fond") {
                // Dans une vue de fond, les objets les plus loins ont
                // un y le plus petit
                let objetsTries = [];
                while (obj.length > 0) {
                    // On cherche l'objet le plus proche de la liste
                    let y = 1000000;
                    let ind = -1;
                    for (let i = 0; i < obj.length; i++) {
                        if (obj[i][1] <= y) {
                            y = obj[i][1];
                            ind = i;
                        }
                        ;
                    }
                    ;
                    // On ajoute cet objet dans la nouvelle liste triée
                    objetsTries.push(obj[ind]);
                    // On le supprime de la liste actuelle
                    obj.splice(ind, 1);
                }
                ;
                return objetsTries;
            } else if (vue == "face") {
                // Dans une vue de face, les objets les plus loins ont
                // un y le plus grand
                let objetsTries = [];
                while (obj.length > 0) {
                    // On cherche l'objet le plus proche de la liste
                    let y = -1;
                    let ind = -1;
                    for (let i = 0; i < obj.length; i++) {
                        if (obj[i][1] >= y) {
                            y = obj[i][1];
                            ind = i;
                        }
                        ;
                    }
                    ;
                    // On ajoute cet objet dans la nouvelle liste triée
                    objetsTries.push(obj[ind]);
                    // On le supprime de la liste actuelle
                    obj.splice(ind, 1);
                }
                ;
                return objetsTries;
            } else if (vue == "gauche") {
                // Dans une vue de gauche, les objets les plus loins ont
                // un x le plus grand
                let objetsTries = [];
                while (obj.length > 0) {
                    // On cherche l'objet le plus proche de la liste
                    let x = -1;
                    let ind = -1;
                    for (let i = 0; i < obj.length; i++) {
                        if (obj[i][0] >= x) {
                            x = obj[i][0];
                            ind = i;
                        }
                        ;
                    }
                    ;
                    // On ajoute cet objet dans la nouvelle liste triée
                    objetsTries.push(obj[ind]);
                    // On le supprime de la liste actuelle
                    obj.splice(ind, 1);
                }
                ;
                return objetsTries;
            } else if (vue == "droite") {
                // Dans une vue de droite, les objets les plus loins ont
                // un x le plus petit
                let objetsTries = [];
                while (obj.length > 0) {
                    // On cherche l'objet le plus proche de la liste
                    let x = 1000000;
                    let ind = -1;
                    for (let i = 0; i < obj.length; i++) {
                        if (obj[i][0] <= x) {
                            x = obj[i][0];
                            ind = i;
                        }
                        ;
                    }
                    ;
                    // On ajoute cet objet dans la nouvelle liste triée
                    objetsTries.push(obj[ind]);
                    // On le supprime de la liste actuelle
                    obj.splice(ind, 1);
                }
                ;
                return objetsTries;
            }
            ;
        };

        function rempliCanvas(obj, vue) {
            // if (document.getElementById("avantMod2D").hasChildNodes()){
            //     document.getElementById("avantMod2D").removeChild(document.getElementById("mod2D-test"));
            // }
            document.getElementById("avantMod2D").removeChild(document.getElementById("mod2D-test"));
            let mod2D = document.createElement("div");
            /*
            mod2D.id="mod2D-test";
            mod2D.style.zIndex="auto";
            mod2D.style.width="600px";
            mod2D.style.height="300px";
            mod2D.style.position="absolute";
            document.getElementById("avantMod2D").appendChild(mod2D);
            */
            mod2D.id = "mod2D-test";
            mod2D.classList.add("dropzone");
            mod2D.classList.add("cadreMod2D");
            // mod2D.style.zIndex="auto";
            // mod2D.style.position="absolute";
            // mod2D.style.border = "1px solid red";
            document.getElementById("avantMod2D").appendChild(mod2D);

            if (vue == "fond" || vue == "face") {
                $('#mod2D-test').width(longPetit);//"1000px";
                $('#mod2D-test').height(hautPetit);//"500px";
            } else {
                $('#mod2D-test').width(profPetit);
                $('#mod2D-test').height(hautPetit);
            }

            let curseur = 0;
            //console.log(obj);
            obj.forEach(o => {
                var image = new Image();
                if (vue == "face" || vue == "gauche") {
                    image.src = 'http://127.0.0.1:8000/../images/' + o[3];
                    image.setAttribute('value', o[4]);
                    //console.log(image.src);
                } else {
                    image.src = 'http://127.0.0.1:8000/../images/miroir_' + o[3];
                    image.setAttribute('value', o[4]);
                    //console.log(image.src);
                }
                ;
                //image.src = '../images/'+o[3];
                image.classList.add('clonedItem');
                image.onload = function () {
                    //img.height;
                    //img.width;

                    let coord = tailleImage(image);
                    let hauteur = coord[0];
                    let largeur = coord[1];

                    let x;
                    let y;
                    if (vue == "face") {
                        x = o[0] ;//+ marge; //coordx + marge
                        y = hautCanvas - o[2] - hauteur;//- marge - o[2] - hauteur;
                    } else if (vue == "fond") {
                        x = larCanvas - o[0] - largeur;//marge - o[0] - largeur;
                        y = hautCanvas - o[2] - hauteur;//marge - o[2] - hauteur;
                    } else if (vue == "droite") {
                        x = o[1] //+ marge;
                        y = hautCanvas - o[2] - hauteur;//marge - o[2] - hauteur;
                    } else if (vue == "gauche") {
                        x = larCanvas - (longPetit - profPetit) - o[1] - largeur;//- marge - (longPetit - profPetit) - o[1] - largeur;
                        y = hautCanvas - o[2] - hauteur;//- marge - o[2] - hauteur;
                    }
                    // Si jamais l'image sort de l'aquarium, on la remet dedans
                    //if (x + largeurImage > largeurCanvas - margeDroiteLong){
                    //ADE
                    if (vue == "droite" || vue == "gauche") {
                        //if (x + largeur > marge + profPetit) {
                        if (x + largeur > profPetit) {
                            //x = marge + profPetit - largeur;
                            x = profPetit - largeur;
                        /*} else if (x < marge) {
                            x = marge;*/
                        } else if (x < 0) {
                            x = 0;
                        }
                        ;
                    } else {
                        if (x + largeur > longPetit) {//> marge + longPetit) {
                           // x = marge + longPetit - largeur;
                           x =  longPetit - largeur;
                        /*} else if (x < marge) {
                            x = marge;*/
                        } else if (x < 0) {
                            x = 0;
                        }
                        ;
                    }
                    ;
                    /*if (y + hauteur > marge + hautPetit) {
                        y = marge + hautPetit - hauteur
                    } else if (y < marge) {
                        y = marge;
                    };*/
                    if (y + hauteur > hautPetit) {
                        y = hautPetit - hauteur
                    } else if (y < 0) {
                        y = 0;
                    };

                    //ctx2.globalCompositeOperation="destination-over";
                    //ctx2.drawImage(this, x, y, largeur, hauteur);//,largeurImage, hauteurImage);

                    /*let div = document.createElement('div');
                    div.id=curseur;
                    div.style.zIndex=curseur;
                    div.style.width=largeur+"px";
                    div.style.height=hauteur+ "px";
                    div.style.position="absolute";
                    div.style.top=y+"px";
                    div.style.left=x+"px";
                    document.getElementById("mod2D-test").appendChild(div);
                    //$("#mod2D-test").appendChild(image);//.appendChild(image));
                    image.width=largeur;
                    image.height=hauteur;
                    document.getElementById(curseur).appendChild(image);*/

                    image.style.zIndex = curseur;
                    image.style.position = "absolute";
                    image.style.top = y + "px";
                    image.style.left = x + "px";
                    image.width = largeur;
                    image.height = hauteur;
                    document.getElementById("mod2D-test").appendChild(image);

                    curseur += 1;

                };
            });
        };

        $('#aqFace').on('click', function () {
            $('#nomFaceCache').text("face");
            //traceContour(ctx2, can, longPetit, hautPetit);
            let objetsAquarium = recupObjets2();
            //afficheContenu(objetsAquarium, 'face', ctx2);
            afficheContenu(objetsAquarium, 'face');
        });
        $('#aqFond').on('click', function () {
            $('#nomFaceCache').text("fond");
            //traceContour(ctx2, can, longPetit, hautPetit);
            let objetsAquarium = recupObjets2();
            //afficheContenu(objetsAquarium, 'fond', ctx2);
            afficheContenu(objetsAquarium, 'fond');
        });
        $('#aqGauche').on('click', function () {
            $('#nomFaceCache').text("gauche");
            //traceContour(ctx2, can, profPetit, hautPetit);
            let objetsAquarium = recupObjets2();
            //afficheContenu(objetsAquarium, 'gauche', ctx2);
            afficheContenu(objetsAquarium, 'gauche');
        });
        $('#aqDroite').on('click', function () {
            $('#nomFaceCache').text("droite");
            //traceContour(ctx2, can, profPetit, hautPetit);
            let objetsAquarium = recupObjets2();
            //afficheContenu(objetsAquarium, 'droite', ctx2);
            afficheContenu(objetsAquarium, 'droite');
        });

        function tailleImage(img) {
            let largeur = img.width / 1.5;
            let hauteur = img.height / 1.5;
            if (hauteur >= hautPetit) {
                let newhauteur = hautPetit - 5;
                largeur = largeur * (newhauteur / hauteur); // toujours proportionnel
                hauteur = newhauteur;
            }
            if ($('#mod2D-test').width() <= profPetit) {
                if (largeur >= profPetit) {
                    let newlargeur = profPetit - 5;
                    hauteur = hauteur * (newlargeur / largeur);
                    largeur = newlargeur;
                }
            }
            return [hauteur, largeur];
        }

    });
});
