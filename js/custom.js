jQuery(document).ready(function ($) {

    // sticky menu
    var header = $('.menu-sticky');
    var win = $(window);
    if (header.length) {
        win.on('scroll', function () {
            var scroll = win.scrollTop();
            if (scroll < 300) {
                header.removeClass("sticky");
            } else {
                header.addClass("sticky");
            }
        });
    }

    // Latest News Slider
    if ($('.latest-news-slider').length) {
        $('.latest-news-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: false,
            asNavFor: '.latest-news-nav'
        });
    }

    if ($('.latest-news-nav').length) {
        $('.latest-news-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.latest-news-slider',
            dots: false,
            centerMode: false,
            centerPadding: '0',
            focusOnSelect: true
        });
    }

    // RS menu mobile behaviour on load
    $(window).on('load', function () {
        if ($(window).width() < 992) {
            if ($('.rs-menu').length) {
                $('.rs-menu').css({ height: '0', opacity: '0' });
            }
            if ($('.rs-menu-toggle').length) {
                $('.rs-menu-toggle').on('click', function () {
                    if ($('.rs-menu').length) {
                        $('.rs-menu').css('opacity', '1');
                    }
                });
            }
        }
    });

    // Home Slider (Slick)
    if ($('#home-slider').length) {
        var $homeSlider = $('#home-slider');

        $homeSlider.slick({
            infinite:       true,
            speed:          800,
            slidesToShow:   1,
            slidesToScroll: 1,
            autoplay:       true,
            autoplaySpeed:  3000,
            fade:           true,
            arrows:         true,
            dots:           false,
            adaptiveHeight: true,
            prevArrow: '<div class="owl-prev"><i class="fa fa-angle-left"></i></div>',
            nextArrow: '<div class="owl-next"><i class="fa fa-angle-right"></i></div>',
        });

        // Preserve data-animation-in/out support for slide content
        var animEnd = 'webkitAnimationEnd mozAnimationEnd animationend';
        function setAnimation($elems, dir) {
            $elems.each(function () {
                var $el = $(this), cls = 'animated ' + $el.data('animation-' + dir);
                $el.addClass(cls).one(animEnd, function () { $el.removeClass(cls); });
            });
        }
        $homeSlider.on('beforeChange', function (e, slick, cur) {
            setAnimation($('.slick-slide[data-slick-index="' + cur + '"]', this).find('[data-animation-out]'), 'out');
        });
        $homeSlider.on('afterChange', function (e, slick, cur) {
            setAnimation($('.slick-slide[data-slick-index="' + cur + '"]', this).find('[data-animation-in]'), 'in');
        });
    }

    // RS Team Slider
    if ($('#rs-team-slider').length) {
        $('#rs-team-slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 3000,
            arrows: true,
            dots: false,
            infinite: true,
            speed: 500,
            prevArrow: '<div class="owl-prev"><svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M768 903.232l-50.432 56.768L256 512l461.568-448 50.432 56.768L364.928 512z" fill="#000000" /></svg></div>',
            nextArrow: '<div class="owl-next"><svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M256 120.768L306.432 64 768 512l-461.568 448L256 903.232 659.072 512z" fill="#000000" /></svg></div>',
            responsive: [
                { breakpoint: 980, settings: { slidesToShow: 2, slidesToScroll: 1, arrows: false } },
                { breakpoint: 767, settings: { slidesToShow: 1, slidesToScroll: 1, arrows: false } }
            ]
        });
    }

    // RS Team Slider — Faculty Page
    if ($('#rs-team-slider-inside-faculty-page').length) {
        $('#rs-team-slider-inside-faculty-page').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 3000,
            arrows: true,
            dots: false,
            infinite: true,
            speed: 500,
            prevArrow: '<div class="owl-prev"><svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M768 903.232l-50.432 56.768L256 512l461.568-448 50.432 56.768L364.928 512z" fill="#000000" /></svg></div>',
            nextArrow: '<div class="owl-next"><svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M256 120.768L306.432 64 768 512l-461.568 448L256 903.232 659.072 512z" fill="#000000" /></svg></div>',
            responsive: [
                { breakpoint: 980, settings: { slidesToShow: 2, slidesToScroll: 1, arrows: false } },
                { breakpoint: 767, settings: { slidesToShow: 1, slidesToScroll: 1, arrows: false } }
            ]
        });
    }

    // Instrument Slider
    // Exposed globally so home.php can lazy-init hidden sections on first show
    window.initInstrumentSlider = function ($el) {
        if ($el.hasClass('slick-initialized')) {
            $el.slick('setPosition');
            return;
        }
        var count = $el.children().length;
        $el.slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 3000,
            arrows: count > 3,
            dots: false,
            infinite: count > 3,
            speed: 500,
            prevArrow: '<div class="owl-prev"><svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M768 903.232l-50.432 56.768L256 512l461.568-448 50.432 56.768L364.928 512z" fill="#000000" /></svg></div>',
            nextArrow: '<div class="owl-next"><svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M256 120.768L306.432 64 768 512l-461.568 448L256 903.232 659.072 512z" fill="#000000" /></svg></div>',
            responsive: [
                { breakpoint: 980, settings: { slidesToShow: 2, slidesToScroll: 1, arrows: count > 2 } },
                { breakpoint: 767, settings: { slidesToShow: 1, slidesToScroll: 1, arrows: count > 1 } }
            ]
        });
    };

    // Init all instrument sliders at page load — hidden sections use visibility:hidden so
    // Slick can still read correct widths without needing lazy init on show
    $('.instrument_slider').each(function () {
        window.initInstrumentSlider($(this));
    });

    // Single Product Slick
    if ($('.single-product').length) {
        $('.single-product').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.single-product-nav'
        });
    }

    if ($('.single-product-nav').length) {
        $('.single-product-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.single-product',
            dots: false,
            focusOnSelect: true,
            centerMode: true
        });
    }

    // YT Player
    if ($('.player').length) {
        $('.player').YTPlayer();
    }

    // Accordion active class
    if ($('.collapse.show').length) {
        $('.collapse.show').prev('.card-header').addClass('active');
    }
    if ($('#accordion, #bs-collapse, #accordion1').length) {
        $('#accordion, #bs-collapse, #accordion1')
            .on('show.bs.collapse', function (a) {
                $(a.target).prev('.card-header').addClass('active');
            })
            .on('hide.bs.collapse', function (a) {
                $(a.target).prev('.card-header').removeClass('active');
            });
    }

    // WOW animations
    if (typeof WOW !== 'undefined') {
        new WOW().init();
    }

    // Isotope grid
    if ($('.grid').length) {
        $('.grid').imagesLoaded(function () {
            var $grid = $('.grid').isotope({
                itemSelector: '.grid-item',
                percentPosition: true,
                masonry: { columnWidth: '.grid-item' }
            });
            if ($('.gridFilter').length) {
                $('.gridFilter').on('click', 'button', function () {
                    $grid.isotope({ filter: $(this).attr('data-filter') });
                });
            }
        });
    }

    // Grid filter active class
    if ($('.gridFilter button').length) {
        $('.gridFilter button').on('click', function (event) {
            event.preventDefault();
            $(this).siblings('.active').removeClass('active');
            $(this).addClass('active');
        });
    }

    // Image popup
    if ($('.image-popup').length) {
        $('.image-popup').magnificPopup({
            type: 'image',
            callbacks: {
                beforeOpen: function () {
                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure animated zoomInDown');
                }
            },
            gallery: { enabled: true }
        });
    }

    // Video popup
    if ($('.popup-youtube').length) {
        $('.popup-youtube').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    }

    // Preloader
    $(window).on('load', function () {
        if ($('.book_preload').length) {
            $('.book_preload').delay(2000).fadeOut(200);
            if ($('.book').length) {
                $('.book').on('click', function () {
                    $('.book_preload').fadeOut(200);
                });
            }
        }
    });

    // Counter Up
    if ($('.counter-number').length) {
        $('.counter-number').counterUp({
            delay: 20,
            time: 1500
        });
    }

    // Scroll to top
    var totop = $('#scrollUp');
    if (totop.length) {
        win.on('scroll', function () {
            if (win.scrollTop() > 150) {
                totop.fadeIn();
            } else {
                totop.fadeOut();
            }
        });
        totop.on('click', function () {
            $("html,body").animate({ scrollTop: 0 }, 500);
        });
    }

    // Google Map
    if ($('#googleMap').length) {
        var initialize = function () {
            var mapOptions = {
                zoom: 10,
                scrollwheel: false,
                center: new google.maps.LatLng(40.837936, -73.412551),
                styles: [{ stylers: [{ saturation: -100 }] }]
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
            new google.maps.Marker({
                position: map.getCenter(),
                animation: google.maps.Animation.BOUNCE,
                icon: 'images/map-marker.png',
                map: map
            });
        };
        google.maps.event.addDomListener(window, "load", initialize);
    }

    // Off-canvas toggle
    if ($('.toggle-btn').length) {
        $('.toggle-btn').on('click', function () {
            $(this).toggleClass('active');
            $('body').toggleClass('hidden-menu');
        });
    }

    // Canvas menu expander
    if ($('#nav-expander').length) {
        $('#nav-expander').on('click', function (e) {
            e.preventDefault();
            $('body').toggleClass('nav-expanded');
        });
    }

    if ($('#nav-close').length) {
        $('#nav-close').on('click', function (e) {
            e.preventDefault();
            $('body').removeClass('nav-expanded');
        });
    }

    // Sidebar nav accordion
    if ($('.sidebarnav_menu').length) {
        $('.sidebarnav_menu li.menu-item-has-children').on('click', function () {
            $(this).children('ul').slideToggle('slow');
        });
    }

    // Mobile menu toggle
    if (document.querySelector('.rs-menu-toggle i')) {
        document.querySelector('.rs-menu-toggle i').addEventListener('click', function () {
            document.querySelector('.rs-menu').classList.toggle('active');
        });
    }

    // Location tabs
    if (document.querySelector('#fort_div')) {
        document.querySelector('#fort_div').addEventListener('click', function () {
            document.querySelector('.fort_sec').classList.add('active');
            document.querySelector('.morris_sec').classList.remove('active');
        });
    }

    if (document.querySelector('#morris_div')) {
        document.querySelector('#morris_div').addEventListener('click', function () {
            document.querySelector('.morris_sec').classList.add('active');
            document.querySelector('.fort_sec').classList.remove('active');
        });
    }

});
