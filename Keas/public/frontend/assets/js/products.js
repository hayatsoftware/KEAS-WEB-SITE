$(document).ready(function(){
    var a = $('.section .article .content .filtre .group .head');
    $(document).on('click', '.section .article .content .filtre .group .head', function(){
        if ($(this).parent().hasClass('open')) {
            $(this).next().stop().slideUp();
            $(this).parent().removeClass('open');
        } else {
            a.next().stop().slideUp();
            a.parent().removeClass('open');
            $('.section .article .content .filtre .group').removeClass('open');
            $('.section .article .content .filtre .group .checkbox_sub').stop().slideUp();
            $(this).parent().addClass('open');
            $(this).next().stop().slideDown();
        }
    });




    $('[data-toggle="tooltip"]').tooltip();

    $('.effect').textillate();

    var ab = $('.checkbox_click > .custom-control > input');
    ab.click(function() {
        if ($(this).parent().hasClass('open')) {
            $(this).parent().parent().find('.checkbox_sub_alt').slideUp();
            $(this).parent().removeClass('open');
            $(this).prev().removeClass('open');
        } else {
            ab.parent().parent().find('.checkbox_sub_alt').slideUp();
            ab.parent().removeClass('open');
            ab.prev().removeClass('open');
            $(this).parent().addClass('open');
            $(this).prev().addClass('open');
            $(this).parent().parent().find('.checkbox_sub_alt').slideDown();
        }
    });


// Show the first tab and hide the rest
    $('#tabs-nav li:first-child').addClass('active');
    $('.tab-content').hide();
    $('.tab-content:first').show();

// Click function



    $('#tabs-nav li').click(function(){
        $('#tabs-nav li').removeClass('active');
        $(this).addClass('active');
        $('.tab-content').hide();

        var activeTab = $(this).find('a').attr('href');
        $(activeTab).fadeIn();
        return false;
    });

    var urlParams = new URLSearchParams(window.location.search);
    var filterValue = urlParams.get('filter');
    $('#tabs-nav li').removeClass('active');
    if (filterValue) {
        $('#tabs-nav li[data-filter="' + filterValue + '"]').addClass('active').trigger('click');
    }


    wd = $(window).width();
    if ( wd < 1200){
        $('.section .article .content .filtre').prepend('<div class="okey"></div>')

        $('.filtre_title').click(function () {
            $('.filtre').show();
            $('body').css('overflow','hidden');
        })
        $('.filtre .close,.filtre .okey,.filtre .form-group button').click(function () {
            $('.filtre').hide();
            $('body').css('overflow','initial');
        })

    }


    $('.asd .alt').click(function () {
        $('.giz').css('opacity','0');
        $('.load').show();
        setTimeout(function () {
            $('.giz').css('opacity','1');
            $('.load').hide();
        },1000)
    })

    $('.section .article .content .decor_appearance .list').each(function() {
        var listing = $(this).find('picture').width();
        $(this).find('picture').css('height',listing);
    });
    $('.section .article .content .decor_list_four .list').each(function() {
          var listing = $(this).find('picture').width();
          $(this).find('picture').css('height',listing);
   });
    $('.section .article .content .mdf_list .list').each(function() {
        var listing = $(this).find('picture').width();
        $(this).find('picture').css('height',listing);
    });


});




$(window).resize(function () {
   $('.section .article .content .decor_appearance .list').each(function() {
        var listing = $(this).find('picture').width();
        $(this).find('picture').css('height',listing);
    });

     $('.section .article .content .decor_list_four .list').each(function() {
        var listing = $(this).find('picture').width();
        $(this).find('picture').css('height',listing);
    });
    $('.section .article .content .mdf_list .list').each(function() {
        var listing = $(this).find('picture').width();
        $(this).find('picture').css('height',listing);
    });
});
