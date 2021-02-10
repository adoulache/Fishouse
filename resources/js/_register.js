$('#expert_file_upload').fadeOut('fast');

$('#expert').change(function(){
    if(this.checked)
        $('#expert_file_upload').fadeIn('fast');
    else
        $('#expert_file_upload').fadeOut('fast');
});
