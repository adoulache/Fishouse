var decos = $.ajax({
    url:'testHome/ajax',
    type:'GET',
    async : false,
    success: function(data){
        console.log('test OK Ajax !');
        console.log('OK');
        console.log(data);
    },
    error: function(data){
        console.log('KO');
        console.log(data);
    }
});
