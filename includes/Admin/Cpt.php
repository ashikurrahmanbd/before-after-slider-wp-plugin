<?php

namespace Pixelese\Bas\Admin;

class Cpt {

    public function __construct(){

        add_action( 'init', [$this, 'pxls_bas_post_type_register']);

        add_action('add_meta_boxes', [$this, 'pxls_bas_cpt_metaboxes']);

        add_action( 'save_post', [$this, 'pxls_bas_save_before_after_image'] );

    

        add_filter( 'post_row_actions', [$this, 'pxls_bas_remove_row_actions'] );

    }

    public function pxls_bas_post_type_register(){

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

     public function pxls_bas_cpt_metaboxes() {

        // Before Image Meta Box
        add_meta_box(
            'pxls_bas_before_image_meta_box',
            'Before Image',
            [$this, 'pxls_bas_before_image_meta_box_callback'],
            'pxls-bas',
            'normal',
            'default'
        );


        //After Image MetaBox
        add_meta_box(
            'pxls_bas_after_image_meta_box',
            'After Image',
            [$this, 'pxls_bas_after_image_meta_box_callback'],
            'pxls-bas',
            'normal',
            'default'
        );

        //metabox for shortcode generation.
        add_meta_box( 

            'pxls_bas_shortcode_meta_box', 
            'Shortcode', 
            function($post){

                echo '<code class="pxls-bas-shortcode"> <strong> [pxls-bas id="' . esc_attr( $post->ID ) . '"] </strong> </code>';

            }, 
            'pxls-bas', 
            'side', 
            'default', 
            
        );

    }
    
    /**
     * Metabox callback for Before Image
     */
    public function pxls_bas_before_image_meta_box_callback($post) {

        wp_nonce_field('pxls_bas_before_image_meta_box_data_action', 'pxls_bas_before_image_meta_box_nonce');
    
        $image_url = get_post_meta($post->ID, '_pxls_bas_metx_box_before_image', true);
    
        ?>
        <?php if( ! empty( $image_url ) ) : ?>
        <div class="pxls-bas-image-wrap-before">
            <?php //phpcs:disable PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage ?>
            <img src="<?php echo esc_url($image_url); ?>" alt="" style="max-width: 100%; display: <?php echo $image_url ? 'block' : 'none'; ?> margin-bottom: 6px;">

        </div>
        <?php endif; ?>
    
        <input type="hidden" name="pxls_bas_metx_box_before_image" id="pxls_bas_meta_box_before_image" value="<?php echo esc_attr($image_url); ?>" />
    
        <button type="button" class="before-image-upload-button button" data-target="before">Upload Image</button>
        <button type="button" class="remove-image-button button" data-target="before" style="display: <?php echo $image_url ? 'inline-block' : 'none'; ?>;">Remove Image</button>
        <?php
    }
    
    /**
     * Save the Before Image Meta Data
     */
    public function pxls_bas_save_before_after_image($post_id) {

        // Check the nonce for security

        // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Nonces should not be sanitized.
        if (!isset(
            $_POST['pxls_bas_before_image_meta_box_nonce']) ||
            // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Nonces should not be sanitized.
            !wp_verify_nonce(wp_unslash( $_POST['pxls_bas_before_image_meta_box_nonce'] ), 'pxls_bas_before_image_meta_box_data_action')) {

            return;

        }
    
        // Check for autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
    
        // Check user permissions
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    
        // Save the before image URL
        if (isset($_POST['pxls_bas_metx_box_before_image'])) {

            update_post_meta($post_id, '_pxls_bas_metx_box_before_image', esc_url_raw(wp_unslash( $_POST['pxls_bas_metx_box_before_image'] )));

        } else {

            delete_post_meta($post_id, '_pxls_bas_metx_box_before_image');

        }


        // Save the after image URL
        if (isset($_POST['pxls_bas_metx_box_after_image'])) {

            update_post_meta($post_id, '_pxls_bas_metx_box_after_image', esc_url_raw( wp_unslash( $_POST['pxls_bas_metx_box_after_image'] ) ));

        } else {

            delete_post_meta($post_id, '_pxls_bas_metx_box_after_image');

        }


    }


    // End of Metabox functionalty with saving for Before image
  
    public function pxls_bas_after_image_meta_box_callback($post){

        wp_nonce_field('pxls_bas_after_image_meta_box_data_action', 'pxls_bas_after_image_meta_box_nonce');
    
        //phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
        $image_url = get_post_meta($post->ID, '_pxls_bas_metx_box_after_image', true);
    
        ?>
        <div class="pxls-bas-image-wrap-after">
            <!-- phpcs:disable PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage -->
            <img src="<?php echo esc_url($image_url); ?>" alt="" style="max-width: 100%; display: <?php echo $image_url ? 'block' : 'none'; ?> margin-bottom: 6px;">
        </div>
    
        <input type="hidden" name="pxls_bas_metx_box_after_image" id="pxls_bas_meta_box_after_image" value="<?php echo esc_attr($image_url); ?>" />
    
        <button type="button" class="after-image-upload-button button" data-target="after">Upload Image</button>
        <button type="button" class="remove-image-button-after button" data-target="after" style="display: <?php echo $image_url ? 'inline-block' : 'none'; ?>;">Remove Image</button>
        <?php


    }


    //Remove view from the action
    public function pxls_bas_remove_row_actions($action){

        unset($action['view']);

        return $action;
    }
   

  
    
    


}