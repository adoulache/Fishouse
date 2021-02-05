/* Clic sur le bouton sauvegarde*/
$(function(){
    $('#boutonSauve').on('click', function() {
        console.log('clic sur le bouton sauvegarde');
        var idProjet = "123"; // A MODIFIER quand on saura où il apparait

        /* Vérification si l'id du projet existe dans la base */
        $.ajax({
            url: 'modelisation',
            type: 'GET',
            data: 'idProjet=' + idProjet,
            success : function(text){
                 if (text == "success"){
                     console.log('C est ok');
                }
            }
        });

        /* Retour : le projet n'existe pas encore (nouveau projet) */
        // ajout if(){} : A AJOUTER
        if (true){
            console.log('le projet n existe pas encore');

            /* Affichage modal demande du nom du projet */
            $('#modalNomProjet').modal('show');

            var nom = $("#formulaire").submit(function(event){
                event.preventDefault();
                var nomProjet = submitForm();
                return nomProjet;
            });

            /* insertion du nom du projet dans la base temporaire*/
            $.ajax({
                url: 'modelisation',
                type: 'POST',
                data: 'nomProjet=' + nom,
                success : function(text){
                     if (text == "success"){
                         console.log('C est ok');
                    }
                }
            });
        }
        /* sauvegarde du projet dans la base */
        $.ajax({
            url: 'modelisation',
            type: 'POST',
            success : function(text){
                 if (text == "success"){
                     console.log('C est ok');
                     formSuccess()
                }
            }
        });
  });
});

function submitForm(){    
    var nom = $("#nom-projet").val();
    $.ajax({
        type: "POST",
        url: "modelisation",
        data: "nomProjet=" + nom,
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