$(document).ready(function() {
    // Theme JavaScript

    (function($) {
        // Tab JS
        $('ul.nav.nav-tabs  a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // Scroll JS..
        $(window).on('load resize', function() {
            var a = $(window).width();
            if (a <= 1025) {
                $('.custom-scroll-box').mCustomScrollbar('destroy')({
                    axis: "y" // vertical scrollbar
                });
            }
        });

        $('.service-slider').owlCarousel({
            loop: true,
            nav: false,
            dots: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })

        // WOW Animate Js..

        wow = new WOW({
            boxClass: 'wow', // default
            animateClass: 'animated', // default
            offset: 0, // default
            mobile: true, // default
            live: true // default
        })
        wow.init();
    })(jQuery);

    // Parallax effect 

    $(document).ready(function() {
        var scene = document.getElementById('bannerParallaxEffect');
        var parallaxInstance = new Parallax(scene, {

        });
    });

    // Upload JS....

    $(document).on("click", ".browse", function() {
        var file = $(this)
            .parent()
            .parent()
            .parent()
            .find(".file");
        file.trigger("click");
    });
    $(document).on("change", ".file", function() {
        $(this)
            .parent()
            .find(".form-control")
            .val(
                $(this)
                .val()
                .replace(/C:\\fakepath\\/i, "")
            );
    });


});