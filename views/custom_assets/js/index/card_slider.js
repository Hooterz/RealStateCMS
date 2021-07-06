(function ($) {
    "use strict";
    $('.next').click(function () { $('#postsCarousel').carousel('next'); return false; });
    $('.prev').click(function () { $('#postsCarousel').carousel('prev'); return false; });
})
    (jQuery);