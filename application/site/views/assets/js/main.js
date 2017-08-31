$(function() {
    $(window).scroll(function() {
        if ($(window).scrollTop()) {
            $('.navbar').addClass('shadow');
        } else {
            $('.navbar').removeClass('shadow');
        }
    }).scroll();

    if ($('article.news').length) {
        if ($('article.news img.full-width').length) {
            $('aside.left div').css('position', 'absolute');
            $('aside.left div:first').css('top', '50px');

            var height = $('article.news img.full-width').position().top + $('article.news img.full-width').height() - 70;
            $('aside.left div').not(':first').each(function() {
                $(this).css('top', height + 30 + 'px');
                height += 50 + $(this).height();
            });

            height = $('article.news img.full-width').position().top + $('article.news img.full-width').height() - 70;
            $('aside.right .theme-news').css('position', 'absolute');
            $('aside.right .theme-news').css('top', height + 30 + 'px');

            height += 30 + $('aside.right .theme-news').height();
            $('aside.right .shop-products').css('position', 'absolute');
            $('aside.right .shop-products').css('top', height + 30 + 'px');
        }
    }
});