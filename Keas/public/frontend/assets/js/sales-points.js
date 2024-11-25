$(document).ready(function () {
    var a = $('#bayi-liste ul li b');
    a.click(function() {
        if ($(this).parent().hasClass('open')) {
            $(this).next().slideUp();
            $(this).parent().removeClass('open');
            $(this).prev().removeClass('open');
        } else {
            a.next().slideUp();
            a.parent().removeClass('open');
            a.prev().removeClass('open');
            $(this).parent().addClass('open');
            $(this).prev().addClass('open');
            $(this).next().slideDown();
        }
    });

});
