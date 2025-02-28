<?php

namespace Pixelese\Beas\Admin;

class Cpt {

    public function __construct(){

        add_action( 'init', [$this, 'pxls_beas_post_type_register']);

        add_action('add_meta_boxes', [$this, 'pxls_beas_cpt_metaboxes']);

        add_action( 'save_post', [$this, 'pxls_beas_save_before_after_image'] );

        add_filter( 'post_row_actions', [$this, 'pxls_beas_remove_row_actions'] );

    }

    public function pxls_beas_post_type_register(){

        $labels = array(

            'name'  => __('BA Sliders', 'before-after-slider-by-pixelese'),
            'singular_name' => __('BA Slider', 'before-after-slider-by-pixelese'),

            'add_new'            => __('Add New', 'before-after-slider-by-pixelese'),
            'add_new_item'       => __('Add New Slider', 'before-after-slider-by-pixelese'),
            'new_item'           => __('New Slider', 'before-after-slider-by-pixelese'),
            'edit_item'          => __('Edit Slider', 'before-after-slider-by-pixelese'),
            'view_item'          => __('View Slider', 'before-after-slider-by-pixelese'),
            'all_items'          => __('All Slider', 'before-after-slider-by-pixelese'),
            'search_items'       => __('Search Slider', 'before-after-slider-by-pixelese'),
            'parent_item_colon'  => __('Parent Slider:', 'before-after-slider-by-pixelese'),
            'not_found'          => __('No Slider found.', 'before-after-slider-by-pixelese'),
            'not_found_in_trash' => __('No Slider found in Trash.', 'before-after-slider-by-pixelese')

        );


        $args = array(

            'labels'    => $labels,
            'public'    => true,
            'show_ui'   => true,
            'show_in_menu'  => 'pxls-beas-settings',
            'capability_type'   => 'post',
            'supports'      => array('title'),
            'has_archive'   => false,
            'rewrite'  => array('slug' => 'pxls-beas')

        );

        register_post_type( 'pxls-beas', $args );

    }

    /**
     * Metaboxes for CPT
     * 
     */

     public function pxls_beas_cpt_metaboxes() {

        // Before Image Meta Box
        add_meta_box(
            'pxls_beas_before_image_meta_box',
            'Before Image',
            [$this, 'pxls_beas_before_image_meta_box_callback'],
            'pxls-beas',
            'normal',
            'default'
        );


        //After Image MetaBox
        add_meta_box(
            'pxls_beas_after_image_meta_box',
            'After Image',
            [$this, 'pxls_beas_after_image_meta_box_callback'],
            'pxls-beas',
            'normal',
            'default'
        );

        //metabox for shortcode generation.
        add_meta_box( 

            'pxls_beas_shortcode_meta_box', 
            'Shortcode', 
            function($post){

                echo '<code class="pxls-bas-shortcode"> <strong> [pxls-bas id="' . esc_attr( $post->ID ) . '"] </strong> </code>';

            }, 
            'pxls-beas', 
            'side', 
            'default', 
            
        );

    }
    
    /**
     * Metabox callback for Before Image
     */
    public function pxls_beas_before_image_meta_box_callback($post) {

        wp_nonce_field('pxls_beas_before_image_meta_box_data_action', 'pxls_beas_before_image_meta_box_nonce');
    
        $image_url = get_post_meta($post->ID, '_pxls_beas_meta_box_before_image', true);
    
        ?>
        <?php if( ! empty( $image_url ) ) : ?>
        <div class="pxls-beas-image-wrap-before">
            <?php //phpcs:disable PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage ?>
            <img src="<?php echo esc_url($image_url); ?>" alt="" style="max-width: 100%; display: <?php echo $image_url ? 'block' : 'none'; ?> margin-bottom: 6px;">

        </div>
        <?php endif; ?>
    
        <input type="hidden" name="pxls_beas_meta_box_before_image" id="pxls_beas_meta_box_before_image" value="<?php echo esc_attr($image_url); ?>" />
    
        <button type="button" class="before-image-upload-button button" data-target="before">Upload Image</button>
        <button type="button" class="remove-image-button button" data-target="before" style="display: <?php echo $image_url ? 'inline-block' : 'none'; ?>;">Remove Image</button>
        <?php
    }
    
    /**
     * Save the Before Image Meta Data
     */
    public function pxls_beas_save_before_after_image($post_id) {

        // Check the nonce for security

        
        if (!isset(
            $_POST['pxls_beas_before_image_meta_box_nonce']) ||
            
            !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['pxls_beas_before_image_meta_box_nonce'] ) ), 'pxls_beas_before_image_meta_box_data_action' )) {

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
        if (isset($_POST['pxls_beas_meta_box_before_image'])) {

            update_post_meta($post_id, '_pxls_beas_meta_box_before_image', esc_url_raw(wp_unslash( $_POST['pxls_beas_meta_box_before_image'] )));

        } else {

            delete_post_meta($post_id, '_pxls_beas_meta_box_before_image');

        }


        // Save the after image URL
        if (isset($_POST['pxls_beas_meta_box_after_image'])) {

            update_post_meta($post_id, '_pxls_beas_meta_box_after_image', esc_url_raw( wp_unslash( $_POST['pxls_beas_meta_box_after_image'] ) ));

        } else {

            delete_post_meta($post_id, '_pxls_beas_meta_box_after_image');

        }


    }
    // End of Metabox functionalty with saving for Before image
  
    public function pxls_beas_after_image_meta_box_callback($post){

        wp_nonce_field('pxls_beas_after_image_meta_box_data_action', 'pxls_beas_after_image_meta_box_nonce');
    
        //phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
        $image_url = get_post_meta($post->ID, '_pxls_beas_metx_box_after_image', true);
    
        ?>
        <div class="pxls-beas-image-wrap-after">
            <!-- phpcs:disable PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage -->
            <img src="<?php echo esc_url($image_url); ?>" alt="" style="max-width: 100%; display: <?php echo $image_url ? 'block' : 'none'; ?> margin-bottom: 6px;">
        </div>
    
        <input type="hidden" name="pxls_beas_metx_box_after_image" id="pxls_beas_meta_box_after_image" value="<?php echo esc_attr($image_url); ?>" />
    
        <button type="button" class="after-image-upload-button button" data-target="after">Upload Image</button>
        <button type="button" class="remove-image-button-after button" data-target="after" style="display: <?php echo $image_url ? 'inline-block' : 'none'; ?>;">Remove Image</button>
        <?php


    }


    //Remove view from the action
    public function pxls_beas_remove_row_actions($action){

        unset($action['view']);

        return $action;
    }
   

  
    
    


}