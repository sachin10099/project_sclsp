// Theme JavaScript

(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

   

    $(window).on('load scroll', function() {
        if ($(window).width() == 1024) {
             // Highlight the top nav as scrolling occurs
            $('body').scrollspy({
                target: '.navbar-fixed-top',
                offset: 300
            });
        }
        else if ($(window).width() < 991) {
             // Highlight the top nav as scrolling occurs
            $('body').scrollspy({
                target: '.navbar-fixed-top',
                offset: 650
            });
        }else {
            $('body').scrollspy({
                target: '.navbar-fixed-top',
                offset: 51
            });
        }

    })

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function(){ 
            $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

})(jQuery); // End of use strict
