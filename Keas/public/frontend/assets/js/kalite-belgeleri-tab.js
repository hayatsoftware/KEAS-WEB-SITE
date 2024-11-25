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

wd = $(window).width();
if ( wd < 1024){
    $('.mob_tab').click(function () {
        $('#tabs-nav').toggle();
    });

    $('.tabs>ul li a').click(function () {
        var mont2 = $(this).html();
        $('.mob_tab span').html(mont2);
    });
}