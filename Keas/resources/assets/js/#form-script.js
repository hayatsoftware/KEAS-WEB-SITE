$("body").on('keyup','.only-text',function(e){
    var val = $(this).val();
    if(val.match(/[^a-zA-ZçÇöÖşŞıİğĞüÜ ]/g)){
        $(this).val(val.replace(/[^a-zA-ZçÇöÖşŞıİğĞüÜ ]/g,''));
    }
});
$("body").on('keyup','.only-number',function(e){
    var val = $(this).val();
    if(val.match(/[^0-123456789 ]/g)){
        $(this).val(val.replace(/[^0-123456789 ]/g,''));
    }
});

$('.telmask').on('input', function(e) {
    if ($(this).val() == '')
        $('.phone_group').find('.invalid-feedback').show();
    else
        $('.phone_group').find('.invalid-feedback').hide();
});
$(".needs-validation").on('submit', function() {
    if ($('.telmask').val() == '')
        $('.phone_group').find('.invalid-feedback').show();
    else
        $('.phone_group').find('.invalid-feedback').hide();
});



$("#email").inputmask('email')

