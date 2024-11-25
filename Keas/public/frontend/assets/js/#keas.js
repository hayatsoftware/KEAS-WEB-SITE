
$(window).scroll(function() {
    scroll = $(window).scrollTop();
    var sticky = $('header');
    if (scroll >= 50) sticky.addClass('fixed');
    else sticky.removeClass('fixed')
});


$('.needs-validation').on('submit',function(){
    $(this).find('input[type="text"],select').focus()
    //event.preventDefault();
    //event.stopPropagation();
    //  console.log("test")
    var errorElements = document.querySelectorAll(".was-validated :invalid");
    for (let index = 0; index < errorElements.length; index++) {
        const element = errorElements[index];
        //  console.log(element);
        $('html, body').animate({
            scrollTop: $(errorElements[0]).focus().offset().top - 150
        },200);
    }
});

$(document).ready(function () {

    $(".preferred_roducts select#demo").prependTo(".preferred_roducts").clone()

    $("#email_bulten").inputmask('email')

    $(".js-example-placeholder-single").select2({
        placeholder: "Select a state",
        allowClear: true
    });

    var i = $('.header').width();
    var ii = $('.header .menu ul li:nth-child(2)').width();
    var iii = i - ii - 13 + 20;
    var iiii = iii / 2
    $('.header .menu ul li:nth-child(2) .megamenu').css('right',iiii-450);

    $('#lang').click(function () {
        $('.language-wrap').fadeIn();
    })

    $('.language-wrap .language-box .map-close').click(function () {
        $('.language-wrap').fadeOut();
    })

    $('.nice-select').niceSelect();
    $('.lazy').lazy();

    $('.header .search').click(function () {
        $(this).toggleClass('open');
        $('#search-page').slideToggle();
        $('#search-page').find('input').focus();
    });


    $('.header .head .menu ul > li  .submenu').parent().addClass('open')

    var lia = '.header .menu > ul > li';
    $(lia).hover(function () {
        if ($(this).find('.submenu').length > 0) {
            $(this).addClass('over');
            $('header').addClass('over');
            $('#search-page').slideUp();
            $('.header .search').removeClass('open');
            $(this).find('> .submenu').stop().fadeIn();
        }
    }, function () {
        $(this).removeClass('over');
        $('header').removeClass('over');
        $(this).find('> .submenu').stop().fadeOut();
    });

    $('#panel .menu ul > li .submenu').parent().addClass('active')

    $('#panel .menu ul > li .submenu').parent().find('> a').attr('href','javascript:void(0)')

    $('#panel .menu ul > li.active > a').click(function () {
        $('.menu > ul').addClass('open');
        $(this).parent().addClass('open');
    })

    $('#panel .menu ul > li.active > .submenu > ul > li.active > a').click(function () {
        $(this).parent().parent().parent().addClass('open');
    })
    $('#panel .menu > ul > li > .submenu > .back').click(function () {
        $(this).parent().parent().removeClass('open')
        $(this).parent().parent().parent().removeClass('open')
    })
    $('#panel .menu ul > li > .submenu > ul > li > .submenu > .back').click(function () {
        $(this).parent().parent().removeClass('open')
        $(this).parent().parent().parent().parent().removeClass('open')
    })



    $('.overlay').click(function () {
        $('#panel').removeClass('active');
        $('.overlay').removeClass('active')
    })
    $('#panel .close').click(function () {
        $('#panel').removeClass('active');
        $('.overlay').removeClass('active')
    })
    $('.header .navbar').click(function () {
        $('#panel').addClass('active')
        $('.overlay').addClass('active')
    })


    // FOOTER KONU SEÇİNİZ ///

    /*$('.footer .ebulten form label input').attr('placeholder','E-Posta *')*/

    var $checkboxes = $('.flex .checkbox_sub .custom-checkbox input[type="checkbox"]');

    $checkboxes.change(function(){
        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        $('#count-checked-checkboxes').text(countCheckedCheckboxes);
    });

    $('.footer .ebulten form .flex .subject').click(function () {
        $('.footer .ebulten form .flex .checkbox_sub').slideToggle();
    })
    $('.footer .ebulten form .flex .checkbox_sub .okey_btn').click(function () {
        $('.footer .ebulten form .flex .checkbox_sub').slideUp();
    })


    $('.footer .ebulten form .flex .checkbox_sub .custom-checkbox input').click(function(){
        if($(this).prop("checked") == true){
            $('.footer .ebulten form .flex .subject .invalid-feedback').hide()
        } else if($(this).prop("checked") == false){
            $('.footer .ebulten form .flex .subject .invalid-feedback').show()
        }
    });



})

$(window).resize(function () {
    var i = $('.header').width();
    var ii = $('.header .menu ul li:nth-child(2)').width();
    var iii = i - ii - 13 + 20;
    var iiii = iii / 2
    $('.header .menu ul li:nth-child(2) .megamenu').css('right',iiii-450);
})


