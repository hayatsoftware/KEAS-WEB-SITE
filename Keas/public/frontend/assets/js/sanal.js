$(document).ready(function () {
    $('.id-01').click(function() {
        $('#id-01').addClass('open');
        $('body').addClass('hidden')

        var srcs = $('#id-01 .all').attr('data-src')
        $('#id-01 .all').append('<iframe></iframe>');
        var iframe = $('#id-01').find('iframe');
        var src = iframe.attr('src');
        iframe.attr('src',srcs);
    })
    $('#id-01 .close').click(function () {
        $('#id-01').removeClass('open');
        $('body').removeClass('hidden')
        $('#id-01').find('iframe').remove()
    })

    $('.id-02').click(function() {
        $('#id-02').addClass('open');
        $('body').addClass('hidden')

        var srcs = $('#id-02 .all').attr('data-src')
        $('#id-02 .all').append('<iframe></iframe>');
        var iframe = $('#id-02').find('iframe');
        var src = iframe.attr('src');
        iframe.attr('src',srcs);
    })
    $('#id-02 .close').click(function () {
        $('#id-02').removeClass('open');
        $('body').removeClass('hidden')
        $('#id-02').find('iframe').remove()
    })



    $('.id-03').click(function() {
        $('#id-03').addClass('open');
        $('body').addClass('hidden')

        var srcs = $('#id-03 .all').attr('data-src')
        $('#id-03 .all').append('<iframe></iframe>');
        var iframe = $('#id-03').find('iframe');
        var src = iframe.attr('src');
        iframe.attr('src',srcs);
    })
    $('#id-03 .close').click(function () {
        $('#id-03').removeClass('open');
        $('body').removeClass('hidden')
        $('#id-03').find('iframe').remove()
    })



});
