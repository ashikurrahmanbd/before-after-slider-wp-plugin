<?php 

namespace Pixelese\Beas\Frontend;

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

        $before_image = get_post_meta($slider_id, '_pxls_beas_metx_box_before_image', true);

        $after_image = get_post_meta($slider_id, '_pxls_beas_metx_box_after_image', true);

        $before_after_tag_bg_color = get_option( 'pxls_beas_bf_bg_color');

        // Get the image ID (if it's from the media library)
        $before_image_id = attachment_url_to_postid($before_image);
        $after_image_id = attachment_url_to_postid($after_image);

        ob_start();

        ?>


        
        <?php if ( !empty( $before_image ) ): ?>
        <div id="beer-slider" class="beer-slider" data-beer-label="before">
            
            
            <?php 
                if ($before_image_id) {
                    echo wp_get_attachment_image($before_image_id, 'full', false, ['alt' => 'Original - Man holding beer']);
                } else {
                    //phpcs:disable PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                    echo '<img src="' . esc_url($before_image) . '" alt="Original - Man holding beer">';
                }
            ?>

            <div class="beer-reveal" data-beer-label="after">
                
                <?php 
                    if ($after_image_id) {
                        echo wp_get_attachment_image($after_image_id, 'full', false, ['alt' => 'Processed - Man holding beer']);
                    } else {
                        //phpcs:disable PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                        echo '<img src="' . esc_url($after_image) . '" alt="Processed - Man holding beer">';
                    }
                ?>

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