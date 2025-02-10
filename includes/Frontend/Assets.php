<?php

namespace Pixelese\Bas\Frontend;

class Assets {

    function __construct(){

        add_action( 'wp_enqueue_scripts', [$this, 'plugin_assets_enqueue_frontend'] );

    }


    public function plugin_assets_enqueue_frontend() {

        global $post;

        wp_register_style( 'pxls-bas-min-css', PXLS_BAS_ASSETS . '/css/pxls-image-compare.min.css', null, filemtime(__FILE__));

        wp_register_style( 'pxls-frontend-css', PXLS_BAS_ASSETS . '/css/frontend.css', null, filemtime(__FILE__));

        

        wp_register_script( 'pxls-slider-min-js', PXLS_BAS_ASSETS . '/js/pxls-image-compare.min.js', array('jquery'), filemtime(__FILE__), true);

        wp_register_script( 'pxls-bas-script', PXLS_BAS_ASSETS . '/js/main.js', array('jquery'), filemtime(__FILE__), true);   


        if ( is_singular() && has_shortcode( $post->post_content, 'pxls-bas' ) ) {

            wp_enqueue_style( 'pxls-bas-min-css' );

            wp_enqueue_style( 'pxls-frontend-css' );
            

            wp_enqueue_script( 'pxls-slider-min-js' );

            wp_enqueue_script( 'pxls-bas-script' );

    

        }

        

    }



}