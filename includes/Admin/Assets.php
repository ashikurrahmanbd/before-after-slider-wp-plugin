<?php

namespace Pixelese\Beas\Admin;

class Assets{

    function __construct(){

        add_action( 'admin_enqueue_scripts', [$this, 'plugin_admin_assets_register']);

    }


    public function plugin_admin_assets_register($hook_suffix){

        global $typenow;

        $screen = get_current_screen();
       
    
        // Register and enqueue CSS and JS for admin page
        wp_register_style(
            'pxls-beas-admin-style',
            PXLS_BEAS_ASSETS . '/css/admin.css',
            [],
            filemtime( plugin_dir_path( dirname( dirname( __FILE__ ) ) ) . '/assets/css/admin.css' ) // Corrected to file's actual path
        );

        wp_register_script(
            'pxls-beas-admin-script',
            PXLS_BEAS_ASSETS . '/js/admin.js',
            ['jquery'],
            filemtime( plugin_dir_path( dirname( dirname( __FILE__ ) ) ) . '/assets/js/admin.js' ), // Corrected to file's actual path
            true
        );

        if ( is_admin() && $screen->post_type === 'pxls-beas' || is_admin() && $screen->base === 'toplevel_page_pxls-beas-settings' ) {

            // Enqueue WordPress media library if needed
            wp_enqueue_media();

            wp_enqueue_style('pxls-beas-admin-style');

            wp_enqueue_script('pxls-beas-admin-script');

            
        }

            

    }
  

}