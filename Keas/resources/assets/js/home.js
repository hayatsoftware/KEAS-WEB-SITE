

var $gallery = $('.home_slider');
$(document).ready(function() {
    $gallery.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplaySpeed: 8000,
        lazyLoad: 'ondemand',
        autoplay:false,
        arrows: true,
        dots: true,
        infinite: true,
        pauseOnHover: false,
        fade: true
    });
});

$gallery.on('afterChange', function (currentSlide) {
    var sliderVideoPause = $gallery;
    sliderVideoPause.find('iframe').attr('src','');
    sliderVideoPause.find('.slick-current iframe').attr('src', sliderVideoPause.find('.slick-current iframe').data('src') );
});


$(document).ready(function () {

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
