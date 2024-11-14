<?php

namespace Pixelese\Bas\Frontend;

class Assets {

    function __construct(){

        add_action( 'wp_enqueue_scripts', [$this, 'plugin_assets_enqueue'] );

    }


    public function plugin_assets_enqueue() {

        global $post;

        wp_register_style( 'cndk-bas-css', PXLS_BAS_ASSETS . '/css/cndk.beforeafter.css', [], filemtime(__FILE__));

        wp_register_script( 'cndk-bas-script', PXLS_BAS_ASSETS . '/js/cndk.beforeafter.js', [], filemtime(__FILE__), true);

        if ( is_singular() && has_shortcode( $post->post_content, 'pxls-bas' ) ) {

            wp_enqueue_style( 'cndk-bas-css' );

            wp_enqueue_script( 'cndk-bas-script' );

        }

        



    }

}