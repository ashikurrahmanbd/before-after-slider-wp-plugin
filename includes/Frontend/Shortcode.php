<?php 

namespace Pixelese\Bas\Frontend;

class Shortcode {

    function __construct() {

        add_shortcode( 'pxls-bas', [$this, 'render_shortcode'] );

    }


    /**
     * Summary of render_shortcode
     * 
     * @param  $atts array
     * @param  $content string
     * 
     * @return string
     */
    public function render_shortcode($atts, $content = null){

        $atts = shortcode_atts( array(

            'attribute_name'    => 'default_value',

        ), $atts, 'pxls-bas' );

        ob_start();
        ?>


        


        <?php

        return ob_get_clean();
        
    }


}