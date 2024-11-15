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


        <div id="beer-slider" class="beer-slider" data-beer-label="before">
            <img src="https://png.pngtree.com/thumb_back/fh260/background/20230411/pngtree-nature-forest-sun-ecology-image_2256183.jpg" alt="Original - Man holding beer">
            <div class="beer-reveal" data-beer-label="after">
                <img src="https://img.freepik.com/premium-photo/wide-angle-shot-single-tree-growing-clouded-sky-sunset-surrounded-by-grass_181624-22807.jpg" alt="Processed - Man holding beer">
            </div>
        </div>


        <?php

        return ob_get_clean();
        
    }


}