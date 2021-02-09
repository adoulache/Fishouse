var decos = $.ajax({
    url:'testHome',
    type:'GET',
    async : false,
    success: function(data){
        console.log('OK');
        console.log(data);
    },
    error: function(data){
        console.log('KO');
        console.log(data);
    }
});

// console.log(decos);

var image = new Image();
for (let i = 0; i < decos.responseJSON.length;i++){
    // console.log(decos.responseJSON[i]);
    var source = "{{asset('../images/" + decos.responseJSON[i] + "')}}";

    console.log(source);
    
    image.src = source;
    $('#imageDeco').append(image);
};
