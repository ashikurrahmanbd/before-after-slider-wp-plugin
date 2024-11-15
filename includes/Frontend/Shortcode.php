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

            'id'    => '',

        ), $atts, 'pxls-bas' );

        $slider_id = $atts['id'];

        $before_image = get_post_meta($slider_id, '_pxls_bas_metx_box_before_image', true);

        $after_image = get_post_meta($slider_id, '_pxls_bas_metx_box_after_image', true);

        ob_start();

        ?>
        

        <div id="beer-slider" class="beer-slider" data-beer-label="before">
            <img src="<?php echo $before_image; ?>" alt="Original - Man holding beer">
            <div class="beer-reveal" data-beer-label="after">
                <img src="<?php echo $after_image; ?>" alt="Processed - Man holding beer">
            </div>
        </div>


        <?php

        return ob_get_clean();
        
    }


}