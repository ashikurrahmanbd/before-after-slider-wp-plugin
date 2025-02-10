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

        $before_after_tag_bg_color = get_option( 'pxls_bas_bf_bg_color');

        ob_start();

        ?>

        <style>
            .beer-reveal[data-beer-label]:after, .beer-slider[data-beer-label]:after{

            }
        </style>
        
        <?php if ( !empty( $before_image ) ): ?>
        <div id="beer-slider" class="beer-slider" data-beer-label="before">

            <img src="<?php echo esc_url( $before_image ) ; ?>" alt="Original - Man holding beer">
            <div class="beer-reveal" data-beer-label="after">
                <img src="<?php echo esc_url( $after_image ) ; ?>" alt="Processed - Man holding beer">
            </div>
            
        </div>
        <?php else: ?>
            
            <div id="beer-slider" class="beer-slider">

                <h5 style="color: #ffcc00;"><?php echo esc_attr__( 'Please setup your before Image to see the View', 'pixelese-before-after-slider' ) ?></h5>

            </div>

        <?php endif; ?>


        <?php

        return ob_get_clean();
        
    }


}