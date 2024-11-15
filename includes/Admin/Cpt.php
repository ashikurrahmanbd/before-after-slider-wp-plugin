<?php

namespace Pixelese\Bas\Admin;

class Cpt {

    public function __construct(){

        add_action( 'init', [$this, 'register_pxls_bas_post_type']);

        add_action('add_meta_boxes', [$this, 'pxls_bas_cpt_metaboxes']);

     

    }

    public function register_pxls_bas_post_type(){

        $labels = array(

            'name'  => __('BA Sliders', 'pixelese-before-after-slider'),
            'singular_name' => __('BA Slider', 'pixelese-before-after-slider'),

            'add_new'            => __('Add New', 'pixelese-before-after-slider'),
            'add_new_item'       => __('Add New Slider', 'pixelese-before-after-slider'),
            'new_item'           => __('New Slider', 'pixelese-before-after-slider'),
            'edit_item'          => __('Edit Slider', 'pixelese-before-after-slider'),
            'view_item'          => __('View Slider', 'pixelese-before-after-slider'),
            'all_items'          => __('All Slider', 'pixelese-before-after-slider'),
            'search_items'       => __('Search Slider', 'pixelese-before-after-slider'),
            'parent_item_colon'  => __('Parent Slider:', 'pixelese-before-after-slider'),
            'not_found'          => __('No Slider found.', 'pixelese-before-after-slider'),
            'not_found_in_trash' => __('No Slider found in Trash.', 'pixelese-before-after-slider')

        );


        $args = array(

            'labels'    => $labels,
            'public'    => true,
            'show_ui'   => true,
            'show_in_menu'  => 'pxls-bas-settings',
            'capability_type'   => 'post',
            'supports'      => array('title'),
            'has_archive'   => false

        );

        register_post_type( 'pxls-bas', $args );

    }

    /**
     * Metaboxes for CPT
     * 
     */

     public function pxls_bas_cpt_metaboxes(){

        add_meta_box('pxls_bas_before_image_meta_box', 'Before Image', [$this, 'pxls_bas_before_image_meta_box_callback'], 'pxls-bas', 'normal', 'default');

        // add_meta_box('pxls_bas_after_image_meta_box', 'After Image', [$this, 'pxls_bas_after_image_meta_box_callback'], 'pxls-bas', 'normal', 'default');

    }
    
    /**
     * Metabox callback for Before Image
     */
    public function pxls_bas_before_image_meta_box_callback($post) {

        wp_nonce_field('pxls_bas_before_image_meta_box_data_action', 'pxls_bas_before_image_meta_box_nonce');

        $image_url = get_post_meta($post->ID, 'pxls_bas_metx_box_before_image', true);

        ?>

        <div class="pxls-bas-image-wrap-before">
            

            <img src="<?php echo esc_url($image_url); ?>" alt="" style="max-width: 100%; display: <?php echo $image_url ? 'block' : 'none'; ?>">
        </div>

        <input type="hidden" name="pxls_bas_metx_box_before_image" id="pxls_bas_meta_box_before_image" value="<?php echo esc_attr($image_url); ?>" />

        <button type="button" class="before-image-upload-button button" data-target="before">Upload Image</button>

        <button type="button" class="remove-image-button button" data-target="before" style="display: <?php echo $image_url ? 'inline-block' : 'none'; ?>;">Remove Image</button>

        <?php
    }
    
   

  
    
    


}