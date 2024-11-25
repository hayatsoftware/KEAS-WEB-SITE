
var gallerySay = 0;

$(document).ready(function () {

    if ($(window).width() > 767) { // Masaüstünde kaç tane gözüksün.
        var kacTaneGozuksun = 8;
    } else { // Mobilde kaç tane gözüksün.
        var kacTaneGozuksun = 2;
    }

    $('.content-gallery').each(function () {
        if ($(this).find('a').length >= 8) {

            $(this).find('a').each(function () {
                var main = $(this).parent();
                var thisHeight = $(this).outerHeight();
                gallerySay += 1;
                main.height(thisHeight * 2); // Kaç satır resim gözükecek satır sayısı yazılacak.
            });

            if (gallerySay > kacTaneGozuksun) {
                var galleryOverlay = $(this).find('a:nth-child(' + kacTaneGozuksun + ')');
                var link = galleryOverlay.attr('href');
                galleryOverlay.removeAttr('data-fancybox');
                galleryOverlay.attr('href', "javascript:;").append('<div class="all" title="Devamını görmek için tıklayınız.."><i>+' + (gallerySay - kacTaneGozuksun) + '</i></div>');
                galleryOverlay.click(function () {
                    var e = $(this);
                    e.attr('data-fancybox', 'gallery');
                    e.attr('href', link);
                    galleryOverlay.find('.all').remove();
                    e.parent().removeAttr('style');
                    e.unbind("click");
                    return false;
                });
            }
            gallerySay = 0;
        }
    });
});

$(document).ready(function () {

    $('.section .article .sidebar ul > li ul').parent().addClass('down')
   //$('.section .article .sidebar ul > li ul').parent().find('> a').attr('href','javascript:void(0)')

    $('.section .article .sidebar ul > li ul li.active').parent().parent().addClass('open')
    $('.section .article .sidebar ul > li > ul > li ul').parent().addClass('down')
    $('.section .article .sidebar ul > li > ul > li ul').parent().find('> a').attr('href','javascript:void(0)')

    var a = $('.section .article .sidebar > ul > li > a');
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
    var ab = $('.section .article .sidebar > ul > li > ul > li > a');
    ab.click(function() {
        if ($(this).parent().hasClass('open')) {
            $(this).next().slideUp();
            $(this).parent().removeClass('open');
            $(this).prev().removeClass('open');
        } else {
            ab.next().slideUp();
            ab.parent().removeClass('open');
            ab.prev().removeClass('open');
            $(this).parent().addClass('open');
            $(this).prev().addClass('open');
            $(this).next().slideDown();
        }
    });

});
