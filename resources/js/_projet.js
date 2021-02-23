$(function(){
    $('#nouveauProjet').on('click', function(){
        $.ajax({
            url: 'mes_projets',
            type: 'GET',
            async: false,
            success: function(data) {
                console.log('SUCCES dans la récupération des images');
            },
            error: function(data) {
                console.log('ERREUR dans la récupération des images')
            }
        });
    });
});

$(function(){
    /*Ajout d'un nouveau projet */
    $('.ajouterProjet').on('click', function() {
        console.log("C'est parti pour l'ajout d'un projet !");

        let idBac = $(this).val();
        console.log("IdBac = " + idBac);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'mes_projets',
            type: 'POST',
            data: 'id_bac=' + idBac,
            dataType: 'html',
            async: true,
            success: function(data){
                console.log("Succès dans l'ajout du nouveau projet !");
            },
            error: function(resultat, statut, erreur){
                console.log("Erreur dans l'ajout du nouveau projet...")
                console.log('======================');
                console.log(resultat);
                console.log('======================');
                console.log(statut);
                console.log('======================');
                console.log(erreur);
            }
        })
    });
});
