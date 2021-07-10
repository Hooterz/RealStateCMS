(function ($) {
    "use strict";
    $('.next').click(function () { $('#postsCarousel').carousel('next'); return false; });
    $('.prev').click(function () { $('#postsCarousel').carousel('prev'); return false; });
})
    (jQuery);


setInterval(() => {
    console.log('Intentando de correr la actualización de  forma automática');
    $('#postsCarousel').carousel('next'); return false;
}, 8000);