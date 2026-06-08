<?php
/*
 * This is the child theme for GeneratePress theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action( 'wp_enqueue_scripts', 'nystringacademy_enqueue_styles' );
function nystringacademy_enqueue_styles() {
         // Bootstrap CSS
        wp_enqueue_style(
            'bootstrap-css',
            '//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
            array(),
            '5.3.3'
        );

         wp_enqueue_style(
            'fa',
            '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
            array(),
            null
         );

        wp_enqueue_style(
            'animate-style',
            get_stylesheet_directory_uri() . '/css/animate.css',
            array()
        );

        wp_enqueue_style(
            'owl-carousel',
            get_stylesheet_directory_uri() . '/css/owl-carousel.css',
            array()
        );

        wp_enqueue_style(
            'slick-style',
            get_stylesheet_directory_uri() . '/css/slick.css',
            array()
        );

        wp_enqueue_style(
            'magnific-style',
            get_stylesheet_directory_uri() . '/css/magnific-popup.css',
            array()
        );

         wp_enqueue_style(
            'off-canvas-style',
            get_stylesheet_directory_uri() . '/css/off-canvas.css',
            array()
        );

        wp_enqueue_style(
            'rsmenu-main-style',
            get_stylesheet_directory_uri() . '/css/rsmenu-main.css',
            array()
        );

         wp_enqueue_style(
            'rsmenu-transitions-style',
            get_stylesheet_directory_uri() . '/css/rsmenu-transitions.css',
            array( 'rsmenu-main-style' )
        );

        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        
        // wp_enqueue_style( 'child-style',
        //     get_stylesheet_directory_uri() . '/style.css',
        //     array('parent-style')
        // );

        wp_enqueue_style(
            'child-custom-style',
            get_stylesheet_directory_uri() . '/css/customstyle.css',
            array( 'parent-style', 'child-style', 'slick-style', 'animate-style', 'rsmenu-main-style', 'rsmenu-transitions-style', 'off-canvas-style', 'bootstrap-css', 'fa', 'generate-style' )
        );
        wp_enqueue_style(
            'responsive-style',
            get_stylesheet_directory_uri() . '/css/responsive.css',
            array( 'child-custom-style' )
        );
        
        
   
   
   

}
function load_custom_js() {
    // Bootstrap JS
    wp_enqueue_script(
        'bootstrap-js',
        '//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js',
        array(),
        '5.3.3',
        true
    );

    wp_enqueue_script(
        'owl-js',
        get_stylesheet_directory_uri() . '/js/owl-carousel-min.js',
        array('jquery'),   
        '1.0',
        true       
    );
        wp_enqueue_script(
        'slick-js',
        get_stylesheet_directory_uri() . '/js/slick-min.js',
        array('jquery'),
        '1.0',
        true
    );

    if ( is_single() ) {
        wp_enqueue_script(
            'viewimageresize',
            get_stylesheet_directory_uri() . '/js/viewimageresize.js',
            array('jquery'),
            '1.0',
            true
        );
    }

    wp_enqueue_script(
        'magnific-popup',
        '//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js',
        array('jquery'),
        '1.1.0',
        true
    );

    wp_enqueue_script(
        'rsmenu-main-js',
        get_stylesheet_directory_uri() . '/js/rsmenu-main.js',
        array('jquery'),
        '1.0',
        true
    );

     wp_enqueue_script(
        'custom-js',
        get_stylesheet_directory_uri() . '/js/custom.js',
        array('jquery'),   
        '1.0',
        true       
    );

}
add_action('wp_enqueue_scripts', 'load_custom_js');

/*
 * Your code goes below
 */

require_once get_stylesheet_directory() . '/inc/nav-walker.php';