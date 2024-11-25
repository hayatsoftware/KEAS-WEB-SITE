

$(document).ready(function () {
    $('.home_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        autoplaySpeed: 8000,
        autoplay: false,
        lazyLoad: 'ondemand',
        infinite: true,
        pauseOnHover: false,
        fade: true
    });



    $('.home_slider').on('afterChange', function (prevSlide) {
        $('.home_slider picture img').removeClass('active');
        $('.home_slider picture img').attr('aria-hidden', 'true');


    });

    $('.home_slider').on('afterChange', function (currentSlide) {
        $('.home_slider .slick-current picture img').addClass('active');
        $('.home_slider .slick-current picture img').attr('aria-hidden', 'false');

    });

    $('.home_slider .slick-current picture img').addClass('active');
    $('.home_slider .slick-current picture img').attr('aria-hidden', 'false');

    $('.home_slider .video i').click(function () {
        var srcs = $(this).parent().parent().find('.video').attr('data-src')
        $(this).parent().parent().find('.video').append('<iframe></iframe>');
        var iframe = $(this).parent().parent().find('.video').find('iframe');
        var src = iframe.attr('src');
        iframe.attr('src',srcs + '&autoplay=true');
        iframe.addClass('active');
        $(this).remove();
    });
    $('.home_slider .video i').trigger('click');



    var li = '.section .box2 .dot';
    $(li).hover(function () {
        if ($(this).find('.windows').length > 0) {
            $(this).addClass('open')
            $(this).find('> .windows').stop().fadeIn(100);
        }
    }, function () {
        $(this).removeClass('open');
        $(this).find('> .windows').stop().fadeOut(100);
    });


    $('.trend_slider').slick({
        lazyLoad: 'ondemand',
        dots:false,
        slidesToShow: 3.2,
        slidesToScroll: 1,
        centerMode:false,
        infinite:false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2.3
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1.2
                }
            }
        ]
    });
    $('.box4_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        autoplaySpeed: 8000,
        autoplay: false,
        lazyLoad: 'ondemand',
        infinite: true,
        pauseOnHover: false,
        fade: true
    });

    $('.homes .scroll .sc').click(function (){
        $('html, body').animate({
            scrollTop: $(".section").offset().top-75
        }, 1000);
    });

})

var i = $('.box3').width();
var ii = $('.box3 .container').width();
var iii = i - ii - 13 + 62;
var iiii = iii / 2
$('.trend_slider').css('marginLeft',iiii-24);
$('.box3 .btn').css('marginRight',iiii-24);
$('.box3 .slick-arrow').css('marginRight',iiii-24);


$(window).resize(function () {
    var i = $('.box3').width();
    var ii = $('.box3 .container').width();
    var iii = i - ii - 13 + 62;
    var iiii = iii / 2
    $('.trend_slider').css('marginLeft',iiii-24);
    $('.box3 .btn').css('marginRight',iiii-24);
    $('.box3 .slick-arrow').css('marginRight',iiii-24);
});

var wd = $(window).width();
if ( wd > 768){
    $(window).on('load',function () {
        setTimeout(function () {
            $('.home_slider').addClass('active');
        },3000)
    })
}
$(document).scroll(function () {
    var wd = $(window).width();
    if (wd > 1199) {
        if ($('.box1').length > 0) {
            $('.box1').each(function(){
                if (($(window).scrollTop() ) > $(this).offset()['top'] - $(this).height() + 300) {
                    $(this).addClass('effect');
                }
            });
        }
        if ($('.box2').length > 0) {
            $('.box2').each(function(){
                if (($(window).scrollTop() ) > $(this).offset()['top'] - $(this).height() + 100) {
                    $(this).addClass('effect');
                }
            });
        }
        if ($('.box3').length > 0) {
            $('.box3').each(function(){
                if (($(window).scrollTop() ) > $(this).offset()['top'] - $(this).height() - 400) {
                    $(this).addClass('effect');
                    setTimeout(function () {
                        $('.box3 .trend_slider').addClass('effect_1');
                    },500)
                }
            });
        }
        if ($('.box4').length > 0) {
            $('.box4').each(function(){
                if (($(window).scrollTop() ) > $(this).offset()['top'] - $(this).height() + 100) {
                    $(this).addClass('effect');
                }
            });
        }
        if ($('.box5').length > 0) {
            $('.box5').each(function(){
                if (($(window).scrollTop() ) > $(this).offset()['top'] - $(this).height() + 100) {
                    $(this).addClass('effect');
                }
            });
        }
        if ($('.box6').length > 0) {
            $('.box6').each(function(){
                if (($(window).scrollTop() ) > $(this).offset()['top'] - $(this).height() - 400) {
                    $(this).addClass('effect');
                }
            });
        }
    }
});
