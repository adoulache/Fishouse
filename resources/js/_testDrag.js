/* The dragging code for '.draggable' from the demo above
 * applies to this demo as well so it doesn't have to be repeated. */
$(function () {

    const interact = require('interactjs')
    const idProjet = $('#idProjetCache').text();
    console.log('id_projet _testDrag.js ' + idProjet);


// enable draggables to be dropped into this
    interact('.dropzone').dropzone({
        // only accept elements matching this CSS selector
        accept: '.clonedItem',
        // Require a 80% element overlap for a drop to be possible
        overlap: 0.8,

        // listen for drop related events:

        ondropactivate: function (event) {
            // add active dropzone feedback
            event.target.classList.add('drop-active')
        },
        ondragenter: function (event) {
            let draggableElement = event.relatedTarget
            let dropzoneElement = event.target

            // feedback the possibility of a drop
            dropzoneElement.classList.add('drop-target')
            draggableElement.classList.add('can-drop')
            //draggableElement.textContent = 'Dragged in'
        },
        ondragleave: function (event) {
            // remove the drop feedback style
            event.target.classList.remove('drop-target')
            event.relatedTarget.classList.remove('can-drop')
            //event.relatedTarget.textContent = 'Dragged out'
        },
        ondrop: function (event) {
            let draggableElement = event.relatedTarget
            let dropzoneElement = event.target
            $(draggableElement).appendTo(".dropzone");

            $(draggableElement)[0].classList.add('clonedItemSelected');
            let id_unique = $(draggableElement).attr('value');
            let imageName = $(draggableElement).attr('src').split('/')[5];

             //let posX = $(draggableElement).position().left;
             let posZ = $(draggableElement).position().top;
             let hauteurAquarium = $(dropzoneElement).height();
             let longueurAquarium = $(dropzoneElement).width();
             let posZBdd = hauteurAquarium - posZ - $(draggableElement).height();
 
             if (posZBdd > hauteurAquarium){
                 posZBdd = hauteurAquarium;
             }else if(posZBdd < 0){
                 posZBdd = 0;
             };
 
             let nomFace = $('#nomFaceCache').text();
             if (nomFace == "face" || nomFace == "fond"){
                 let posX;
                 if (nomFace == "face"){
                     posX = $(draggableElement).position().left;
                 }else if (nomFace == "fond"){
                     posX = longueurAquarium - $(draggableElement).position().left - $(draggableElement).width();
                 };
 
                 if (posX > longueurAquarium){
                     posX = longueurAquarium;
                 }else if(posX < 0){
                     posX = 0;
                 };

                 // Update ou insert des coordonnées X et Z
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                 $.ajax({
                     url: 'ajoutDecoFace',
                     type: 'POST',
                     data: 'idProjet=' + idProjet + '&imageName=' + imageName + '&idUnique=' + id_unique + '&posX=' + posX + '&posZ=' + posZBdd,
                     async: false,
                     success: function (data) {
                         console.log('success');
                     },
                     error: function (error) {
                         console.log('error');
                         console.log (error);
                     }
                 });
             };
             if (nomFace == "droite" || nomFace == "gauche"){
                 let posY;
                 if(nomFace == "droite"){
                     posY = $(draggableElement).position().left;
                 }else if(nomFace == "gauche"){
                     posY = longueurAquarium - $(draggableElement).position().left - $(draggableElement).width();
                 };

                 if (posY > longueurAquarium){
                     posY = longueurAquarium;
                 }else if(posY < 0){
                     posY = 0;
                 };

                 // Update ou insert des coordonnées Y et Z
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                 $.ajax({
                     url: 'ajoutDecoCote',
                     type: 'POST',
                     data: 'idProjet=' + idProjet + '&imageName=' + imageName + '&idUnique=' + id_unique + '&posY=' + posY + '&posZ=' + posZBdd,
                     async: false,
                     success: function (data) {
                        console.log('success');
                     },
 
                     error: function (error) {
                        console.log('error');
                        console.log(error);
                     }
                 });
             };
 
             /*
             $.ajax({
                 url: 'ajoutDeco',
                 type: 'GET',
                 data: 'idProjet=' + idProjet + '&imageName=' + imageName + '&idUnique=' + id_unique + '&posX=' + posX + '&posZ=' + posZBdd,
                 async: false,
                 success: function (data) {
                    console.log('success');
                    console.log(data);
                 },
                 error: function (data) {
                     console.log('error');
                     console.log(data);
                 }
             });
             */
         },
 
        ondropdeactivate: function (event) {
            // remove active dropzone feedback
            event.target.classList.remove('drop-active')
            event.target.classList.remove('drop-target')
        }
    })

    interact('.clonedItem')
        .draggable({
            inertia: true,
            modifiers: [
                interact.modifiers.restrictRect({
                    restriction: '.tab-content',
                    endOnly: true
                })
            ],
            autoScroll: true,
            // dragMoveListener from the dragging demo above
            listeners: {move: dragMoveListener}
        });

    interact('.yes-drop')
        .draggable({
            inertia: true,
            modifiers: [
                interact.modifiers.restrictRect({
                    restriction: '.tab-content',
                    endOnly: true
                })
            ],
            autoScroll: true,
            // dragMoveListener from the dragging demo above
            listeners: {move: dragMoveListener}
        }).on('move', function (event) {
        let interaction = event.interaction;
        if (interaction.pointerIsDown && !interaction.interacting() && event.currentTarget.getAttribute('clonable') !== 'false') {
            let original = event.currentTarget;
            let clone = original.cloneNode(true);
            clone.classList.remove("newObjectPicture");
            clone.classList.remove("yes-drop");
            clone.classList.add("clonedItem");
            clone.setAttribute('clonable', 'false');
            clone.setAttribute('value', generateRandomString());
            clone.style.position = "absolute";
            //clone.style.width = "200px";
            //clone.style.height = "200px";
            clone.onload = function () {
                let tailleNewImage = tailleImage(clone); //[hauteur,largeur]
                clone.style.width = tailleNewImage[1]+"px";
                clone.style.height = tailleNewImage[0]+"px";
            }
            //$(".blocRecherche")[0].classList.add("onScrollBlockRecherche") ;
            original.parentElement.appendChild(clone);
            interaction.start({name: 'drag'}, event.interactable, clone);
        }
    });

    function tailleImage(img) {
        const profPetit = 333;
        const hautPetit = 500;
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

    function dragMoveListener(event) {
        let target = event.target
        // keep the dragged position in the data-x/data-y attributes
        let x = (parseInt(target.getAttribute('data-x')) || 0) + event.dx
        let y = (parseInt(target.getAttribute('data-y')) || 0) + event.dy

        // translate the element
        target.style.webkitTransform =
            target.style.transform =
                'translate(' + x + 'px, ' + y + 'px)'

        // update the posiion attributes
        target.setAttribute('data-x', x)
        target.setAttribute('data-y', y)
    }

    // this function is used later in the resizing and gesture demos
    window.dragMoveListener = dragMoveListener

    const generateRandomString = function (length = 6) {
        return Math.random().toString(20).substr(2, length)
    }

    $('.clonedItem').bind("contextmenu", function (event) {

        // Avoid the real one
        event.preventDefault();

        $(this)[0].classList.add('clonedItemSelected');

        // Show contextmenu
        $(".custom-menu").finish().toggle(100).

            // In the right position (the mouse)
            css({
                top: event.pageY + "px",
                left: event.pageX + "px"
            });
    });


    // If the document is clicked somewhere
    $(document).bind("mousedown", function (e) {

        // If the clicked element is not the menu
        if (!$(e.target).parents(".custom-menu").length > 0) {

            // Hide it
            $(".custom-menu").hide(100);
            $('.clonedItem').each(function (index) {
                $(this)[0].classList.remove('clonedItemSelected')
            });
        }
    });


    // If the menu element is clicked
    $(".custom-menu li").click(function () {

        // Get the unique ID of the selected Image
        let selectedImg = $('.clonedItemSelected')[0];
        let id_unique = $('.clonedItemSelected').attr('value');

        // This is the triggered action name
        switch ($(this).attr("data-action")) {

            // A case for each action. Your actions here
            case "delete":
                $.ajax({
                    url: 'deleteDeco',
                    type: 'GET',
                    data: 'idProjet=' + idProjet + '&idUnique=' + id_unique,
                    async: false,
                    success: function (data) {
                        console.log('delete success');
                        console.log(data);
                        selectedImg.remove();
                    },
                    error: function (data) {
                        console.log('delete error');
                        console.log(data);
                    }
                });
                break;
            case "action1":
                alert("action 1");
                break;
            case "action2":
                alert("action 2");
                break;
        }

        // Hide it AFTER the action was triggered
        $(".custom-menu").hide(100);
    });

});
