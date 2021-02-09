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

        /* Retour : le projet n'existe pas encore (nouveau projet) */
        // ajout if(){} : A AJOUTER
        //if (retour.statusText!="OK"){

        // CAS OU LE PROJET N EXISTE PAS ENCORE
        if(retour == -1){
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