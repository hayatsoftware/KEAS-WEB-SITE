$(document).ready(function () {
    $('.id-01').click(function () {
        $('#id-01').addClass('open');
        $('body').css('overflow','hidden');

        var srcs = $('#id-01 iframe').attr('data-src')
        // $('#showroom_modal .all').append('<iframe></iframe>');
        var iframe = $('#id-01').find('iframe');
        var src = iframe.attr('src');
        iframe.attr('src',srcs);
    })
    $('#id-01 .close').click(function () {
        $('#id-01').removeClass('open');
        $('body').css('overflow','inherit');


        $('#id-01').find('iframe').attr('src','');
    })


    $('.id-02').click(function () {
        $('#id-02').addClass('open');
        $('body').css('overflow','hidden');

        var srcs = $('#id-02 iframe').attr('data-src')
        // $('#showroom_modal .all').append('<iframe></iframe>');
        var iframe = $('#id-02').find('iframe');
        var src = iframe.attr('src');
        iframe.attr('src',srcs);
    })
    $('#id-02 .close').click(function () {
        $('#id-02').removeClass('open');
        $('body').css('overflow','inherit');

        $('#id-02').find('iframe').attr('src','');
    })



    $('.id-03').click(function () {
        $('#id-03').addClass('open');
        $('body').css('overflow','hidden');

        var srcs = $('#id-03 iframe').attr('data-src')
        // $('#showroom_modal .all').append('<iframe></iframe>');
        var iframe = $('#id-03').find('iframe');
        var src = iframe.attr('src');
        iframe.attr('src',srcs);
    })
    $('#id-03 .close').click(function () {
        $('#id-03').removeClass('open');
        $('body').css('overflow','inherit');

        $('#id-03').find('iframe').attr('src','');
    })




});
