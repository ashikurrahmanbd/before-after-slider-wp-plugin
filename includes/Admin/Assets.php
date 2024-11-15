<?php

namespace Pixelese\Bas\Admin;

class Assets{

    function __construct(){

        add_action( 'admin_enqueue_scripts', [$this, 'plugin_admin_assets_register']);

    }


    public function plugin_admin_assets_register(){

        global $typenow;

        $screen = get_current_screen();

    
        // Check if we are on the desired post type's page
       

            // Enqueue WordPress media library if needed
            wp_enqueue_media();
    
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
    
            wp_enqueue_style('pxls-bas-admin-style');
            wp_enqueue_script('pxls-bas-admin-script');
            
        
       
            
        


    }



    

}