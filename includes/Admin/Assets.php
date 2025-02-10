<?php

namespace Pixelese\Bas\Admin;

class Assets{

    function __construct(){

        add_action( 'admin_enqueue_scripts', [$this, 'plugin_admin_assets_register']);

        add_action('wp_head', );

    }


    public function plugin_admin_assets_register($hook_suffix){

        global $typenow;

        $screen = get_current_screen();
       
    
            // Register and enqueue CSS and JS for admin page
            wp_register_style(
                'pxls-bas-admin-style',
                PXLS_BAS_ASSETS . '/css/admin.css',
                [],
                filemtime(__FILE__) // Corrected to file's actual path
            );
    
            wp_register_script(
                'pxls-bas-admin-script',
                PXLS_BAS_ASSETS . '/js/admin.js',
                ['jquery'],
                filemtime(__FILE__), // Corrected to file's actual path
                true
            );
    
            if ( is_admin() && $screen->post_type === 'pxls-bas' || is_admin() && $screen->base === 'toplevel_page_pxls-bas-settings' ) {

                // Enqueue WordPress media library if needed
                wp_enqueue_media();

                wp_enqueue_style('pxls-bas-admin-style');

                wp_enqueue_script('pxls-bas-admin-script');

                
            }

            
            
        
       
            
        


    }



    

}