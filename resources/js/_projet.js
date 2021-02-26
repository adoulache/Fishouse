$(function(){
    $.ajax({
        url: 'mes_projets',
        type: 'GET',
        async: false,
        success: function(data) {
            console.log('SUCCES dans la récupération des projets existants et des bacs pour nouveaux projets');
        },
        error: function(data) {
            console.log('ERREUR dans la récupération des projets existants et des bacs pour nouveaux projets')
        }
    });
});

//let idProjetASuppr;

/*SUPPRESSION D'UN PROJET */
$(function(){
    $('.btnSupprimer').on('click', function(){
        $('#delete').modal();
        let id = $(this).attr('id');
        $('#supprIdHidden').val(id);
        document.getElementById("supprId").innerHTML=id;

        return false;
    });
});

/*RENOMMAGE D'UN PROJET */
$(function(){
    $('.btnRenommer').on('click', function(){
        $('#rename').modal();
        let id = $(this).attr('id');
        $('#renommeIdHidden').val(id);
        document.getElementById("renommeId").innerHTML=id;

        return false;
    });
});

/*PARTAGE D'UN PROJET */
$(function(){
    $('.btnPartager').on('click', function(){
        $('#share').modal();
        let id = $(this).attr('id');
        $('#partageIdHidden').val(id);
        document.getElementById("partageId").innerHTML=id;

        return false;
    });
});

/*$(function(){
    $('.boutonSuppr').on('click', function() {

        let idProjetASuppr = $("input[name='username']").val();

        alert(idProjetASuppr);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: 'projets3',
            type: 'POST',
            data: {idProjet : idProjetASuppr},
            async: false,
            success: function(data) {
                console.log('SUCCES dans la suppression');
            },
            error: function(error) {
                console.log('ERREUR dans la suppression');
                console.log(error);
            }
        });
    });
});*/

/*$(function(){
    /!*Ajout d'un nouveau projet *!/
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
            url: "{{ route('ajoutProjet') }}",
            type: 'POST',
            data: 'id_bac=' + idBac,
            dataType: 'json',
            async: true,
            success: function(data){
                console.log("Succès dans l'ajout du nouveau projet !");
                //console.log(data);
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
});*/
