$(document).ready(function () {

    $('.trend_slider').slick({
        lazyLoad: 'ondemand',
        dots:false,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode:false,
        fade:true,
        infinite:false
    });

    $('.section .article .content .filterBtn span').click(function () {
        $('.section .article .content .link').addClass('active')
    })
    $('.section .article .content .link .closes').click(function () {
        $('.section .article .content .link').removeClass('active')
    })
})
