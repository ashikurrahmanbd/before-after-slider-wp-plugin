<?php

namespace Pixelese\Bas\Admin;

class Cpt {

    public function __construct(){

        add_action( 'init', [$this, 'register_pxls_bas_post_type']);

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

}