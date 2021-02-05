// function reinitProjet() {
//     //var url = '/app/Http/Controllers/ModelisationController.php';
//     //$.post(url, function($idProjet){});
//     //console.log('test');
//     alert ('test');
// }
$(function(){
    $('#boutonReinit').on('click', function() {
      var id = document.getElementById('idProjetTest').textContent;
      console.log(id);
      $.ajax({
        url: 'modelisation',
        method:'POST',
        //url: '../ModelisationController.php',
        success: function() {
             alert('OK');
        },
        error: function() {
          alert('KO');
        }

    //   $.ajax({
    //     url : 'ModelisationController.php', // La ressource ciblée
    //     type : 'GET', // Le type de la requête HTTP.
    //     data : 'id=' + id
    //  });


      // let Datas = new FormData();
		  // Datas.append("id", id);
      // let request =
      //   $.ajax({
      //     type: 'POST',
      //     url : '',
      //   });
      // request.done(function (output) {
      //   //Code à jouer en cas d'éxécution sans erreur du script du PHP
      //   alert('Tout OK');
      // });
      // request.fail(function (error) {
      //   //Code à jouer en cas d'éxécution en erreur du script du PHP ou de ressource introuvable
      //   alert('Problème');
      // });

      })
  });
});



