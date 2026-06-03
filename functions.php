<?php
/*
 * This is the child theme for GeneratePress theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action( 'wp_enqueue_scripts', 'nystringacademy_enqueue_styles' );
function nystringacademy_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
        wp_enqueue_style(
            'child-custom-style',
            get_stylesheet_directory_uri() . '/css/customstyle.css',
            array()
        );
         wp_enqueue_style(
            'slick-style',
            get_stylesheet_directory_uri() . '/css/slick.css',
            array()
        );
          wp_enqueue_style(
            'owl-style',
            get_stylesheet_directory_uri() . '/css/owl-carousel.css',
            array()
        );
        
         // Bootstrap CSS
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        array(),
        '5.3.3'
    );

    // Bootstrap JS (bundle includes Popper)
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        array(),
        '5.3.3',
        true
    );
    wp_enqueue_style(
        'fa',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        array(),
        null
    );

}
function load_custom_js() {
    wp_enqueue_script(
        'custom-js',
        get_stylesheet_directory_uri() . '/js/custom.js',
        array('jquery'),   
        '1.0',
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

}
add_action('wp_enqueue_scripts', 'load_custom_js');

/*
 * Your code goes below
 */