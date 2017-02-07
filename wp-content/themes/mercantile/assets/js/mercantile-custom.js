jQuery(document).ready(function($){
    var at_window = $(window);

    at_window.on("load", function() {
        $('.acme-owl-carausel').show().owlCarousel({
            autoPlay : true,
            navigation : true, // Show next and prev buttons
            pagination : false, // Show next and prev buttons
            slideSpeed : 600,
            paginationSpeed : 600,
            singleItem:true,
            navigationText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
            addClassActive: true
        });
        /*parallax scolling*/
        $('a[href*="#"]').click(function(event){
            $('html, body').animate({
                scrollTop: $( $.attr(this, 'href') ).offset().top-$('.at-navbar').height()
            }, 1000);
            event.preventDefault();
        });
        /*bootstrap sroolpy*/
        $("body").scrollspy({target: ".navbar-fixed-top", offset: $('.at-navbar').height()+50 } );

        /*parallax*/
        function mercantile_parallax_fixed(){
            var is_iPad = navigator.userAgent.match(/iPad/i) != null;
            if ( is_iPad ){
                jQuery('.at-parallax,.inner-main-title').each(function() {
                    jQuery(this).css('background-attachment','');
                });
            }
            else{
                if ( at_window.width() > 767) {
                    jQuery('.at-parallax,.inner-main-title').each(function() {
                        jQuery(this).parallax('center', 0.2, true);
                        jQuery(this).css('background-attachment','fixed');
                    });
                }
                else{
                    jQuery('.at-parallax,.inner-main-title').each(function() {
                        jQuery(this).css('background-attachment','');
                    });
                }
            }
        }
        mercantile_parallax_fixed();
        // disable skrollr if the window is resized below 768px wide
        at_window.on('resize', function () {
            mercantile_parallax_fixed();
        });
    });

    function mercantile_stickyMenu() {

        var scrollTop = at_window.scrollTop();
        var offset = 20;

        if ( scrollTop > offset ) {
            $('.mercantile-sticky').addClass('navbar-fixed-top ');
            $('.sm-up-container').show();
        }
        else {
            $('.mercantile-sticky').removeClass('navbar-fixed-top ');
            $('.sm-up-container').hide();
        }
    }
    //What happen on window scroll
    mercantile_stickyMenu();
    at_window.on("scroll", function (e) {
        setTimeout(function () {
            mercantile_stickyMenu();
        }, 300)
    });
    
    //show hide search
    $('.search-wrap .search-icon').on('click', function() {
        $('.search-wrap .search-block').toggleClass('active');
    });

});

/*animation with wow*/
mercantile_wow = new WOW({
        boxClass: 'init-animate',
        animateClass: 'animated' // default
    }
);
mercantile_wow.init();