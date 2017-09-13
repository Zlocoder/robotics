$(function() {
    $(window).scroll(function() {
        if ($(window).scrollTop()) {
            $('.navbar').addClass('shadow');
        } else {
            $('.navbar').removeClass('shadow');
        }
    }).scroll();

    $(window).resize(function() {
        if ($(window).width() >= 970 && $(window).width() < 1170) {
            $('aside .content').css('padding', 0);

            $('.calendar').css({
                position: 'absolute',
                left: '695px',
                top: 0 - $('.last-news').height() - $('.news').height() + $('.news .text').position().top + 'px'
            });

            if ($('.news .full-width').length == 1) {
                $('.linked-news').css({
                    position: 'absolute',
                    left: '695px',
                    top: 0 - $('.last-news').height() - $('.news').height() + $('.news .full-width').position().top + $('.news .full-width').height() + 30 + 'px'
                });
            } else {
                $('.linked-news').css({
                    position: 'absolute',
                    left: '695px',
                    top: $('.calendar').position().top + $('.calendar').height() + 30 + 'px'
                });
            }

            $('.linked-products').css({
                position: 'absolute',
                left: '695px',
                top: $('.linked-news').position().top + $('.linked-news').height() + 30 + 'px'
            });
        } else if ($(window).width() >= 1170) {
            $('aside .content').css('padding', 0);

            $('.calendar').css({
                position: 'absolute',
                left: '890px',
                top: 0 - $('.last-news').height() - $('.news').height() + $('.news .text').position().top + 'px'
            });

            if ($('.news .full-width').length == 1) {
                $('.linked-news').css({
                    position: 'absolute',
                    left: '890px',
                    top: 0 - $('.last-news').height() - $('.news').height() + $('.news .full-width').position().top + $('.news .full-width').height() + 30 + 'px'
                });
            } else {
                $('.linked-news').css({
                    position: 'absolute',
                    left: '890px',
                    top: $('.calendar').position().top + $('.calendar').height() + 30 + 'px'
                });
            }

            $('.linked-products').css({
                position: 'absolute',
                left: '890px',
                top: $('.linked-news').position().top + $('.linked-news').height() + 30 + 'px'
            });
        }
    }).resize();
});