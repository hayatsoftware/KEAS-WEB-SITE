$(document).ready(function () {
    $('.photo_gallery').slick({
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
    $('[data-toggle="tooltip"]').tooltip();

    $('.id-01').click(function () {
        $('#id-01').addClass('open');
        $('body').css('overflow','hidden');
    })
    $('#id-01 .close').click(function () {
        $('#id-01').removeClass('open');
        $('body').css('overflow','inherit');
    })

    $('.id-01').click(function () {
        var srcs = $('#id-01 iframe').attr('data-src')
        // $('#showroom_modal .all').append('<iframe></iframe>');
        var iframe = $('#id-01').find('iframe');
        var src = iframe.attr('src');
        iframe.attr('src',srcs);
    })
    $('#id-01 .close').click(function () {
        $('#id-01').find('iframe').attr('src','');
    })

    $('.showroom').click(function () {
        $('#showroom_modal').addClass('open');
        $('body').css('overflow','hidden');
    })
    $('#showroom_modal .close').click(function () {
        $('#showroom_modal').removeClass('open');
        $('body').css('overflow','inherit');
    })

    $('.showroom').click(function () {
        var srcs = $('#showroom_modal iframe').attr('data-src')
        // $('#showroom_modal .all').append('<iframe></iframe>');
        var iframe = $('#showroom_modal').find('iframe');
        var src = iframe.attr('src');
        iframe.attr('src',srcs);
    })
    $('#showroom_modal .close').click(function () {
        $('#showroom_modal').find('iframe').attr('src','');
    })

    $('.mimarim_ol').click(function () {
        $('#see_in_room').addClass('open');
        $('body').css('overflow','hidden');
    })
    $('#see_in_room .close').click(function () {
        $('#see_in_room').removeClass('open');
        $('body').css('overflow','inherit');
    })

    $('.mimarim_ol').click(function () {
        var srcs = $('#see_in_room iframe').attr('data-src')
        // $('#showroom_modal .all').append('<iframe></iframe>');
        var iframe = $('#see_in_room').find('iframe');
        var src = iframe.attr('src');
        iframe.attr('src',srcs);
    })
    $('#see_in_room .close').click(function () {
        $('#see_in_room').find('iframe').attr('src','');
    })

    $(document).on('keydown', function(event) {
        if (event.key == "Escape") {
            $('#see_in_room').removeClass('open');
            $('body').css('overflow','inherit');

            $('#showroom_modal').removeClass('open');
            $('body').css('overflow','inherit');

            $('#id-01').removeClass('open');
            $('body').css('overflow','inherit');
        }
    });

});
