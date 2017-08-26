$(function() {
    $(window).scroll(function() {
        if ($(window).scrollTop()) {
            $('.navbar').addClass('shadow');
        } else {
            $('.navbar').removeClass('shadow');
        }
    }).scroll();
});