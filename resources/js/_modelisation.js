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
            method:'POST',
            data: 'idProjet=' + idProjet,
            // success: function() {
            //      alert('OK');
            // },
            // error: function() {
            //   alert('KO');
            // }
            success: function (data) {
                console.log('success');
            },
            error : function(data){
                console.log('error');
            }
        })
    });
});



