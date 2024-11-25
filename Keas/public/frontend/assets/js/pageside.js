
$(document).ready(function () {

    $('.section .article .sidebar ul > li ul').parent().addClass('down')
   //$('.section .article .sidebar ul > li ul').parent().find('> a').attr('href','javascript:void(0)')


    $('.section .article .sidebar ul > li > ul > li ul').parent().addClass('down')
    $('.section .article .sidebar ul > li > ul > li ul').parent().find('> a').attr('href','javascript:void(0)')



})
